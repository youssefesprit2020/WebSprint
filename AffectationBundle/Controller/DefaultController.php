<?php

namespace AffectationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AffectationBundle:Default:index.html.twig');
    }
}
