<?php


namespace Drupal\cci_agenda\Service;

use Drupal\node\Entity\Node;

/**
 * Class AgendaService
 *
 * @package Drupal\agenda
 */
class AgendaService{
    
    /**
   * Fetch the events that will after the current day and retrieve 5 of them;
   *
   * @return array The nodes.
   *   empty if there is no node, array of nodes if there is.
   */
    public function lastEvents(){

        $date = Date('Y-m-d');
        
        $query = \Drupal::entityQuery('node')
                ->range(0,5)
                ->condition('field_cci_agenda_date_debut', $date, '>');
        
        $nodes = $query->execute();

    if (empty($nodes)) {
        return [];
      }
      return Node::loadMultiple($nodes);
    }
}