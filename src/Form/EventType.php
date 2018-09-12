<?php

namespace App\Form;

use App\Entity\Event;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        try {
            $dateTimeOptions = $this->getDateTimeOptions();
        } catch (\Exception $e) {
            die('Date format could not be handled');
        }

        $builder
            ->add(
                'fromDate',
                DateType::class,
                $dateTimeOptions
            )
            ->add(
                'toDate',
                DateType::class,
                $dateTimeOptions
            )
            ->add('topic')
            ->add(
                'location',
                EntityType::class,
                [
                    'class'        => Event::class,
                    'choice_label' => 'location.name',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
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
                    $yearInterval = new \DateInterval("P1Y")
                )->format('Y'),
            ],
        ];

        return $dateTimeOptions;
    }
}
