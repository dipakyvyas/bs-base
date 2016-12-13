<?php
namespace BsBase\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Form\Element\File;
use Zend\Form\Element\Button;
use Zend\Form\Form;
use Zend\Form\Fieldset;
use DoctrineModule\Form\Element\ObjectSelect;
use Zend\Form\Element\Collection;

class PrintAdminForm extends AbstractHelper
{

    public function __invoke(Form $form)
    {
        $form->prepare();
        $form->setAttribute('class', 'form-horizontal group-border-dashed');
        echo $this->getView()
            ->form()
            ->openTag($form);
        
     foreach ($form->getIterator() as $element) {
                $this->element($element);
            }
        echo $this->getView()
            ->form()
            ->closeTag();
        
        return $form;
    }

    public function element($element)
    {
       
      
        if ($element instanceof Collection) {
            foreach ($element as $collectionElement) {
                if($collectionElement instanceof Fieldset){
                    $this->fieldset($collectionElement);
                }else{
                    $this->element($collectionElement);
                }
        
        
            }
        }
        
        
        if($element instanceof Fieldset){
        	return $this->fieldset($element);
        }
        
        if($element instanceof ObjectSelect){
            $element->setAttribute('class', 'select2');

        }
        
        if ($element->getAttribute('type') == 'hidden' && ! $element->getOption('showLabel')) {
        	echo $this->getView()->formElement($element);
  
        }
        if ($element instanceof Button) {
        	$element->setAttribute('class', $element->getAttribute('class') . ' btn btn-default ');
        }
        echo '<div id="id_group_' . $element->getName() . '" class="form-group ' . ($element->getMessages() ? 'has-error' : '') . '">';
        
        if (! $element instanceof File && ! $element instanceof Button && $element->getAttribute('type') != 'hidden' && !$element instanceof ObjectSelect) {
        
        	$element->setAttribute('class', $element->getAttribute('class') . ' form-control');
        }
        
        $element->setAttribute('id', 'id_' . $element->getName());
        
        if (! $element instanceof Button) {
        	echo '<label for="' . 'id_' . $element->getName() . '" class="' . ($element->getOption('label_wrapper_class') ?  : 'col-sm-4') . ' control-label">' . $element->getLabel() . '</label>';
        	echo '<div class="' . ($element->getOption('wrapper_class') ?  : 'col-sm-8') . '">';
        } else{
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

    public function fieldset($fieldset)
    {
        echo '<fieldset>';
        foreach ($fieldset as $element) {
            $this->element($element);
        }
        echo '</fieldset>';
    }
}