<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MainController extends Controller
{
  /**
  * @Route("/", name="home")
  * @Method({"GET"})
  */
    public function homepageAction()
    {
        return $this->render('main/homepage.html.twig');
    }
}
