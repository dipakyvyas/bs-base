<?php
namespace BsBase\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Cache\StorageFactory;
/**
 *
 * @author Mat Wright <mat.wright@broadshout.com>
 * 
 * Base controller with frequently used configuration shared across controllers
 */
class BaseController extends AbstractActionController
{


    protected $return = array();
    private $dm;
    private $fm;
    private $cache;
    private $config;


    public function setConfig($config){
        $this->config=$config;
    }
    
    public function getConfig($element=null){
        
        if(!$this->config){
            $this->config=$this->serviceLocator->get('Config');
        }
        if($element){
            return $this->config[$element];
        }
        return $this->config;
    }

    
    public function setFormManager($fm){
        $this->fm=$fm;
    }
    
    public function getFormManager(){
        if(!$this->fm){
            $this->fm=$this->serviceLocator->get('FormElementManager');
        }
        return $this->fm;
    }
    
    public function setDocumentManager($dm){
        $this->dm=$dm;
    } 

    public function getDocumentManager(){
        if(!$this->dm){
            $this->dm=$this->serviceLocator->get('doctrine.documentmanager.odm_default');
        }
        return $this->dm;
    }
    
    public function getCache(){
    	if(!$this->cache){
    		 $cache = StorageFactory::adapterFactory('filesystem', array(
            'ttl' => (3600),
            'cache_dir' => $this->getConfig('cache_dir')
        ));
        $plugin = StorageFactory::pluginFactory('serializer', array());
        
        $cache->addPlugin($plugin);
        $this->cache = $cache;
    	}
    	return $this->cache;
    }
    


}

?>
