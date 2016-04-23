<?php

/**
 * @Entity
 * @Table(name="workflow_activities")
 */
class EuhitWorkflow_Entity_Activity
{
    /**
     * @Id
     * @Column(name="activity_id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @var
     */
    protected $item;

    protected $startStatus;

    /**
     * End status may contain info about the outcome, outcome may also be stored in data
     * @var
     */
    protected $endStatus;

    protected $startedAt;

    /**
     * Time when this activity has been completed
     * @Column(name="completed_at", type="epoch")
     * @var DateTime
     */
    protected $completedAt;

    /**
     * User who performed the transition, may be null if transition occurred automatically
     * @ManyToOne()
     * @JoinColumn
     * @var
     */
    protected $completedBy;

    /**
     * @Column(name="activity_name", type="string", length=255)
     * @var string
     */
    protected $name;

    /**
     * Additional data associated with the transition, such as review, comment etc.
     * @Column(name="activity_data", type="json_array")
     * @var array
     */
    protected $data;
}
