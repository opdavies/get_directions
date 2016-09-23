<?php

namespace Drupal\get_directions\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\get_directions\Form\DirectionsForm;

/**
 * Provides a 'DirectionsBlock' block.
 *
 * @Block(
 *  id = "directions_block",
 *  admin_label = @Translation("Directions block"),
 * )
 */
class DirectionsBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['destination'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Destination'),
      '#description' => $this->t('The postcode or address to use as the destination.'),
      '#default_value' => $this->configuration['destination'] ?: '',
      '#maxlength' => 64,
      '#required' => TRUE,
      '#size' => 64,
      '#weight' => '5',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['destination'] = $form_state->getValue('destination');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm(
      DirectionsForm::class,
      $this->configuration['destination']
    );

    $build['#markup'] = render($form);

    return $build;
  }

}
