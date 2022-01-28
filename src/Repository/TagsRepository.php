<?php

namespace App\Repository;

use App\Entity\Tags;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tags|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tags|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tags[]    findAll()
 * @method Tags[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tags::class);
    }

    /**
      * @return Tags[] Returns an array of Tags objects
      */

    public function findByNameField($value)
    {
  //SELECT * FROM `voyage` JOIN `voyage_tags` ON voyage.id = voyage_tags.voyage_id JOIN tags ON voyage_tags.tags_id = tags.id WHERE tags.name LIKE "%Aventure%"; 
        return $this->createQueryBuilder('t')
            ->join('t.voyages', 'v')
            ->addSelect('v')
            ->andWhere('t.name LIKE :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Tags
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
