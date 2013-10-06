<?php

namespace Merci\CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Merci\CartBundle\Entity\Cart;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MerciCartBundle:Default:index.html.twig');
    }

    public function addAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository('MerciCatalogBundle:Product')
            ->findOneById($id);

        if (!$product) {
            $this->get('session')->getFlashBag()->add(
                'notice', 'Produto não existe'
            );
            return $this->redirect($this->generateUrl('cart'));
        }

        $session = $this->get('session');
        $cart = $session->get('cart', new Cart());
        $cart->add($product);
        $session->set('cart', $cart);

        return $this->render('MerciCartBundle:Default:index.html.twig');
    }

    public function deleteAction($id)
    {
        return $this->render('MerciCartBundle:Default:index.html.twig');
    }

    public function updateAction()
    {
        return $this->render('MerciCartBundle:Default:index.html.twig');
    }
}
