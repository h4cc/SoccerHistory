<?php

namespace Sweepo\BettingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\Translator;

use Sweepo\BettingBundle\Form\TeamType;

class BetType extends AbstractType
{
    private $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('first_team', 'entity', array(
            'required' => true,
            'class'    => 'SweepoBettingBundle:Team',
            'property' => 'name',
        ));
        $builder->add('second_team', 'entity', array(
            'required' => true,
            'class'    => 'SweepoBettingBundle:Team',
            'property' => 'name',
        ));
        $builder->add('league', 'entity', array(
            'required' => true,
            'class'    => 'SweepoBettingBundle:League',
            'property' => 'name',
        ));
        $builder->add('type', 'choice', array(
            'required' => true,
            'label' => $this->translator->trans('type'),
            'choices' => array('foo' => 'Foo', 'bar' => 'Bar', 'test' => 'Test'),
        ));
        $builder->add('bet', 'text', array(
            'required' => true,
            'label' => $this->translator->trans('bet')
        ));
        $builder->add('odds', 'number', array(
            'required' => true,
            'label' => $this->translator->trans('odds')
        ));
        $builder->add('stake', 'number', array(
            'required' => false,
            'label' => $this->translator->trans('stake')
        ));
        $builder->add('stake_type', 'choice', array(
            'required' => false,
            'label' => $this->translator->trans('stake_type'),
            'choices' => array(
                'euro' => $this->translator->trans('euro'),
                'percent'  => $this->translator->trans('percent'),
            ),
            'empty_value' => false,
        ));
        $builder->add('result', 'choice', array(
            'required' => false,
            'label' => $this->translator->trans('result'),
            'choices' => array(
                true  => $this->translator->trans('success'),
                false => $this->translator->trans('fail')
            ),
            'empty_value' => $this->translator->trans('result_not_yet'),
            'empty_data'  => null
        ));
        $builder->add('date', 'datetime', array(
            'required' => true,
            'label' => $this->translator->trans('date')
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'        => 'Sweepo\BettingBundle\Entity\Bet',
        ));
    }

    public function getName()
    {
        return 'create_bet';
    }
}