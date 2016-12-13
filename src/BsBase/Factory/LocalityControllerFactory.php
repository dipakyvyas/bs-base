<?php
namespace BsBase\Factory;

use \Zend\ServiceManager\FactoryInterface;
use \Zend\ServiceManager\ServiceLocatorInterface;
use \BsBase\Factory as BSFactory;

class LocalityControllerFactory extends BSFactory\BaseControllerFactory implements FactoryInterface, BSFactory\ControllerFactoryInterface, BSFactory\DocumentManagerAwareControllerFactoryInterface, BSFactory\FormManagerAwareControllerFactoryInterface, BSFactory\ConfigAwareControllerFactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->setServiceManager($serviceLocator->getServiceLocator());
       
        
        $this->getController()->setEventManager($this->getServiceManager()
            ->get("bsimmomanager_event_manager"));
        $this->attachDefaultServices();
        return $this->getController();
    }
}