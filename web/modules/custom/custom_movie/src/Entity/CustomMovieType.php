<?php

declare(strict_types=1);

namespace Drupal\custom_movie\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Custom movie type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "custom_movie_type",
 *   label = @Translation("Custom movie type"),
 *   label_collection = @Translation("Custom movie types"),
 *   label_singular = @Translation("custom movie type"),
 *   label_plural = @Translation("custom movies types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count custom movies type",
 *     plural = "@count custom movies types",
 *   ),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\custom_movie\Form\CustomMovieTypeForm",
 *       "edit" = "Drupal\custom_movie\Form\CustomMovieTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "list_builder" = "Drupal\custom_movie\CustomMovieTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer custom_movie types",
 *   bundle_of = "custom_movie",
 *   config_prefix = "custom_movie_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/custom_movie_types/add",
 *     "edit-form" = "/admin/structure/custom_movie_types/manage/{custom_movie_type}",
 *     "delete-form" = "/admin/structure/custom_movie_types/manage/{custom_movie_type}/delete",
 *     "collection" = "/admin/structure/custom_movie_types",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *   },
 * )
 */
final class CustomMovieType extends ConfigEntityBundleBase {

  /**
   * The machine name of this custom movie type.
   */
  protected string $id;

  /**
   * The human-readable name of the custom movie type.
   */
  protected string $label;

}
