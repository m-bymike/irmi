<?php

namespace Irma\Http\Controllers;

use Carbon\Carbon;
use Irma\Member;
use Irma\Reservation;
use Illuminate\Support\Collection;
use Irma\Services\Calendar\CalendarFactoryInterface;
use Irma\User;

class ICalController extends Controller
{
    /**
     * @var CalendarFactoryInterface
     */
    private $calendarFactory;

    /**
     * ICalController constructor.
     *
     * @param CalendarFactoryInterface $calendarFactory
     */
    public function __construct(CalendarFactoryInterface $calendarFactory)
    {
        $this->calendarFactory = $calendarFactory;
    }

    public function download($calendarToken)
    {
        $user = User::where('calendar_token', $calendarToken)->first();

        if (!$user) {
            abort(404);
        }

        $from = Carbon::today()->subMonths(1);
        $to = Carbon::today()->addYear(1);

        /** @var Reservation[]|Collection $reservations */
        $reservations = Reservation::where('end', '>=',  $from)
            ->where('start', '<', $to)
            ->where('member_id', $user->member->id)
            ->get()
        ;

        $this->calendarFactory->addReservations($reservations);

        return $this->calendarFactory->applyTo(response()->make());
    }
}
