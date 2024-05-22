<?php

namespace Drupal\event_manager\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Faq entities.
 */
class EventEntityViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.
    return $data;
  }

}
