<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/book/", name="book_")
 */
class BookController extends AbstractController
{
    /**
     * @Route(path="create", name="create", methods={"GET"})
     */
    public function create(EntityManagerInterface $entityManager) {

        // Insertion
        $book = new Book();
        $book->setTitle("Symfony");
        $book->setAuthor("ENI");
        $book->setPages(200);
        $book->setDatePublished(new DateTime('now'));

        // Ajout de l'objet dans la "TODOLIST" de Doctrine
        $entityManager->persist($book);

        // Traitement de la "TODOLIST" de Doctrine
        $entityManager->flush();

        return $this->render('book/test.html.twig');
    }

    /**
     * @Route(path="obtain", name="obtain", methods={"GET"})
     */
    public function obtain(EntityManagerInterface $entityManager, BookRepository $bookRepository) {

        // Récupération d'un élément par @ORM\ID
        // Façon 1
        $book = $this->getDoctrine()->getRepository('App:Book')->find(3);

        // Façon 2
        $book = $entityManager->getRepository('App:Book')->find(3);

        // Façon 3
        $book = $bookRepository->find(3);
        dump($book);

        // Récupération de tous les éléments
        $books = $entityManager->getRepository('App:Book')->findAll();
        dump($books);

        // Récupération de tous les éléments par critéres
        $books = $entityManager->getRepository('App:Book')->findBy(['title' => 'Symfony', 'author' => 'ENI'], ['id' => 'DESC'], 2, 5);
        dump($books);

        // Récupération du nombre d'élément par critéres
        $count = $bookRepository->count(['title' => 'Symfony', 'author' => 'ENI']);
        dump($count);

        // Récupération des élements en fonction du titre (Custom DQL)
        $books = $bookRepository->getByTitleDQL('Sym', 150);
        dump($books);

        // Récupération des élements en fonction du titre (Custom QB)
        $books = $bookRepository->getByTitleQB('Sym', 150);
        dump($books);
        exit();
    }

    /**
     * @Route(path="update", name="update", methods={"GET"})
     */
    public function update(EntityManagerInterface $entityManager) {

        // Récupération d'un élément par @ORM\ID
        $book = $entityManager->getRepository('App:Book')->find(5);

        // Modification
        $book->setTitle("Symfony Updated");

        // Traitement de la "TODOLIST" de Doctrine
        $entityManager->flush();

        return $this->render('book/test.html.twig');
    }

    /**
     * @Route(path="remove", name="remove", methods={"GET"})
     */
    public function remove(EntityManagerInterface $entityManager) {

        // Récupération d'un élément par @ORM\ID
        $book = $entityManager->getRepository('App:Book')->find(5);

        // Suppression de l'objet dans la "TODOLIST" de Doctrine
        $entityManager->remove($book);

        // Traitement de la "TODOLIST" de Doctrine
        $entityManager->flush();

        return $this->render('book/test.html.twig');
    }
}