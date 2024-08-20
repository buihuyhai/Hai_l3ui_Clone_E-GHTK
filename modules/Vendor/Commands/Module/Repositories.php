<?php

namespace Modules\Vendor\Commands\Module;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Repositories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-repositories {name} {--module=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Repositories Module';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $name = $this->argument("name");
        $module = $this->option("module");

        if (!File::exists(base_path("modules/{$module}"))) {
            return $this->error("Module not exists!");
        }

        $repositoryFolder = base_path("modules/{$module}/Repositories");

        if (!File::exists($repositoryFolder)) {

            File::makeDirectory($repositoryFolder, 0755, true, true);

        }

        $eloquentFolder = base_path("modules/{$module}/Repositories/Eloquent");

        if (!File::exists($eloquentFolder)) {

            File::makeDirectory($eloquentFolder, 0755, true, true);

        }

        $contractFolder = base_path("modules/{$module}/Repositories/Contracts");

        if (!File::exists($contractFolder)) {

            File::makeDirectory($contractFolder, 0755, true, true);

        }

        $this->call("module:make-contract", [
            "name"     => "{$name}RepositoryInterface",
            "--module" => $module
        ]);

        $this->call("module:make-repository", [
            "name"     => "{$name}Repository",
            "--module" => $module
        ]);

    }
}
