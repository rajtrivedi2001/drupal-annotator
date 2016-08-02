<?php

namespace Drupal\annotator\Plugin\Field\FieldFormatter;

use Drupal\annotator\Plugin\Field\FieldType\AnnotatorItemInterface;
use Drupal\Core\Field\FieldItemInterface;

/**
 * Plugin implementation of the 'annotator_status' formatter.
 *
 * @FieldFormatter(
 *   id = "annotator_status",
 *   label = @Translation("Annotation status"),
 *   field_types = {
 *     "annotator"
 *   }
 * )
 */
class AnnotatorStatus extends AnnotatorBase {

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
    switch ($item->value) {
      case AnnotatorItemInterface::CLOSED:
        return $this->t('Annotation is closed.');

      case AnnotatorItemInterface::OPEN:
        return $this->t('Annotation is open.');

    }
  }

}
