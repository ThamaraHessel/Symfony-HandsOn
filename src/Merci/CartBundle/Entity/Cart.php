<?php
namespace Merci\CartBundle\Entity;
use \ArrayObject;
use Merci\CatalogBundle\Entity\Product;

class Cart extends ArrayObject
{
    public function __constructor()
    {
        $this->setFlags(ArrayObject::ARRAY_AS_PROPS);
    }

    public function add(Product $product)
    {
        if ($this->offsetExists($product->getId())) {
            $cartItem = $this->offsetGet($product->getId());
            $newQuantity = $cartItem->quantity + 1;
            $this->update($product, $newQuantity);
        } else {
            $cartItem = new ArrayObject();
            $cartItem->setFlags(ArrayObject::ARRAY_AS_PROPS);
            $cartItem->offsetSet('product', $product);
            $cartItem->offsetSet('quantity', 1);
            $this->offsetSet($product->getId(), $cartItem);
        }
    }

    public function delete(Product $product)
    {
        $this->offsetUnset($product->getId());
    }

    public function update(Product $product, $quantity)
    {
        $isValidQuantity = round($quantity) && ($quantity > 0 && $quantity <= 10);
        if ($isValidQuantity && $this->offsetExists($product->getId())) {
            $cartItem = $this->offsetGet($product->getId());
            $cartItem->quantity = $quantity;
        }
    }

    public function getQuantity()
    {
        $quantity = 0;
        foreach ($this as $cartItem) {
            $quantity += $cartItem->quantity;
        }
        return $quantity;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this as $cartItem) {
            $total += $cartItem->product->getPrice() * $cartItem->quantity;
        }
        return $total;
    }
}