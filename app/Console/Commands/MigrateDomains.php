<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;

class MigrateDomains extends Command
{
    protected $signature = 'migrate:domains {--domain=*} {--migrate=}';
    protected $description = 'Run migrations for all domains';

    public function handle()
    {
        $domains = $this->option('domain');
        $specificMigration = $this->option('migrate');
        $domainsPath = app_path('Domains');

        $this->info('Starting the migration process.');

        //specific migration within a domain
        if ($specificMigration) {
            $this->runSpecificMigration($specificMigration);
            return;
        }

        //Migrate specific domain
        if (!empty($domains)) {
            foreach ($domains as $domain) {
                $this->runMigrationsForDomain($domain);
            }
            return;
        }

        //All migrations
        $this->info('Starting migration for all domains');

        $this->info('Looking for domain directories in: ' . $domainsPath);

        // Make sure to search in the 'database/migrations' subdirectory of each domain
        $domainDirectories = glob($domainsPath . '/*/Database/migrations');

        if (empty($domainDirectories)) {
            $this->error('No migration directories found!');
            return;
        }

        foreach ($domainDirectories as $migrationPath) {
            if (is_dir($migrationPath)) {
                $relativePath = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $migrationPath);
                $this->info('Running migrations in: ' . $relativePath);
                $this->call('migrate', ['--path' => $relativePath]);
            } else {
                $this->error('Not a directory: ' . $migrationPath);
            }
        }

        $this->info('Finished migrating domains');
    }

    protected function runMigrationsForDomain($domain)
    {
        // Define the migration path based on the provided domain
        $migrationPaths = app_path("Domains/{$domain}/Database/migrations");
        $this->info("Running migrations for the '{$domain}' domain.");

        // Check if the migration directory exists
        if (!is_dir($migrationPaths)) {
            $this->error("The migration directory does not exist for the domain: {$domain}");
            return;
        }

        // Check for migration files in the specified directory
        $migrationFiles = glob("{$migrationPaths}/*.php");
        if (empty($migrationFiles)) {
            $this->warn("No migration files found in the '{$domain}' domain.");
            return;
        }

        // Run the migrations using the specified path
        try {
            $this->call('migrate', ['--path' => "Domains/{$domain}/Database/migrations", '--realpath' => true]);
            $this->line("Successfully migrated: " . implode(', ', array_map('basename', $migrationFiles)));
        } catch (\Exception $e) {
            $this->error("An error occurred while migrating the '{$domain}' domain: " . $e->getMessage());
        }
    }

    protected function runSpecificMigration($migrationPath)
    {
        $this->info("Running specific migration: {$migrationPath}");

        // Derive the namespace from the migration file path
        $migrationDirectory = dirname($migrationPath);
        $namespace = str_replace('/', '\\', $migrationDirectory);

        // Adjust the namespace if needed, e.g., remove "database/migrations"
        $namespace = str_replace('app\\Domains\\Dispatch\\Database\\migrations', 'App\\Domains\\Dispatch\\Database\\Migrations', $namespace);

        // Since you're using anonymous classes, no need to check for class existence
        $this->call('migrate', ['--path' => $migrationPath, '--pretend' => true]); // Use --pretend to check if it runs without executing
        $this->call('migrate', ['--path' => $migrationPath]); // Run the actual migration
        $this->line("Migrated: " . $migrationPath);
    }

}
