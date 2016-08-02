<?php

namespace Drupal\annotator\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemInterface;

/**
 * Plugin implementation of the 'annotator_invisible' formatter.
 *
 * @FieldFormatter(
 *   id = "annotator_visually_hidden",
 *   label = @Translation("- Visually Hidden -"),
 *   field_types = {
 *     "annotator"
 *   }
 * )
 */
class AnnotatorVisuallyHidden extends AnnotatorBase {

  /**
   * Generate the output appropriate for one field item.
   *
   * @param \Drupal\Core\Field\FieldItemInterface $item
   *   One field item.
   *
   * @return string
   *   The textual output generated.
   */
  protected function viewValue(FieldItemInterface $item) {
    return '';
  }

}
