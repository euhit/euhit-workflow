<?php

class EuhitWorkflow_WorkflowRunner
{
    /**
     * Execute current task of the given workflow item.
     *
     * @param $item
     * @param array|null $args
     */
    public function execute(EuhitWorkflow_Entity_Item $item, array $args = null)
    {
        $currentStep = $item->getCurrentStep();
        $handler = $this->getHandler($currentStep->getState()->getHandler());
        $handler->execute($currentStep, $args);
    }

    public function advance($activity)
    {
        $nextStates = $activity->getState()->getNextStates();
        $nextState = $nextStates[0];

        if (!$nextState) {
            $this->_finalize($activity);
        } else {
            $this->executeTransition($activity, $nextState);
        }
    }

    protected function _finalize($activity)
    {
        $completedAt = new DateTime();

        $activity->setCompletedAt($completedAt);
        $activity->setNextState(null);
        $this->save($activity);

        // don't change state, current state is final one
        $activity->getItem()->setCompletedAt($completedAt);
        $this->save($activity->getItem());

        // TODO how to check if all items are completed, and so the whole workflow is completed?
    }

    public function executeTransition($activity, $nextState)
    {
        $transition = $this->findTransition($activity->getState(), $nextState);

        if (!$transition) {
            throw new Exception(sprintf(
                'Invalid transition specified %s -> %s',
                $activity->getState()->getLabel(),
                $nextState->getLabel()
            ));
        }

        $activity->setCompletedAt(new DateTime);
        $activity->setCompletedBy(); // ???
        $activity->setNextState($nextState);
        $this->save($activity);

        return $this->_enterState($activity->getItem(), $nextState);
    }

    protected function _enterState($item, $nextState)
    {
        $handler = $this->getHandler($nextState->getHandler());
        $newActivity = new EuhitWorkflow_Entity_Step();
        $newActivity->setStartedAt(new DateTime);
        $newActivity->setState($nextState);
        $newActivity->setName($handler->getActivityName());
        $newActivity->setItem($item);

        $item->setState($nextState);
        $item->getActivities()->add($newActivity);

        $this->saveItem($item);

        $handler->activityStart($newActivity);

        return $newActivity;
    }

    public function getHandler($handlerConfig)
    {
        $handler = new $handlerConfig($this);
        return $handler;
    }
}