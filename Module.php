<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonBsBase for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace BsBase;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use BsBase\Library\BsImage;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                /* Entities */

                "BsBase\Domain\Repository\UKLocality" => function ($service_manager)
                {
                    $dm = $service_manager->get('doctrine.documentmanager.odm_default');
                    return $dm->getRepository('BsBase\Domain\Aggregate\UKLocality');
                },
                "BsBase\Domain\Repository\UKCounty" => function ($service_manager)
                {
                    $dm = $service_manager->get('doctrine.documentmanager.odm_default');
                    return $dm->getRepository('BsBase\Domain\Aggregate\UKCounty');
                },
                "BsBase\Domain\Repository\UKCountry" => function ($service_manager)
                {
                    $dm = $service_manager->get('doctrine.documentmanager.odm_default');
                    return $dm->getRepository('BsBase\Domain\Aggregate\UKCountry');
                },
                "BsBase\Library\BsImage" => function ($service_manager)
                {
                    return new BsImage($service_manager);
                }
            )
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'invokables'=>array(
        	'EscapeTextarea'=>'\BsBase\View\Helper\EscapeTextarea'
        ),
            'factories' => array(
                'RouteName' => function ($sm)
                {
                    $routeMatch = $sm->getServiceLocator()
                        ->get('application')
                        ->getMvcEvent()
                        ->getRouteMatch();

                    $helper = new \BsBase\View\Helper\RouteName($routeMatch);
                    return $helper;
                },
                'Messages' => function ($sm)
                {
                    $plugin = $sm->getServiceLocator()
                        ->get('ControllerPluginManager')
                        ->get('flashMessenger');
                    $helper = new \BsBase\View\Helper\Messages($plugin);
                    return $helper;
                },
                'PrintForm' => function ($sm)
                {
                    $helper = new \BsBase\View\Helper\PrintForm();
                    return $helper;
                },
                'PrintAdminForm' => function ($sm)
                {
                    $helper = new \BsBase\View\Helper\PrintAdminForm();
                    return $helper;
                },
                'Thumbnail' => function ($sm)
                {
                    $sl = $sm->getServiceLocator();
                    $config = $sl->get('Config');
                    $cacheDir = $config['cache_dir'];
                    $helper = new \BsBase\View\Helper\Thumbnail($sl->get('BsBase\Library\BsImage'), $cacheDir);
                    return $helper;
                }
            )
        );
    }
}
