<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function filter(array $listCarRequest): array
    {
        dump($listCarRequest);

        $qb = $this->createQueryBuilder('p');
        foreach ($listCarRequest['criteria'] as $key => $value) {
            if ($value != null) {
                $qb->andWhere('p.' . $key . ' = ' . '\'' . $value . '\'');
            }
        }
        foreach ($listCarRequest['filterBy'] as $key => $value) {
            $qb->addOrderBy('p.' . $key, $value);
        }

        $query = $qb->getQuery();
        return $query->execute();
    }
}
