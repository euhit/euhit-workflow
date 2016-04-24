<?php

/**
 * @Entity
 * @Table(name="workflow_step_documents")
 */
class EuhitWorkflow_Entity_StepDocument implements EuhitWorkflow_Entity_DocumentInterface
{
    /**
     * @Id
     * @Column(name="document_id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @ManyToOne(targetEntity="EuhitWorkflow_Entity_Step")
     * @JoinColumn(name="step_id", referencedColumnName="step_id")
     * @var EuhitWorkflow_Entity_Step
     */
    protected $step;

    /**
     * @Column(name="document_type", type="string", length=255)
     * @var string
     */
    protected $type;

    /**
     * @Column(name="created_at", type="epoch")
     * @var DateTime
     */
    protected $createdAt;

    /**
     * @ManyToOne(targetEntity="Maniple\ModUser\Entity\User")
     * @JoinColumn(name="created_by", referencedColumnName="user_id", nullable=true)
     * @var Maniple\ModUser\Entity\User
     */
    protected $createdBy;

    /**
     * @Column(name="submitted_at", type="epoch", nullable=true)
     * @var DateTime
     */
    protected $submittedAt;

    /**
     * @Column(name="title", type="string", length=255)
     * @var string
     */
    protected $title;

    /**
     * @Column(name="document_data", type="json_array")
     * @var array
     */
    protected $data = array();

    /**
     * @var Doctrine\Common\Collections\ArrayCollection;
     */
    protected $files;


    public function __construct()
    {
        $this->createdAt = new DateTime();
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
    public function getStep()
    {
        return $this->step;
    }

    /**
     * @param EuhitWorkflow_Entity_Step $step
     * @return EuhitWorkflow_Entity_StepDocument
     */
    public function setStep(EuhitWorkflow_Entity_Step $step)
    {
        $this->step = $step;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return EuhitWorkflow_Entity_StepDocument
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return EuhitWorkflow_Entity_StepDocument
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \Maniple\ModUser\Entity\User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param \Maniple\ModUser\Entity\User $createdBy
     * @return EuhitWorkflow_Entity_StepDocument
     */
    public function setCreatedBy($createdBy = null)
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getSubmittedAt()
    {
        return $this->submittedAt;
    }

    /**
     * @param DateTime $submittedAt
     * @return EuhitWorkflow_Entity_StepDocument
     */
    public function setSubmittedAt(DateTime $submittedAt = null)
    {
        $this->submittedAt = $submittedAt;
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
     * @param string $title
     * @return EuhitWorkflow_Entity_StepDocument
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
