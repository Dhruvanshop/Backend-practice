<?php

namespace Drupal\taxonomy_term_info\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Class TermInfoForm.
 *
 * Provides a form to enter a taxonomy term name.
 */
class TermInfoForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'taxonomy_term_info_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['term_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Taxonomy Term Name'),
      '#description' => $this->t('Enter the name of an existing taxonomy term (case-sensitive).'),
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
    $term_name = $form_state->getValue('term_name');
    $url = Url::fromRoute('term_info.page', ['term_name' => $term_name]);
    $form_state->setRedirectUrl($url);
  }

}
