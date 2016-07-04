<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Horse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\HorseType;

/**
 *
 */
class HorseController extends Controller
{
  
  /**
    * @Route("/horse/new")
    */
   public function newAction(Request $request)
   {
       $horse = new Horse();
       $horse->setName('Lysi');
       $horse->setAge(17);
       $horse->setBreed('French Trotter');
       $horse->setDisipline('Jumping');
       $horse->setStable($stable);
       
       $stable = new Stable();
       
       $form = $this->createForm('AppBundle\Form\HorseType', $horse);
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
             $em = $this->getDoctrine()->getManager();
             $em->persist($horse);
             $em->flush();

             return $this->redirectToRoute('horse_show', array('id' => $horse->getId()));
         }

         return $this->render('horse/new.html.twig', array(
             'horse' => $horse,
             'form' => $form->createView(),
         ));
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
