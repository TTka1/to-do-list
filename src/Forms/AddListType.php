<?php

namespace App\Forms;

use Symfony\Component\Form\AbstractType;
use App\Entity\Todo;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddListType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name', TextType::class, [
                'label' => 'Vaša lista',
                'attr' =>[
                    'class' => 'form-control my-2 rounded-0',
                ]
            ]);

        $builder
            ->add('add', SubmitType::class, [
                'label' => 'cart.addToCart',
                'attr' => [
                    'class' => 'btn btn-danger rounded-0 text-center w-100 btn-fa-cart'
                ],
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Todo::class,
        ]);
    }
}