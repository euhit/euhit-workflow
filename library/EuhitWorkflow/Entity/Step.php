<?php

use \Doctrine\Common\Collections\ArrayCollection;

/**
 * Workflow step definition.
 *
 * @Entity(repositoryClass="EuhitWorkflow_Repository_StepRepository")
 * @Table(name="workflow_steps")
 */
class EuhitWorkflow_Entity_Step
{
    /**
     * @Id
     * @Column(name="step_id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="EuhitWorkflow_Entity_Workflow")
     * @JoinColumn(name="workflow_id", referencedColumnName="workflow_id"),
     * @var EuhitWorkflow_Entity_Workflow
     */
    protected $workflow;

    /**
     * Outgoing transitions
     *
     * @OneToMany(targetEntity="EuhitWorkflow_Entity_Transition", mappedBy="sourceStep", cascade={"persist", "remove"})
     * @var EuhitWorkflow_Entity_Transition[]
     */
    protected $transitions;

    /**
     * @OneToMany(targetEntity="EuhitWorkflow_Entity_Transition", mappedBy="targetStep", cascade={"persist", "remove"})
     * @var EuhitWorkflow_Entity_Transition[]
     */
    protected $incomingTransitions;

    /**
     * Internal read-only column to allow compound (step, workshop) foreign keys in transitions
     *
     * @Column(name="workflow_id", type="integer")
     * @internal
     */
    protected $__workflowId;

    public function __construct()
    {
        $this->transitions = new ArrayCollection();
    }

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
     * @return EuhitWorkflow_Entity_Step
     */
    public function setWorkflow(EuhitWorkflow_Entity_Workflow $workflow = null)
    {
        $this->workflow = $workflow;
        return $this;
    }

    /**
     * @return EuhitWorkflow_Entity_Transition[]
     */
    public function getTransitions()
    {
        return $this->transitions;
    }

    /**
     * @return EuhitWorkflow_Entity_Transition[]
     */
    public function getIncomingTransitions()
    {
        return $this->incomingTransitions;
    }
}
