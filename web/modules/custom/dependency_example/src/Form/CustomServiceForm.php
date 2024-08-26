<?php

namespace Drupal\dependency_example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\dependency_example\Service\ExampleService;
use Drupal\Core\Messenger\MessengerInterface;

class CustomServiceForm extends FormBase {

    /**
     * The example service.
     *
     * @var \Drupal\dependency_example\Service\ExampleService
     */
    protected $exampleService;

    /**
     * The messenger service.
     *
     * @var \Drupal\Core\Messenger\MessengerInterface
     */
    protected $messenger;

    /**
     * Constructs a new CustomServiceForm.
     *
     * @param \Drupal\dependency_example\Service\ExampleService $example_service
     *   The example service.
     * @param \Drupal\Core\Messenger\MessengerInterface $messenger
     *   The messenger service.
     */
    public function __construct(ExampleService $example_service, MessengerInterface $messenger) {
        $this->exampleService = $example_service;
        $this->messenger = $messenger;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container) {
        return new static(
            $container->get('dependency_example.example_service'),
            $container->get('messenger')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'custom_service_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['input_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Input Text'),
            '#required' => TRUE,
        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $input = $form_state->getValue('input_text');
        $processed_text = $this->exampleService->processText($input);

        $this->messenger->addMessage($this->t('Processed Text: %text', ['%text' => $processed_text]));
    }
}
