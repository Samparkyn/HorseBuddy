<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="competition")
*/
class Competition
{
  /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string")
     */
    private $location;
    
    /**
     * @ORM\Column(type="string")
     */
    private $discipline;
    
    /**
     * @ORM\Column(type="date")
     */
    private $date;
}
