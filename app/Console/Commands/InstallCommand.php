<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eveops:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Easy installation';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->welcome();

        $this->createEnvFile();

        if (strlen(config('app.key')) === 0) {
            $this->call('key:generate');
            $this->line('~ Secret key properly generated.');
        }

        $this->updateEnvironmentFile($this->requestDatabaseCredentials());

        $this->create3rdParty();

        $this->updateEnvironmentFile($this->requestEveThirdPartyDetails());

        if ($this->confirm('Do you want to migrate the database?', true)) {
            $this->call('migrate');
            $this->call('db:seed');
            $this->line('~ Database successfully migrated.');
        }
        $this->call('cache:clear');

        $this->goodbye();
    }

    /**
     * Display the welcome message.
     */
    protected function welcome()
    {
        $this->info('>> Welcome to the EveOps installation process! <<');
    }

    /**
     * Create the initial .env file.
     */
    protected function createEnvFile()
    {
        if (! file_exists('.env')) {
            copy('.env.example', '.env');
            $this->line('.env file successfully created');
        }
    }

    /**
     * Update the .env file from an array of $key => $value pairs.
     *
     * @param  array $updatedValues
     * @return void
     */
    protected function updateEnvironmentFile($updatedValues)
    {
        $envFile = $this->laravel->environmentFilePath();
        foreach ($updatedValues as $key => $value) {
            file_put_contents($envFile, preg_replace(
                "/{$key}=(.*)/",
                "{$key}={$value}",
                file_get_contents($envFile)
            ));
        }
    }

    /**
     * Request the local database details from the user.
     *
     * @return array
     */
    protected function requestDatabaseCredentials()
    {
        return [
            'DB_DATABASE' => $this->ask('Database name'),
            'DB_PORT' => $this->ask('Database port', 3306),
            'DB_USERNAME' => $this->ask('Database user'),
            'DB_PASSWORD' => $this->secret('Database password ("null" for no password)'),
        ];
    }

    /**
     * Display the welcome message.
     */
    protected function create3rdParty()
    {
        $this->info('>> Head over to https://developers.eveonline.com and create a new 3rd party app. <<');
        $this->info('>> Give it a name and description. <<');
        $this->info('>> Choose Authentication Only. <<');
        $this->info('>> Set you callback URL. This is the domain the app will be running on followed by /auth/callback ( for example : https://eveops.xyz/auth/callback ) <<');
    }

    /**
     * Request the EvE Third Party App details from the user.
     *
     * @return array
     */
    protected function requestEveThirdPartyDetails()
    {
        $this->info('>> You can find these on the Eve Online Developers page! <<');
        return [
            'EVEONLINE_CLIENT_ID' => $this->ask('Client ID'),
            'EVEONLINE_CLIENT_SECRET' => $this->ask('Secret Key'),
            'EVEONLINE_REDIRECT' => $this->ask('Callback URL'),
        ];
    }

    /**
     * Display the completion message.
     */
    protected function goodbye()
    {
        $this->info('>> The installation process is complete. Enjoy your new Eve Operations Tool! <<');
    }
}
