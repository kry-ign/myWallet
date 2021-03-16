<?php

namespace App\Form;

use App\Command\Product\AbstractProductCommand;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('productName')
            ->add('price', NumberType::class, [
                'invalid_message' => 'to low money',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
            ])
            ->add('submit', SubmitType::class)
        ;
        $builder->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'onPreSubmit']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AbstractProductCommand::class,
            'budgetLeft' => 0,
        ]);
    }

    public function onPreSubmit(FormEvent $event): void
    {
        $data = $event->getData();
        $budgetLeft = $event->getForm()->getConfig()->getOption('budgetLeft');

        if ($budgetLeft < $data['price']) {
            return;
        }

        $event->setData($data);
    }
}
