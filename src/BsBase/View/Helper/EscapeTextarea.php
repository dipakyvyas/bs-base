<?php
namespace BsBase\View\Helper;



use Zend\Form\View\Helper\AbstractHelper;
/**
 *
 * @author matwright
 *        
 */
class EscapeTextarea extends AbstractHelper
{


  
    /**
     * @param string $textarea
     * @param boolean $unescape
     * @return string
     */
    public function __invoke($textarea,$unescape=false)
    {
        if($unescape){
            return str_replace('<_/textarea>', '</textarea>', $textarea);
        }
    	return str_replace('</textarea>', '<_/textarea>', $textarea);
    }
}

?>