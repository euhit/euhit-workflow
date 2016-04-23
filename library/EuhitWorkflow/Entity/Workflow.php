<?php

/**
 * @Entity(repositoryClass="EuhitWorkflow_Repository_WorkflowRepository")
 * @Table(name="workflows")
 */
class EuhitWorkflow_Entity_Workflow
{
    /**
     * @Id
     * @Column(name="workflow_id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @Column(name="open_time", type="epoch")
     * @var \DateTime
     */
    protected $openTime;

    /**
     * @Column(name="close_time", type="epoch", nullable=true)
     * @var \DateTime
     */
    protected $closeTime;

    /**
     * Workflow creation time
     * @Column(name="created_at", type="epoch")
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * Time when all submissions has been completed
     * @Column(name="completed_at", type="epoch", nullable=true)
     * @var \DateTime
     */
    protected $completedAt;

    /**
     * @Column(name="is_active", type="boolint", nullable=false, options={"default"=true})
     * @var bool
     */
    protected $active = true;

    /**
     * Step which all submitted submissions start
     * @var EuhitWorkflow_Entity_State
     */
    protected $initialState;

    /**
     * Number of submissions in this call
     * @Column(name="item_count", type="integer", nullable=false, options={"unsigned"=true, "default"=0})
     * @var int
     */
    protected $itemCount = 0;

    /**
     * @Column(name="item_limit", type="integer", nullable=false, options={"unsigned"=true, "default"=0})
     * @var int
     */
    protected $itemLimit = 0;

    /**
     * @Column(type="string", nullable=false, unique=true)
     * @var string
     */
    protected $title;

    protected $states;

    protected $transitions;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \DateTime $closeTime
     * @return EuhitWorkflow_Entity_Workflow
     */
    public function setCloseTime(\DateTime $closeTime = null)
    {
        $this->closeTime = $closeTime;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCloseTime()
    {
        return $this->closeTime;
    }

    /**
     * @param \DateTime $completedAt
     * @return EuhitWorkflow_Entity_Workflow
     */
    public function setCompletedAt(\DateTime $completedAt = null)
    {
        $this->completedAt = $completedAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getCompletedAt()
    {
        return $this->completedAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return EuhitWorkflow_Entity_Workflow
     */
    public function setCreatedAt(\DateTime $createdAt = null)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $openTime
     * @return EuhitWorkflow_Entity_Workflow
     */
    public function setOpenTime(\DateTime $openTime = null)
    {
        $this->openTime = $openTime;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOpenTime()
    {
        return $this->openTime;
    }

    /**
     * @param int $itemCount
     * @return EuhitWorkflow_Entity_Workflow
     */
    public function setItemCount($itemCount)
    {
        $this->itemCount = $itemCount;
        return $this;
    }

    /**
     * @return int
     */
    public function getItemCount()
    {
        return $this->itemCount;
    }

    /**
     * @return mixed
     */
    public function getItemLimit()
    {
        return $this->itemLimit;
    }

    /**
     * @param int $itemLimit
     * @return EuhitWorkflow_Entity_Workflow
     */
    public function setItemLimit($itemLimit)
    {
        $this->itemLimit = $itemLimit;
        return $this;
    }

    /**
     * @param string $title
     * @return EuhitWorkflow_Entity_Workflow
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     * @return EuhitWorkflow_Entity_Workflow
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    // isRunning() (completedAt IS NULL) AND (submissionCount > 0)
}
