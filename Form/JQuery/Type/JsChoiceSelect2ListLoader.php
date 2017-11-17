<?php

namespace Genemu\Bundle\FormBundle\Form\JQuery\Type;

use Symfony\Component\Form\ChoiceList\Loader\ChoiceLoaderInterface;


class JsChoiceSelect2ListLoader implements ChoiceLoaderInterface
{
	public function loadChoiceList($value = null)
	{
		return new JsChoiceSelect2List();
	}


	public function loadChoicesForValues(array $values, $value = null)
	{
		return $values;
	}	
	public function loadValuesForChoices(array $choices, $value = null)
	{
		return $choices;
	}

}