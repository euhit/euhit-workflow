<?php

// should be nodeType -> each workflow node must have an associated behavior
class EuhitWorkflow_ActivityHandler
{
    public function getWorkflowManager()
    {

    }

    public function activityStart($activity)
    {

    }

    public function execute($activity, array $data = null)
    {
        $this->getWorkflowManager()->advance($activity);
    }
}

