<?php

namespace Drupal\testing_module\Controller;

Use Drupal\Core\Controller\ControllerBase;

class WelcomeController extends ControllerBase {  
    
    public function listings() {

    return array(

      '#type' => 'markup',

      '#markup' => ('welcome to our website'),

    );

  }
}