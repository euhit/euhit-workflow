<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(
 *     name="workflow_steps",
 *     uniqueConstraints={
 *         @UniqueConstraint(columns={"step_id", "item_id"}),
*          @UniqueConstraint(columns={"step_id", "workflow_id"})
 *     }
 * )
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
     * @ManyToOne(targetEntity="EuhitWorkflow_Entity_Item")
     * @JoinColumns({
     *     @JoinColumn(name="item_id", referencedColumnName="item_id")
     * })
     * @var EuhitWorkflow_Entity_Item
     */
    protected $item;

    /**
     * @manyToOne(targetEntity="EuhitWorkflow_Entity_Workflow")
     * @JoinColumn(name="workflow_id", referencedColumnName="workflow_id")
     * @var EuhitWorkflow_Entity_Workflow
     */
    protected $workflow;

    /**
     * @ManyToOne(targetEntity="EuhitWorkflow_Entity_State")
     * @JoinColumns({
     *     @JoinColumn(name="state_id", referencedColumnName="state_id"),
     * })
     * @var EuhitWorkflow_Entity_State
     */
    protected $state;

    /**
     * @ManyToOne(targetEntity="EuhitWorkflow_Entity_Step")
     * @JoinColumns({
     *     @JoinColumn(name="next_step_id", referencedColumnName="step_id", nullable=true)
     * })
     * @var EuhitWorkflow_Entity_Step
     */
    protected $nextStep;

    /**
     * @Column(name="started_at", type="epoch")
     * @var DateTime
     */
    protected $startedAt;

    /**
     * @Column(name="completed_at", type="epoch", nullable=true)
     * @var DateTime
     */
    protected $completedAt;

    /**
     * User who performed the transition, may be null if transition occurred automatically
     * @var
     */
    protected $completedBy;

    /**
     * Label of the corresponding state at the moment of creation of this step
     * @Column(name="label", type="string", length=255)
     * @var string
     */
    protected $label;

    /**
     * Additional data associated with the transition, such as review, comment etc.
     * @Column(name="step_data", type="json_array")
     * @var array
     */
    protected $data;

    /**
     * @var
     */
    protected $documents;

    public function __construct()
    {
        $this->startedAt = new DateTime();
        $this->documents = new ArrayCollection();
    }

    /**
     * @return EuhitWorkflow_Entity_Item
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param EuhitWorkflow_Entity_Item $item
     * @return EuhitWorkflow_Entity_Step
     */
    public function setItem(EuhitWorkflow_Entity_Item $item)
    {
        $this->item = $item;
        return $this;
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
    public function setWorkflow(EuhitWorkflow_Entity_Workflow $workflow)
    {
        $this->workflow = $workflow;
        return $this;
    }

    /**
     * @return EuhitWorkflow_Entity_State
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param EuhitWorkflow_Entity_State $state
     * @return EuhitWorkflow_Entity_Step
     */
    public function setState(EuhitWorkflow_Entity_State $state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return EuhitWorkflow_Entity_Step
     */
    public function getNextStep()
    {
        return $this->nextStep;
    }

    /**
     * @param EuhitWorkflow_Entity_Step $nextStep
     * @return EuhitWorkflow_Entity_Step
     */
    public function setNextStep($nextStep)
    {
        $this->nextStep = $nextStep;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getStartedAt()
    {
        return $this->startedAt;
    }

    /**
     * @param DateTime $startedAt
     * @return EuhitWorkflow_Entity_Step
     */
    public function setStartedAt($startedAt)
    {
        $this->startedAt = $startedAt;
        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return EuhitWorkflow_Entity_Step
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }


}
