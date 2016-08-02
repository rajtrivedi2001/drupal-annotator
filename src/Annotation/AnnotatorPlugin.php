<?php

namespace Drupal\annotator\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a Annotator plugin item annotation object.
 *
 * @see \Drupal\annotator\Plugin\AnnotatorPluginManager
 * @see plugin_api
 *
 * @Annotation
 */
class AnnotatorPlugin extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The label of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $label;

}
