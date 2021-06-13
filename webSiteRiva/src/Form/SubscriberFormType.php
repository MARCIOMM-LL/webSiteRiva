<?php

namespace App\Form;

use App\Entity\Subscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubscriberFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', TextType::class, [
                'attr' => [
                    'placeholder' => 'Digite o seu nome'
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Digite o seu e-mail'
                ]
            ])
            ->add('telefone', TextType::class, [
                'attr' => [
                    'placeholder' => 'Digite o seu telefone'
                ]
            ])
            ->add('mensagem', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Escreva a sua mensagem'
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, ['mapped' => false, 'required' => false])
            ->add('Submit', SubmitType::class)
            ->getForm()
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Subscriber::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'subscriber_item'
        ]);
    }
}
