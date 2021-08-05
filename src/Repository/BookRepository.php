<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }


    public function getByTitle(string $title, int $pages = 100):array {

        $dql = "SELECT b FROM App\Entity\Book b WHERE b.title LIKE :title AND b.pages > :pages";

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameters(['title'=>'%'.$title.'%', 'pages'=>$pages]);
        //$query->setParameter('title', '%'.$title.'%')->setParameter('pages', $pages);

        $results = $query->getResult();

        return $results;
    }


    public function getByTitleQB(string $title, int $pages = 100):array {



        $query = $this->createQueryBuilder('b')->where('b.title LIKE :title')->andWhere('b.pages > :pages');

        $query->setParameter('title', '%'.$title.'%')->setParameter('pages', $pages);

        return $query->getQuery()->getResult();
    }
}
