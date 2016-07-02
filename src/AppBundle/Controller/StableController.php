<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Stable;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 *
 */
class StableController extends Controller
{
  /**
    * @Route("/stable/new")
    */
   public function newAction()
   {
       $stable = new Stable();
       $stable->setName('Chavannes des Bois Poney Club');
       $stable->setLocation('Chavannes des Bois');
       $stable->setCapacity(50);
       
       
       $em = $this->getDoctrine()->getManager();
        $em->persist($stable);
        $em->flush();
        
        return new Response('<html><body>Stable added!</body></html>');
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
            'stable' => $stable
        ));
      }
}
