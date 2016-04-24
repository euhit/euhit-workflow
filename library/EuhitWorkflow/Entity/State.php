<?php

use \Doctrine\Common\Collections\ArrayCollection;

/**
 * Workflow step definition
 *
 * @Entity(repositoryClass="EuhitWorkflow_Repository_StateRepository")
 * @Table(
 *     name="workflow_states",
 *     uniqueConstraints={
 *         @UniqueConstraint(columns={"state_id", "workflow_id"}),
 *         @UniqueConstraint(columns={"workflow_id", "label"})
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
     * @Column(name="label", type="string", length=255)
     * @var string
     */
    protected $label;

    /**
     * @Column(name="handler", type="json_array")
     * @var array
     */
    protected $handler = array();

    /**
     * @Column(name="display_options", type="json_array")
     * @var array
     */
    protected $displayOptions = array();

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
    public function setWorkflow(EuhitWorkflow_Entity_Workflow $workflow)
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
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return EuhitWorkflow_Entity_State
     */
    public function setLabel($label)
    {
        $this->label = $label;
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
