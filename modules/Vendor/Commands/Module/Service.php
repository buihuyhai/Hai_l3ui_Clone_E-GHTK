<?php

namespace Modules\Vendor\Commands\Module;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Service extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-service {name} {--module=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Service Module';

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

        $serviceFolder = base_path("modules/{$module}/Services");
        if (File::exists($serviceFolder)) {
            $serviceFile = base_path("modules/Vendor/Commands/Templates/Service.stub");
            $serviceContent = File::get($serviceFile);
            $serviceContent = str_replace("{module}", $module, $serviceContent);
            $serviceContent = str_replace("{name}", $name, $serviceContent);
            if (!File::exists($serviceFolder . '/' . $name . '.php')) {
                File::put($serviceFolder . '/' . $name . '.php', $serviceContent);
                return $this->info("Service Created Successfully!");
            } else {
                return $this->info("Service already exists!");
            }
        }
        return $this->error("Base Folder Module not exists!");
    }
}
