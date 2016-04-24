<?php

/**
 * @Entity(repositoryClass="EuhitWorkflow_Repository_ItemRepository")
 * @Table(
 *     name="workflow_items",
 *     uniqueConstraints={
 *         @UniqueConstraint(columns={"item_id", "workflow_id"})
 *     }
 * )
 */
class EuhitWorkflow_Entity_Item
{
    /**
     * @Id
     * @Column(name="item_id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="EuhitWorkflow_Entity_Workflow")
     * @JoinColumn(name="workflow_id", referencedColumnName="workflow_id")
     * @var EuhitWorkflow_Entity_Workflow
     */
    protected $workflow;

    /**
     * Read-only column to allow composite foreign key (item_id, workshop_id)
     * from EuhitWorkflow_Entity_Step entity, without workflow_id column being
     * part of the primary key.
     *
     * @Column(name="workflow_id", type="integer")
     * @internal
     */
    protected $__workflowId;

    /**
     * @ManyToOne(targetEntity="EuhitWorkflow_Entity_Step")
     * @JoinColumns({
     *     @JoinColumn(name="current_step_id", referencedColumnName="step_id", nullable=true),
     *     @JoinColumn(name="workflow_id", referencedColumnName="workflow_id")
     * })
     * @var EuhitWorkflow_Entity_Step
     */
    protected $currentStep;

    /**
     * @Column(name="item_type", type="string", length=255)
     * @var string
     */
    protected $type;

    /**
     * @ManyToOne(targetEntity="Maniple\ModUser\Entity\User")
     * @JoinColumn(name="created_by", referencedColumnName="user_id", nullable=true)
     * @var Maniple\ModUser\Entity\User
     */
    protected $createdBy;

    /**
     * @Column(name="created_at", type="epoch")
     * @var DateTime
     */
    protected $createdAt;

    /**
     * First submission time
     * @Column(name="submitted_at", type="epoch", nullable=true)
     * @var DateTime
     */
    protected $submittedAt;

    /**
     * Human readable number of submission within the workflow
     * @Column(name="submission_number", type="integer", nullable=true)
     * @var int
     */
    protected $submissionNumber;

    /**
     * @Column(name="completed_at", type="epoch", nullable=true)
     * @var DateTime
     */
    protected $completedAt;

    /**
     * @Column(name="is_accepted", type="boolint", nullable=true)
     * @var bool
     */
    protected $isAccepted;

    /**
     * @Column(name="title", type="string", length=255)
     * @var string
     */
    protected $title;

    /**
     * @Column(name="item_data", type="json_array")
     * @var array
     */
    protected $data = array();


    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return EuhitWorkflow_Entity_Item
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
     * @return EuhitWorkflow_Entity_StepDocument
     */
    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function getDatum($key, $default = null)
    {
        return isset($this->data[$key]) ? $this->data[$key] : $default;
    }

    public function setDatum($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }
}
