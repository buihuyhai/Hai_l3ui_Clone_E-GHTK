<?php

namespace Modules\Vendor\Commands\Module;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Model extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-model {name} {--module=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Model Module';

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

        $modelFolder = base_path("modules/{$module}/Models");

        if (!File::exists($modelFolder)) {
            File::makeDirectory($modelFolder, 0755, true, true);
        }
        if (File::exists($modelFolder)) {
            $modelFile = base_path("modules/Vendor/Commands/Templates/Model.stub");
            $modelContent = File::get($modelFile);
            $modelContent = str_replace("{module}", $module, $modelContent);
            $modelContent = str_replace("{name}", $name, $modelContent);
            if (!File::exists($modelFolder . '/' . $name . '.php')) {
                File::put($modelFolder . '/' . $name . '.php', $modelContent);
                return $this->info("Model Created Successfully!");
            } else {
                return $this->info("Model already exists!");
            }
        }

        return $this->error("Base Folder Module not exists!");

    }
}
