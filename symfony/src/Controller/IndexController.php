<?php



namespace App\Controller;

use App\Entity\Budget;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\User;
use App\Form\NewProductAddType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    private ObjectManager $objectManager;
//
//    public function __construct(ObjectManager $objectManager)
//    {
//        $this->objectManager = $objectManager;
//    }

    /**
     * @Route("/", name="index")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $this->objectManager = $this->getDoctrine()->getManager();
//        $entity = new Budget(
//            22,
//            $this->getUser(),
//            new \DateTime('now')
//        );

        $productRepository = $this->objectManager->getRepository(Product::class);


        $wynik = $productRepository->find(1);


        $newCategory = new Category();

        $newCategory->setCategoryName('nowa2 ');
        $newCategory->setDescription('opis2');
        $newCategory->setProducts(new ArrayCollection([$wynik]));



        $this->objectManager->persist($newCategory);
        $this->objectManager->flush();

        dd('exi2s');

        dd('exis');
        $form = $this->createForm(NewProductAddType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
//            dd($this->getUser());

            $this->objectManager = $this->getDoctrine()->getManager();
//            dd($form->get('category')->getData());

            if ($this->getUser()) {
                $entityProduct = new Product();
                $entityProduct->setProductName($form->get('ProductName')->getData());
                $entityProduct->setPrice($form->get('Price')->getData());
                $entityProduct->setCategory($form->get('category')->getData());
                $entityProduct->addUser($this->getUser());
//                $entityProduct->setCategoryID($this->getUser());

                $em->persist($entityProduct);
                $em->flush();
            }
        }

        return $this->render('index/index.html.twig', [
            'form' => $form->createView(),

        ]);
    }
}
