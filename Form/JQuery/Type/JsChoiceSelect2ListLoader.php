<?php

namespace Genemu\Bundle\FormBundle\Form\JQuery\Type;

use Symfony\Component\Form\ChoiceList\Loader\ChoiceLoaderInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\ChoiceList\ArrayChoiceList;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;


class JsChoiceSelect2ListLoader implements ChoiceLoaderInterface
{
    // public function loadChoiceList($value = null)
    // {
    //  return new JsChoiceSelect2List();
    // }


    public function loadChoicesForValues(array $values, $value = null)
    {
        return $values;
    }   
    public function loadValuesForChoices(array $choices, $value = null)
    {
        return $choices;
    }

    // Currently selected choices
    protected $selected = [ ];
    protected $r = null;
    
    /**
     * Constructor
     */
    public function __construct(FormBuilderInterface $builder = null, $options_getter = null)
    {
        $this->r = rand();
        // Let the form builder notify us about initial/submitted choices
        if($builder)
        {
            if(!$options_getter)
                throw new \Exception("Getter is needed", 1);
                
            $this->options_getter = $options_getter;

            $builder->addEventListener
            (
                FormEvents::POST_SET_DATA, 
                [ $this, 'onFormPostSetData' ]
            );

            $builder->addEventListener
            (
                FormEvents::POST_SUBMIT, 
                [ $this, 'onFormPostSetData' ]
            );
        }
 
    }
    
    /**
     * Form submit event callback
     * Here we get notified about the submitted choices.
     * Remember them so we can add them in loadChoiceList().
     */
    public function onFormPostSetData(FormEvent $event)
    {
        $this->selected = [ ];
        
        $formdata = $event->getData();
        
        if (! is_object($formdata))
        {
            return;
        }
        
        $this->selected = $formdata->{$this->options_getter}();
    }

    public function setSelected($selected)
    {
        $this->selected = $selected;
        return $this;
    }

    /**
     * Choices to be displayed in the SELECT element.
     * It's okay to not return all available choices, but the
     * selected/submitted choices (model values) must be
     * included.
     * Required by ChoiceLoaderInterface.
     */
    public function loadChoiceList($value = null)
    {
        $choices = [];

        if(!$this->selected)
            return new ArrayChoiceList($choices);

        if(is_array($this->selected))
        {
            $missing_choices = array_flip($this->selected);

            foreach (array_keys($missing_choices) as $id)
            {
                $choices[ $id ] = $id;
            }
        }
        else
        {   
            //FOR ENTITIES. TODO: Especific List Loader for entities
            $rc = new \ReflectionClass($this->selected);

            if(!$rc->hasMethod('__toString'))
                throw new Exception("The object must to implement __toString method", 1);
            if(!$rc->hasMethod('getId'))
                throw new Exception("The object must to implement getId method", 1);
                
            $choices[$this->selected->__toString()] = $this->selected->getId();
        }

        return new ArrayChoiceList($choices);
    }

}