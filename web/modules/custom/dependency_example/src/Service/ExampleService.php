<?php

namespace Drupal\dependency_example\Service;

class ExampleService {

    /**
     * Performs an example operation.
     *
     * @param string $text
     *   The text to process.
     *
     * @return string
     *   Processed text.
     */
    public function processText($text) {
        return strtoupper($text);
    }
}
