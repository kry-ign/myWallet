<?php


namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ProductShowController extends AbstractController
{
    public function showProduct(int $id): Response
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        return new Response($product->getProductName());

//        return $this->render('index.html.twig', [
//            'product' => $product
//        ]);
    }
}