<?php

namespace App\Form;

use App\Entity\Refund;
use Container5uAYmHG\getSecurity_Csrf_TokenManagerService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class Refund1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('order_code', null, [
                'required' => true,
                'label' => false,
                'disabled' => true,

            ])
            ->add('name', null, [
                'required' => true,
                'label' => false,
                'disabled' => true,

            ])
            ->add('surname', null, [
                'required' => true,
                'label' => false,
                'disabled' => true,
            ])
            ->add('country', null, [
                'required' => true,
                'label' => false,
                'disabled' => true,
            ])
            ->add('street_address', null, [
                'required' => true,
                'label' => false,
                'disabled' => true,
            ])
            ->add('postcode', null, [
                'required' => true,
                'label' => false,
                'disabled' => true,
            ])
            ->add('city', null, [
                'required' => true,
                'label' => false,
                'disabled' => true,
            ])
            ->add('email', null, [
                'required' => true,
                'label' => false,
                'disabled' => true,
            ])
            ->add('phone', null, [
                'required' => true,
                'label' => false,
                'disabled' => true,
            ])
            ->add('credit_card_number', null, [
                'required' => true,
                'label' => false,
                'disabled' => true,
            ])
            ->add('order_detail', TextareaType::class, [
                'required' => true,
                'label' => false,
                'disabled' => true,
                'attr' => array('cols' => '61', 'rows' => '5'),
            ])
            ->add('messages', TextareaType::class, [
                'required' => false,
                'label' => false,
                'disabled' => false,
                'attr' => array('cols' => '61', 'rows' => '4', 'placeholder' => 'Message to Customer'),
            ])
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'New' => 'New',
                    'Accepted' => 'Accepted',
                    'Canceled' => 'Canceled',
                    'Completed' => 'Completed',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Refund::class,
            'csrf_protection' => false,
        ]);
    }
}
