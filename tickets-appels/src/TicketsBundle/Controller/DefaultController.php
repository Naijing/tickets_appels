<?php

namespace TicketsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TicketsBundle:Default:index.html.twig');
    }
}
