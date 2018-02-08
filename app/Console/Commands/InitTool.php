<?php

namespace App\Console\Commands;

use App\Models\Auth\Whitelist;
use Illuminate\Console\Command;

class InitTool extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eveops:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add your corporation/alliance to the whitelist';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->welcome();

        $this->getIds();

        $this->requestWhitelistInfo();

        $this->goodbye();

        $this->call('eveops:admin');
    }

    /**
     * Display the welcome message.
     */
    protected function welcome()
    {
        $this->info('>> Welcome to the first step of the Initialization process! <<');
        $this->info('>> During this process we will make sure you can access the tool! <<');
        if ( ! $this->confirm('Do you wish to continue?', true))
        {
            throw new \RuntimeException('Without completion the tool will not work!');
        }
    }

    /**
     * Display how to obtain id's.
     */
    protected function getIds()
    {
        $this->info('>> In order to get the needed information some ids are required! <<');
        $this->info('>> You can aquire these by going to your corp and or alliance killboard at https://zkillboard.com. <<');
        $this->info('>> At the end of the address is the corp or alliance id. Make notes of these as they will be needed. <<');
        if ( ! $this->confirm('Do you have the ids?', true))
        {
            throw new \RuntimeException('Without ids the tool will not work!');
        }
    }

    /**
     * Request the Corp/Alliance details from the user.
     *
     * @return array
     */
    protected function requestWhitelistInfo()
    {
        $whitelist = new Whitelist();
        $this->info(">> Use caps where they are otherwise this won't work! <<");
            $corpName = $this->ask('Name of your Corporation?');
            $corpId = $this->ask('Your corporation id?');
            $whitelist->corporation_id = $corpId;
            $whitelist->corporation_name = $corpName;
            if ($this->confirm('Is your Corp in an Alliance?', true))
            {
                $allianceName = $this->ask('Name of your alliance?');
                $allianceId = $this->ask('Your alliance id?');

                $whitelist->alliance_id = $allianceId;
                $whitelist->alliance_name = $allianceName;
            }
        $whitelist->save();
    }

    protected function goodbye()
    {
        $this->info('>> The Whitelist process is complete. Time to login for the first time! <<');
        $this->info('>> You will now be aided in setting up the first admin account. <<');
    }
}
