<?php

namespace Drupal\custom_text\Plugin\Block;


use Drupal\Core\Block\BlockBase;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;


/**
 * Provides a 'custom text ' block.
 *
 * @Block(
 *   id = "custom_text_block",
 *   admin_label = @Translation("Custom text block")
 * )
 */
class CustomTextBlock extends BlockBase implements ContainerFactoryPluginInterface  {

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
   * Constructor.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ConfigFactory $config_factory, AccountInterface $account, EntityTypeManagerInterface $entity_type_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->configFactory = $config_factory;
    $this->account = $account;
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    // Instantiates this form class.
    return new static(
      // Load the service required to construct this class.
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('config.factory'),
      $container->get('current_user'),
      $container->get('entity_type.manager')
    );
  }


  /**
   * {@inheritdoc}
   */
  public function build() {
    $items = ['himmat','kimmat','satwant'];
    $id = $this->account->id();
	  $user = $this->entityTypeManager->getStorage('user')->load($id);
    $heading_text =   $user->getDisplayName();;
    $subheading_text = "This is sub heading";
    return [
        '#theme' => 'custom_item_list',
        '#items' => $items,
        '#heading' => $heading_text,
        '#subheading' => $subheading_text,
        '#attached' => array('library' => array('custom_text/custom_text.text')),
    ];
  }

}
