<?php

namespace App\Controller;

use App\Entity\Admin;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
// constructeur pour ajout admin

    /*private $passwordEncoder;
public function  __construct (UserPasswordEncoderInterface $passwordEncoder ) {

     $this->passwordEncoder=$passwordEncoder;
} */


    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils,EntityManagerInterface $em ): Response
    {
   /*    // enregistrer un admin
        $user=new Admin();
        $user->setLogin("admin");
        $user->setPassword($this->passwordEncoder->encodePassword($user,"admin"));
        $em->persist($user); ww
        
        $em->flush();
 */
/*        if ($this->getUser()) {
             return $this->redirectToRoute('etudiant_liste');
         }*/

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
