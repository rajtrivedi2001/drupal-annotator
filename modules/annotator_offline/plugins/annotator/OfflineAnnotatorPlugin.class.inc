<?php

/**
 * HelloWorld Annotator ctools plugin
 */
class OfflineAnnotatorPlugin extends AnnotatorPlugin {
  public function setup() {
    drupal_add_library('annotator', 'annotator_offline', TRUE);
    drupal_add_js(drupal_get_path('module', 'annotator_offline') . '/js/annotator_offline.js');
  }
}