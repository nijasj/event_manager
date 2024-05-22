<?php

namespace Drupal\event_manager;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of event entities.
 *
 * @ingroup event_manager
 */
class EventEntityListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['event_name'] = $this->t('Event Name');
    $header['event_description'] = $this->t('Event Description');
    $header['event_datetime'] = $this->t('Event Datetime');
    $header['event_location'] = $this->t('Event Location');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /** @var \Drupal\event_manager\Entity\EventEntity $entity */
    $row['event_name'] = Link::createFromRoute(
      $entity->label(),
      'entity.event.canonical',
      ['event' => $entity->id()]
    );
   
    $row['event_description'] = $entity->get('event_description')->value;
    $row['event_datetime'] = $entity->get('event_datetime')->value;
    $row['event_location'] = $entity->get('event_location')->value;
    return $row + parent::buildRow($entity);
  }
}
