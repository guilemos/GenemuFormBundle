<?php

namespace Genemu\Bundle\FormBundle\Form\JQuery\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * A choice input whose options are populated by Javascript.
 */
class JsChoiceSelect2Type extends AbstractType
{
    public function getBlockPrefix()
    {
        return 'js_choice_select2';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }

    public function getParent()
    {
        return Select2ChoiceType::class;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choice_list' => new JsChoiceSelect2List(),
            'validation_groups' => false,
        ));
    }
}