<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    public function list(Request $request): Response
    {
        return $this->render('product/list.html.twig', [
            'budgets' => $this->budgetService->findAllProductList,
        ]);
    }
}