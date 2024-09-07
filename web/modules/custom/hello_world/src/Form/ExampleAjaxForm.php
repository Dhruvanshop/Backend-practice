<?php

namespace Drupal\hello_world\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Database\Database;

/**
 * Provides a employee form
 */

 class ExampleAjaxForm extends FormBase {

 
  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'hello_world_example_ajax';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {

    $form['element'] = [
      '#type' => 'markup',
      '#markup' => "<div class='success'></div>",
    ];

    $form['full_name'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Full Name'),
      '#required' => TRUE,
      '#maxlength' => 30,
      '#suffix' => '<div class = "error" id ="full_name"></div>',
    ];

    $form['email_id'] = [
      '#type' => 'email',
      '#title' => $this->t('Email ID'),
      '#required' => TRUE,
      '#maxlength' => 100,
      '#suffix' => '<div class = "error" id ="email_id"></div>',
      '#ajax' => [
        'callback' => '::validateEmailAjax',
        'event' => 'change',
        'wrapper' => 'email-validation-message',
        'progress' => [
          'type' => 'throbber',
          'message' => $this->t('Validating...'),
        ],
      ],
    ];

    $form['email_validation_message'] = [
      '#type' => 'container',
      '#attributes' => ['id' => 'email-validation-message'],
    ];
    
    $form['phone_no'] = [
      '#type' => 'tel',
      '#title' => $this->t('Phone Number'),
      '#required' => TRUE,
      '#maxlength' => 100,
      '#attributes' => [
        'placeholder' => 'e.g., (123) 456-7890',
      ],
      '#suffix' => '<div class = "error" id ="phone_no"></div>',
      '#ajax' => [
        'callback' => '::validatePhoneNumberAjax',
        'event' => 'change',
        'wrapper' => 'phone-validation-message',
        'progress' => [
          'type' => 'throbber',
          'message' => $this->t('Validating...'),
        ],
      ],
    ];

    $form['phone_validation_message'] = [
      '#type' => 'container',
      '#attributes' => ['id' => 'phone-validation-message'],
    ];

    
    $form['gender'] = [
      '#type' => 'radios',
      '#title' => $this->t('Select your gender'),
      '#options' => [
        'male' => $this->t('Male'),
        'female' => $this->t('Female'),
        'other' => $this->t('Other'),
      ],
      '#required' => TRUE,
      '#suffix' => '<div class = "error" id ="gender"></div>',
    ];

    $form['actions'] = [
      '#type' => 'actions',
      'submit' => [
        '#type' => 'submit',
        '#value' => $this->t('Submit'),
    ]
      ];

    return $form;
  }
  
   /**
   * AJAX callback to validate email.
   */
  public function validateEmailAjax(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();

    $email = $form_state->getValue('email_id');

    $message = $this->validateEmail($email);

    $response->addCommand(new HtmlCommand('#email-validation-message', $message));

    return $response;
  }

  /**
   * AJAX callback to validate phone number.
   */
  public function validatePhoneNumberAjax(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();

    $phone_no = $form_state->getValue('phone_no');

    $message = $this->validatePhoneNumber($phone_no);

    $response->addCommand(new HtmlCommand('#phone-validation-message', $message));

    return $response;
  }

  /**
   * Validate the email.
   */
  private function validateEmail($email) {
    // Validate email format using PHP filter_var().
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return $this->t('Please enter a valid email address.');
    }

    // List of public email domains.
    $public_domains = ['gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com'];

    // Extract domain from email.
    $email_domain = substr(strrchr($email, "@"), 1);

    // Check if the email is from a public domain.
    if (!in_array($email_domain, $public_domains)) {
      return $this->t('Please use an email from a public domain like Gmail, Yahoo, or Outlook.');
    }

    // Check if the email extension is .com.
    if (substr($email_domain, -4) !== '.com') {
      return $this->t('Only .com email addresses are allowed.');
    }

    return '';
  }

  /**
   * Validate the phone number.
   */
  private function validatePhoneNumber($phone_no) {
    // Validate that the contact number is exactly 10 digits and consists of only numbers.
    if (!preg_match('/^\d{10}$/', $phone_no)) {
      return $this->t('Please enter a valid 10-digit Indian contact number.');
    }

    return '';
  }
  
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $email_message = $this->validateEmail($form_state->getValue('email_id'));
    if ($email_message) {
      $form_state->setErrorByName('email_id', $email_message);
    }

    $phone_message = $this->validatePhoneNumber($form_state->getValue('phone_no'));
    if ($phone_message) {
      $form_state->setErrorByName('phone_no', $phone_message);
    }
  }
  
  // public function submitData(array &$form, FormStateInterface $form_state ) {
  //   $ajax_response = new AjaxResponse();
  //   $conn = Database::getConnection();

  //   $FormField = $form_state->getValues();

  //   $formData['full_name'] = $FormField['full_name'];
  //   $formData['email_id'] = $FormField['email_id'];
  //   $formData['phone_no'] = $FormField['phone_no'];
  //   $formData['gender'] = $FormField['gender'];

  //   $conn->insert('example_form_submissions')
  //     ->fields($formData)->execute();

  //   $ajax_response->addCommand(new HtmlCommand('.success','Form submitted successfully'));
  //   return $ajax_response;
  // }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {

    $conn = Database::getConnection();

    $FormField = $form_state->getValues();

    $formData['full_name'] = $FormField['full_name'];
    $formData['email_id'] = $FormField['email_id'];
    $formData['phone_no'] = $FormField['phone_no'];
    $formData['gender'] = $FormField['gender'];

    $conn->insert('example_form_submissions')
      ->fields($formData)->execute();
      $this->messenger()->addStatus($this->t('The data has been sent.'));
  }
}