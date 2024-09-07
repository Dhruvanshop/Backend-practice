<?php
namespace Drupal\flagship_programmer_form\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;
/**
 * Provides a block with the form data.
 *
 * @Block(
 *   id = "Dynamic_Group_Block",
 *   admin_label = @Translation("Dynamic Group Block"),
 * )
 */
class DynamicGroupBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    // $build['#attached']['library'][] = 'block_form/form_data_block';
    // Query the database to get form data.
    $query = Database::getConnection()->select('dynamic_groups', 'f')
      ->fields('f')
      ->orderBy('id', 'DESC')
      ->range(0, 5)
      ->execute();
    $rows = $query->fetchAllAssoc('id');
    $data = [];
    foreach ($rows as $row) {
      $data[] = [
        'group_name' => $row->group_name,
        'label_1' => $row->label_1,
        'value_1' => $row->value_1,
        'label_2' => $row->label_2,
        'value_2' => $row->value_2,
      ];
    }
    return [
      '#theme' => 'flagship_custom',
      '#data' => $data,
    ];
  }
}