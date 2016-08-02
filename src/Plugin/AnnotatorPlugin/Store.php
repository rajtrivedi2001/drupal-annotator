<?php

namespace Drupal\annotator\Plugin\AnnotatorPlugin;

use Drupal\annotator\Plugin\AnnotatorPluginBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Annotator Store.
 *
 * @AnnotatorPlugin(
 *   id = "store",
 *   label = @Translation("Store")
 * )
 */
class Store extends AnnotatorPluginBase {

  protected $library = 'annotator/annotator-store';

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();
    $form['store'] = [
      '#type' => 'details',
      '#title' => $this->t('Store plugin'),
      '#markup' => $this->t('This plugin sends annotations (serialised as JSON) to the server at key events broadcast by the annotator.'),
      '#open' => TRUE,
      '#weight' => 500,
      '#tree' => TRUE,
    ];
    $form['store']['status'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable the plugin'),
      '#default_value' => $config['status'],
    );
    return $form;
  }

}
