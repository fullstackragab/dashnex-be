<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\OpenApi\Model\Operation;
use App\State\CartStateProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ApiResource(
    operations: [
        new Get(
            provider: CartStateProvider::class, 
            uriTemplate: '/cart',
            openapi: new Operation(
                summary: 'Retrieves cart content'
            )
            ),
        new Post(
            uriTemplate: '/cart',
            openapi: new Operation(
                summary: 'Adds a product to the cart'
            )
        ),
        new Delete(
            uriTemplate: '/cart/{id}',
            openapi: new Operation(
                summary: 'Removes a product from the cart'
            )
        )
    ]
)]
class Cart
{
    public Collection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems(Collection $items) {
        $this->items = $items;

        return $this;
    }

    public function addItem(CartItem $cartItem) {
        if (!$this->items->contains($cartItem)) {
            $this->items->add($cartItem);
        }

        return $this;
    }

    public function removeItem(CartItem $cartItem) {
        if ($this->items->contains($cartItem)) {
            $this->items->removeElement($cartItem);
        }
    }
}