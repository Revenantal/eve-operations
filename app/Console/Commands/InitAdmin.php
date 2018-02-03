<?php

namespace App\Console\Commands;

use App\Models\Auth\Role;
use App\Models\Auth\User;
use DB;
use Illuminate\Console\Command;

class InitAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eveops:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grant Admin Role to user';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->welcome();

        $this->getIds();

        $this->askCharacterId();

        $this->goodbye();
    }

    protected function welcome()
    {
        $this->info('>> Welcome to the second and last step of the Initialization process! <<');
        $this->info('>> During this process we will make sure you can access the control panel! <<');
        if ( ! $this->confirm('Did you successfully login?', true))
        {
            throw new \RuntimeException('Login first and then run this command (eveops:admin) again!');
        }
    }

    protected function getIds()
    {
        $this->info('>> In order to get the needed information your character id is required! <<');
        $this->info('>> You can aquire this by going to your personal killboard at https://zkillboard.com. <<');
        $this->info('>> At the end of the address is the character id. Make notes of these as they will be needed. <<');
        if ( ! $this->confirm('Do you have the id?', true))
        {
            throw new \RuntimeException('Without the id we cannot grant you the admin role!');
        }
    }

    protected function askCharacterId()
    {
        $charId = $this->ask('Your Character id?');
        $user = User::where('character_id', $charId)->first();

        $user->attachRole(Role::where('name', 'Admin')->first());
    }

    protected function goodbye()
    {
        $this->info('>> The Initialization process is now complete. Login to the admin panel to customize and finalize your tool. <<');
        $this->info('>> ENJOY! <<');
    }
}
