<?php

namespace Modules\Core;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Hooks\BulkActionHook;
use Modules\Core\Hooks\ModuleHook;


class ModuleProvider extends ServiceProvider
{
    public function boot(Kernel $kernel)
    {

    }

    public function register()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('BulkActionHook', BulkActionHook::class);
        $loader->alias('ModuleHook', ModuleHook::class);
    }


}
