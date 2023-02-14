<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Put;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\OpenApi\Model\Operation;
use App\State\CartStateProcessor;

#[ORM\Entity()]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(paginationEnabled: false),
        new Put(
            processor: CartStateProcessor::class,
            uriTemplate: '/product/{id}/cart',
            formats: ['json'],
            openapiContext: [
                'requestBody' => [
                    'description' => 'Puts Product to the Cart',
                    'content' => [
                         'application/json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'amount' => ['type' => 'integer'],
                                ],
                                'required' => ['amount']
                            ],
                        ],
                    ]
                ]
            ]
        ),
        new Delete(
            processor: CartStateProcessor::class, 
            uriTemplate: '/product/{id}/cart', 
            openapi: new Operation(
                summary: 'Removes Product from the cart',
                description: 'Removes Product from the cart. Doesn\'t require any request body',
            ),
        ),
    ]
)]
class Product
{
    public function __construct(
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?int $id = null,

        #[ORM\Column(length: 255)]
        private ?string $title = null,

        #[ORM\Column(length: 255, nullable: true)]
        private ?string $image = null,

        #[ORM\Column]
        private ?float $price = null,

        #[ORM\Column(length: 1000)]
        private ?string $description = null,
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->title;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
