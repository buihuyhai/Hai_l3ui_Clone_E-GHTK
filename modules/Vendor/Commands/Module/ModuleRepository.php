<?php

namespace Modules\Vendor\Commands\Module;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ModuleRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-repository {name} {--module=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Repository Module';

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

        $eloquentFolder = base_path("modules/{$module}/Repositories/Eloquent");

        if (!File::exists($eloquentFolder)) {

            File::makeDirectory($eloquentFolder, 0755, true, true);

        }

        $moduleRepositoryFile = base_path("modules/{$module}/Repositories/Eloquent/{$name}.php");

        if (!File::exists($moduleRepositoryFile)) {

            $moduleRepositoryFileContent = file_get_contents(base_path('modules/Vendor/Commands/Templates/ModuleRepository.stub'));

            $moduleRepositoryFileContent = str_replace('{module}', $module, $moduleRepositoryFileContent);

            $moduleRepositoryFileContent = str_replace('{name}', $name, $moduleRepositoryFileContent);

            File::put($moduleRepositoryFile, $moduleRepositoryFileContent);

            return $this->info("Repository created successfully!");

        }
    }
}
