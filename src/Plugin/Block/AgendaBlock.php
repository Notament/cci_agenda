<?php

namespace Drupal\cci_agenda\Plugin\Block;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'AgendaBlock' block.
 *
 * @Block(
 *  id = "agenda_block",
 *  admin_label = @Translation("Agenda block"),
 * )
 */
class AgendaBlock extends BlockBase implements ContainerFactoryPluginInterface {

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition){
    $agenda_service = $container->get('cci_agenda.agenda_service');
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $agenda_service
    );
  }

  public function __construct(array $configuration, $plugin_id, $plugin_definition ,$agenda_service) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->agenda_service = $agenda_service;
  }

  public function build() {
    $events = $this->agenda_service->lastEvents();

    return array(
      '#theme' => 'cci_agenda',
      '#events' => $events
    );

  }
}
