<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Stable;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Form\StableType;

/**
 *
 */
class StableController extends Controller
{
  /**
    * @Route("/stable/new")
    * @Method({"GET", "POST"})
    */
   public function newAction()
   {
       $stable = new Stable();
       $form = $this->createForm('AppBundle\Form\StableType', $stable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($stable);
            $em->flush();

            return $this->redirectToRoute('stable_show', array('id' => $stable->getId()));
        }

        return $this->render('stable/new.html.twig', array(
            'stable' => $stable,
            'form' => $form->createView(),
        ));
   }
   
   /**
      * @Route("/stable")
      */
     public function listAction()
     {
       $em = $this->getDoctrine()->getManager();
       
       $stables = $em->getRepository('AppBundle:Stable')
             ->findAll();
       
      return $this->render('stable/list.html.twig', [
          'stables' => $stables
        ]);
     }
  
  /**
   * @Route("/stable/{stableName}", name="stable_show" )
   */
  public function showAction($stableName)
  {
    
    $em = $this->getDoctrine()->getManager();
        $stable = $em->getRepository('AppBundle:Stable')
            ->findOneBy(['name' => $stableName]);
        if (!$stable) {
            throw $this->createNotFoundException('stable not found :( )');
        }
        
    return $this->render('stable/show.html.twig', array(
            'stable' => $stable,
            'delete_form' => $deleteForm->createView()
        ));
      }
      
      /**
     * Displays a form to edit an existing Stable entity.
     *
     * @Route("/{id}/edit", name="stable_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Stable $stable)
    {
        $deleteForm = $this->createDeleteForm($stable);
        $editForm = $this->createForm('AppBundle\Form\StableType', $stable);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($stable);
            $em->flush();

            return $this->redirectToRoute('stable_edit', array('id' => $stable->getId()));
        }

        return $this->render('stable/edit.html.twig', array(
            'stable' => $stable,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Deletes a Stable entity.
     *
     * @Route("/{id}", name="stable_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Stable $stable)
    {
        $form = $this->createDeleteForm($stable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($stable);
            $em->flush();
        }

        return $this->redirectToRoute('stable_index');
    }

    /**
     * Creates a form to delete a Stable entity.
     *
     * @param Stable $stable The Stable entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Stable $stable)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('stable_delete', array('id' => $stable->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
