<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;

class SeedDomains extends Command
{

    protected $signature = 'seed:domains {--domain=*} {--seeder=}';
    protected $description = 'Run seederd for all domains, a specific domain or a specific seeder.';

    public function handle()
    {
        $domains = $this->option('domain');
        $specificSeeder = $this->option('seeder');
        $domainsPath = app_path('Domains'); // get the path to the application folder and then to the Domains directory

        $this->info('Starting the seeding Process');

        // Seeders within a domain

        if (!empty($specificSeeder) && !empty($domains)) {
            // Run specific seeders
            $this->runSpecificSeeder($specificSeeder, $domains[0]);
            return;
        }

        if (!empty($domains)) {
            foreach ($domains as $domain) {
                // Run seeders for domains
                $this->runSeedersForDomain($domain);
            }
            return;
        }


        // Running all seeders
        $this->info('Running All Seeders');
        // @return an array containing the matched files/directories, an empty array if no file matched or false on error.
        $domainDirectories = glob($domainsPath . '/*/Database/seeders');

        if (empty($domainDirectories)) {
            $this->info('No seeder directories found');
            return;
        }

        foreach ($domainDirectories as $seederPath) {
            if (is_dir($seederPath)) {
                $domain = basename(dirname(dirname($seederPath))); // Get the domain name from the path
                $this->runSeedersForDomain($domain);
            }
        }

        $this->info('Finished seeding domains');
    }

    protected function runSeedersForDomain($domain)
    {
        $seederPath = app_path("Domains/{$domain}/Database/seeders");
        $this->info("Running seeder for the '{$domain}' domain. ");

        if (!is_dir($seederPath)) {
            $this->error('No seeder directory for this domain');
            return;
        }

        $namespace = "App\\Domains\\{$domain}\\Database\\seeders\\";
        $seeders = glob($seederPath . '/*.php'); // get all files in this namespace directory


        foreach ($seeders as $seeder) {
            $seederClass = $namespace . pathinfo($seeder, PATHINFO_FILENAME); // Returns the path to the specific seeder
            $this->info($seederClass);
            $this->call('db:seed', ['--class' => $seederClass]);
            $this->line("Seeded: " . $seederClass);
        }
    }

    protected function runSpecificSeeder($seeder, $domain)
    {
        // Passing the seeder class and the doamin to be seeded

        // Still need to get the relative path of the seeder 

        $seederPath = app_path("Domains/{$domain}/Database/seeders");
        $this->info("Running the Seeder for {$seeder} in the {$domain} domain");

        if (!is_dir($seederPath)) {
            $this->error('No seeder directory for this domain');
            return;
        }

        // geting the namespace
        $namespace = "App\\Domains\\{$domain}\\Database\\seeders";
        $seedersPath = "App\\Domains\\{$domain}\\Database\\seeders\\{$seeder}";

        $seederClass = $namespace . pathinfo($seeder, PATHINFO_FILENAME);

        if (!class_exists($seederClass)) {
            $this->error("The seeder class '{$seederClass}' does not exist");
            return;
        }

        $this->call('db:seed', ['--class' => $seederClass]);
        $this->info("Seeded: " . $seederClass);
    }
}
