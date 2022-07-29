<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Event>
 *
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function add(Event $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Event $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Event[]
     */
    public function getOldEvent(\DateTime $dateTime, string $category = 'concert'): array
    {
        $queryBuilder = $this->createQueryBuilder('e')
            ->andWhere('e.category = :category')
            ->andWhere('e.start_at <= :date')
            ->setParameter('date', $dateTime)
            ->setParameter('category', $category)
            ->orderBy('e.start_at', 'ASC');
        $query = $queryBuilder->getQuery();

        return $query->getArrayResult();
    }

    /**
     * @return Event[]
     */
    public function getNewEvent(\DateTime $dateTime, string $category = 'concert'): array
    {
        $qb = $this->createQueryBuilder('e')
            ->where('e.category = :category')
            ->andWhere('e.start_at > :date')
            ->setParameter('date', $dateTime)
            ->setParameter('category', $category)
            ->orderBy('e.start_at', 'ASC');
        $query = $qb->getQuery();

        return $query->getArrayResult();
    }
}
