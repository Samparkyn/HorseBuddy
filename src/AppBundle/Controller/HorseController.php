<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 *
 */
class HorseController extends Controller
{
  
  /**
   * @Route("/horse/{horseName}")
   */
  public function showAction($horseName)
  {
    $templating = $this->container->get('templating');
    $html = $templating->render('horse/show.html.twig', array(
           'name' => $horseName
       ));
       
    return new Response($html);
  }
}
