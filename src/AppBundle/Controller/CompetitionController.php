<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Competition;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Form\CompetitionType;

class CompetitionController extends Controller
{
  /**
    * @Route("/competition/new", name="competition_new")
    * @Method({"GET", "POST"})
    */
   public function newAction(Request $request)
   {
     $competition = new Competition();
     
     $form = $this->createForm('AppBundle\Form\CompetitionType', $competition);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($competition);
          $em->flush();
          
          $this->addFlash('success', 'Your competition was added!');

          return $this->redirectToRoute('competition_show', array('id' => $competition->getId()));
      }

      return $this->render('competition/new.html.twig', array(
          'competition' => $competition,
          'form' => $form->createView(),
      ));
     
   }
   
   /**
      * @Route("/competition", name="competition")
      * @Method("GET")
      */
     public function listAction()
     {
       $em = $this->getDoctrine()->getManager();
       
       $competitions = $em->getRepository('AppBundle:Competition')
             ->findAll();
       
      return $this->render('competition/list.html.twig', [
          'competitions' => $competitions
        ]);
     }
  
  /**
   * @Route("/competition/{id}", name="competition_show" )
   * @Method("GET")
   */
  public function showAction(Competition $competition)
  {
    
    $deleteForm = $this->createDeleteForm($competition);
        
    return $this->render('competition/show.html.twig', array(
            'competition' => $competition,
            'delete_form' => $deleteForm->createView()
        ));
      }
      
      /**
     * Displays a form to edit an existing Stable entity.
     *
     * @Route("/competition/{id}/edit", name="competition_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Competition $competition)
    {
        
        $editForm = $this->createForm('AppBundle\Form\CompetitionType', $competition);
        $editForm->handleRequest($request);
        $deleteForm = $this->createDeleteForm($competition);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($competition);
            $em->flush();

            return $this->redirectToRoute('competition_edit', array('id' => $competition->getId()));
        }

        return $this->render('competition/edit.html.twig', array(
            'competition' => $competition,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
            
        ));
    }
    
    /**
   * Deletes a Competition entity.
   *
   * @Route("/{id}", name="competition_delete")
   * @Method("DELETE")
   */
  public function deleteAction(Request $request, Competition $competition)
  {
      $form = $this->createDeleteForm($competition);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->remove($competition);
          $em->flush();
      }

      return $this->redirectToRoute('competition');
  }

  /**
   * Creates a form to delete a Stable entity.
   *
   * @param Competition $competition The Competition entity
   *
   * @return \Symfony\Component\Form\Form The form
   */
  private function createDeleteForm(Competition $competition)
  {
      return $this->createFormBuilder()
          ->setAction($this->generateUrl('competition_delete', array('id' => $competition->getId())))
          ->setMethod('DELETE')
          ->getForm()
      ;
  }

}
