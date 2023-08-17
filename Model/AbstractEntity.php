<?php

abstract class AbstractEntity {
    protected function formatDate($date) {
        return date('d/m/Y', strtotime($date));
    }

    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
}
