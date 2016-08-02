<?php

namespace Drupal\annotator\Plugin\AnnotatorPlugin;

use Drupal\annotator\Plugin\AnnotatorPluginBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Annotator Tags.
 *
 * @AnnotatorPlugin(
 *   id = "tags",
 *   label = @Translation("Tags")
 * )
 */
class Tags extends AnnotatorPluginBase {

  protected $library = 'annotator/annotator-tags';

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();
    $form['tags'] = [
      '#type' => 'details',
      '#title' => $this->t('Tags plugin'),
      '#markup' => $this->t('This plugin allows the user to tag their annotations with keywords.'),
      '#open' => TRUE,
      '#weight' => 600,
      '#tree' => TRUE,
    ];
    $form['tags']['status'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable the plugin'),
      '#default_value' => $config['status'],
    );
    return $form;
  }

}
