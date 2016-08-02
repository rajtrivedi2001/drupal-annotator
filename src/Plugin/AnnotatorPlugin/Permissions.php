<?php

namespace Drupal\annotator\Plugin\AnnotatorPlugin;

use Drupal\annotator\Plugin\AnnotatorPluginBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Annotator Permissions.
 *
 * @AnnotatorPlugin(
 *   id = "permissions",
 *   label = @Translation("Permissions")
 * )
 */
class Permissions extends AnnotatorPluginBase {

  protected $library = 'annotator/annotator-permissions';

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();
    $form['permissions'] = [
      '#type' => 'details',
      '#title' => $this->t('Permissions plugin'),
      '#markup' => $this->t('This plugin handles setting the user and permissions.'),
      '#open' => TRUE,
      '#weight' => 400,
      '#tree' => TRUE,
    ];
    $form['permissions']['status'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable the plugin'),
      '#default_value' => $config['status'],
    );
    return $form;
  }

}
