<?php

/**
 * @Entity(repositoryClass="EuhitWorkflow_Repository_ItemRepository")
 * @Table(name="workflow_items")
 */
class EuhitWorkflow_Entity_Item
{
    /**
     * @Id
     * @Column(name="item_id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    protected $workflow;

    protected $title;

    protected $state;

    protected $submittedAt;

    protected $completedAt;

    protected $type;

    protected $data;
}
