<?php

namespace Drupal\get_directions\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class DirectionsForm.
 *
 * @package Drupal\get_directions\Form
 */
class DirectionsForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'directions_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form += [
      '#action' => 'http://maps.google.com/maps',
      '#method' => 'get',
    ];

    $form['saddr'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Your location'),
      '#description' => $this->t('Enter your postcode or the first line of your address.'),
      '#maxlength' => 64,
      '#size' => 64,
      '#required' => TRUE,
    );

    $form['daddr'] = [
      '#type' => 'hidden',
      '#value' => $form_state->getBuildInfo()['args'][0],
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Get directions'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
