<?php

namespace Modules\Vendor\Commands\Module;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Init extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init Module';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $this->call("migrate:fresh");
        $this->call("db:seed");
//        $this->call("module:update");

        return $this->info("Module initialized Successfully!");
    }
}
