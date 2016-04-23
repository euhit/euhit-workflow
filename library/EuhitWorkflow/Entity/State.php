<?php

use \Doctrine\Common\Collections\ArrayCollection;

/**
 * Workflow step definition
 *
 * @Entity(repositoryClass="EuhitWorkflow_Repository_StateRepository")
 * @Table(
 *     name="workflow_states",
 *     uniqueConstraints={
 *         @UniqueConstraint(columns={"workflow_id", "activity_name"}),
 *     }
 * )
 */
class EuhitWorkflow_Entity_State
{
    /**
     * @Id
     * @Column(name="state_id", type="integer")
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
     * Internal read-only column to allow compound (step, workshop) foreign keys in transitions
     *
     * @Column(name="workflow_id", type="integer")
     * @internal
     */
    protected $__workflowId;

    /**
     * Activity name to be used in activity entity. If not provided a start status will be used.
     * @Column(name="activity_name", type="string", length=255, nullable=true)
     * @var string
     */
    protected $activityName;

    /**
     * @Column(name="handler", type="json_array")
     * @var array
     */
    protected $handler;

    /**
     * @Column(name="display_options", type="json_array")
     * @var array
     */
    protected $displayOptions;

    /**
     * @Column(name="label", type="string", length=255)
     * @var string
     */
    protected $status;

    /**
     * Outgoing transitions
     *
     * @OneToMany(targetEntity="EuhitWorkflow_Entity_Transition", mappedBy="sourceState", cascade={"persist", "remove"})
     * @var EuhitWorkflow_Entity_Transition[]
     */
    protected $transitions;

    /**
     * @OneToMany(targetEntity="EuhitWorkflow_Entity_Transition", mappedBy="targetState", cascade={"persist", "remove"})
     * @var EuhitWorkflow_Entity_Transition[]
     */
    protected $incomingTransitions;

    public function __construct()
    {
        $this->transitions = new ArrayCollection();
        $this->incomingTransitions = new ArrayCollection();
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
     * @return EuhitWorkflow_Entity_State
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

    /**
     * @param string $option
     * @param mixed $default
     * @return mixed
     */
    public function getDisplayOption($option, $default = null)
    {
        return isset($this->displayOptions[$option]) ? $this->displayOptions[$option] : $default;
    }

    /**
     * @param string $option
     * @param mixed $value
     * @return EuhitWorkflow_Entity_State
     */
    public function setDisplayOption($option, $value)
    {
        $this->displayOptions[$option] = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFinal()
    {
        return 0 === count($this->getTransitions());
    }
}
