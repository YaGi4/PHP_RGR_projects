<?php

namespace App\Repository;

use App\Entity\AgentEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AgentEntity>
 *
 * @method AgentEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgentEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgentEntity[]    findAll()
 * @method AgentEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgentEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgentEntity::class);
    }

    public function findAllAgent(): array
    {
            $entityManager = $this->getEntityManager();
    
            $query = $entityManager->createQuery(
                'SELECT p FROM App\Entity\AgentEntity p'
            );
            return $query->getResult();
    }
    public function delete(int $id): void
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'DELETE FROM App\Entity\AgentEntity p WHERE p.id = :id '
        )->setParameter('id', $id);
        $query->getResult();
    }
    public function deleteByFilialId(int $id): void
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'DELETE FROM App\Entity\AgentEntity p WHERE p.codeFilial = :id '
        )->setParameter('id', $id);
        $query->getResult();
    }

    public function findByFilialId(int $id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p FROM App\Entity\AgentEntity p WHERE p.codeFilial = :id'
        )->setParameter('id', $id);
        return $query->getResult();
    }
//    public function saveAgent(AgentEntity $agentEntity): void
//    {
//        $entityManagerInterface = $this->getEntityManager();
//
//        try {
//            $entityManagerInterface->getConnection()->createQueryBuilder()
//                ->insert('agents')
//                ->setValue('agent_name', ':agent_name')
//                ->setValue('agent_surname', ':agent_surname')
//                ->setValue('agent_patronymic', ':agent_patronymic')
//                ->setValue('address', ':address')
//                ->setValue('phone', ':phone')
//                ->setValue('code_filial', ':code_filial')
//                ->setParameter('agent_name', $agentEntity->getAgentName())
//                ->setParameter('agent_surname', $agentEntity->getAgentSurname())
//                ->setParameter('agent_patronymic', $agentEntity->GetAgentPatronymic())
//                ->setParameter('address', $agentEntity->getAgentAddress())
//                ->setParameter('phone', $agentEntity->getAgentPhone())
//                ->setParameter('code_filial', $agentEntity->getCodeFilial())
//                ->executeQuery();
//        } catch (Exception $e) {
//            throw new \Error();
//        }
//    }
}