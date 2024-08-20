<?php

namespace Modules\Vendor\Commands\Module;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class Module extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Module CLI';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        $module = $this->argument("module");

        if (File::exists(base_path("modules/{$module}"))) {
            $this->error("Module already exists!");
        } else {

            File::makeDirectory(base_path("modules/{$module}"), 0755, true, true);

            $moduleProviderFile = base_path("modules/{$module}/ModuleProvider.php");
            $moduleProviderContent = str_replace("{module}", $module, File::get(base_path('modules/Vendor/Commands/Templates/ModuleProvider.stub')));
            if (!File::exists($moduleProviderFile)) {
                File::put($moduleProviderFile, $moduleProviderContent);
            }

            $routeProviderFile = base_path("modules/{$module}/RouteServiceProvider.php");
            $routeProviderContent = str_replace("{module}", $module, File::get(base_path('modules/Vendor/Commands/Templates/RouteServiceProvider.stub')));
            $routeProviderContent = str_replace('{module_lc}', strtolower($module), $routeProviderContent);
            if (!File::exists($routeProviderFile)) {
                File::put($routeProviderFile, $routeProviderContent);
            }

            $adminFolder = base_path("modules/{$module}/Admin");
            if (!File::exists($adminFolder)) {
                File::makeDirectory($adminFolder, 0755, true, true);
            }

            $controllerFolder = base_path("modules/{$module}/Controllers");
            if (!File::exists($controllerFolder)) {
                File::makeDirectory($controllerFolder, 0755, true, true);
            }

            $configFolder = base_path("modules/{$module}/Configs");
            if (!File::exists($configFolder)) {
                File::makeDirectory($configFolder, 0755, true, true);
            }

            $helperFolder = base_path("modules/{$module}/Helpers");
            if (!File::exists($helperFolder)) {
                File::makeDirectory($helperFolder, 0755, true, true);
            }

            $databaseFolder = base_path("modules/{$module}/Database");
            if (!File::exists($databaseFolder)) {
                File::makeDirectory($databaseFolder, 0755, true, true);

                $migrationsFolder = base_path("modules/{$module}/Database/Migrations");
                if (!File::exists($migrationsFolder)) {
                    File::makeDirectory($migrationsFolder, 0755, true, true);
                }

                $seedersFolder = base_path("modules/{$module}/Database/Seeders");
                if (!File::exists($seedersFolder)) {
                    File::makeDirectory($seedersFolder, 0755, true, true);
                }

            }

            $langFolder = base_path("modules/{$module}/Lang");
            if (!File::exists($langFolder)) {
                File::makeDirectory($langFolder, 0755, true, true);

                $viFolder = base_path("modules/{$module}/Lang/vi");
                if (!File::exists($viFolder)) {
                    File::makeDirectory($viFolder, 0755, true, true);
                }

                $enFolder = base_path("modules/{$module}/Lang/en");
                if (!File::exists($enFolder)) {
                    File::makeDirectory($enFolder, 0755, true, true);
                }
            }

            $modelFolder = base_path("modules/{$module}/Models");
            if (!File::exists($modelFolder)) {
                File::makeDirectory($modelFolder, 0755, true, true);
            }

            $repositoryFolder = base_path("modules/{$module}/Repositories");
            if (!File::exists($repositoryFolder)) {

                File::makeDirectory($repositoryFolder, 0755, true, true);
                //

                Artisan::call("module:make-contract", [
                    "name"     => "{$module}RepositoryInterface",
                    "--module" => $module
                ]);

                Artisan::call("module:make-repository", [
                    "name"     => "{$module}Repository",
                    "--module" => $module
                ]);

            }

            $routeFolder = base_path("modules/{$module}/Routes");
            if (!File::exists($routeFolder)) {
                File::makeDirectory($routeFolder, 0755, true, true);

                $routeWebFile = base_path("modules/{$module}/Routes/web.php");
                $routeApiFile = base_path("modules/{$module}/Routes/api.php");
                $routeAdminFile = base_path("modules/{$module}/Routes/admin.php");

                $routeContent = str_replace("{module}", strtolower($module), File::get(base_path('modules/Vendor/Commands/Templates/Route.stub')));

                if (!File::exists($routeWebFile)) {
                    File::put($routeWebFile, $routeContent);
                }
                if (!File::exists($routeApiFile)) {
                    File::put($routeApiFile, $routeContent);
                }
                if (!File::exists($routeAdminFile)) {
                    File::put($routeAdminFile, $routeContent);
                }
            }

            $viewFolder = base_path("modules/{$module}/Views");
            if (!File::exists($viewFolder)) {
                File::makeDirectory($viewFolder, 0755, true, true);

                $viewAdminFolder = base_path("modules/{$module}/Views/admin");
                if (!File::exists($viewAdminFolder)) {
                    File::makeDirectory($viewAdminFolder, 0755, true, true);
                }

                $viewFrontendFolder = base_path("modules/{$module}/Views/frontend");
                if (!File::exists($viewFrontendFolder)) {
                    File::makeDirectory($viewFrontendFolder, 0755, true, true);
                }

            }
            $this->info("Module created successfully!");
        }
    }
}
