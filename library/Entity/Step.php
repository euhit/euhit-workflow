<?php

use \Doctrine\Common\Collections\ArrayCollection;

/**
 * Workflow step definition.
 *
 * @Entity(repositoryClass="ManipleWorkflow_Repository_StepRepository")
 * @Table(name="workflow_steps")
 */
class ManipleWorkflow_Entity_Step
{
    /**
     * @Id
     * @Column(name="step_id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="ManipleWorkflow_Entity_Workflow")
     * @JoinColumn(name="workflow_id", referencedColumnName="workflow_id"),
     * @var ManipleWorkflow_Entity_Workflow
     */
    protected $workflow;

    /**
     * Outgoing transitions
     *
     * @OneToMany(targetEntity="ManipleWorkflow_Entity_Transition", mappedBy="sourceStep", cascade={"persist", "remove"})
     * @var ManipleWorkflow_Entity_Transition[]
     */
    protected $transitions;

    /**
     * @OneToMany(targetEntity="ManipleWorkflow_Entity_Transition", mappedBy="targetStep", cascade={"persist", "remove"})
     * @var ManipleWorkflow_Entity_Transition[]
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
     * @return ManipleWorkflow_Entity_Workflow
     */
    public function getWorkflow()
    {
        return $this->workflow;
    }

    /**
     * @param ManipleWorkflow_Entity_Workflow $workflow
     * @return ManipleWorkflow_Entity_Step
     */
    public function setWorkflow(ManipleWorkflow_Entity_Workflow $workflow = null)
    {
        $this->workflow = $workflow;
        return $this;
    }

    /**
     * @return ManipleWorkflow_Entity_Transition[]
     */
    public function getTransitions()
    {
        return $this->transitions;
    }

    /**
     * @return ManipleWorkflow_Entity_Transition[]
     */
    public function getIncomingTransitions()
    {
        return $this->incomingTransitions;
    }
}
