<?php

namespace Drupal\random_depen\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\StringTranslation\StringTranslationTrait;

class RandomController extends ControllerBase {
    use StringTranslationTrait;

    /**
     * Displays a page with a translated message.
     *
     * @return array
     *   A render array.
     */
    public function content() {
        $message = $this->t('Hello, World!');
        return [
            '#markup' => $message,
        ];
    }
}
