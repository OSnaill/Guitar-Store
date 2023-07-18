<?php

namespace App\Repository;

use App\Entity\Guitar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Guitar>
 *
 * @method Guitar|null find($id, $lockMode = null, $lockVersion = null)
 * @method Guitar|null findOneBy(array $criteria, array $orderBy = null)
 * @method Guitar[]    findAll()
 * @method Guitar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GuitarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Guitar::class);
    }

    public function save(Guitar $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Guitar $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllForShow()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT g.*, b.name AS brand_name  FROM guitar g
        LEFT JOIN brand b
        ON g.brand_id = b.id
        ORDER BY g.id DESC
        ';

        $resultSet = $conn->executeQuery($sql);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }
    public function findFilteredGuitars(string $brand = null, float $price = 0)
    {
        $conn = $this->getEntityManager()->getConnection();

        if($price == 0)
        {
            
            $sql = "
            SELECT g.*, b.name AS brand_name  FROM guitar g
            JOIN brand b
            WHERE b.name = :brand
            AND g.brand_id = b.id
            ORDER BY g.id DESC
            ";
            $resultSet = $conn->executeQuery($sql, ["brand"  => $brand]);
        } else {
            $sql = '
            SELECT g.*, b.name AS brand_name  FROM guitar g
            LEFT JOIN brand b
            ON g.brand_id = b.id
            ORDER BY g.id DESC
            WHERE b.name = :brand
            AND g.price <= :price 
            ';
            $resultSet = $conn->executeQuery($sql, [':brand' => $brand, ':price' => $price]);
        }

       

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function findEightForShow()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT g.*, b.name AS brand_name  FROM guitar g
        LEFT JOIN brand b
        ON g.brand_id = b.id
        ORDER BY g.id DESC
        LIMIT 4
        ';

        $resultSet = $conn->executeQuery($sql);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }

    public function findForDetail($id)
    {

        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT g.id, g.reference, g.price, g.image, g.brand_id , b.name AS brand_name
        FROM guitar g
        JOIN brand b
        WHERE g.brand_id = b.id
        AND g.id = :id
            ';

        $resultSet = $conn->executeQuery($sql, ['id' => $id]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
        // returns an array of Product objects
    }
//    public function findOneBySomeField($value): ?Guitar
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
