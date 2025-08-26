<?php

namespace App\Repository;

use App\Entity\Evento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Evento>
 */
class EventoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evento::class);
    }

    public function queryEventosAlfabeticamente(){
        $em=$this->getEntityManager();
        $dql="SELECT e FROM App\Entity\Evento e ORDER BY e.titulo ASC";
        return $em->createQuery($dql);
    }
    
    public function findEventosAlfabeticamente(){
        return $this->queryEventosAlfabeticamente()->getResult();
    }

    /**
     * Buscar por idioma
     */
    public function findByIdioma(string $idioma): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.idioma = :idioma')
            ->setParameter('idioma', $idioma)
            ->orderBy('e.fecha', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Obtener últimos N eventos
     */
    public function findUltimos(int $limite = 5): array
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.fecha', 'DESC')
            ->setMaxResults($limite)
            ->getQuery()
            ->getResult();
    }
}
