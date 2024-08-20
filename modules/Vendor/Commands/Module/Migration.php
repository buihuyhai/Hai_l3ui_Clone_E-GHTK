<?php

namespace Modules\Vendor\Commands\Module;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class Migration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-migration {name} {--module=} {--table=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Migration Module';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $name = $this->argument("name");
        $module = $this->option("module");

        $table = $this->option("table");

        if (!File::exists(base_path("modules/{$module}"))) {
            return $this->error("Module not exists!");
        }

        $databasePath = base_path("modules/{$module}/Database");

        if (!File::exists($databasePath)) {
            File::makeDirectory($databasePath, 0755, true, true);
        }

        $migrationPath = base_path("modules/{$module}/Database/Migrations");

        if (!File::exists($migrationPath)) {
            File::makeDirectory($migrationPath, 0755, true, true);
        }

        if (strpos($name, "create_") === 0) {
            if (!$table)
                $table = preg_replace("/^create_|_table$/", '', $name);
            $migrationFile = base_path("modules/Vendor/Commands/Templates/Migration.stub");
            $migrationContent = File::get($migrationFile);
            $migrationContent = str_replace('{table}', strtolower($table), $migrationContent);

            $name = Carbon::now()->format("Y_m_d_His_") . $name;

            if (!File::exists($migrationPath . '/' . $name . '.php')) {
                File::put($migrationPath . '/' . $name . '.php', $migrationContent);

                return $this->info("Migration create successfully!");
            }
        } else {
            $migrationFile = base_path("modules/Vendor/Commands/Templates/MigrationUpdate.stub");
            $migrationContent = File::get($migrationFile);
            $migrationContent = str_replace('{table}', strtolower($table), $migrationContent);

            $name = Carbon::now()->format("Y_m_d_His_") . $name;

            if (!File::exists($migrationPath . '/' . $name . '.php')) {
                File::put($migrationPath . '/' . $name . '.php', $migrationContent);

                return $this->info("Migration update successfully!");
            }
        }
    }
}
