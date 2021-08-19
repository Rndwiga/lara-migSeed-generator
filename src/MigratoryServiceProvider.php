<?php

namespace Tyondo\Migratory;

use Illuminate\Database\Migrations\MigrationRepositoryInterface;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Tyondo\Migratory\Console\MigrateGenerateCommand;
use Tyondo\Migratory\Console\SeederGenerateCommand;

class MigratoryServiceProvider  extends ServiceProvider
{
    protected static $packageName = 'migratory';
    protected $providers = [];

    protected $aliases = [];

    protected $commands = [
        MigrateGenerateCommand::class,
        SeederGenerateCommand::class
    ];

    protected $defer = false;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServiceProviders();
        $this->registerAliases();
        $this->registerCommands();
        $this->registerConfigs();

        $this->app->bindIf(MigrationRepositoryInterface::class, 'migration.repository');

    }


    private function registerConfigs()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/'.self::$packageName.'.php', self::$packageName
        );
    }

    private function registerServiceProviders()
    {
        foreach ($this->providers as $provider)
        {
            $this->app->register($provider);
        }
    }
    private function registerAliases()
    {
        $loader = AliasLoader::getInstance();
        foreach ($this->aliases as $key => $alias)
        {
            $loader->alias($key, $alias);
        }
    }
    private function registerCommands(){
        $this->commands($this->commands);
    }

}
