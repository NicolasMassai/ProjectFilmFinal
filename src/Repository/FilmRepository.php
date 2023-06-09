<?php

namespace App\Repository;

use App\Entity\Film;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Film>
 *
 * @method Film|null find($id, $lockMode = null, $lockVersion = null)
 * @method Film|null findOneBy(array $criteria, array $orderBy = null)
 * @method Film[]    findAll()
 * @method Film[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Film::class);
    }

    public function save(Film $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Film $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    
    public function requete(int $x){
    
        $em = $this->getEntityManager();
    
        $query = $em->createQuery('SELECT f FROM App\Entity\Film f WHERE f.id = ' . $x . '');
    
        $result = $query->getResult();
        //dd($result);
        
        return $result;
    }

    public function requete2(string $genre){
    
        $em = $this->getEntityManager();
    
        $query = $em->createQuery('SELECT f FROM App\Entity\Film f WHERE f.genre = :genre');
        $query->setParameter('genre', $genre);
    
        $result = $query->getResult();
        //dd($result);
        
        return $result;
    }

    
    public function requete3(){
    
        $em = $this->getEntityManager();
    
        $query = $em->createQuery('SELECT f FROM App\Entity\Film f ORDER BY f.note DESC');
    
        $result = $query->getResult();
        //dd($result);
        
        return $result;
    }

    

//    /**
//     * @return Film[] Returns an array of Film objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Film
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
