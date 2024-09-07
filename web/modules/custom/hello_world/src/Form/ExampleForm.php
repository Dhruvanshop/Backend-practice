<?php

declare(strict_types=1);

namespace Drupal\hello_world\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;

/**
 * Provides a Hello World form.
 */
final class ExampleForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'hello_world_example';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {

    $form['full_name'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Full Name'),
      '#required' => TRUE,
      '#maxlength' => 30,
    ];

    $form['email_id'] = [
      '#type' => 'email',
      '#title' => $this->t('Email ID'),
      '#required' => TRUE,
      '#maxlength' => 100,
    ];
    
    $form['phone_no'] = [
      '#type' => 'tel',
      '#title' => $this->t('Phone Number'),
      '#required' => TRUE,
      '#maxlength' => 100,
      '#attributes' => [
        'placeholder' => 'e.g., (123) 456-7890',
      ],
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
    ];

    $form['actions'] = [
      '#type' => 'actions',
      'submit' => [
        '#type' => 'submit',
        '#value' => $this->t('Submit'),
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {
    // @todo Validate the form here.
    // Example:
    // @code
    //   if (mb_strlen($form_state->getValue('message')) < 10) {
    //     $form_state->setErrorByName(
    //       'message',
    //       $this->t('Message should be at least 10 characters.'),
    //     );
    //   }
    // @endcode
    $FormField=$form_state->getValues();

    $fullname = $FormField['full_name'];
    $email = trim($FormField['email_id']);
    $contact_number = trim($FormField['phone_no']);

    // Validate the full name
    if (!preg_match("/^[a-zA-Z\s]+$/", $fullname)) {
      $form_state->setErrorByName('full_name', $this->t("Enter a valid name."));
    }
    
    // Validate email format using PHP filter_var().
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $form_state->setErrorByName('email', $this->t('Please enter a valid email address.'));
      return;
    }

    // List of public email domains.
    $public_domains = ['gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com'];

    // Extract domain from email.
    $email_domain = substr(strrchr($email, "@"), 1);

    // Check if the email is from a public domain.
    if (!in_array($email_domain, $public_domains)) {
      $form_state->setErrorByName('email', $this->t('Please use an email from a public domain like Gmail, Yahoo, or Outlook.'));
      return;
    }

    // Check if the email extension is .com.
    if (substr($email_domain, -4) !== '.com') {
      $form_state->setErrorByName('email_id', $this->t('Only .com email addresses are allowed.'));
    }

     // Validate that the contact number is exactly 10 digits and consists of only numbers.
     if (!preg_match('/^\d{10}$/', $contact_number)) {
      $form_state->setErrorByName('phone_no', $this->t('Please enter a valid 10-digit Indian contact number.'));
    }
  }
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




