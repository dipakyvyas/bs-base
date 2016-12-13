<?php
namespace BsBase\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use BsImmoManager\Domain\Aggregate\Advertiser;
use BsImmoManager\Domain\Aggregate\Image;
use Zend\View\Model\JsonModel;
use Zend\InputFilter\Input;
use BsBase\Domain\Repository\Country;
use BsBase\Domain\Aggregate\UKCountry;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use DoctrineMongoODMModule\Paginator\Adapter\DoctrinePaginator;
use BsImmoManager\Domain\Aggregate\Advert;
use Zend\I18n\Validator\PostCode;
use Zend\I18n\Filter\Alpha;
use Zend\Console\Request;
use Zend\I18n\Validator\Alnum;
use BsBase\Domain\Aggregate\UKLocality;
use BsImmoManager\Domain\Aggregate\Property;
use Zend\Form\Form;
use BsImmoManager\Domain\Aggregate\Keyword;
use BsImmoManager\Feed\Adapter\V4N;
use BsBase\Domain\Aggregate\Coordinates;
use Zend\I18n\Validator\PhoneNumber;
use Zend\Debug\Debug;
use BsImmoManager\Domain\Aggregate\Enquiry;
use BsBase\Domain\Aggregate\Contact;
use BsImmoManager\Domain\Aggregate\Link;
use BsBase\Domain\Aggregate\UKAddress;
use BsImmoManager\Domain\Aggregate\Letting;
use BsBase\Domain\Aggregate\Event;
use BsImmoManager\Domain\Aggregate\SavedSearch;
use BsBase\Controller\BaseController;
use BsImmoManager\Domain\Aggregate\Role;
use Zend\Log\Writer\MongoDB;

/**
 *
 * @author Mat Wright <mat.wright@broadshout.com>
 *        
 */
class LocalityController extends BaseController
{

    

    const LOCATION_TYPE_POSTCODE = 'postcode';

    const LOCATION_TYPE_TOWN = 'town';

    const LOCATION_TYPE_COUNTY = 'county';

   

    public function ajaxAction()
    {
        $formArray = array();
        if (($this->params()->fromPost('countyId'))) {
            $lm = $this->getDocumentManager()->getRepository($this->getConfig('bs_base')['locality']['entity']);
            // Récupération de la liste des localitées en fonction du county
            $localities = $lm->findBy(array(
                'county.id' =>$this->params()
                    ->fromPost('countyId')
            ));
      
            if (count($localities) > 0) {
                foreach ($localities as $locality) {
                    $localityArray = $locality->toArray();
                    $localityArray['id'] = $locality->getId();
                    $formArray[] = $localityArray;
                }
                
           echo json_encode($formArray);exit;

            } else {
                return new JsonModel(array(
                    'return' => array(
                        'status' => false,
                        'message' => '0 towns Find'
                    )
                ));
            }
        } else {
            return new JsonModel(array(
                'return' => array(
                    'status' => false,
                    'message' => 'The county is invalid'
                )
            ));
        }
    }

 


}

?>
