<?php

declare(strict_types=1);

namespace Drupal\award_movie\Form;

use Drupal\award_movie\Entity\AwardMovie;
use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Award movie form.
 */
final class AwardMovieForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state): array {

    $form = parent::form($form, $form_state);

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $this->entity->label(),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $this->entity->id(),
      '#machine_name' => [
        'exists' => [AwardMovie::class, 'load'],
      ],
      '#disabled' => !$this->entity->isNew(),
    ];

    $form['movie_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Movie Name'),
      '#maxlength' => 255,
      '#default_value' => $this->entity->get('movie_name') ?: '',
      '#required' => TRUE,
    ];

    $form['award_year'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Award Year'),
      '#maxlength' => 4,
      '#default_value' => $this->entity->get('award_year') ?: '',
      '#required' => TRUE,
    ];

    $form['description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Description'),
      '#default_value' => $this->entity->get('description'),
    ];

    $form['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enabled'),
      '#default_value' => $this->entity->status(),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state): int {
    $entity = $this->entity;

    // Set the new fields to the entity.
    $entity->set('movie_name', $form_state->getValue('movie_name'));
    $entity->set('award_year', $form_state->getValue('award_year'));
    $entity->set('description', $form_state->getValue('description'));

    $result = parent::save($form, $form_state);
    $message_args = ['%label' => $entity->label()];
    $this->messenger()->addStatus(
      match ($result) {
        SAVED_NEW => $this->t('Created new award movie %label.', $message_args),
        SAVED_UPDATED => $this->t('Updated award movie %label.', $message_args),
      }
    );
    $form_state->setRedirectUrl($entity->toUrl('collection'));

    return $result;
  }

}
