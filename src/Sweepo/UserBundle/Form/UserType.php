<?php

namespace Sweepo\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\Translator;

class UserType extends AbstractType
{
    private $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username');
        $builder->add('email');
        $builder->add('password', 'repeated', array(
            'type'            => 'password',
            'invalid_message' => $this->translator->trans('password_not_match'),
            'first_options'    => ['label' => $this->translator->trans('password1')],
            'second_options'    => ['label' => $this->translator->trans('password2')],
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sweepo\UserBundle\Entity\User',
        ));
    }

    public function getName()
    {
        return 'create_user';
    }
}