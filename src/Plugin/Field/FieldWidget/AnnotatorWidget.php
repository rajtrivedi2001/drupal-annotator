<?php

namespace Drupal\annotator\Plugin\Field\FieldWidget;

use Drupal\annotator\Plugin\Field\FieldType\AnnotatorItemInterface;
use Drupal\Component\Utility\Html;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'annotator_default' widget.
 *
 * @FieldWidget(
 *   id = "annotator_default",
 *   label = @Translation("Check boxes/radio buttons"),
 *   field_types = {
 *     "annotator"
 *   }
 * )
 */
class AnnotatorWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $entity = $items->getEntity();

    $element['value'] = array(
      '#type' => 'radios',
      '#title' => t('Annotations'),
      '#title_display' => 'invisible',
      '#default_value' => isset($items->value) ? $items->value : AnnotatorItemInterface::OPEN,
      '#options' => array(
        AnnotatorItemInterface::OPEN => t('Open'),
        AnnotatorItemInterface::CLOSED => t('Closed'),
      ),
      AnnotatorItemInterface::OPEN => array(
        '#description' => t('Users with the "Post annotations" permission can post annotations.'),
      ),
      AnnotatorItemInterface::CLOSED => array(
        '#description' => t('Users cannot post annotations and existing annotations will not be displayed.'),
      ),
    );

    // If the advanced settings tabs-set is available (normally rendered in the
    // second column on wide-resolutions), place the field as a details element
    // in this tab-set.
    if (isset($form['advanced'])) {
      // Get default value from the field.
      $field_default_values = $this->fieldDefinition->getDefaultValue($entity);

      // Override widget title to be helpful for end users.
      $element['#title'] = $this->t('Annotation settings');

      $element += array(
        '#type' => 'details',
        // Open the details when the selected value is different to the stored
        // default values for the field.
        '#open' => ($items->value != $field_default_values[0]['value']),
        '#group' => 'advanced',
        '#attributes' => array(
          'class' => array('annotator-' . Html::getClass($entity->getEntityTypeId()) . '-settings-form'),
        ),
      );
    }

    return $element;
  }

}
