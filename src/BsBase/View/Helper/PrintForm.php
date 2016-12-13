<?php
namespace BsBase\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Form\Element\File;
use Zend\Form\Element\Button;

class PrintForm extends AbstractHelper
{

    public function __invoke($form)
    {

        $form->prepare();
        echo $this->getView()
            ->form()
            ->openTag($form);
        echo '<fieldset>'; 
        foreach ($form->getElements() as $element) {
          
            if($element->getAttribute('type')=='hidden'){
           echo $this->getView()->formElement($element);
                continue;
            }
            if ($element instanceof Button) {
                $element->setAttribute('class', $element->getAttribute('class') . ' btn btn-default ');
            }
            echo '<div id="id_group_'.$element->getName().'" class="form-group ' . ($element->getMessages() ? 'has-error' : '') . '">';
            
            if (! $element instanceof File && ! $element instanceof Button) {

                $element->setAttribute('class', $element->getAttribute('class') . ' form-control');
            }
            $element->setAttribute('id', 'id_' . $element->getName());
            
            if (! $element instanceof Button) {
                echo '<label for="' . 'id_' . $element->getName() . '" class="'. ($element->getOption('label_wrapper_class') ?  : 'col-sm-4') .' control-label">' . $element->getLabel() . '</label>';
                echo '<div class="' . ($element->getOption('wrapper_class') ?  : 'col-sm-8') . '">';
            } else {
                $element->setAttribute('class', $element->getAttribute('class') . ' btn-default');
                echo '<div class="' . ($element->getOption('wrapper_class') ?  : 'col-sm-12') . '">';
            }
            
            echo $this->getView()->formElement($element);
            if ($element->getOption('help')) {
                echo '<p class="help-block">' . $element->getOption('help') . '</p>';
            }
            if ($element->getMessages()) {
                echo $this->getView()
                ->formelementerrors()
                ->setMessageOpenFormat('<p class=" text-danger ">')
                ->setMessageSeparatorString('</p><p class="text-danger ">')
                ->setMessageCloseString('</p>')
                ->render($element);
            }
            echo '</div>';
           
            
            echo '</div>'; // close form group
        }
        echo $this->getView()
            ->form()
            ->closeTag();
        echo '</fieldset>';
        return $form;
    }
}