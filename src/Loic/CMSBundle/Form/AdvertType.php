<?php

namespace Loic\CMSBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Loic\CMSBundle\Form\CkeditorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class AdvertType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('content', CkeditorType::class)
            ->add('firstCategory', EntityType::class, array(
                'class'         => 'LoicCMSBundle:Category',
                'choice_label'  => 'name',
                'multiple'      => false,
            ))
            ->add('categories', EntityType::class, array(
                'class'         => 'LoicCMSBundle:Category',
                'choice_label'  => 'name',
                'multiple'      => true,
            ))
            ->add('access', ChoiceType::class, array(
                'choices'   => array(
                    'All'   => 'IS_AUTHENTICATED_ANONYMOUSLY',
                    'User'  => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN',
                ),
                'preferred_choices'  => $options['extra_fields_message']['primary'],
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Loic\CMSBundle\Entity\Advert'
        ));
    }
}
