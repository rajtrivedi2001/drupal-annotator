<?php

namespace Drupal\annotator\Plugin\AnnotatorPlugin;

use Drupal\annotator\Plugin\AnnotatorPluginBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Annotator Markdown.
 *
 * @AnnotatorPlugin(
 *   id = "markdown",
 *   label = @Translation("Markdown")
 * )
 */
class Markdown extends AnnotatorPluginBase {

  protected $library = 'annotator/annotator-markdown';

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();
    $form['markdown'] = [
      '#type' => 'details',
      '#title' => $this->t('Markdown plugin'),
      '#markup' => $this->t('The Markdown plugin allows you to use Markdown in your annotation comments. It will then render them in the Viewer.'),
      '#open' => TRUE,
      '#weight' => 300,
      '#tree' => TRUE,
    ];
    $form['markdown']['status'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable the plugin'),
      '#default_value' => $config['status'],
    );
    return $form;
  }

}
