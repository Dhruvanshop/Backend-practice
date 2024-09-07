<?php

declare(strict_types=1);

namespace Drupal\custom_movie;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of custom movie type entities.
 *
 * @see \Drupal\custom_movie\Entity\CustomMovieType
 */
final class CustomMovieTypeListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader(): array {
    $header['label'] = $this->t('Label');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity): array {
    $row['label'] = $entity->label();
    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritdoc}
   */
  public function render(): array {
    $build = parent::render();

    $build['table']['#empty'] = $this->t(
      'No custom movie types available. <a href=":link">Add custom movie type</a>.',
      [':link' => Url::fromRoute('entity.custom_movie_type.add_form')->toString()],
    );

    return $build;
  }

}
