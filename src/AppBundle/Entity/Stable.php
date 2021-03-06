<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity
 * @ORM\Table(name="stable")
 */
class Stable
{
  
  /**
    * @var ArrayCollection
    *
    * @ORM\OneToMany(targetEntity="Horse", mappedBy="stable")
    */
    private $horse;
  
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
     * @ORM\Column(type="string")
     */
    private $location;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $capacity;
    
    /**
     * @Vich\Uploadablefield(mapping="stable_image", fileNameProperty="imageName")
     *
     * @var File
     */
    private $image;
    
    


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
     * @return Stable
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
     * Set location
     *
     * @param string $location
     *
     * @return Stable
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set capacity
     *
     * @param integer $capacity
     *
     * @return Stable
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return integer
     */
    public function getCapacity()
    {
        return $this->capacity;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->horse = new ArrayCollection();
    }
    
    public function __toString(){
    return $this ->getName();
  }

    /**
     * Add horse
     *
     * @param \AppBundle\Entity\Horse $horse
     *
     * @return Stable
     */
    public function addHorse(\AppBundle\Entity\Horse $horse)
    {
        $this->horse[] = $horse;

        return $this;
    }

    /**
     * Remove horse
     *
     * @param \AppBundle\Entity\Horse $horse
     */
    public function removeHorse(\AppBundle\Entity\Horse $horse)
    {
        $this->horse->removeElement($horse);
    }

    /**
     * Get horse
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHorse()
    {
        return $this->horse;
    }
    
    /**
     * Set image
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Stable
     */
    public function setImage(File $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return File
     */
    public function getImage()
    {
        return $this->image;
    }
}
