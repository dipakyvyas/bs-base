<?php
namespace BsBase\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Messages extends AbstractHelper
{

    protected $fm;

    protected $messageString;

    public function __construct ($fm)
    {
        $this->fm = $fm;
    }

    public function __invoke ()
    {
        if ($this->fm) {
            
            if ($this->fm) {
                foreach ($this->fm->getSuccessMessages() as $message) {
                    
                    $this->messageString .= '<div class="alert alert-success flashMessage"> <button type="button" class="close" data-dismiss="alert">&times;</button>' . $message . '</div>';
                }
                
                foreach ($this->fm->getInfoMessages() as $message) {
                 
                    $this->messageString .= '<div class="alert alert-info flashMessage"><button type="button" class="close" data-dismiss="alert">&times;</button>' . $message . '</div>';
                }
                
                foreach ($this->fm->getErrorMessages() as $message) {
                
                    $this->messageString .= '<div class="alert alert-danger flashMessage"><button type="button" class="close" data-dismiss="alert">&times;</button>' . $message . '</div>';
                }
            }
        }
        
        return $this->messageString;
    }
}