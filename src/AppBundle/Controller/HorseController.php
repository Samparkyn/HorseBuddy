<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 *
 */
class HorseController
{
  
  /**
   * @Route("/horse")
   */
  public function showAction()
  {
    return new Response('Hey horsey');
  }
}
