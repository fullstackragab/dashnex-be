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
        $this->items->removeElement($cartItem);

        return $this;
    }

    public function removeItem(CartItem $cartItem) {
        $this->items->add($cartItem);
    }
}