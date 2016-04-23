<?php

/**
 * Workflow step definition.
 *
 * @Entity(repositoryClass="EuhitWorkflow_Repository_StateRepository")
 * @Table(
 *     name="workflow_transitions",
 *     uniqueConstraints={
 *         @UniqueConstraint(columns={"workflow_id", "source_state_id", "target_state_id"}),
 *         @UniqueConstraint(columns={"workflow_id", "label"})
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
     * @Column(name="workflow_id", type="integer", nullable=false)
     * @var EuhitWorkflow_Entity_Workflow
     */
    protected $workflow;

    /**
     * @ManyToOne(targetEntity="EuhitWorkflow_Entity_State")
     * @JoinColumns({
     *   @JoinColumn(name="source_state_id", referencedColumnName="state_id", nullable=false),
     *   @JoinColumn(name="workflow_id", referencedColumnName="workflow_id")
     * })
     * @var EuhitWorkflow_Entity_State
     */
    protected $sourceState;

    /**
     * @ManyToOne(targetEntity="EuhitWorkflow_Entity_State")
     * @JoinColumns({
     *   @JoinColumn(name="target_state_id", referencedColumnName="state_id", nullable=false),
     *   @JoinColumn(name="workflow_id", referencedColumnName="workflow_id")
     * })
     * @var EuhitWorkflow_Entity_State
     */
    protected $targetState;

    /**
     * @Column(name="label", type="string", length=255)
     * @var string
     */
    protected $label;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
