<?php

abstract class AbstractEntity {
    protected function formatDate($date) {
        return date('d/m/Y', strtotime($date));
    }
}
