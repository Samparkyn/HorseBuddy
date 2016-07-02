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
      * @Route("/horse")
      */
     public function listAction()
     {
       $em = $this->getDoctrine()->getManager();
       
       $horses = $em->getRepository('AppBundle:Horse')
             ->findAll();
       
      return $this->render('horse/list.html.twig', [
          'horses' => $horses
        ]);
     }
  
  /**
   * @Route("/horse/{horseName}", name="horse_show" )
   */
  public function showAction($horseName)
  {
    
    $em = $this->getDoctrine()->getManager();
        $horse = $em->getRepository('AppBundle:Horse')
            ->findOneBy(['name' => $horseName]);
        if (!$horse) {
            throw $this->createNotFoundException('horse not found :( )');
        }
        
    return $this->render('horse/show.html.twig', array(
            'horse' => $horse
        ));
       
  }
  
}
