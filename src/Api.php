<?php
namespace Executor;

class Api {
    private $instances = [];

    private $client;

    private $config;

    public function __construct($config, $ssl_verify = true) {
        $this->client = new \GuzzleHttp\Client(['verify' => $ssl_verify]);
        $this->config = $config;
    }

    public function __call($name, $arguments)
    {
        if (count($arguments) > 0) {
            throw new \BadMethodCallException("Arguments should not be passed");
        }

        $class_name = $this->getClassName($name);

        if (array_key_exists($class_name, $this->instances)) {
            return $this->instances[$class_name];

        } elseif (class_exists($this->getClassName($name))) {
            $this->instances[$name] = new $class_name($this->client, $this->config);
            return $this->instances[$name];

        } else {
            throw new \BadMethodCallException("class $class_name does not exist");
        }
    }

    private function getClassName($name)
    {
        return '\\ProcessMaker\\Client\Api\\' . ucfirst($name) . "Api";
    }
}