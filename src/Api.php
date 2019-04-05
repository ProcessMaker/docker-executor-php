<?php
namespace Executor;

/**
 * This helper allows you to use Api classes in the namespace
 * ProcessMaker\Client\Api\ by calling its name as a function
 * on an instance of this class. The class name is lowercase first.
 * 
 * For example, to call \ProcessMaker\Client\Api\ProcessesApi
 * call $api->processes()
 * 
 */
class Api {

    /**
     * Reusable instances of api objects
     *
     * @var array
     */
    private $instances = [];

    /**
     * Instance of the Guzzle client
     *
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * Instance of the client configuration object
     *
     * @var \ProcessMaker\Client\Configuration
     */
    private $config;

    /**
     * Constructor
     *
     * @param \ProcessMaker\Client\Configuration $config
     * @param boolean $ssl_verify
     */
    public function __construct($config, $ssl_verify = true) {
        $this->client = new \GuzzleHttp\Client(['verify' => $ssl_verify]);
        $this->config = $config;
    }

    /**
     * Method to catch all undefined methods
     *
     * @param string $name
     * @param array $arguments
     * @return object
     */
    public function __call($name, $arguments)
    {
        if (count($arguments) > 0) {
            throw new \BadMethodCallException("Arguments should not be passed");
        }

        $class_name = $this->getClassName($name);

        if (array_key_exists($class_name, $this->instances)) {
            return $this->instances[$class_name];

        } elseif (class_exists($this->getClassName($name))) {
            $this->instances[$class_name] = new $class_name($this->client, $this->config);
            return $this->instances[$class_name];

        } else {
            throw new \BadMethodCallException("class $class_name does not exist");
        }
    }

    /**
     * Translate the called name to a real class
     *
     * @param string $name
     * @return string
     */
    private function getClassName($name)
    {
        return '\\ProcessMaker\\Client\Api\\' . ucfirst($name) . "Api";
    }
}