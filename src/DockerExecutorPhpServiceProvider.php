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
            
            // Restart the workers so they know about the new supported language
            // \Artisan::call('horizon:terminate');
        });

        $this->commands([TestDocs::class]);

        $config = [
            'name' => 'PHP',
            'runner' => 'PhpRunner',
            'mime_type' => 'application/x-php',
            'options' => ['invokerPackage' => "ProcessMaker\\Client"],
            'init_dockerfile' => [
                'ARG SDK_DIR',
                'COPY $SDK_DIR /opt/sdk-php',
                'RUN composer config repositories.sdk-php path /opt/sdk-php',
                'RUN composer require processmaker/sdk-php:@dev',
                'RUN composer require aws/aws-sdk-php'
            ],
            'package_path' => __DIR__ . '/..',
            'package_version' => self::version,
        ];
        config(['script-runners.php' => $config]);

        $this->completePluginBoot();
    }
}
