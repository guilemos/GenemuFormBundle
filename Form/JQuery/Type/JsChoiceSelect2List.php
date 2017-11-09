<?php

namespace Genemu\Bundle\FormBundle\Form\JQuery\Type;

use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceListInterface;

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

}