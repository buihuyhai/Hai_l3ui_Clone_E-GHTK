<?php

namespace Modules\Vendor;

use Illuminate\Support\ServiceProvider;
use Modules\Vendor\Commands\Module\Contract;
use Modules\Vendor\Commands\Module\Controller;
use Modules\Vendor\Commands\Module\Init;
use Modules\Vendor\Commands\Module\Migration;
use Modules\Vendor\Commands\Module\Model;
use Modules\Vendor\Commands\Module\Module;
use Modules\Vendor\Commands\Module\ModuleRepository;
use Modules\Vendor\Commands\Module\Repositories;
use Modules\Vendor\Commands\Module\Service;

class ModuleProvider extends ServiceProvider
{
    private $commands = [
        Controller::class,
        Migration::class,
        Model::class,
        Module::class,
        Init::class,
        ModuleRepository::class,
        Contract::class,
        Service::class,
        Repositories::class
    ];

    public function boot()
    {

    }

    public function register()
    {
        $this->commands($this->commands);
    }


}
