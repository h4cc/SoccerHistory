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
            'class'    => 'SweepoBettingBundle:Team',
            'property' => 'name',
        ));

        $builder->add('second_team', 'entity', array(
            'class'    => 'SweepoBettingBundle:Team',
            'property' => 'name',
        ));

        $builder->add('type', 'choice', array(
            'label' => $this->translator->trans('type'),
            'choices' => array('foo' => 'Foo', 'bar' => 'Bar'),
        ));
        $builder->add('bet', 'text', array('label' => $this->translator->trans('bet'),));
        $builder->add('odds', 'integer', array('label' => $this->translator->trans('odds'),));
        $builder->add('stake_percent', 'integer', array('label' => $this->translator->trans('stake_percent'),));
        $builder->add('stake_euro', 'integer', array('label' => $this->translator->trans('stake_euro'),));
        $builder->add('result', 'choice', array(
            'label' => $this->translator->trans('result'),
            'choices' => array(
                'true'  => $this->translator->trans('success'),
                'flase' => $this->translator->trans('fail')
            ),
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