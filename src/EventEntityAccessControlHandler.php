<?php

namespace Drupal\event_manager;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the event entity.
 *
 * @see \Drupal\event_manager\Entity\EventEntity.
 */
class EventEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\event_manager\Entity\EventEntityInterface $entity */

    switch ($operation) {

      case 'view':

        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished event entities');
        }

        return AccessResult::allowedIfHasPermission($account, 'view published event entities');

      case 'update':

        return AccessResult::allowedIfHasPermission($account, 'edit event entities');

      case 'delete':

        return AccessResult::allowedIfHasPermission($account, 'delete event entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add event entities');
  }

}
