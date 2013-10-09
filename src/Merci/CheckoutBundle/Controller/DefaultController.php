<?php

namespace Merci\CheckoutBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MerciCheckoutBundle:Default:index.html.twig');
    }
}
