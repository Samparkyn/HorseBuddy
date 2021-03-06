<?php

namespace AppBundle\Entity;

use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface
{
  
  /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
   private $id;
   /**
    * @ORM\Column(type="string", unique=true)
    */
   private $email;
  
  private $username;
  
  public function getUsername()
  {
    return $this->username;
  }
  
  public function setUsername($username)
   {
       $this->username = $username;
   }
   
public function getRoles()
  {
    return ['ROLE_USER'];
  }
  
public function getPassword()
  {
    
  }
  
public function getSalt()
  {
    
  }
  
public function eraseCredentials()
  {
    
  }

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
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}
