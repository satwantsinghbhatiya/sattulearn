<?php

namespace Drupal\custom_text\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;



class MyConfigurationForm extends ConfigFormBase {

    /** 
     * Config settings.
     *
     * @var string
     */
    const SETTINGS = 'custom_text.settings';
  
    /** 
     * {@inheritdoc}
     */
    public function getFormId() {
      return 'custom_text_settings';
    }
  
    /** 
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
      return [
        static::SETTINGS,
      ];
    }
  
    /** 
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
      $config = $this->config(static::SETTINGS);
  
      $form['my_token'] = [
        '#type' => 'textfield',
        '#title' => $this->t('My Token'),
        '#default_value' => $config->get('my_token'),
      ];  
  
      $form['my_key'] = [
        '#type' => 'textfield',
        '#title' => $this->t('My Accress Key'),
        '#default_value' => $config->get('my_key'),
      ]; 
  
      $form['name'] = [
        '#type' => 'textfield',
        '#title' => $this->t('My Accress Key'),
        '#default_value' => $config->get('name'),
      ]; 
  
      return parent::buildForm($form, $form_state);
    }
  
    /** 
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
      // Retrieve the configuration.
      // Set the submitted configuration setting.
      $this->configFactory->getEditable(static::SETTINGS)
      ->set('my_key', $form_state->getValue('my_key'))
      ->set('my_token', $form_state->getValue('my_token'))
      ->set('name', $form_state->getValue('name'))
        ->save();
  
      parent::submitForm($form, $form_state);
    }
  
}
