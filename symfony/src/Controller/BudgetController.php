<?php

declare(strict_types=1);

namespace App\Controller;

use App\Command\CreateBudgetCommand;
use App\Entity\Product;
use App\Form\BudgetType;
use App\Service\BudgetService;
use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/budget", name="budget.")
 */
class BudgetController extends AbstractController
{
    private BudgetService $budgetService;
    private CommandBus $commandBus;


    public function __construct(
        BudgetService $budgetService,
        CommandBus $commandBus
    )
    {
        $this->budgetService = $budgetService;
        $this->commandBus = $commandBus;
    }

    /**
     * @Route("/list", name="list")
     * @param Request $request
     *
     * @return Response
     */
    public function list(Request $request): Response
    {
        return $this->render('budget/list.html.twig', [
            'budgets' => $this->budgetService->findAllByUser($this->getUser()),
        ]);
    }

    /**
     * @Route("/add", name="add")
     * @param Request $request
     *
     * @return Response
     */
    public function add(Request $request): Response
    {
        $command = new CreateBudgetCommand();
        $form = $this->createForm(BudgetType::class, $command)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->commandBus->handle($command);
        }

        return $this->render('budget/add.html.twig', [
            'budgetForm' => $form->createView(),
        ]);
    }
}
