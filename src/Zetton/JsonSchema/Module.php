<?php
namespace Zetton\JsonSchema;

/**
 * Module class for use with ZF2
 */
class Module
{
    /**
     * Retrieve autoloader configuration for this module
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        
        return array('Zend\Loader\StandardAutoloader' => array(
            'namespaces' => array(
                __NAMESPACE__ => __DIR__ . '/../../../src/Zetton/JsonSchema',
            ),
        ));
    }

    /**
     * Retrieve application configuration for this module
     *
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../../config/module.config.php';
    }

}
