<?php

namespace App\Controller;

use App\Entity\Wish;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wish/", name="wish_")
 */
class WishController extends AbstractController
{
    #[Route(path: '/wish', name: 'wish', methods: '{"GET"}')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        for ($i=0;$i<5;$i++)

            $wish = new Wish();
            $wish->setTitle("Wish n° ".$i) ;
            $wish->setAuthor("Me");
            $wish->setIsPublished(false);


            $entityManager->persist($wish);


        return $this->render('wish/list.html.twig', ['controller_name' => 'WishController',]);
    }

    /**
     * @Route(path="", name="list", methods={"GET"})
     */
    public function list() {
        return $this->render('wish/list.html.twig');
    }

    /**
     * @Route(path="{id}", requirements={"id": "\d+"}, name="details", methods={"GET"})
     */
    public function details(Request $request) {

        // Récupération de l'identifiant
        $id = (int) $request->get('id');

        return $this->render('wish/details.html.twig', ['id' => $id]);
    }

}
