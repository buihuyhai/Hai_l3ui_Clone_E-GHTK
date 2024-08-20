<?php

namespace Modules;

use Illuminate\Support\Facades\File;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    private $middlewares = [];

    private $commands = [

    ];

    public function boot()
    {
        $modules = $this->getModules();

        foreach ($modules as $module) {
            $this->registerModule($module);
        }
        if (File::exists(__DIR__ . '/Layout')) {
            $this->loadViewsFrom(__DIR__ . '/Layout', 'Layout');
        }
    }

    public function register()
    {
        $modules = $this->getModules();

        foreach ($modules as $module) {
            $class = "\Modules\\" . ucfirst($module) . "\\ModuleProvider";
            if (class_exists($class)) {
                $this->app->register($class);
            }
            $this->registerConfig($module);
        }

        $this->registerMiddlewares();
        $this->commands($this->commands);
    }

    private function getModules()
    {
        return array_map("basename", File::directories(__DIR__));
    }

    private function registerModule($module)
    {
        $modulePath = __DIR__ . "/{$module}";

        if (File::exists($modulePath . '/Views')) {

            $this->loadViewsFrom($modulePath . '/Views', $module);
        }

        if (File::exists($modulePath . '/Lang')) {
            $this->loadTranslationsFrom($modulePath . '/Lang', $module);
            $this->loadJsonTranslationsFrom($modulePath . '/Lang');
        }

        if (File::exists($modulePath . '/Helpers')) {
            $helpers = File::allFiles($modulePath . '/Helpers');
            if (!empty($helpers)) {
                foreach ($helpers as $helper) {
                    $file = $helper->getPathname();
                    require $file;
                }
            }
        }
    }

    private function registerConfig($module)
    {
        $configPath = __DIR__ . '/' . $module . '/Configs';

        if (File::exists($configPath)) {
            $configFiles = array_map("basename", File::allFiles($configPath));

            foreach ($configFiles as $config) {
                $alias = basename($config, '.php');
                $this->mergeConfigFrom($configPath . '/' . $config, $alias);
            }
        }
    }

    private function registerMiddlewares()
    {
        if (!empty($this->middlewares)) {
            foreach ($this->middlewares as $key => $middleware) {
                $this->app['router']->pushMiddlewareToGroup($key, $middleware);
            }
        }
    }

}
