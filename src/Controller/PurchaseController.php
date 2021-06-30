<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Purchase;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PurchaseType;

/**
 * @Route("purchase/", name="purchase_")
 */
class PurchaseController extends AbstractController
{
    /**
     * @Route("", name="index")
     */
    public function index(): Response
    {
        
        $purchase = $this->getDoctrine()
        ->getRepository(Purchase::class)
        ->findAll();

        return $this->render('purchase/index.html.twig', [
            'purchases' => $purchase
        ]);
    }


     /**
     * The controller for the category add form
     * Display the form or deal with it
     *
     * @Route("new", name="new")
     */
     public function new(Request $request) : Response
     {
         // Create a new purchase Object
         $purchase = new Purchase();
         // Create the associated Form
         $form = $this->createForm(PurchaseType::class, $purchase);
         // Get data from HTTP request
         $form->handleRequest($request);
         // Was the form submitted ?
         if ($form->isSubmitted()) {
             // Deal with the submitted data
         // Get the Entity Manager
         $entityManager = $this->getDoctrine()->getManager();
         // Persist Category Object
         $entityManager->persist($purchase);
         // Flush the persisted object
         $entityManager->flush();
         // Finally redirect
         return $this->redirectToRoute('purchase_discount');
         }
         // Render the form
         return $this->render('purchase/new.html.twig', ["form" => $form->createView()]);
     }      

   /**
     * @Route("discount", name="discount")
     */
    public function discount():Response 
    {
        
        //récupérer le dernier id de la BDD après création
        
        $repository = $this->getDoctrine()
                        ->getManager()
                        ->getRepository(Purchase::class);
        $purchases = $repository->findBy(array(), array('id' => 'desc'),1,0);
        $purchase = $purchases[0];
        
        $repositoryName = $this->getDoctrine()
                        ->getManager()
                        ->getRepository(Purchase::class);
        $userName = $purchase->getUserName();    

        $forDiscounts = $repositoryName->findBy(array('userName' => $userName ));
        
        $nbreUser = count($forDiscounts);

        $discountOk = 0;
        if($nbreUser >= 3) {
            $discountOk = 1;
        }


        return $this->render('purchase/algo.html.twig',
             ['forDiscounts' => $forDiscounts, 'userName' => $userName, 'nbreUser' => $nbreUser, 'discountOk' => $discountOk]);

    }


}