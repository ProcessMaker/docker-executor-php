<?php

use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    const API_TOKEN = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQyN2RlODA3MzhiZWNmYzgyZGFiMDA4MTExYzQxYTFkZTM3NzYyYjg5MDYyYWQyZjcxZTAzYzAwNzk3YTc5NDBjY2U5MGFlM2IzZTE1MWE1In0.eyJhdWQiOiIxIiwianRpIjoiNDI3ZGU4MDczOGJlY2ZjODJkYWIwMDgxMTFjNDFhMWRlMzc3NjJiODkwNjJhZDJmNzFlMDNjMDA3OTdhNzk0MGNjZTkwYWUzYjNlMTUxYTUiLCJpYXQiOjE1NzkxMzY2NzQsIm5iZiI6MTU3OTEzNjY3NCwiZXhwIjoxNjEwNzU5MDc0LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.mQtWB8xclNpWMn6bpX6BnceJey8xu-IMicrzkLcbsTT9vXwvrn4e25Cbyzfahz7vwjqi10s2j7CeLJZwSkeF_k4f4uZsfJpDoTt08K1tYa_cRfpuoInP_2PhJnBIVZO2kdljJBwC3K_9gWgBzsGKS0I2fglSEycWaiIXWx5jAy8QS8hPYGPsrNG4YDTiNiUnYvbmY8c9JHbKS-yLtRZFEnkF7k-zUgSFKVz6WAwO2TcqCB_YX8RVKmnzG1KMgzXaGV-B4kCH5zdY74ZFLIwJalflTmA9jAgtaR3GsXeWqWXkxnPIIYHQdNlNONDqsJ1troo-3rH6hwZETRHKPVtrBAlR9q2k1SYRC9GUhC1otLJH0PXKiabUryIHPXC3cBavCYQ6MGEv2ou5ZfAuAAcKovWZd7-GDqwnDQxx-uMyIEiGrsZAt8EZiDFETHq1eBIGQLVezFbYhnOACYARWrMarZrQ6Q5yCKLrZ4KqIeaoJoPJOf8UJIQcpqhRAonfX_0RDLRWdbAW9ltfYkmfzWU2uJe15YqZu2wi9Bss0iGXWuRq2ASeNERgg_tkNe9ELQMxSKTx8D7tDe-g0Ja1QViLawmHK8XYDsmmKgOSMC9Xj-jd-Dg-ZjA3sMXWTEomudQyjQIBfdu68T4rGd_1lfneZAEEqtw9y2dKR7if13Fwar4';

    const API_HOST = 'http://pm.local.processmaker.com/api/1.0';

    public function testCallUserApi()
    {
        $api_config = new ProcessMaker\Client\Configuration();
        $api_config->setAccessToken(self::API_TOKEN);
        $api_config->setHost(self::API_HOST);
        $api = new Executor\Api($api_config, false);
        $this->assertEquals('ok', $api->users()->getUsers());
    }

    public function testApiDoesNotExist()
    {
        $api_config = new ProcessMaker\Client\Configuration();
        $api = new Executor\Api($api_config, false);

        $this->expectException(BadMethodCallException::class);
        $this->assertEquals('ok', $api->foo()->getUsers());
    }
}
