<?php

namespace Irma\Console\Commands;

use Irma\Member;
use Irma\Services\Irma\DataTypes\Member as IrmaMember;
use Irma\Services\IrmaClient;
use Illuminate\Console\Command;

class ScrapeMembers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'irma:scrape:members {--u|userId=}';

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
        $user = env('IRMA_USER') ?: $this->option('userId');
        $pw = env('IRMA_PASSWORD');
        $pw = $pw ? $pw : $this->secret('password');

        $this->info(' > login');
        $client->login($user, $pw);

        $this->info(' > fetch members');
        $irmaMembers = $client->getIrmaMembers();

        $this->info(' > update database');
        $bar = $this->output->createProgressBar($irmaMembers->count());
        $bar->setFormat('verbose');

        $members = Member::all();
        $irmaMembers->each(function (IrmaMember $member) use ($members, $bar) {
            Member::updateOrCreate(['irma_id' => $member->getMemberId()], [
                'first_name' => $member->getFirstName(),
                'last_name' => $member->getLastName(),
            ]);

            $bar->advance();
        });

        $this->info('');

        return 0;
    }
}
