<?php
namespace BsBase\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @author matwright
 *        
 */
interface ControllerFactoryInterface
{

    public function attachConfig();

    /**
     *
     * @param ServiceLocatorInterface $serviceManager            
     * @return void;
     */
    public function setServiceManager(ServiceLocatorInterface $serviceManager);

    /**
     *
     * @return ServiceLocatorInterface $serviceManager
     *        
     */
    public function getServiceManager();

    /**
     *
     * @return AbstractActionController
     *
     */
    public function getController();

    /**
     * Method to attach multiple services as per factory requirements
     */
    public function attachDefaultServices();
}

?>