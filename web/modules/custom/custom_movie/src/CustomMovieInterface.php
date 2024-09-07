<?php

declare(strict_types=1);

namespace Drupal\custom_movie;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a custom movie entity type.
 */
interface CustomMovieInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
