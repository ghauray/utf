<?php

namespace Batiweb\FakeBundle\Core\Interceptor;

use CG\Proxy\MethodInterceptorInterface;
use CG\Proxy\MethodInvocation;
use Doctrine\ORM\EntityManager;

/**
 * Class TransactionalInterceptor
 * @package Batiweb\FakeBundle\Core\Interceptor
 */
class TransactionalInterceptor implements MethodInterceptorInterface {

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Constructeur
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @see \CG\Proxy\MethodInterceptorInterface::intercept()
     */
    public function intercept(MethodInvocation $invocation) {
        $isMasterTransactionalCaller = false;
        // Activation de la transaction si elle n'existe pas
        if (!$this->entityManager->getConnection()->isTransactionActive()) {
            $this->entityManager->beginTransaction();
            $isMasterTransactionalCaller = true;
        }

        try {
            $result = $invocation->proceed();
            // Si c'est le porteur de la transaction, alors commit
            if ($isMasterTransactionalCaller) {
                $this->entityManager->commit();
            }
            return $result;
        } catch (\Exception $e) {
            // Si c'est le master alors femeture
            if ($isMasterTransactionalCaller) {
                $this->entityManager->rollback();
            }
            throw $e;
        }
    }
}