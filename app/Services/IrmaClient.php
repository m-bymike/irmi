<?php
/**
 * ----------------------------------------------------------------------------
 * This code is part of the Sclable Business Application Development Platform
 * and is subject to the provisions of your License Agreement with
 * Sclable Business Solutions GmbH.
 *
 * @copyright (c) 2017 Sclable Business Solutions GmbH
 * ----------------------------------------------------------------------------
 */

namespace Irma\Services;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Irma\Services\Irma\DataTypes\Member;
use Symfony\Component\DomCrawler\Crawler;
use Irma\Services\Irma\DataTypes\Callsign;
use Irma\Services\Irma\DataTypes\Reservation;
use Irma\Services\Irma\DataTypes\MemberCollection;
use Irma\Services\Irma\DataTypes\ReservationCollection;

class IrmaClient
{
    private $baseUri = 'http://213.143.118.82/irma/';

    private $loginUrl = 'login.php';

    private $reportUrl = 'reports.php';

    private $loggedIn = false;

    private $irmaTimezone = 'Europe/Vienna';

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * IrmaClient constructor.
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public static function create() : IrmaClient
    {
        return new self(new Client(['cookies' => true]));
    }

    /**
     * @param string $userId
     * @param string $pw
     *
     * @return bool
     */
    public function login(string $userId, string $pw) : bool
    {
        $url = $this->baseUri . '/' . $this->loginUrl;
        $res = $this->client->request('POST', $url, [
            'form_params' => [
                'login' => 'Login',
                'UserID' => $userId,
                'pass' => $pw,
            ],
        ]);

        return $this->loggedIn = $res->getStatusCode() === 200;
    }

    /**
     * @param Carbon $from
     * @param Carbon $to
     *
     * @return ReservationCollection
     * @throws \Exception
     */
    public function getReservations(Carbon $from, Carbon $to) : ReservationCollection
    {
        $this->verifyLoggedIn();

        $url = $this->baseUri . '/' . $this->reportUrl;
        $query = [
            'astartDate' => $from->setTimezone($this->irmaTimezone)->format('d.m.Y'),
            'astopDate' => $to->setTimezone($this->irmaTimezone)->format('d.m.Y'),
            'resall' => 'Anzeigen',
        ];

        $res = $this->client->request('GET', $url, [
            'query' => $query,
        ]);

        if ($res->getStatusCode() <> 200) {
            throw new \Exception($res->getReasonPhrase());
        }

        $crawler = new Crawler((string) $res->getBody());

        $values = $crawler
            ->filter('body > table > tr')
            ->each(function (Crawler $node) {
                $cols = $node->filter('td');

                if ($cols->count() !== 10) {
                    return false;
                }

                $userId = -1;
                $type = Reservation::TYPE_BLOCKED;
                $userLink = $cols->eq(5)->filter('a');
                if ($userLink->count() > 0) {
                    $type = Reservation::TYPE_RESERVATION;
                    $jsString = (string) $userLink->attr('href');
                    if (preg_match('/user_info.php\?user=(\d+)\'/', $jsString, $matches) === 1) {
                        $userId = (int) $matches[1];
                    }
                }

                // load reservation id
                $reservationLink = $cols->eq(0)->filter('a');
                $irmaId = -1;
                if ($reservationLink->count() > 0) {
                    $jsString = (string) $reservationLink->attr('href');
                    if (preg_match('/ri.php\?id=(\d+)\'/', $jsString, $matches) === 1) {
                        $irmaId = (int) $matches[1];
                    }
                }

                if ($irmaId < 0) {
                    return false;
                }

                // create callsign
                $callsign = $cols->eq(0)->text();

                try {
                    $callsign = Callsign::createFromString($callsign);
                } catch (\InvalidArgumentException $exception) {
                    return false;
                }

                return new Reservation(
                    $callsign,
                    Carbon::createFromFormat('d.m.y H:i', $cols->eq(1)->text(), 'Europe/Vienna'),
                    Carbon::createFromFormat('d.m.y H:i', $cols->eq(2)->text(), 'Europe/Vienna'),
                    $userId,
                    $type,
                    $irmaId
                );
        });

        return ReservationCollection::make(array_filter($values));
    }

    public function getUserReservations($userId)
    {
        $this->verifyLoggedIn();

        $url = $this->baseUri . '/' . $this->reportUrl;
        $carbon = Carbon::now($this->irmaTimezone);
        $query = [
            'astartDate' => $carbon->format('d.m.Y'),
            'astopDate' => $carbon->addYear()->format('d.m.Y'),
            'yres' => 'Anzeigen',
        ];

        $res = $this->client->request('GET', $url, [
            'query' => $query,
        ]);

        if ($res->getStatusCode() <> 200) {
            throw new \Exception($res->getReasonPhrase());
        }

        $crawler = new Crawler((string) $res->getBody());

        $values = $crawler
            ->filter('body > table > tr')
            ->each(function (Crawler $node) use ($userId) {
                $cols = $node->filter('td');

                if ($cols->count() !== 9) {
                    return false;
                }

                return new Reservation(
                    Callsign::createFromString($cols->eq(0)->text()),
                    Carbon::createFromFormat('d.m.y H:i', $cols->eq(1)->text(), 'Europe/Vienna'),
                    Carbon::createFromFormat('d.m.y H:i', $cols->eq(2)->text(), 'Europe/Vienna'),
                    $userId,
                    Reservation::TYPE_RESERVATION,
                    0 // TODO
                );
            });

        return ReservationCollection::make(array_filter($values));
    }

    /**
     * @return MemberCollection|Member[]
     * @throws \Exception
     */
    public function getIrmaMembers() : MemberCollection
    {
        $this->verifyLoggedIn();

        $url = $this->baseUri . '/' . $this->reportUrl;
        $carbon = Carbon::createFromDate(1970, 01, 01, $this->irmaTimezone);
        $query = [
            'astartDate' => $carbon->format('d.m.Y'),
            'astopDate' => Carbon::now($this->irmaTimezone)->addYear()->format('d.m.Y'),
            'member' => 'Anzeigen',
        ];

        $res = $this->client->request('GET', $url, [
            'query' => $query,
        ]);

        if ($res->getStatusCode() <> 200) {
            throw new \Exception($res->getReasonPhrase());
        }

        $crawler = new Crawler(utf8_encode((string) $res->getBody()));

        $trimChars = chr(0xC2).chr(0xA0);
        $values = $crawler
            ->filter('body > table > tr')
            ->each(function (Crawler $node) use ($trimChars) {
                $cols = $node->filter('td');

                if ($cols->count() !== 3) {
                    return false;
                }

                $memberId = (int) trim((string) $cols->eq(2)->text(), $trimChars);

                if (empty($memberId) || $memberId <= 0) {
                    return false;
                }

                return new Member(
                    trim((string) $cols->eq(0)->text(), $trimChars),
                    trim((string) $cols->eq(1)->text(), $trimChars),
                    $memberId
                );
            });

        return MemberCollection::make(array_filter($values));
    }

    /**
     * @return void
     */
    private function verifyLoggedIn()
    {
        if (!$this->loggedIn === true) {
            throw new \LogicException('Must be logged in.');
        }
    }
}
