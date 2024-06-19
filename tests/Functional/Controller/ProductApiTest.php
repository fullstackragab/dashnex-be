<?php

namespace App\Tests\Functional;

use App\Entity\Product;
use Codeception\Test\Unit;
use Symfony\Component\HttpFoundation\Response;

class ProductApiTest extends Unit
{
    /**
     * @var \FunctionalTester
     */
    protected $tester;

    public function testGetProductsList(): void
    {
        $this->tester->sendGET('/api/products');
        $this->tester->seeResponseCodeIs(Response::HTTP_OK);
        $this->tester->seeResponseIsJson();
        $this->tester->seeResponseContainsJson([
            'data' => [],
        ]);
    }

    public function testCreateProduct(): void
    {
        $productData = [
            'title' => 'Test Product',
            'price' => 19.99,
        ];

        $this->tester->sendPOST('/api/products', $productData);
        $this->tester->seeResponseCodeIs(Response::HTTP_CREATED);
        $this->tester->seeResponseIsJson();
        $this->tester->seeResponseContainsJson($productData);

        $product = $this->tester->grabEntityFromRepository(Product::class, ['title' => 'Test Product']);
        $this->assertNotNull($product);
        $this->assertEquals($productData['title'], $product->getTitle());
        $this->assertEquals($productData['price'], $product->getPrice());
    }
}