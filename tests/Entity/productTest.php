<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testGetAndSetTitle(): void
    {
        $product = new Product();
        $product->setTitle('Test Product');
        $this->assertEquals('Test Product', $product->getTitle());
    }

    public function testGetAndSetPrice(): void
    {
        $product = new Product();
        $product->setPrice(99.99);
        $this->assertEquals(99.99, $product->getPrice());
    }
}