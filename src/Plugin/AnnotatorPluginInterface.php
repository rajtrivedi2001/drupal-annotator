<?php

namespace Drupal\annotator\Plugin;

use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Defines an interface for Annotator plugin plugins.
 */
interface AnnotatorPluginInterface extends PluginInspectionInterface {

  /**
   * Get the plugin status.
   *
   * @return bool
   *   TRUE for active, FALSE for inactive.
   */
  public function isActive();

  /**
   * Get the library.
   *
   * @return string
   *   The library identifier.
   */
  public function getLibrary();

  /**
   * Get the configuration.
   *
   * @return array
   *   The configuration array.
   */
  public function getConfiguration();

}
