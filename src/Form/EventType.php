<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class EventType
 * @package App\Form
 */
class EventType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        try {
            $dateTimeOptions = $this->getDateTimeOptions();
        } catch (\Exception $e) {
            die('Date format could not be handled');
        }

        $builder
            ->add(
                'date',
                DateType::class,
                $dateTimeOptions
            )
            ->add(
                'location',
                EntityType::class,
                [
                    'class'        => Event::class,
                    'choice_label' => 'location.name',
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Event::class,
            ]
        );
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function getDateTimeOptions(): array
    {
        $dateTime        = new \DateTime();
        $dateTimeOptions = [
            'widget' => 'single_text',
            'years'  => [
                $dateTime->format('Y'),
                $dateTime->add(
                    $yearInterval = new \DateInterval('P1Y')
                )->format('Y'),
            ],
        ];

        return $dateTimeOptions;
    }
}
