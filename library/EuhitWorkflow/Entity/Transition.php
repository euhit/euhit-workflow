<?php

/**
 * @Entity(repositoryClass="EuhitWorkflow_Repository_StateRepository")
 * @Table(
 *     name="workflow_transitions",
 *     uniqueConstraints={
 *         @UniqueConstraint(columns={"source_state_id", "target_state_id"})
 *     }
 * )
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
     * @ManyToOne(targetEntity="EuhitWorkflow_Entity_Workflow")
     * @JoinColumn(name="workflow_id", referencedColumnName="workflow_id", nullable=false)
     * @var EuhitWorkflow_Entity_Workflow
     */
    protected $workflow;

    /**
     * @ManyToOne(targetEntity="EuhitWorkflow_Entity_State")
     * @JoinColumns({
     *     @JoinColumn(name="source_state_id", referencedColumnName="state_id", nullable=false)
     * })
     * @var EuhitWorkflow_Entity_State
     */
    protected $sourceState;

    /**
     * @ManyToOne(targetEntity="EuhitWorkflow_Entity_State")
     * @JoinColumns({
     *     @JoinColumn(name="target_state_id", referencedColumnName="state_id", nullable=false)
     * })
     * @var EuhitWorkflow_Entity_State
     */
    protected $targetState;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return EuhitWorkflow_Entity_Workflow
     */
    public function getWorkflow()
    {
        return $this->workflow;
    }

    /**
     * @param EuhitWorkflow_Entity_Workflow $workflow
     * @return EuhitWorkflow_Entity_Transition
     */
    public function setWorkflow(EuhitWorkflow_Entity_Workflow $workflow)
    {
        $this->workflow = $workflow;
        return $this;
    }

    /**
     * @return EuhitWorkflow_Entity_State
     */
    public function getSourceState()
    {
        return $this->sourceState;
    }

    /**
     * @param EuhitWorkflow_Entity_State $sourceState
     * @return EuhitWorkflow_Entity_Transition
     */
    public function setSourceState(EuhitWorkflow_Entity_State $sourceState)
    {
        $this->sourceState = $sourceState;
        return $this;
    }

    /**
     * @return EuhitWorkflow_Entity_State
     */
    public function getTargetState()
    {
        return $this->targetState;
    }

    /**
     * @param EuhitWorkflow_Entity_State $targetState
     * @return EuhitWorkflow_Entity_Transition
     */
    public function setTargetState(EuhitWorkflow_Entity_State $targetState)
    {
        $this->targetState = $targetState;
        return $this;
    }
}
