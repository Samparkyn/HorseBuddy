<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Stable;
use AppBundle\Entity\Horse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
    * @Route("/stable/new", name="stable_new")
    * @Method({"GET", "POST"})
    */
   public function newAction(Request $request)
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
      * @Route("/stable", name="stable")
      * @Method("GET")
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
   * @Method("GET")
   */
  public function showAction(Stable $stable)
  {
    
    // $em = $this->getDoctrine()->getManager();
    //     $stable = $em->getRepository('AppBundle:Stable')
    //         ->findOneBy(['name' => $stableName]);
    //     if (!$stable) {
    //         throw $this->createNotFoundException('stable not found :( )');
    //     }
        
    return $this->render('stable/show.html.twig', array(
            'stable' => $stable,
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
        ));
    }

}
