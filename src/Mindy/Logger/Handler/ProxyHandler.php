<?php

namespace Mindy\Logger\Handler;

use Mindy\Helper\Traits\Accessors;
use Mindy\Helper\Traits\Configurator;
use Monolog\Logger;

/**
 * Class ProxyHandler
 * @package Mindy\Logger
 */
abstract class ProxyHandler
{
    use Accessors, Configurator;

    public $name;
    public $level;
    public $bubble = true;
    public $handler;

    public function init()
    {
        $this->handler = $this->getHandler();
    }

    abstract public function getHandler();

    public function __call($name, $args)
    {
        return call_user_func_array([$this->handler, $name], $args);
    }

    public function getLevel()
    {
        switch ($this->level) {
            case "DEBUG":
                $level = Logger::DEBUG;
                break;
            case "NOTICE":
                $level = Logger::NOTICE;
                break;
            case "WARNING":
                $level = Logger::WARNING;
                break;
            case "ERROR":
                $level = Logger::ERROR;
                break;
            case "CRITICAL":
                $level = Logger::CRITICAL;
                break;
            case "ALERT":
                $level = Logger::ALERT;
                break;
            case "EMERGENCY":
                $level = Logger::EMERGENCY;
                break;
            case "INFO":
            default:
                $level = Logger::INFO;
                break;
        }
        return $level;
    }
}
