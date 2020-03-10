<?php
namespace ProcessMaker\Package\DockerExecutorPhp;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use ProcessMaker\Traits\PluginServiceProviderTrait;

class DockerExecutorPhpServiceProvider extends ServiceProvider
{
    use PluginServiceProviderTrait;

    const version = '1.0.0'; // Required for PluginServiceProviderTrait

    public function register()
    {
    }

    public function boot()
    {
        // Note: `processmaker4/executor-php` is now the base image that the instance inherits from
        $image = env('SCRIPTS_PHP_IMAGE', 'processmaker4/executor-instance-php:v1.0.0');

        \Artisan::command('docker-executor-php:install', function () {
            // Restart the workers so they know about the new supported language
            \Artisan::call('horizon:terminate');

            // Build the base image that `executor-instance-php` inherits from
            system("docker build -t processmaker4/executor-php:latest " . __DIR__ . '/..');
        });

        $config = [
            'name' => 'PHP',
            'runner' => 'PhpRunner',
            'mime_type' => 'application/x-php',
            'image' => $image,
            'options' => ['invokerPackage' => "ProcessMaker\\Client"],
            'init_dockerfile' => "FROM processmaker4/executor-php:latest\nARG SDK_DIR\n",
        ];
        config(['script-runners.php' => $config]);

        $this->completePluginBoot();
    }
}
