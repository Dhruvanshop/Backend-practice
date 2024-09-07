<?php

declare(strict_types=1);

namespace Drupal\award_movie\Entity;

use Drupal\award_movie\AwardMovieInterface;
use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the award movie entity type.
 *
 * @ConfigEntityType(
 *   id = "award_movie",
 *   label = @Translation("Award movie"),
 *   label_collection = @Translation("Award movies"),
 *   label_singular = @Translation("award movie"),
 *   label_plural = @Translation("award movies"),
 *   label_count = @PluralTranslation(
 *     singular = "@count award movie",
 *     plural = "@count award movies",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\award_movie\AwardMovieListBuilder",
 *     "form" = {
 *       "add" = "Drupal\award_movie\Form\AwardMovieForm",
 *       "edit" = "Drupal\award_movie\Form\AwardMovieForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *   },
 *   config_prefix = "award_movie",
 *   admin_permission = "administer award_movie",
 *   links = {
 *     "collection" = "/admin/structure/award-movie",
 *     "add-form" = "/admin/structure/award-movie/add",
 *     "edit-form" = "/admin/structure/award-movie/{award_movie}",
 *     "delete-form" = "/admin/structure/award-movie/{award_movie}/delete",
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "description",
 *   },
 * )
 */
final class AwardMovie extends ConfigEntityBase implements AwardMovieInterface {

  /**
   * The example ID.
   */
  protected string $id;

  /**
   * The example label.
   */
  protected string $label;

  /**
   * The example description.
   */
  protected string $description;

}
