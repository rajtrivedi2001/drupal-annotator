<?php

namespace Drupal\annotator\Plugin;

use Drupal\Component\Plugin\PluginBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Base class for Annotator plugin plugins.
 */
abstract class AnnotatorPluginBase extends PluginBase implements AnnotatorPluginInterface {

  use StringTranslationTrait;

  /**
   * The library name.
   *
   * @var string
   */
  protected $library;

  /**
   * The plugin status.
   *
   * @var boolean
   *   TRUE for active, FALSE for inactive
   */
  protected $status;

  /**
   * {@inheritdoc}
   */
  public function __construct(
      array $configuration,
      $plugin_id,
      $plugin_definition
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->status = $configuration['status'];
  }

  /**
   * {@inheritdoc}
   */
  public function isActive() {
    return $this->status;
  }

  /**
   * {@inheritdoc}
   */
  public function getLibrary() {
    return $this->library;
  }

  /**
   * {@inheritdoc}
   */
  public function getConfiguration() {
    return $this->configuration;
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateConfigurationForm(array &$form, FormStateInterface $form_state) {
    // No need to do anything, but make the function have a body anyway
    // so that it's callable by overriding methods.
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    // No need to do anything, but make the function have a body anyway
    // so that it's callable by overriding methods.
  }

}
