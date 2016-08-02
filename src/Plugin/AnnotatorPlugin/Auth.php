<?php

namespace Drupal\annotator\Plugin\AnnotatorPlugin;

use Drupal\annotator\Plugin\AnnotatorPluginBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Annotator Auth.
 *
 * @AnnotatorPlugin(
 *   id = "auth",
 *   label = @Translation("Auth")
 * )
 */
class Auth extends AnnotatorPluginBase {

  protected $library = 'annotator/annotator-auth';

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();
    $form['auth'] = [
      '#type' => 'details',
      '#title' => $this->t('Auth plugin'),
      '#markup' => $this->t('The Auth plugin complements the Store plugin by providing authentication for requests. This may be necessary if you are running the Store on a separate domain or using a third party service like annotateit.org. The plugin works by requesting an authentication token from the local server and then provides this in all requests to the store.'),
      '#open' => TRUE,
      '#weight' => -100,
      '#tree' => TRUE,
    ];
    $form['auth']['status'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable the plugin'),
      '#default_value' => $config['status'],
    );
    $form['auth']['configuration'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Plugin configuration'),
    ];
    $form['auth']['configuration']['token_url'] = array(
      '#type' => 'textfield',
      '#title' => t('Token URL'),
      '#default_value' => $config['token_url'],
      '#description' => $this->t('The URL to request the token from. Defaults to <code>/auth/token</code>.'),
    );
    $form['auth']['configuration']['token'] = array(
      '#type' => 'textfield',
      '#title' => t('Token'),
      '#default_value' => $config['token'],
      '#description' => $this->t('An auth token. If this is present it will not be requested from the server. Defaults to <code>null</code>.'),
    );
    $form['auth']['configuration']['auto_fetch'] = array(
      '#type' => 'checkbox',
      '#title' => t('Auto fetch the token when the plugin is loaded'),
      '#default_value' => $config['auto_fetch'],
      '#description' => $this->t('Whether to fetch the token when the plugin is loaded. Defaults to <code>true</code>'),
    );
    return $form;
  }

}
