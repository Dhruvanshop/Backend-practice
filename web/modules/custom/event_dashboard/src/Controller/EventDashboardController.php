<?php

namespace Drupal\event_dashboard\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;

class EventDashboardController extends ControllerBase {

  public function dashboard() {
    $output = [];

    // Get counts of events yearly
    $output['yearly_counts'] = $this->getEventCountsByYear();

    // Get counts of events for each quarter
    $output['quarterly_counts'] = $this->getEventCountsByQuarter();

    // Get counts of events by type
    $output['type_counts'] = $this->getEventCountsByType();

    return [
      '#theme' => 'event_dashboard',
      '#data' => $output,
    ];
  }

  private function getEventCountsByYear() {
    $query = Database::getConnection()->select('node__field_event_date', 'nfd');
    $query->addExpression('COUNT(*)', 'count');
    // Use YEAR without UNIX timestamp conversion
    $query->addExpression('YEAR(nfd.field_event_date_value)', 'year');
    $query->condition('nfd.bundle', 'events');
    $query->groupBy('year');
    $query->orderBy('year', 'ASC');

    return $query->execute()->fetchAllKeyed();
  }

  private function getEventCountsByQuarter() {
    $query = Database::getConnection()->select('node__field_event_date', 'nfd');
    $query->addExpression('COUNT(*)', 'count');
    // Use CONCAT with YEAR and QUARTER without UNIX timestamp conversion
    $query->addExpression("CONCAT(YEAR(nfd.field_event_date_value), ' Q', QUARTER(nfd.field_event_date_value))", 'quarter');
    $query->condition('nfd.bundle', 'events');
    $query->groupBy('quarter');
    $query->orderBy('quarter', 'ASC');

    return $query->execute()->fetchAllKeyed();
  }

  private function getEventCountsByType() {
    $query = Database::getConnection()->select('node__field_event_type', 'nft');
    $query->addExpression('COUNT(*)', 'count');
    $query->innerJoin('taxonomy_term_field_data', 'ttfd', 'ttfd.tid = nft.field_event_type_target_id');
    $query->fields('ttfd', ['name']);
    $query->condition('nft.bundle', 'events');
    $query->groupBy('ttfd.name');
    $query->orderBy('ttfd.name', 'ASC');

    return $query->execute()->fetchAllKeyed();
  }
}
