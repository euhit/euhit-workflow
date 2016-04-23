<?php

/**
 * Workflow step definition.
 *
 * @Entity(repositoryClass="EuhitWorkflow_Repository_StepRepository")
 * @Table(name="workflow_transitions")
 *
 * foreignKey (source_step_id, workflow_id) -> (step_id, workflow_id)
 * foreignKey (target_step_id, workflow_id) -> (step_id, workflow_id)
 */
class EuhitWorkflow_Entity_Transition
{
    /**
     * @Id
     * @Column(name="transition_id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @Column(name="workflow_id", type="integer", nullable=false)
     * @var EuhitWorkflow_Entity_Workflow
     */
    protected $workflow;

    /**
     * @ManyToOne(targetEntity="EuhitWorkflow_Entity_Step")
     * @JoinColumns({
     *   @JoinColumn(name="source_step_id", referencedColumnName="step_id", nullable=false),
     *   @JoinColumn(name="workflow_id", referencedColumnName="workflow_id")
     * })
     * @var EuhitWorkflow_Entity_Step
     */
    protected $sourceStep;

    /**
     * @ManyToOne(targetEntity="EuhitWorkflow_Entity_Step")
     * @JoinColumns({
     *   @JoinColumn(name="target_step_id", referencedColumnName="step_id", nullable=false),
     *   @JoinColumn(name="workflow_id", referencedColumnName="workflow_id")
     * })
     * @var EuhitWorkflow_Entity_Step
     */
    protected $targetStep;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
