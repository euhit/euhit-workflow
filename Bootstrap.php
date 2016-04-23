<?php

class ManipleWorkflow_Bootstrap extends Maniple_Application_Module_Bootstrap
{
    protected function _initEntityManager()
    {
        $bootstrap = $this->getApplication();

        /** @var ManipleCore\Doctrine\Config $config */
        $config = $bootstrap->getResource('EntityManager.config');
        if ($config) {
            $config->addPath(__DIR__ . '/library/Entity');
        }
    }
}
