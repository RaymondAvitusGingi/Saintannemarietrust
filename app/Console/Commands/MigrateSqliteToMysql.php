<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateSqliteToMysql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-sqlite-to-mysql';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate data from SQLite to MySQL';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting migration from SQLite to MySQL...');

        // Force SQLite connection to point to the file
        \Illuminate\Support\Facades\Config::set('database.connections.sqlite_source', [
            'driver' => 'sqlite',
            'database' => database_path('database.sqlite'),
            'prefix' => '',
        ]);

        $sqlite = \Illuminate\Support\Facades\DB::connection('sqlite_source');
        $mysql = \Illuminate\Support\Facades\DB::connection('mysql');

        // Get all tables from SQLite
        $tables = $sqlite->select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");

        // Order tables to handle foreign keys (basic approach: migrations first, then others)
        $tableNames = array_map(function ($table) {
            return $table->name;
        }, $tables);

        // Sort to ensure 'migrations' and 'users' come early if possible, or just disable FK checks
        $mysql->statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($tableNames as $tableName) {
            if ($tableName === 'migrations') {
                $this->info("Migrating table: {$tableName} (preserving schema history)");
            } else {
                $this->info("Migrating table: {$tableName}");
            }

            // Clear MySQL table first
            $mysql->table($tableName)->truncate();

            // Get data from SQLite
            $data = $sqlite->table($tableName)->get();

            // Chunk and insert into MySQL
            $data->chunk(100)->each(function ($chunk) use ($mysql, $tableName) {
                $mysql->table($tableName)->insert($chunk->map(function ($row) {
                    return (array) $row;
                })->toArray());
            });
        }

        $mysql->statement('SET FOREIGN_KEY_CHECKS=1');

        $this->info('Migration completed successfully!');
    }
}
