<?php

class DIContainer {
    protected $instances = [];

    public function set($key, $instance) {
        $this->instances[$key] = $instance;
    }

    public function get($key) {
        if (isset($this->instances[$key])) {
            return $this->instances[$key];
        }

        throw new Exception("No instance found for key: $key");
    }
}
?>
