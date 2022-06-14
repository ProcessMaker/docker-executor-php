<?php
namespace ProcessMaker\Package\DockerExecutorPhp;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use ProcessMaker\Traits\PluginServiceProviderTrait;
use ProcessMaker\Models\ScriptExecutor;

class DockerExecutorPhpServiceProvider extends ServiceProvider
{
    use PluginServiceProviderTrait;

    const version = '1.1.0'; // Required for PluginServiceProviderTrait

    public function register()
    {
    }

    public function boot()
    {
        \Artisan::command('docker-executor-php:install', function () {
            $scriptExecutor = ScriptExecutor::install([
                'language' => 'php',
                'title' => 'PHP Executor',
                'description' => 'Default PHP Executor',
                'config' => ''
            ]);
            
            // Build the instance image. This is the same as if you were to build it from the admin UI
            \Artisan::call('processmaker:build-script-executor ' . $scriptExecutor->id);
            
        });

        $this->commands([TestDocs::class]);

        $config = [
            'name' => 'PHP',
            'runner' => 'PhpRunner',
            'mime_type' => 'application/x-php',
            'options' => ['invokerPackage' => "ProcessMaker\\Client"],
            'init_dockerfile' => [
            ],
            'package_path' => __DIR__ . '/..',
            'package_version' => self::version,
        ];
        config(['script-runners.php' => $config]);

        $this->completePluginBoot();
    }
}
