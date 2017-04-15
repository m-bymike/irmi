<?php

namespace Irma\Console\Commands;

use Carbon\Carbon;
use Irma\Services\IrmaClient;
use Illuminate\Console\Command;
use Irma\DataTypes\Reservation;

class Scrape extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'irma:scrape {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'print reservations from irma';

    /**
     * Execute the console command.
     *
     * @param IrmaClient $client
     *
     * @return mixed
     */
    public function handle(IrmaClient $client)
    {
        $pw = $this->secret('Password');

        $this->info(' > login');
        if (!$client->login($this->argument('user') , $pw)) {
            $this->warn('  failed!');
            return 1;
        }

        $this->info(' > success');
        $this->info(' > get reservation report');

        $reservations = $client->getReservations(
            Carbon::now(),
            Carbon::now()->addWeek()
        );

        $content = $reservations->map(function (Reservation $reservation) {
            return [
                $reservation->getType(),
                $reservation->getCallsign(),
                $reservation->getStart()->toDateTimeString(),
                $reservation->getEnd()->toDateTimeString(),
                $reservation->getUserId()
            ];
        });

        $this->table(['type', 'callsign', 'from', 'to', 'user'], $content);

        return 0;
    }
}
