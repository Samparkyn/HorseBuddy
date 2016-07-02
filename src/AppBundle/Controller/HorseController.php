<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Horse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 *
 */
class HorseController extends Controller
{
  
  /**
    * @Route("/horse/new")
    */
   public function newAction()
   {
       $horse = new Horse();
       $horse->setName('Lysi');
       $horse->setAge(17);
       $horse->setBreed('French Trotter');
       $horse->setDisipline('Jumping');
       
       
       $em = $this->getDoctrine()->getManager();
        $em->persist($horse);
        $em->flush();
        
        return new Response('<html><body>Horse added!</body></html>');
   }
  
  /**
   * @Route("/horse/{horseName}")
   */
  public function showAction($horseName)
  {
    return $this->render('horse/show.html.twig', array(
            'name' => $horseName
        ));
       
    return new Response($html);
  }
}
