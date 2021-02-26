<?php



namespace App\Controller;

use App\Entity\Product;
use App\Form\NewProductAddType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(NewProductAddType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();

            if ($this->getUser()) {
                $entityProduct = new Product();
                $entityProduct->setProductName($form->get('ProductName')->getData());
                $entityProduct->setPrice($form->get('Price'));
                $entityProduct->addUser($this->getUser());

                $em->persist($entityProduct);
                $em->flush();
            }
        }

        return $this->render('index/index.html.twig', [
            'form' => $form->createView(),

        ]);
    }
}
