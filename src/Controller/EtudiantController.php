<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    /**
     * @Route("/etudiant/liste", name="etudiant_liste")
     */
    public function index(EtudiantRepository $etudiantRepository)
    {
        $etudiants = $etudiantRepository->findAll();
        return $this->render('etudiant/liste.html.twig', compact(('etudiants')));
    }

    /**
     * @Route("/etudiant/enregistrer", name="etudiant_register", methods={"POST","GET"})
     */
    public function enregistrer(Request $request, EntityManagerInterface $em):Response
    {
        $etudiant = new Etudiant();
        $form = $this->createForm(EtudiantType::class,$etudiant);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
           // dump($etudiant);
           
            $em = $this->getDoctrine()->getManager();
            $em->persist($etudiant);
            $em->flush();
        }
        //dump($form);
        //die();
        return $this->render('etudiant/enregistrer.html.twig', [
            'form' => $form->createView(),
            'editMode' => $etudiant->getId() !== null
        ]);
    }

     /**
     * @Route("/etudiant/{id<[0-9]+>}/edite", name="etudiant_edite", methods={"GET","POST"})
     */
    public function edite(Request $request,Etudiant $etudiant):Response
    {
        $form = $this->createForm(EtudiantType::class,$etudiant);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
           // $em->persist($etudiant);
            $em->flush();
            $this->addFlash('success', 'We saved a battle with id ' );
            return $this->redirectToRoute('etudiant_liste');
        }
        return $this->render('etudiant/enregistrer.html.twig', [
            'etudiant' => $etudiant,
             'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/etudiant/{id<[0-9]+>}/delete", name="etudiant_delete")
    */
    public function delete(EntityManagerInterface $em, etudiant $etudiant)
    {
        //dd($etudiant);
        $em->remove($etudiant);
        $em->flush();
        return $this->redirectToRoute('etudiant_liste');
    }
}
