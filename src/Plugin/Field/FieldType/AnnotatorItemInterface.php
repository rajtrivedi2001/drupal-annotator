<?php

namespace Drupal\annotator\Plugin\Field\FieldType;

/**
 * Interface definition for Annotation items.
 */
interface AnnotatorItemInterface {

  /**
   * Annotations for this entity are closed.
   */
  const CLOSED = 0;

  /**
   * Annotations for this entity are open.
   */
  const OPEN = 1;

}
