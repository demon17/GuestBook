<?php
namespace Core;

abstract class Controller {
    protected $route_params = [];

    public function __construct($route_params) {
        $this->route_params = $route_params;
    }

    public function __call($name, $args) {
        $method = $name . 'Action';

        if(method_exists($this,$method)) {
                call_user_func_array([$this,$method],$args);
        }
        else {
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }

    }

    //redeclare these methods in specific controllers
    protected function before() {
        //action to be executed before
    }

    protected function after() {
        //action to be executed after
    }
}
?>