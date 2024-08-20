<?php

namespace Modules\Vendor\Commands\Module;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Contract extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-contract {name} {--module=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Contract Module';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $name = $this->argument("name");
        $module = $this->option("module");

        if (!File::exists(base_path("modules/{$module}"))) {
            return $this->error("Module not exists!");
        }

        $repositoryFolder = base_path("modules/{$module}/Repositories");

        if (!File::exists($repositoryFolder)) {

            File::makeDirectory($repositoryFolder, 0755, true, true);

        }

        $contractFolder = base_path("modules/{$module}/Repositories/Contracts");

        if (!File::exists($contractFolder)) {

            File::makeDirectory($contractFolder, 0755, true, true);

        }

        $moduleRepositoryInterfaceFile = base_path("modules/{$module}/Repositories/Contracts/{$name}.php");

        if (!File::exists($moduleRepositoryInterfaceFile)) {

            $moduleRepositoryInterfaceFileContent = file_get_contents(base_path("modules/Vendor/Commands/Templates/ModuleRepositoryInterface.stub"));

            $moduleRepositoryInterfaceFileContent = str_replace('{module}', $module, $moduleRepositoryInterfaceFileContent);

            $moduleRepositoryInterfaceFileContent = str_replace('{name}', $name, $moduleRepositoryInterfaceFileContent);

            File::put($moduleRepositoryInterfaceFile, $moduleRepositoryInterfaceFileContent);

            return $this->info("Contract created successfully!");

        }
    }
}
