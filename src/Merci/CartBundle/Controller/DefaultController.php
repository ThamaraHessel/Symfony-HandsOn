<?php

namespace Merci\CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Merci\CartBundle\Entity\Cart;

class DefaultController extends Controller
{
public function indexAction()
{
    $content = 'MerciCartBundle:Default:index.html.twig';

    $session = $this->get('session');
    $cart = $session->get('cart');
    if (!$cart || $cart->count() == 0) {
        $content = 'MerciCartBundle:Default:empty.html.twig';
    }

    return $this->render($content);
}

    public function addAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository('MerciCatalogBundle:Product')
            ->findOneById($id);

        if (!$product) {
            return $this->redirectAndNotify('Produto não existe');
        }

        $session = $this->get('session');
        $cart = $session->get('cart', new Cart());
        $cart->add($product);
        $session->set('cart', $cart);

        return $this->render('MerciCartBundle:Default:index.html.twig');
    }

    public function deleteAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository('MerciCatalogBundle:Product')
            ->findOneById($id);

        if (!$product) {
            return $this->redirectAndNotify();
        }

        $session = $this->get('session');
        $cart = $session->get('cart');
        if ($cart && $cart->count() > 0) {
            $cart->delete($product);
            $session->set('cart', $cart);
        }

        return $this->redirect($this->generateUrl('cart'));
    }

    public function updateAction()
    {
        $request = $this->getRequest();
        $id = $request->query->get('id');
        $quantity = $request->query->get('quantity');

        if (!$id || !$quantity) {
            return $this->redirectAndNotify('Não foi possivel atualizar o carrinho');
        }

        $product = $this->getDoctrine()
            ->getRepository('MerciCatalogBundle:Product')
            ->findOneById($id);

        if (!$product) {
            return $this->redirectAndNotify('Produto não existe');
        }

        $session = $this->get('session');
        $cart = $session->get('cart');
        if ($cart && $cart->count() > 0) {
            $cart->update($product, $quantity);
            $session->set('cart', $cart);
        }

        return $this->redirect($this->generateUrl('cart'));
    }

    protected function redirectAndNotify($message=null)
    {
        if ($message) {
            $this->get('session')->getFlashBag()->add('notice', $message);
        }
        return $this->redirect($this->generateUrl('cart'));
    }
}
