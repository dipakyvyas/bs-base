<?php
/**
 * 
 * @package BsBase
 * @link      https://packages.bstechnologies.com/bs-technologies/bs-technologies/bs-base
 * @copyright Copyright Broadshout Technologies LTD (http://www.broadshout.com)
 * @license   http://www.bstechnologies.com/license/new-bsd
 */
namespace BsBase\Factory;

use \Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Mvc\Controller\AbstractController;

/**
 * Base class for controller factories implementing BSFactory\ControllerFactoryInterface
 * BaseControllerFactory attaches generic services as required dynamically based on interfaces implemented by extending class.
 *
 * @author matwright <mat.wright@broadshout.com>
 *        
 */
class BaseControllerFactory
{

    private $controller;

    private $reflection;

    private $serviceManager;

    /**
     * Lazy load a reflection object for the called class.
     *
     * @return \ReflectionClass
     */
    public function getReflection()
    {
        if (! $this->reflection) {
            $calledClass = get_called_class();
            $this->reflection = new \ReflectionClass($calledClass);
        }
        return $this->reflection;
    }

    /**
     * Attaches generic services based on controller class interfaces
     *
     * @return \BsBase\Factory\BaseControllerFactory
     */
    public function attachDefaultServices()
    {
        $interfaces = $this->getReflection()->getInterfaceNames();
        
        if (in_array('BsBase\\Factory\\ConfigAwareControllerFactoryInterface', $interfaces)) {
            $this->attachConfig();
        }
        
        if (in_array('BsBase\\Factory\\FormManagerAwareControllerFactoryInterface', $interfaces)) {
            $this->attachFormManager();
        }
        
        if (in_array('BsBase\\Factory\\DocumentManagerAwareControllerFactoryInterface', $interfaces)) {
            $this->attachDocumentManager();
        }
        return $this;
    }

    /**
     * Injects formManager service into current controller
     * 
     * @return \BsBase\Factory\BaseControllerFactory
     */
    public function attachFormManager()
    {
        $this->getController()->setFormManager($this->getServiceManager()
            ->get('FormElementManager'));
        return $this;
    }

    /**
     * Injects documentManager service into current controller
     *
     * @return \BsBase\Factory\BaseControllerFactory
     */
    public function attachDocumentManager()
    {
        $this->getController()->setDocumentManager($this->getServiceManager()
            ->get('doctrine.documentmanager.odm_default'));
        return $this;
    }

    /**
     * Injects config service into current controller
     *
     * @return \BsBase\Factory\BaseControllerFactory
     */
    public function attachConfig()
    {
        $config = $this->getServiceManager()->get('Config');
        
        $this->getController()->setConfig($config);
        return $this;
    }

    /**
     * Calculates and returns fully qualified namespace of current Controller class
     *
     * @return AbstractController
     */
    public function getController()
    {
        if (! $this->controller) {
            $controllerClass = str_replace('Factory', '', $this->getReflection()->getShortName());
            $classToCall = '\\' . str_replace('Factory', 'Controller', $this->getReflection()->getNamespaceName()) . '\\' . $controllerClass;
            
            $this->controller = new $classToCall();
        }
        return $this->controller;
    }

    /**
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    /**
     *
     * @param ServiceLocatorInterface $serviceManager            
     * @return \BsBase\Factory\BaseControllerFactory
     */
    public function setServiceManager(ServiceLocatorInterface $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }
}

?>