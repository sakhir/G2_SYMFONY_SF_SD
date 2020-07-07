<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Form\ChambreType;
use App\Repository\ChambreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChambreController extends AbstractController
{
    /**
     * @Route("/chambre/liste", name="chambre_liste")
     */
    public function index(ChambreRepository $chambreRepository)
    {
        $chambres = $chambreRepository->findAll();
        return $this->render('chambre/liste.html.twig', compact(('chambres')));
    }


    // je dois creer une fonction  qui prend le numero du batiment et
    // genere le numero de  la chambre en fonction du numbat

    public function GenNumChambre($numbat) {
        $alea=rand();
        $alea=substr($alea,0,4);
        $numba=strval($numbat) ;
        $zer="00".$numba;
        $numcham=$zer."_".$alea;

        return $numcham;


    }


    /**
     * @Route("/chambre/enregistrer", name="chambre_register", methods={"POST","GET"})
     */
    public function enregistrer(Request $request, EntityManagerInterface $em):Response
    {
        $chambre = new Chambre();
       // $numc=$chambre->getNumeroBatiment();
        $form = $this->createForm(ChambreType::class,$chambre);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
              $numc=$chambre->getNumeroBatiment()->getNumero();
              $numcham=$this->GenNumChambre($numc);
              $chambre->setNumero($numcham);
            //dd($chambre->getNumeroBatiment()->getNumero());
             $em = $this->getDoctrine()->getManager();
            $em->persist($chambre);
            $em->flush();
        }
        //dump($form);
        return $this->render('chambre/enregistrer.html.twig', [
            'form' => $form->createView(),
            'editMode' => $chambre->getId() !== null
        ]);
    }

     /**
     * @Route("/chambre/{id<[0-9]+>}/edite", name="chambre_edite", methods={"GET","POST"})
     */
    public function edite(Request $request,Chambre $chambre):Response
    {
        $form = $this->createForm(ChambreType::class,$chambre);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
           // $em->persist($chambre);
            $em->flush();
            $this->addFlash('success', 'We saved a battle with id ' );
            return $this->redirectToRoute('chambre_liste');
        }
        return $this->render('chambre/enregistrer.html.twig', [
            'chambre' => $chambre,
             'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/chambre/{id<[0-9]+>}/delete", name="chambre_delete")
    */
    public function delete(EntityManagerInterface $em, chambre $chambre)
    {
        //dd($chambre);
        $em->remove($chambre);
        $em->flush();
        return $this->redirectToRoute('chambre_liste');
    }
}
