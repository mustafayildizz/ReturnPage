<?php

namespace App\Form;

use App\Entity\Refund;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RefundType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('order_code')
            ->add('name')
            ->add('surname')
            ->add('country')
            ->add('street_address')
            ->add('postcode')
            ->add('city')
            ->add('email')
            ->add('phone')
            ->add('credit_card_number')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Refund::class,
        ]);
    }
}
