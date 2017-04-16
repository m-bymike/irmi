<?php

namespace Irma\Console\Commands;

use Carbon\Carbon;
use Irma\Aircraft;
use Irma\Member;
use Irma\Services\Irma\DataTypes\Reservation;
use Irma\Services\IrmaClient;
use Illuminate\Console\Command;

class ScrapeReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'irma:scrape:reservations {--u|userId=} {from} {to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download & update member list';

    /**
     * Execute the console command.
     *
     * @param IrmaClient $client
     *
     * @return mixed
     */
    public function handle(IrmaClient $client)
    {
        $user = $this->option('userId');
        $pw = env('IRMA_PASSWORD');
        $pw = $pw ? $pw : $this->secret('password');

        $this->info(' > login');
        $client->login($user, $pw);

        $from = Carbon::parse($this->argument('from'));
        $to = Carbon::parse($this->argument('to'));

        $this->info(' > fetch reservations');
        $irmaReservations = $client->getReservations($from, $to);

        $this->info(' > update database');
        $bar = $this->output->createProgressBar($irmaReservations->count());
        $bar->setFormat('verbose');

        $irmaReservations->each(function (Reservation $irmaReservation) use ($bar) {
            $aircraft = Aircraft::firstOrCreate(
                ['callsign' => $irmaReservation->getCallsign()->toString()],
                ['type' => '?']
            );

            $member = Member::where('irma_id', $irmaReservation->getUserId())->first();

            \Irma\Reservation::updateOrCreate(
                ['irma_id' => $irmaReservation->getIrmaId()],
                [
                    'aircraft_id' => $aircraft->id,
                    'start' => $irmaReservation->getStart(),
                    'end' => $irmaReservation->getEnd(),
                    'member_id' => $member ? $member->id : null,
                    'type' => $this->mapType($irmaReservation->getType()),
                ]
            );

            $bar->advance();
        });

        // TODO soft delete leftovers

        $this->info('');

        return 0;
    }

    private function mapType($type) : int
    {
        switch ($type) {
            case Reservation::TYPE_BLOCKED:
                return \Irma\Reservation::TYPE_BLOCKER;

            case Reservation::TYPE_RESERVATION:
            default:
                return \Irma\Reservation::TYPE_RESERVATION;

        }
    }
}
