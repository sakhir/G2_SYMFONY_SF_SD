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

    // je dois creer une fonction  qui prend le prenom de l etudiant , son nom et
    // genere son matricule

    public function GenMatricule($pren,$nom)
    {
        $annee=date('Y');
        $alea=rand();
        $alea=substr($alea,0,4);
        // deux premiers lettre du nom
        $nn= strtoupper(substr($nom,0,2));
        $pp= strtoupper(substr($pren,0,-2));
        $matricule=$annee.$nn.$pp.$alea;
        return $matricule;


    }

    /**
     * @Route("/etudiant/enregistrer", name="etudiant_register", methods={"POST","GET"})
     */
    public function enregistrer(Request $request, EntityManagerInterface $em):Response
    {
        $etudiant = new Etudiant();

        $etudiant->setDateinscription(new \DateTime("now"));

        $form = $this->createForm(EtudiantType::class,$etudiant);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            // verifier dabord si la bourse est non
            if ($_POST['etudiant']['bourse']=="non") {

                $etudiant->setAddresse($_POST["addresse"]);
                $etudiant->setLoge("Neant");
                $etudiant->setChambre(null);
                $etudiant->setNomchambre("Neant");


            }
            if ($_POST['etudiant']['bourse']=="oui") {
                // verifions si l etudiant est loge ou non

                  if ($_POST['loge']=="non") {

                      $etudiant->setAddresse($_POST["addresse"]);
                      $etudiant->setLoge("Neant");
                      $etudiant->setChambre(null);
                      $etudiant->setNomchambre("Neant");


                  }
                  // la l etudiant a une bourse et a un logement
                  else {
                      $etudiant->setNomchambre($etudiant->getChambre()->getNumero());
                      $etudiant->setLoge("Oui");
                      $etudiant->setChambre($etudiant->getChambre());
                  }
                //dd($_POST);


                }

       // dd($_POST);
           $etudiant->setMatricule($this->GenMatricule($etudiant->getNom(),$etudiant->getPrenom()));
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
