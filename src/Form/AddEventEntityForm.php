<?php

namespace Drupal\event_manager\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\event_manager\Entity\EventEntity;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Provides a form for adding new Event entities.
 */
class AddEventEntityForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'add_event_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, EventEntity $event = NULL) {
    $form['event_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Event Name'),
      '#default_value' => $event ? $event->get('event_name')->value : '',
      '#required' => TRUE,
    ];

    $form['event_description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Event Description'),
      '#default_value' => $event ? $event->get('event_description')->value : '',
      '#required' => TRUE,
    ];
    
    $form['event_datetime'] = [
      '#type' => 'datetime',
      '#title' => $this->t('Event Datetime'),
      '#default_value' => $event ? new DrupalDateTime($event->get('event_datetime')->value) : '',
      '#required' => TRUE,
      '#date_date_format' => 'Y-m-d',
      '#date_time_format' => 'H:i:s',
    ];

    $form['event_location'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Event Location'),
      '#default_value' => $event ? $event->get('event_location')->value : '',
      '#required' => TRUE,
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save Event'),
      '#button_type' => 'primary',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Validate the event name.
    if (empty($form_state->getValue('event_name'))) {
      $form_state->setErrorByName('event_name', $this->t('The event name is required.'));
    }

    // Validate the event description.
    if (empty($form_state->getValue('event_description'))) {
      $form_state->setErrorByName('event_description', $this->t('The event description is required.'));
    }

    // Validate the event datetime.
    $datetime_value = $form_state->getValue('event_datetime');
    if (empty($datetime_value)) {
      $form_state->setErrorByName('event_datetime', $this->t('The event datetime is required.'));
    }

    // Validate the event location.
    if (empty($form_state->getValue('event_location'))) {
      $form_state->setErrorByName('event_location', $this->t('The event location is required.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Format the datetime value.
    /** @var \Drupal\Core\Datetime\DrupalDateTime $datetime_value */
    $datetime_value = $form_state->getValue('event_datetime');
    $formatted_datetime = $datetime_value->format('Y-m-d\TH:i:s');

    // Create and save the event entity.
    $event = EventEntity::create([
      'event_name' => $form_state->getValue('event_name'),
      'event_description' => $form_state->getValue('event_description'),
      'event_datetime' => $formatted_datetime,
      'event_location' => $form_state->getValue('event_location'),
    ]);
    $event->save();

    // Display a success message.
    $this->messenger()->addMessage($this->t('Event %name has been created.', ['%name' => $event->label()]));
  }

}
