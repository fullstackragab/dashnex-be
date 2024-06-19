<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Entity\CartItem;
use App\Entity\Product;

class CartStateProvider implements ProviderInterface
{
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        return [
            new CartItem(
                product: new Product(
                    id: 1,
                    title: 'SteelSeries Prime Wireless', 
                    image: '/images/mouse1.webp', 
                    price: 100, 
                    description: "I've always had a soft spot for Steelseries gaming mice. They're always so balanced: nice lights but not too many; not too expensive; and lovely, understated design. But it wasn't until the Steelseries Prime Wireless mouse that I really, truly, madly, deeply fell in love. The Prime Wireless mouse is a perfect fit for a wide range of hand sizes, and it isn't cluttered with extra buttons."), 
                amount: 3
            ),
        ];
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        if ($operation->getMethod() === 'POST') {
            $cart = $data;
            $product = $operation->getPayload();
            $cartItem = new CartItem(
                product: $product,
                amount: 1
            );
            $cart->addItem($cartItem);
            return $cart;
        } elseif ($operation->getMethod() === 'DELETE') {
            $cart = $data;
            $cartItemId = $uriVariables['id'];
            $cartItem = $cart->getItems()->findBy(['id' => $cartItemId])[0];
            $cart->removeItem($cartItem);
            return $cart;
        }

        return $data;
    }
}
