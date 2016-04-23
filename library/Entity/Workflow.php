<?php

/**
 * @Entity(repositoryClass="ManipleWorkflow_Repository_WorkflowRepository")
 * @Table(name="workflows")
 */
class ManipleWorkflow_Entity_Workflow
{
    /**
     * @Id
     * @Column(name="call_id", type="integer")
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
     * Number of submissions in this call
     * @Column(name="submission_count", type="integer", nullable=false, options={"unsigned"=true, "default"=0})
     * @var int
     */
    protected $submissionCount = 0;

    /**
     * @Column(name="submission_limit", type="integer", nullable=false, options={"unsigned"=true, "default"=0})
     * @var int
     */
    protected $submissionLimit = 0;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $status;

    /**
     * @Column(type="string", nullable=false, unique=true)
     * @var string
     */
    protected $title;


    protected $states;


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
     * @return ManipleWorkflow_Entity_Workflow
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
     * @return ManipleWorkflow_Entity_Workflow
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
     * @return ManipleWorkflow_Entity_Workflow
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
     * @return ManipleWorkflow_Entity_Workflow
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
     * @param string $status
     * @return ManipleWorkflow_Entity_Workflow
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $submissionCount
     * @return ManipleWorkflow_Entity_Workflow
     */
    public function setSubmissionCount($submissionCount)
    {
        $this->submissionCount = $submissionCount;
        return $this;
    }

    /**
     * @return int
     */
    public function getSubmissionCount()
    {
        return $this->submissionCount;
    }

    /**
     * @return mixed
     */
    public function getSubmissionLimit()
    {
        return $this->submissionLimit;
    }

    /**
     * @param int $submissionLimit
     * @return ManipleWorkflow_Entity_Workflow
     */
    public function setSubmissionLimit($submissionLimit)
    {
        $this->submissionLimit = $submissionLimit;
        return $this;
    }

    /**
     * @param string $title
     * @return ManipleWorkflow_Entity_Workflow
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
     * @return ManipleWorkflow_Entity_Workflow
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return bool
     */
    public function getAutoAcceptSubmissions()
    {
        return $this->autoAcceptSubmissions;
    }

    /**
     * @param bool $autoAcceptSubmissions
     * @return ManipleWorkflow_Entity_Workflow
     */
    public function setAutoAcceptSubmissions($autoAcceptSubmissions)
    {
        $this->autoAcceptSubmissions = $autoAcceptSubmissions;
        return $this;
    }
}
