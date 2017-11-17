<?php

namespace Genemu\Bundle\FormBundle\Form\JQuery\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

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

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choice_loader' => new JsChoiceSelect2ListLoader(),
            'validation_groups' => false,
        ));
    }
}