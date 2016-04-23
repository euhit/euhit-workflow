<?php

/**
 * Workflow step definition.
 *
 * @Entity(repositoryClass="ManipleWorkflow_Repository_StepRepository")
 * @Table(name="workflow_transitions")
 *
 * foreignKey (source_step_id, workflow_id) -> (step_id, workflow_id)
 * foreignKey (target_step_id, workflow_id) -> (step_id, workflow_id)
 */
class ManipleWorkflow_Entity_Transition
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
     * @var ManipleWorkflow_Entity_Workflow
     */
    protected $workflow;

    /**
     * @ManyToOne(targetEntity="ManipleWorkflow_Entity_Step")
     * @JoinColumns({
     *   @JoinColumn(name="source_step_id", referencedColumnName="step_id", nullable=false),
     *   @JoinColumn(name="workflow_id", referencedColumnName="workflow_id")
     * })
     * @var ManipleWorkflow_Entity_Step
     */
    protected $sourceStep;

    /**
     * @ManyToOne(targetEntity="ManipleWorkflow_Entity_Step")
     * @JoinColumns({
     *   @JoinColumn(name="target_step_id", referencedColumnName="step_id", nullable=false),
     *   @JoinColumn(name="workflow_id", referencedColumnName="workflow_id")
     * })
     * @var ManipleWorkflow_Entity_Step
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
