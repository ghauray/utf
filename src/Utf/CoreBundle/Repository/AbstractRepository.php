<?php
/**
 * Created by PhpStorm.
 * User: Pigcell
 * Date: 20/01/2019
 * Time: 16:14
 */

namespace Utf\CoreBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\ORMInvalidArgumentException;
use Utf\CoreBundle\Entity\AbstractEntity;

/**
 * Class AbstractRepository
 * @package Utf\CoreBundle\Repository
 */
abstract class AbstractRepository extends EntityRepository {

    /**
     * Créer ou mets à jours une entité
     * @param AbstractEntity $entity
     * @return  AbstractEntity
     * @throws ORMInvalidArgumentException
     */
    public function createOrUpdate(AbstractEntity $entity) {
        $this->_em->persist($entity);
        return $entity;
    }

    /**
     * Tells the EntityManager to make an instance managed and persistent.
     * The entity will be entered into the database at or before transaction
     * commit or as a result of the flush operation.
     * @see EntityManager::persist()
     *
     * @param AbstractEntity $entity
     * @return AbstractEntity
     * @throws ORMInvalidArgumentException
     */
    public function persist(AbstractEntity $entity) {
        $this->_em->persist($entity);
        return $entity;
    }

    /**
     * Flushes all changes to objects that have been queued up to now to the database.
     * This effectively synchronizes the in-memory state of managed objects with the
     * database.
     *
     * If an entity is explicitly passed to this method only this entity and
     * the cascade-persist semantics + scheduled inserts/removals are synchronized.
     * @see EntityManager::flush()
     *
     * @param AbstractEntity $entity
     */
    public function flush($entity = null) {
        $this->_em->flush($entity);
    }

    /**
     * Removes an entity instance.
     *
     * A removed entity will be removed from the database at or before transaction commit
     * or as a result of the flush operation.
     * @see EntityManager::remove()
     *
     * @param AbstractEntity $entity
     * @throws ORMInvalidArgumentException
     */
    public function remove($entity) {
        $this->_em->remove($entity);
    }


    /**
     * Permet de detacher une entitée
     * @param AbstractEntity $entity
     * @return AbstractEntity
     */
    public function detach($entity){
        $this->_em->detach($entity);
        return $entity;
    }

    /**
     * Retourne une liste d'entité en fonction de leurs ids
     * @param string $repoName
     * @param int[] $ids
     * @return AbstractEntity
     */
    public function findByIds($repoName, array $ids) {
        $repo = $this->_em->getRepository($repoName);
        $qb = $repo->createQueryBuilder('e');
        $qb->andWhere($qb->expr()->in('e.id', ':ids'))
            ->setParameter('ids', $ids);

        return $qb->getQuery()->getResult();
    }
}