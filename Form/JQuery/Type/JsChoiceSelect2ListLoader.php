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
    
    /**
     * Constructor
     */
    public function __construct(FormBuilderInterface $builder = null, $options_getter = null)
    {

        // Let the form builder notify us about initial/submitted choices
        if(!$builder)
            return;
        
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
    
    /**
     * Form submit event callback
     * Here we get notified about the submitted choices.
     * Remember them so we can add them in loadChoiceList().
     */
    public function onFormPostSetData(FormEvent $event)
    {
        $this->selected = [ ];
        
        $formdata = $event->getData();

        dump($formdata);
        
        if (! is_object($formdata))
        {
            return;
        }
        
        $this->selected = $formdata->{$this->options_getter}();
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
        // Get first n choices
        
        // $choices = $this->getChoicesList(false);
        $choices = [];

        // Check which choices are missing

        $missing_choices = array_flip($this->selected);

        // foreach ($choices as $label => $id)
        // {
        //     if (isset($missing_choices[ $id ]))
        //     {
        //         unset($missing_choices[ $id ]);
        //     }
        // }
        
        // Now add selected choices if they're missing

        foreach (array_keys($missing_choices) as $id)
        {
            // $label = $this->getChoiceLabel($id);
            
            // if (strlen($label) === 0)
            // {
            //     continue;
            // }

            $choices[ $id ] = $id;
        }
        
        return new ArrayChoiceList($choices);
    }

}