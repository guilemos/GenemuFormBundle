<?php

namespace Genemu\Bundle\FormBundle\Form\JQuery\Type;

use Symfony\Component\Form\ChoiceList\ChoiceListInterface;

class JsChoiceSelect2List implements ChoiceListInterface
{
    public function getChoices()
    {
        return array();
    }

    public function getChoicesForValues(array $values)
    {
        return $values;
    }

    public function getIndicesForChoices(array $choices)
    {
        return $choices;
    }

    public function getIndicesForValues(array $values)
    {
        return $values;
    }

    public function getPreferredViews()
    {
        return array();
    }

    public function getRemainingViews()
    {
        return array();
    }

    public function getValues()
    {
        return array();
    }

    public function getValuesForChoices(array $choices)
    {
        return $choices;
    }

    public function getStructuredValues()
    {
        return array();
    }

    public function getOriginalKeys()
    {
        return array();
    }

}