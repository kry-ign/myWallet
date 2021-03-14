<?php

namespace App\Controller;

use App\Command\CreateBudgetCommand;
use App\Entity\Budget;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\User;
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

//        dd($form);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->commandBus->handle($command);
//
//            if ($this->getUser()) {
//                $entityProduct = new Product();
//                $entityProduct->setProductName($form->get('ProductName')->getData());
//                $entityProduct->setPrice($form->get('Price')->getData());
//                $entityProduct->setCategory($form->get('category')->getData());
//                $entityProduct->addUser($this->getUser());
////                $entityProduct->setCategoryID($this->getUser());
//
//                $this->objectManager->persist($entityProduct);
//                $this->objectManager->flush();
//            }
        }

        return $this->render('budget/add.html.twig', [
//            'form' => $form->createView(),
            'budgetForm' => $form->createView(),
//            'budget' => $budget,
//            'product' => $product

        ]);
    }
//
//    public function __construct(ObjectManager $objectManager)
//    {
//        $this->objectManager = $objectManager;
//    }

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


//    /**
//     * @Route("/test", name="index")
//     * @param Request $request
//     * @return Response
//     */
//    public function index(Request $request): Response
//    {
////        $this->objectManager = $this->getDoctrine()->getManager();
////        $entity = new Budget(
////            22,
////            $this->getUser(),
////            new \DateTime('now')
////        );
////
////        $productRepository = $this->objectManager->getRepository(Product::class);
////
////
////        $wynik = $productRepository->find(1);
////
////
////        $newCategory = new Category();
////
////        $newCategory->setCategoryName('nowa2 ');
////        $newCategory->setDescription('opis2');
////        $newCategory->setProducts(new ArrayCollection([$wynik]));
//
//
////
////        $this->objectManager->persist($newCategory);
////        $this->objectManager->flush();
//
////        dd('exi2s');
////
////        dd('exis');
//
//        $product = $this->getDoctrine()
//            ->getRepository(Product::class)
//            ->findAll();
//
//        $budget = $this->getDoctrine()
//            ->getRepository(Budget::class)
//            ->findAll();
//
//        $formBudget = $this->createForm(BudgetType::class);
//
//        $formBudget->handleRequest($request);
//
//
//        $form = $this->createForm(NewProductAddType::class);
//        if ($form->isSubmitted()) {
////            dd($this->getUser());
//
//            $this->objectManager = $this->getDoctrine()->getManager();
////            dd($form->get('category')->getData());
//
//            if ($this->getUser()) {
//            $budget = new Budget();
//            $budget->setValue($formBudget->get('value')->getData());
//            $budget->setMonth(new \DateTime('now'));
//            $budget->setUsers($this->getUser());
//
//            $this->objectManager->persist($budget);
//            $this->objectManager->flush();
//            }
//        }
//
//$form = $this->createForm(NewProductAddType::class);
//        $form->handleRequest($request);
//        if ($form->isSubmitted()) {
////            dd($this->getUser());
//
//            $this->objectManager = $this->getDoctrine()->getManager();
////            dd($form->get('category')->getData());
//
//            if ($this->getUser()) {
//                $entityProduct = new Product();
//                $entityProduct->setProductName($form->get('ProductName')->getData());
//                $entityProduct->setPrice($form->get('Price')->getData());
//                $entityProduct->setCategory($form->get('category')->getData());
//                $entityProduct->addUser($this->getUser());
////                $entityProduct->setCategoryID($this->getUser());
//
//                $this->objectManager->persist($entityProduct);
//                $this->objectManager->flush();
//            }
//        }
//
//        return $this->render('index/index.html.twig', [
//            'form' => $form->createView(),
//            'formBudget' => $formBudget->createView(),
//            'budget' => $budget,
//            'product' => $product
//
//        ]);

}
