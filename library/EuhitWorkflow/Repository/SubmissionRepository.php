<?php

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Maniple\ModUser\Entity\User;

class EuhitWorkflow_Repository_SubmissionRepository extends EntityRepository
{
    /**
     * @param EuhitWorkflow_Entity_Workflow $workflow
     * @return int
     */
    public function getNextSubmissionNumber(EuhitWorkflow_Entity_Workflow $workflow)
    {
        $dql = 'SELECT MAX(s.submissionNumber) AS maxSubmissionNumber FROM EuhitWorkflow_Entity_Submission s WHERE s.workflow = :workflow';

        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('workflow', $workflow);
        $result = $query->getResult(Query::HYDRATE_SINGLE_SCALAR);

        return $result + 1;
    }

    /**
     * @param EuhitWorkflow_Entity_Workflow|int $workflow
     * @return EuhitWorkflow_Entity_Submission[]
     */
    public function getSubmissions($workflow)
    {
        if (!$workflow instanceof EuhitWorkflow_Entity_Workflow) {
            $workflow = $this->getEntityManager()->getReference('EuhitWorkflow_Entity_Workflow', (int) $workflow);
        }

        $qb = $this->createQueryBuilder('s');
        $qb->where('s.workflow = :workflow');
        $qb->andWhere('s.submissionNumber IS NOT NULL');
        $qb->orderBy('s.submissionNumber', 'asc');
        $qb->setParameter('workflow', $workflow);

        return $qb->getQuery()->getResult();
    }

    /**
     * Get submissions that are not drafts
     *
     * @param EuhitWorkflow_Entity_Workflow|int $workflow
     * @param User|int $user
     * @param array $options
     * @return EuhitWorkflow_Entity_Submission[]
     */
    public function getSubmissionsByUser($workflow, $user, array $options = null)
    {
        if (!$workflow instanceof EuhitWorkflow_Entity_Workflow) {
            $workflow = $this->getEntityManager()->getReference('EuhitWorkflow_Entity_Workflow', (int) $workflow);
        }

        if (!$user instanceof User) {
            $user = $this->getEntityManager()->getReference('Maniple\ModUser\Entity\User', (int) $user);
        }

        $qb = $this->createQueryBuilder('s');
        $qb->where('s.workflow = :workflow');
        $qb->andWhere('s.submissionNumber IS NOT NULL');
        $qb->andWhere('s.user = :user');
        $qb->setParameter('workflow', $workflow);
        $qb->setParameter('user', $user);

        $qb->orderBy('s.submissionNumber', 'asc');

        if (isset($options['limit'])) {
            $qb->setMaxResults((int) $options['limit']);
        }

        if (isset($options['offset'])) {
            $qb->setFirstResult((int) $options['offset']);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * Get submission drafts
     *
     * @param EuhitWorkflow_Entity_Workflow|int $workflow
     * @param User|int $user
     * @param array $options
     * @return EuhitWorkflow_Entity_Submission[]
     */
    public function getSubmissionDraftsByUser($workflow, $user, array $options = null)
    {
        if (!$workflow instanceof EuhitWorkflow_Entity_Workflow) {
            $workflow = $this->getEntityManager()->getReference('EuhitWorkflow_Entity_Workflow', (int) $workflow);
        }

        if (!$user instanceof User) {
            $user = $this->getEntityManager()->getReference('Maniple\ModUser\Entity\User', (int) $user);
        }

        $qb = $this->createQueryBuilder('s');
        $qb->where('s.workflow = :workflow');
        $qb->andWhere('s.submissionNumber IS NULL');
        $qb->andWhere('s.user = :user');
        $qb->setParameter('workflow', $workflow);
        $qb->setParameter('user', $user);

        $qb->orderBy('s.createdAt', 'desc');

        if (isset($options['limit'])) {
            $qb->setMaxResults((int) $options['limit']);
        }

        if (isset($options['offset'])) {
            $qb->setFirstResult((int) $options['offset']);
        }

        return $qb->getQuery()->getResult();
    }
}
