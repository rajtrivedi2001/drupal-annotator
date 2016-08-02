<?php

namespace Drupal\annotator\Plugin;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * Provides the Annotator plugin plugin manager.
 */
class AnnotatorPluginManager extends DefaultPluginManager {

  /**
   * Constructor for AnnotatorPluginManager objects.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(
      \Traversable $namespaces,
      CacheBackendInterface $cache_backend,
      ModuleHandlerInterface $module_handler
  ) {
    parent::__construct(
      'Plugin/AnnotatorPlugin',
      $namespaces,
      $module_handler,
      'Drupal\annotator\Plugin\AnnotatorPluginInterface',
      'Drupal\annotator\Annotation\AnnotatorPlugin'
    );

    $this->alterInfo('annotator_annotator_plugin_info');
    $this->setCacheBackend($cache_backend, 'annotator_annotator_plugin_plugins');
  }

}
