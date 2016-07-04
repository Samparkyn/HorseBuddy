<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="horse")
 */
class Horse
{
  
  /**
    * @var Stable
    *
    * @ORM\ManyToOne(targetEntity="Stable", inversedBy="horse")
    * @ORM\JoinColumn(name="stable_id", referencedColumnName="id")
    */
    
    private $stable;
  
  /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $age;
    
    /**
     * @ORM\Column(type="string")
     */
    private $breed;
    
    /**
     * @ORM\Column(type="string")
     */
    private $disipline;
    

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Horse
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Horse
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set breed
     *
     * @param string $breed
     *
     * @return Horse
     */
    public function setBreed($breed)
    {
        $this->breed = $breed;

        return $this;
    }

    /**
     * Get breed
     *
     * @return string
     */
    public function getBreed()
    {
        return $this->breed;
    }

    /**
     * Set disipline
     *
     * @param string $disipline
     *
     * @return Horse
     */
    public function setDisipline($disipline)
    {
        $this->disipline = $disipline;

        return $this;
    }

    /**
     * Get disipline
     *
     * @return string
     */
    public function getDisipline()
    {
        return $this->disipline;
    }

    /**
     * Set stable
     *
     * @param \AppBundle\Entity\Stable $stable
     *
     * @return Horse
     */
    public function setStable(Stable $stable)
    {
        $this->stable = $stable;

        return $this;
    }

    /**
     * Get stable
     *
     * @return \AppBundle\Entity\Stable
     */
    public function getStable()
    {
        return $this->stable;
    }
}
