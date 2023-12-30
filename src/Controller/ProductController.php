<?php

namespace App\Controller;

use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private ProductService $productService;

    function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    #[Route('/product', name: 'app_product', methods: ['GET'])]
    public function listProducts(): JsonResponse
    {
        try {

            //I get all the records from the DB
            $productsArray = $this->productService->getAll();

            $formattedProducts = [];
            foreach ($productsArray as $product) {
                $formattedProducts[] = [
                    'id' => $product->getId(),
                    'sku' => $product->getSku(),
                    'name' => $product->getName(),
                    'description' => $product->getDescription(),
                    'created_at' => $product->getCreatedAt()->format('Y-m-d H:i:s'),
                    'updated_at' => $product->getUpdatedAt()->format('Y-m-d H:i:s'),
                ];
            }

            // Convert the array to JSON format
            $jsonResponse = json_encode(['data' => $formattedProducts]);

            // Return the JSON response
            return new JsonResponse($jsonResponse, JsonResponse::HTTP_OK, [], true);
        } catch (\Throwable $th) {
            return $this->json([
                'data' => $th->getMessage(),
            ]);
        }
    }

    #[Route('/product/load', name: 'app_product_load', methods: ['POST'])]
    public function loadProducts(Request $request): JsonResponse
    {
        try {
            if (!empty($request)) {
                //Call product service with the request param who contains the new product data.
                $this->productService->createProduct($request);
                return $this->json([
                    'data' => 'The product was created correctly',
                ]);
            }
            else{
                return $this->json([
                    'data' => 'Please, complete all inputs.',
                ]);
            }
        } catch (\Throwable $th) {
            return $this->json([
                'data' => $th->getMessage(),
            ]);
        }
    }

    #[Route('/product/update', name: 'app_product_update', methods: ['PUT'])]
    public function updateProducts(Request $request): JsonResponse
    {
        try {
            $this->productService->updateProduct($request);
            return $this->json([
                'data' => 'The product was updated correctly',
            ]);
        } catch (\Throwable $th) {
            return $this->json([
                'data' => $th->getMessage(),
            ]);
        }
    }
}
