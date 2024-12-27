<?php

declare(strict_types=1);

namespace Synolia\SyliusSchedulerCommandPlugin\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints;
use Synolia\SyliusSchedulerCommandPlugin\Entity\ScheduledCommandInterface;

final class ScheduledCommandType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'empty_data' => '',
            ])
            ->add('command', CommandChoiceType::class)
            ->add('arguments')
            ->add('timeout', IntegerType::class, [
                'required' => false,
                'constraints' => [
                    new Constraints\PositiveOrZero(),
                ],
                'attr' => [
                    'min' => 0,
                ],
            ])
            ->add('idle_timeout', IntegerType::class, [
                'required' => false,
                'constraints' => [
                    new Constraints\PositiveOrZero(),
                ],
                'attr' => [
                    'min' => 0,
                ],
            ])
            ->add('logFile')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ScheduledCommandInterface::class,
        ]);
    }
}
