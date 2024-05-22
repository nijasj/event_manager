<?php

namespace Drupal\event_manager\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

/**
 * Provides a block to display the next upcoming event.
 *
 * @Block(
 *   id = "next_upcoming_event_block",
 *   admin_label = @Translation("Next Upcoming Event")
 * )
 */
class NextUpcomingEventBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The entity type manager service.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a new NextUpcomingEventBlock instance.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_type_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];

    // Load the event storage.
    $storage = $this->entityTypeManager->getStorage('event');

    // Query to get the next upcoming event.
    $query = $storage->getQuery()
      ->condition('status', 1)
      ->condition('event_datetime', (new DrupalDateTime())->format('Y-m-d\TH:i:s'), '>')
      ->sort('event_datetime', 'ASC')
      ->range(0, 1);
    $entity_ids = $query->execute();

    if (!empty($entity_ids)) {
      $event = $storage->load(reset($entity_ids));
      $build = [
        '#theme' => 'next_upcoming_event',
        '#event' => [
          'name' => $event->get('event_name')->value,
          'description' => $event->get('event_description')->value,
          'datetime' => $event->get('event_datetime')->value,
          'location' => $event->get('event_location')->value,
        ],
      ];
      // Attach the CSS library.
     $build['#attached']['library'][] = 'event_manager/event_manager';
    } 
     
    else {
      $build['#markup'] = $this->t('No upcoming events found.');
    }

    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    return 0;
  }

}
