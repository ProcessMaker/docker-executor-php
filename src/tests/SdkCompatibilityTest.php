<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use ProcessMaker\Client\Api\RequestFilesApi;
use ProcessMaker\Client\Configuration;

class SdkCompatibilityTest extends TestCase
{
    public function testRequestFilesApiSerializesQueryWithGuzzle7(): void
    {
        if (!class_exists(RequestFilesApi::class)) {
            $this->markTestSkipped('The generated SDK is installed only during the executor image build.');
        }

        $configuration = new Configuration();
        $configuration->setHost('https://example.test/api/1.0');
        $api = new RequestFilesApi(new Client(), $configuration);

        $request = $api->getRequestFilesRequest(42, null, 'created_at', 'desc', 10);
        $query = $request->getUri()->getQuery();

        $this->assertSame('/api/1.0/requests/42/files', $request->getUri()->getPath());
        $this->assertStringContainsString('order_by=created_at', $query);
        $this->assertStringContainsString('order_direction=desc', $query);
        $this->assertStringContainsString('per_page=10', $query);
    }

    public function testGeneratedSdkDoesNotUseGuzzle6Functions(): void
    {
        if (!class_exists(RequestFilesApi::class)) {
            $this->markTestSkipped('The generated SDK is installed only during the executor image build.');
        }

        $reflection = new ReflectionClass(RequestFilesApi::class);
        $sdkDirectory = dirname($reflection->getFileName(), 2);
        $legacyFunctions = [
            'GuzzleHttp\\json_encode',
            'GuzzleHttp\\Psr7\\build_query',
        ];

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($sdkDirectory, FilesystemIterator::SKIP_DOTS)
        );

        foreach ($legacyFunctions as $legacyFunction) {
            foreach ($files as $file) {
                if ($file->getExtension() !== 'php') {
                    continue;
                }

                $this->assertStringNotContainsString(
                    $legacyFunction,
                    (string) file_get_contents($file->getPathname())
                );
            }
        }
    }
}
