<?php
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    public function testCallUserApi()
    {
        $class = Mockery::mock('overload:ProcessMaker\Client\Api\UsersApi');
        $class->shouldReceive('getUsers')->once()->andReturn('ok');

        $api_config = new ProcessMaker\Client\Configuration();
        $api = new Executor\Api($api_config);
        $this->assertEquals('ok', $api->users()->getUsers());
    }

    public function testApiDoesNotExist()
    {
        $api_config = new ProcessMaker\Client\Configuration();
        $api = new Executor\Api($api_config);

        $this->expectException(BadMethodCallException::class);
        $this->assertEquals('ok', $api->foo()->getUsers());
    }
}