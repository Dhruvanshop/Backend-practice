<?php

namespace Drupal\hello_world\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure settings for the Hello World module.
 */
class HelloFormSetting extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'hello_world_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['hello_world.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('hello_world.settings');

    $form['dhruv'] = [
      '#type' => 'textfield',
      '#title' => $this->t('My name'), // Use translation function
      '#default_value' => $config->get('dhruv'), // Correct config key
    ];

    return parent::buildForm($form, $form_state); // Return the parent form
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Validation logic can go here if needed
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('hello_world.settings')
      ->set('dhruv', $form_state->getValue('dhruv'))
      ->save();

    parent::submitForm($form, $form_state); // Call the parent submit method
  }

}

