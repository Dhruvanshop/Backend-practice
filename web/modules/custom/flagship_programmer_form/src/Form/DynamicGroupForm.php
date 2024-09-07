<?php

namespace Drupal\flagship_programmer_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;



class DynamicGroupForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'dynamic_group_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $num_groups = $form_state->get('num_groups');
    if (is_null($num_groups)) {
      $num_groups = 1;
      $form_state->set('num_groups', $num_groups);
    }

    $form['#tree'] = TRUE;

    $form['groups'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Groups'),
      '#prefix' => '<div id="groups-wrapper">',
      '#suffix' => '</div>',
    ];

    for ($i = 0; $i < $num_groups; $i++) {
      $form['groups'][$i] = [
        '#type' => 'fieldset',
        '#title' => $this->t('Group') . ' ' . ($i + 1),
      ];

      $form['groups'][$i]['group_name'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Name of the group'),
        '#required' => TRUE,
      ];

      $form['groups'][$i]['label_1'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Name of the 1st label'),
        '#required' => TRUE,
      ];

      $form['groups'][$i]['value_1'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Value of the 1st label'),
        '#required' => TRUE,
      ];

      $form['groups'][$i]['label_2'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Name of the 2nd label'),
        '#required' => TRUE,
      ];

      $form['groups'][$i]['value_2'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Value of the 2nd label'),
        '#required' => TRUE,
      ];

      if ($i > 0) {
        $form['groups'][$i]['remove_group'] = [
          '#type' => 'submit',
          '#value' => $this->t('Remove'),
          '#submit' => ['::removeOne'],
          '#ajax' => [
            'callback' => '::updateForm',
            'wrapper' => 'groups-wrapper',
          ],
        ];
      }
    }

    $form['add_group'] = [
      '#type' => 'submit',
      '#value' => $this->t('Add more'),
      '#submit' => ['::addOne'],
      '#ajax' => [
        'callback' => '::updateForm',
        'wrapper' => 'groups-wrapper',
      ],
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }
  /**
   * AJAX callback for the add/remove buttons.
   */
  public function updateForm(array &$form, FormStateInterface $form_state) {
    return $form['groups'];
  }

  /**
   * Custom submit handler for adding one more group.
   */
  public function addOne(array &$form, FormStateInterface $form_state) {
    $group_count = $form_state->get('num_groups');
    $add_button = $group_count + 1;
    $form_state->set('num_groups', $add_button);
    $form_state->setRebuild();
  }

  /**
   * Custom submit handler for removing one group.
   */
  public function removeOne(array &$form, FormStateInterface $form_state) {
    $group_count = $form_state->get('num_groups');
    if ($group_count > 1) {
      $remove_button = $group_count - 1;
      $form_state->set('num_groups', $remove_button);
    }
    $form_state->setRebuild();
  }


public function submitForm(array &$form, FormStateInterface $form_state) {
  

  foreach($form_state->getValue('groups') as $group){
    \Drupal::database()->insert('dynamic_groups')
    ->fields([
      'group_name' => $group['group_name'],
      'label_1' => $group['label_1'],
      'value_1' => $group['value_1'],
      'label_2' => $group['label_2'],
      'value_2' => $group['value_2'],
    ])
    ->execute();
  }
  
  // Notify the user.
  \Drupal::messenger()->addMessage($this->t('The groups have been saved successfully.'));

  // Optionally, redirect to another page after submission.
  // $form_state->setRedirect('your_route_name');
}

}

