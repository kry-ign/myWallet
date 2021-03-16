<?php

namespace App\Controller;

use App\Command\Product\CreateProductCommand;
use App\Command\Product\DeleteProductCommand;
use App\Command\Product\EditProductCommand;
use App\Entity\Budget;
use App\Entity\Product;
use App\Form\ProductType;
use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product", name="budget_product.")
 */
class ProductController extends AbstractController
{
    private CommandBus $commandBus;

    public function __construct(
        CommandBus $commandBus
    ) {
        $this->commandBus = $commandBus;
    }

    /**
     * @Route("/{budgetId}/create", name="create", methods={"GET", "POST"}))
     * @ParamConverter("budget", options={"id" = "budgetId"});
     */
    public function create(Request $request, Budget $budget): Response
    {
        $command = new CreateProductCommand($budget);
        $form = $this->createForm(ProductType::class, $command, [
            'budgetLeft' => $budget->getLeftValue(),
        ])
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->commandBus->handle($command);

            return $this->redirectToRoute('budget.view', [
                'budgetId' => $budget->getId(),
            ]);
        }

        return $this->render('budget/add.html.twig', [
            'budgetForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{productId}", name="edit", methods={"GET", "POST"}))
     * @ParamConverter("product", options={"id" = "productId"});
     */
    public function edit(Request $request, Product $product): Response
    {
        $command = new EditProductCommand($product);
        $form = $this->createForm(ProductType::class, $command)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->commandBus->handle($command);

            return $this->redirectToRoute('budget.view', [
                'budgetId' => $product->getBudget()->getId(),
            ]);
        }

        return $this->render('budget/add.html.twig', [
            'budgetForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{productId}", name="delete"))
     * @ParamConverter("product", options={"id" = "productId"});
     */
    public function delete(Product $product): Response
    {
        $command = new DeleteProductCommand($product);
        $this->commandBus->handle($command);

        return $this->redirectToRoute('budget.view', [
            'budgetId' => $product->getBudget()->getId(),
        ]);
    }
}
