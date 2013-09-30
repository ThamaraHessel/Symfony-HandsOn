<?php

namespace Merci\CatalogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MerciCatalogBundle:Default:index.html.twig');
    }

    public function productAction()
    {
        return $this->render('MerciCatalogBundle:Default:product.html.twig');
    }
}
