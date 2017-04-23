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

namespace Irma\Services\Calendar;

use Irma\Reservation;
use Illuminate\Http\Response;
use Eluceo\iCal\Component\Event;
use Illuminate\Support\Collection;
use Eluceo\iCal\Component\Calendar;

class ICalDecorator implements CalendarFactoryInterface
{
    /**
     * @var Calendar
     */
    private $vCalendar;

    /**
     * @var string
     */
    private $vEventClass;

    /**
     * ICalDecorator constructor.
     *
     * @param Calendar $vCalendar
     * @param string   $vEventClass
     */
    public function __construct(Calendar $vCalendar, string $vEventClass = Event::class)
    {
        $this->vCalendar = $vCalendar;
        $this->vEventClass = $vEventClass;
    }

    /**
     * Add a list of reservations.
     *
     * @param Collection $collection
     *
     * @return ICalDecorator|CalendarFactoryInterface
     */
    public function addReservations(Collection $collection) : CalendarFactoryInterface
    {
        $collection->each([$this, 'addReservation']);

        return $this;
    }

    /**
     * Add a single reservation.
     *
     * @param Reservation $reservation
     *
     * @return ICalDecorator|CalendarFactoryInterface
     */
    public function addReservation(Reservation $reservation) : CalendarFactoryInterface
    {
        /** @var Event $vEvent */
        $vEvent = new $this->vEventClass();
        $vEvent
            ->setDtStart($reservation->start)
            ->setDtEnd($reservation->end)
            ->setNoTime(false)
            ->setSummary($this->makeSummary($reservation))

            // TODO add some html with a link to the reservation
            ->setDescription($reservation->remarks)
        ;

        $this->vCalendar->addComponent($vEvent);

        return $this;
    }

    /**
     * Create a summary from the reservation.
     *
     * @param Reservation $reservation
     *
     * @return string
     */
    protected function makeSummary(Reservation $reservation) : string
    {
        $summary = $reservation->aircraft->callsign;

        if (!empty($reservation->remarks)) {
            $summary .= str_limit($reservation->remarks, 30);
            $summary .= strlen($reservation->remarks) > 30 ? ' ...' : '';
        }

        return $summary;
    }

    /**
     * Render the calendar as ICal.
     *
     * @return string
     */
    public function render() : string
    {
        return $this->vCalendar->render();
    }

    /**
     * @param Response $response
     * @param string   $filename
     *
     * @return Response
     */
    public function applyTo(Response $response, string $filename = 'irma.ics') : Response
    {
        $response->header('Content-Type', 'text/calendar; charset=utf-8');
        $response->header('Content-Disposition', "attachment; filename=\"{$filename}\"");
        $response->setContent($this->render());

        return $response;
    }
}
