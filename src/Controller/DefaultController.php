<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 * @Route(path="/", name="default_")
 */
class DefaultController extends AbstractController
{
//    #[Route('/default', name: 'default')]
//    public function index(): Response
//    {
//        return $this->render('default/index.html.twig', [
//            'controller_name' => 'DefaultController',
//        ]);
//    }

    /**
     * @Route (path="", name="home", methods={"GET"})
     * @param Request $request
     */
    #[Route(path: "home")]
    public function home(Request $request) {

        $html = "<h1 style='color:red;'>Hacked !</h1>";

        return $this->render('default/home.html.twig', ['html' => $html]);
    }

    /**
     * @Route(path="redirection", name="redirection")
     */
    public function redirection() {
        // Redirection sur une URL Externe
        #return $this->redirect('https://eni.fr');

        // Redirection sur une URL Interne (Nom de la route)
        return $this->redirectToRoute('default_home');
    }

    /**
     * @Route(path="contact", name="contact", methods={"GET"})
     */
    public function contact() {
        return $this->render('default/contact.html.twig');
    }

    /**
     * @Route(path="about-us", name="about_us", methods={"GET"})
     */
    public function aboutUs() {
        return $this->render('default/about_us.html.twig');
    }

    /**
     * @Route(path="legal-stuff", name="legal_stuff", methods={"GET"})
     */
    public function legalStuff() {
        return $this->render('default/legal_stuff.html.twig');
    }


}
