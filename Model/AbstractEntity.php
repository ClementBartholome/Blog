<?php

abstract class AbstractEntity {

    // Hydration method to populate object properties from an array
    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            // Create the setter method name based on the property name
            $method = 'set' . ucfirst($key);
            // Check if the setter method exists in the class
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
}
