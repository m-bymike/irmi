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
use Irma\DataTypes\Callsign;
use Irma\DataTypes\Reservation;
use Irma\DataTypes\ReservationCollection;
use Symfony\Component\DomCrawler\Crawler;

class IrmaClient
{
    private $baseUri = 'http://213.143.105.34/irma';

    private $loginUrl = 'login.php';

    private $reportUrl = 'reports.php';

    private $loggedIn = false;

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
     * @param int    $userId
     * @param string $pw
     *
     * @return bool
     */
    public function login(int $userId, string $pw) : bool
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
            'astartDate' => $from->format('d.m.Y'),
            'astopDate' => $to->format('d.m.Y'),
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

            $jsString = (string) $cols->eq(5)->filter('a')->attr('href');
            if (preg_match('/user_info.php\?user=(\d+)\'/', $jsString, $matches) === 1) {
                $userId = (int) $matches[1];
            } else {
                $userId = 0;
            }

            return new Reservation(
                Callsign::createFromString($cols->eq(0)->text()),
                Carbon::createFromFormat('d.m.y H:i', $cols->eq(1)->text(), 'Europe/Vienna'),
                Carbon::createFromFormat('d.m.y H:i', $cols->eq(2)->text(), 'Europe/Vienna'),
                $userId
            );
        });

        return ReservationCollection::make(array_filter($values));
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
