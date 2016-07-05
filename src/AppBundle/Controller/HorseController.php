<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Horse;
use AppBundle\Entity\Stable;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
    * @Route("/horse/new", name="horse_new")
    * @Method({"GET", "POST"})
    */
   public function newAction(Request $request)
   {
       $horse = new Horse();
       
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
      * @Route("/horse", name="horse")
      * @Method("GET")
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
   * @Route("/horse/{id}", name="horse_show" )
   */
  public function showAction(Horse $horse)
  {
    
    // $em = $this->getDoctrine()->getManager();
    //     $horse = $em->getRepository('AppBundle:Horse')
    //         ->findOneBy(['name' => $horseName]);
    //         // $stableName = $horse->getStable();
    //
    //     if (!$horse) {
    //         throw $this->createNotFoundException('horse not found :( )');
    //     }
        
    return $this->render('horse/show.html.twig', array(
            'horse' => $horse,
    
        ));
       
  }
  
  /**
   * Displays a form to edit an existing Horse entity.
   *
   * @Route("/{id}/edit", name="horse_edit")
   * @Method({"GET", "POST"})
   */
  public function editAction(Request $request, Horse $horse)
  {
      $editForm = $this->createForm('AppBundle\Form\HorseType', $horse);
      $editForm->handleRequest($request);

      if ($editForm->isSubmitted() && $editForm->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($horse);
          $em->flush();

          return $this->redirectToRoute('horse_edit', array('id' => $horse->getId()));
      }

      return $this->render('horse/edit.html.twig', array(
          'horse' => $horse,
          'edit_form' => $editForm->createView(),
      ));
  }

  
}
