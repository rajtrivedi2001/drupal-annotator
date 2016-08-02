<?php

namespace Drupal\annotator\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin base.
 */
abstract class AnnotatorBase extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    $config = \Drupal::service('config.factory')->getEditable('annotator.settings');
    return ['selector' => $config->get('selector')] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $form['selector'] = [
      '#title' => $this->t('Selector'),
      '#type' => 'textfield',
      '#description' => $this->t('The selector to attach the annotator to.'),
      '#default_value' => $this->getSetting('selector'),
    ];
    return $form + parent::settingsForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    global $base_path;

    $elements = [];
    foreach ($items as $delta => $item) {
      $elements[$delta] = [
        '#markup' => '<p>' . $this->viewValue($item) . '</p>',
      ];

      if ($item->value) {
        $path = drupal_get_path('module', 'annotator') . '/locale/' . self::langcodeToLocale($langcode) . '.po';
        $realpath = \Drupal::service('file_system')->realpath($path);
        // Check for localization.
        if (!empty($realpath) && file_exists($realpath)) {
          // Attach Gettext library and localization.
          $elements[$delta]['#attached']['library'][] = 'annotator/gettext';
          $elements[$delta]['#attached']['html_head_link'][][] = [
            'rel' => 'gettext',
            'type' => 'application/x-po',
            'href' => $base_path . $path,
          ];
        }

        // Attach annotator.
        $elements[$delta]['#attached']['library'][] = 'annotator/annotator-field';
        $elements[$delta]['#attached']['drupalSettings'] = [
          'annotatorField' => [
            'selector' => $this->getSetting('selector'),
          ],
        ];

        /** @var \Drupal\annotator\Plugin\AnnotatorPluginManager $plugin_manager */
        $plugin_manager = \Drupal::service('plugin.manager.annotator_plugin.processor');
        $plugins = $plugin_manager->getDefinitions();

        // Attach active annotator plugins.
        foreach ($plugins as $plugin) {
          $config = \Drupal::service('config.factory')
            ->get('annotator.settings.' . $plugin['id'])
            ->get();

          /** @var \Drupal\annotator\Plugin\AnnotatorPluginInterface $instance */
          $instance = $plugin_manager->createInstance(
            $plugin['id'],
            $config
          );

          if ($instance->isActive()) {
            $elements[$delta]['#attached']['library'][] = $instance->getLibrary();
            $elements[$delta]['#attached']['drupalSettings']['annotator'] = [
              strtolower($instance->getPluginId()) => $instance->getConfiguration(),
            ];
          }
        }
      }
    }
    return $elements;
  }

  /**
   * Convert langcode to locale.
   *
   * @param string $langcode
   *   A language code string.
   *
   * @return string
   *   A locale string.
   */
  private static function langcodeToLocale($langcode) {
    $mapping = [
      'da' => 'da',
      'de' => 'de_DE',
      'el' => 'el',
      'en' => 'en',
      'es' => 'es_ES',
      'et' => 'et',
      'fa' => 'fa',
      'fr' => 'fr',
      'id' => 'id',
      'pt-br' => 'pt_BR',
      'pt-pt' => 'pt_PT',
      'ru' => 'ru',
      'uk' => 'uk',
      'zh-hans' => 'zh_CN',
      'zh-hant' => 'zh_TW',
    ];
    return isset($mapping[$langcode]) ? $mapping[$langcode] : $langcode;
  }

}
