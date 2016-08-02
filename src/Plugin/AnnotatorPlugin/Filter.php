<?php

namespace Drupal\annotator\Plugin\AnnotatorPlugin;

use Drupal\annotator\Plugin\AnnotatorPluginBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Annotator Filter.
 *
 * @AnnotatorPlugin(
 *   id = "filter",
 *   label = @Translation("Filter")
 * )
 */
class Filter extends AnnotatorPluginBase {

  protected $library = 'annotator/annotator-filter';

  /**
   * {@inheritdoc}
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition
  ) {
    if (
      isset($configuration['filter']) &&
      is_string($configuration['filter'])
    ) {
      $configuration['filter'] = self::decodeFilterConfig($configuration['filter']);
    }
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();
    $form['filter'] = [
      '#type' => 'details',
      '#title' => $this->t('Filter plugin'),
      '#markup' => $this->t('This plugin allows the user to navigate and filter the displayed annotations. The plugin adds a toolbar to the top of the window. This contains the available filters that can be applied to the current annotations.'),
      '#open' => TRUE,
      '#weight' => 200,
      '#tree' => TRUE,
    ];
    $form['filter']['status'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable the plugin'),
      '#default_value' => $config['status'],
    );
    $form['filter']['configuration'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Plugin configuration'),
    ];
    $form['filter']['configuration']['filters'] = array(
      '#type' => 'textarea',
      '#title' => t('Filters'),
      '#default_value' => $config['filters'],
      '#description' => $this->t('A list of new line separated <code>label|property</code> pairs. These will be added to the toolbar on load.'),
    );
    $form['filter']['configuration']['add_annotation_filter'] = array(
      '#type' => 'checkbox',
      '#title' => t('Add annotation filter'),
      '#default_value' => $config['add_annotation_filter'],
      '#description' => $this->t('This will display the default filter that searches the annotation text.'),
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    // No need to do anything, but make the function have a body anyway
    // so that it's callable by overriding methods.
  }

  /**
   * Encode the filter config.
   *
   * @param array $config
   *   A single dimension config array.
   *
   * @return string
   *   A newline separated string with pipe delimited key value pairs,
   *   e.g. "key|value\n".
   */
  public static function encodeFilterConfig($config) {
    $string = '';
    foreach ($config as $key => $value) {
      $string .= $key . '|' . $value . "\n";
    }
    return $string;
  }

  /**
   * Decode the filter config.
   *
   * @param string $string
   *   A newline separated string with pipe delimited key value pairs,
   *   e.g. "key|value\n".
   *
   * @return array
   *   A single dimension config array.
   */
  public static function decodeFilterConfig($string) {
    $config = [];
    $lines = explode("\n", $string);
    foreach ($lines as $line) {
      list($key, $value) = explode('|', $line);
      $config[$key] = $value;
    }
    return $config;
  }

  /**
   * Normalize linebreaks.
   *
   * @param string $string
   *   A string with linebreaks, e.g. \r\n, \r, \n.
   *
   * @return string
   *   A string with normalized linebreaks, e.g. \n.
   */
  public static function normalizeLinebreaks($string) {
    return str_replace(['\r\n', '\r'], ['\n', '\n'], $string);
  }

}
