<?php
namespace BsBase\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Locale extends AbstractHelper
{

    protected $sm;

    public function __construct($sm)
    {

        $this->sm = $sm;
    }

    public function __invoke()
    {
        $translator = $this->sm->getServiceLocator()->get('MvcTranslator');

        $this->locale = $translator->getLocale();
        if ($this->locale) {
            return $this->locale;
        }
    }
}