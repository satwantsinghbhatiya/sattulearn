<?php

namespace Drupal\custom_text\Controller;


use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Messenger\MessengerInterface;


/**
 * Provides controllers for login, login status and logout via HTTP requests.
 */
class CustomText extends ControllerBase  {

  /**
   * Configuration Factory.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  /**
   * @var AccountInterface $account
   */
  protected $account;

  /**
   * @var Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   */
  protected $entityTypeManager;
/**
   * The Messenger service.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * Constructor.
   */
  public function __construct(ConfigFactory $config_factory, 
  AccountInterface $account, EntityTypeManagerInterface $entity_type_manager, MessengerInterface $messenger) {
    $this->configFactory = $config_factory;
    $this->account = $account;
    $this->entityTypeManager = $entity_type_manager;
    $this->messenger = $messenger;
    
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    // Instantiates this form class.
    return new static(
      // Load the service required to construct this class.
      $container->get('config.factory'),
      $container->get('current_user'),
      $container->get('entity_type.manager'),
      $container->get('messenger')
    );
  }

  public function display_content($id,$mtext) {
   // \Drupal::messenger()->addMessage("thisi is test message", 'status');
   $token = \Drupal::service('config.factory')->get('my_token');
 
	 
  //  $entities = $node->field_base_url->getValue();
	/*
	foreach($entities as $key => $value) {
		$basicpagenode = $this->entityTypeManager->getStorage('node')->load($value['target_id']);
		$nodes[] = $basicpagenode->getTitle();
		
	}
	*/
    $basicpagenode = $this->entityTypeManager->getStorage('node')->load($id);
    $token =  $this->configFactory->get('custom_text.settings')->get('my_token');

    return [
     '#markup' =>   $token,
    ];
  
  }
 
}
