<?php

namespace Drupal\event_manager\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining event entities.
 *
 * @ingroup event_manager
 */
interface EventEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface, EntityOwnerInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the event Title.
   *
   * @return string
   *   Title of the event.
   */
  public function getTitle();

  /**
   * Sets the  event.
   *
   * @param string $title
   *   The  event title.
   *
   * @return \Drupal\event_manager\Entity\EventEntityInterface
   *   The called event entity.
   */
  public function setTitle($title);

  /**
   * Gets the event creation timestamp.
   *
   * @return int
   *   Creation timestamp of the event.
   */
  public function getCreatedTime();

  /**
   * Sets the event creation timestamp.
   *
   * @param int $timestamp
   *   The event creation timestamp.
   *
   * @return \Drupal\event_manager\Entity\EventEntityInterface
   *   The called event entity.
   */
  public function setCreatedTime($timestamp);

}
