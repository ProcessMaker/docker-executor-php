<?php
namespace ProcessMaker\Package\DockerExecutorPhp;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use ProcessMaker\Traits\PluginServiceProviderTrait;

class DockerExecutorPhpServiceProvider extends ServiceProvider
{
    use PluginServiceProviderTrait;

    const version = '0.0.1'; // Required for PluginServiceProviderTrait

    public function register()
    {
    }

    public function boot()
    {
        $image = env('SCRIPTS_PHP_IMAGE', 'processmaker4/executor-php');
        $dockerDir = sys_get_temp_dir() . "/pm4-docker-builds/php";
        $sdkDir = $dockerDir . "/sdk";

        \Artisan::command('docker-executor-php:install', function () {
            // Restart the workers so they know about the new supported language
            \Artisan::call('horizon:terminate');
        });

        \Artisan::command('docker-executor-php:build-base', function () {
            system("docker build -t processmaker4/base-php:latest " . __DIR__ . '/..');
        });
        
        $config = [
            'name' => 'PHP',
            'runner' => 'PhpRunner',
            'mime_type' => 'application/x-php',
            'image' => $image,
            'options' => ['invokerPackage' => "ProcessMaker\\Client"],
            'init_dockerfile' => "FROM processmaker4/base-php:latest\nCOPY ./sdk /opt/pm4-sdk\nRUN composer config repositories.pm4-sdk path /opt/pm4-sdk\nRUN composer require ProcessMaker/sdk-php:@dev",
        ];
        config(['script-runners.php' => $config]);

        $this->completePluginBoot();
    }
}
