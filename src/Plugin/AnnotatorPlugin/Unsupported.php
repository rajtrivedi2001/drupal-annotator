<?php

namespace Drupal\annotator\Plugin\AnnotatorPlugin;

use Drupal\annotator\Plugin\AnnotatorPluginBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Annotator Unsupported.
 *
 * @AnnotatorPlugin(
 *   id = "unsupported",
 *   label = @Translation("Unsupported")
 * )
 */
class Unsupported extends AnnotatorPluginBase {

  protected $library = 'annotator/annotator-unsupported';

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();
    $form['unsupported'] = [
      '#type' => 'details',
      '#title' => $this->t('Unsupported plugin'),
      '#markup' => $this->t('The Annotator only supports browsers that have the window.getSelection() method. This plugin provides a notification to users of these unsupported browsers letting them know that the plugin has not loaded.'),
      '#open' => TRUE,
      '#weight' => 700,
      '#tree' => TRUE,
    ];
    $form['unsupported']['status'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable the plugin'),
      '#default_value' => $config['status'],
    );
    $form['unsupported']['configuration'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Plugin configuration'),
    ];
    $form['unsupported']['configuration']['message'] = array(
      '#type' => 'textfield',
      '#title' => t('Message'),
      '#default_value' => $config['message'],
      '#description' => $this->t('A customised message that you wish to display to users.'),
    );
    return $form;
  }

}
