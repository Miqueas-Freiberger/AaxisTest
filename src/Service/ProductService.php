<?php
// src/Service/ProductService.php

namespace App\Service;

use App\Entity\Product;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ProductService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createProduct(Request $request)
    {
        //Decodes product data
        $productData = json_decode($request->getContent(), true);
        //If NOT has the property without iterate it, it means is an array with more than one product
        if (!isset($productData['sku'])) {
            //For each product i create and save it.
            foreach ($productData as $data) {
                $this->saveEntity($data);
            }
        } //Else if it has the property without iteration so it's only one.
        else {
            $this->saveEntity($productData);
        }
    }

    public function updateProduct(Request $request)
    {
        //Decodes product data
        $productData = json_decode($request->getContent(), true);
        //If NOT has the property without iterate it, it means is an array with more than one product
        if (!isset($productData['sku'])) {
            //For each product i create and save it.
            foreach ($productData as $data) {
                $findedProduct = $this->entityManager->getRepository(Product::class)->findOneBySku($data['sku']);
                $this->saveEntity($data, $findedProduct);
            }
        } //Else if it has the property without iteration so it's only one.
        else {
            $findedProduct = $this->entityManager->getRepository(Product::class)->findOneBySku($productData['sku']);
            $this->saveEntity($productData, $findedProduct);
        }
    }

    public function getAll()
    {
        return $this->entityManager->getRepository(Product::class)->findAll();
    }

    private function saveEntity($data, $findedProduct = null)
    {
        $product = $findedProduct == null ? new Product() : $findedProduct;
        $dateTimeNow = new DateTimeImmutable();
        if ($findedProduct) {
            $product->setName($data['name']);
            $product->setDescription($data['description']);
            $product->setUpdatedAt($dateTimeNow);
        } else {
            $product->setSku($data['sku']);
            $product->setName($data['name']);
            $product->setDescription($data['description']);
            $product->setCreatedAt($dateTimeNow);
            $product->setUpdatedAt($dateTimeNow);
        }
        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }


}
