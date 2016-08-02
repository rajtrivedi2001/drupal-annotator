<?php

namespace Drupal\annotator\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\annotator\Plugin\AnnotatorPluginManager;

/**
 * Class SettingsForm.
 *
 * @package Drupal\annotator\Form
 */
class SettingsForm extends ConfigFormBase {

  /**
   * Drupal\annotator\Plugin\AnnotatorPluginManager definition.
   *
   * @var \Drupal\annotator\Plugin\AnnotatorPluginManager
   */
  protected $pluginManager;

  /**
   * SettingsForm constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The configuration factory.
   * @param \Drupal\annotator\Plugin\AnnotatorPluginManager $plugin_manager
   *   The annotator plugin manager.
   */
  public function __construct(
      ConfigFactoryInterface $config_factory,
      AnnotatorPluginManager $plugin_manager
  ) {
    parent::__construct($config_factory);
    $this->pluginManager = $plugin_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('plugin.manager.annotator_plugin.processor')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'annotator.settings',
      'annotator.settings.auth',
      'annotator.settings.filter',
      'annotator.settings.markdown',
      'annotator.settings.permissions',
      'annotator.settings.store',
      'annotator.settings.tags',
      'annotator.settings.unsupported',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'annotator_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $config = $this->config('annotator.settings')->get();
    $form['selector'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Default selector'),
      '#description' => $this->t('The default selector the annotator is attached to.'),
      '#default_value' => $config['selector'],
    ];

    $plugins = $this->pluginManager->getDefinitions();
    foreach ($plugins as $plugin) {
      $config = $this->config('annotator.settings.' . $plugin['id'])->get();
      /** @var \Drupal\annotator\Plugin\AnnotatorPluginInterface $instance */
      $instance = $this->pluginManager->createInstance(
        $plugin['id'],
        $config
      );
      $form['plugins'][$instance->getPluginId()] = [
        'settings' => $instance->buildConfigurationForm([], $form_state),
      ];
    }
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $values = $this->configFactory()->getEditable('annotator.settings')
      ->setData($form_state->getValues())
      ->save();

    $plugins = $this->pluginManager->getDefinitions();
    foreach ($plugins as $plugin) {
      $config = $values->get($plugin['id']);
      if (isset($config['configuration'])) {
        $config = array_merge($config, $config['configuration']);
        unset($config['configuration']);
      }
      $this->configFactory()->getEditable('annotator.settings.' . $plugin['id'])
        ->setData($config)
        ->save();
    }
  }

}
