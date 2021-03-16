<?php

namespace App\Controller;

use App\Command\Budget\CreateBudgetCommand;
use App\Command\Budget\DeleteBudgetCommand;
use App\Command\Budget\EditBudgetCommand;
use App\Entity\Budget;
use App\Form\BudgetType;
use App\Service\BudgetService;
use League\Tactician\CommandBus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
    ) {
        $this->budgetService = $budgetService;
        $this->commandBus = $commandBus;
    }

    /**
     * @Route("/", name="index")
     */
    public function list(): Response
    {
        return $this->render('budget/list.html.twig', [
            'budgets' => $this->budgetService->findAllByUser($this->getUser()),
        ]);
    }

    /**
     * @Route("/create", name="create", methods={"GET", "POST"}))
     */
    public function create(Request $request): Response
    {
        $command = new CreateBudgetCommand();
        $form = $this->createForm(BudgetType::class, $command)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->commandBus->handle($command);

            return $this->redirectToRoute('budget.index');
        }

        return $this->render('budget/add.html.twig', [
            'budgetForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{budgetId}", name="view")
     * @ParamConverter("budget", options={"id" = "budgetId"});
     */
    public function view(Budget $budget): Response
    {
        return $this->render('budget/view.html.twig', [
            'budget' => $budget,
            'products' => $this->budgetService->getProducts($budget),
        ]);
    }

    /**
     * @Route("/edit/{budgetId}", name="edit", methods={"GET", "POST"}))
     * @ParamConverter("budget", options={"id" = "budgetId"});
     */
    public function edit(Request $request, Budget $budget): Response
    {
        $command = new EditBudgetCommand($budget);
        $form = $this->createForm(BudgetType::class, $command)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->commandBus->handle($command);

            return $this->redirectToRoute('budget.index');
        }

        return $this->render('budget/add.html.twig', [
            'budgetForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{budgetId}", name="delete"))
     * @ParamConverter("budget", options={"id" = "budgetId"});
     */
    public function delete(Budget $budget): Response
    {
        $command = new DeleteBudgetCommand($budget);
        $this->commandBus->handle($command);

        return $this->redirectToRoute('budget.index');
    }
}
