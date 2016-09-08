<?php

namespace TipmytipBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class QuestionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add('inquirer_delete')
            ->add('question_date')
            ->add('question_text')
            ->add('location', EntityType::class, array(
			    'class' => 'TipmytipBundle:Location',
            	'query_builder' => function (EntityRepository $er) {
        			return $er->createQueryBuilder('u')
        				//->where('u.available = ?', '1')
        				->orderBy('u.name', 'ASC');
    			},
			    'choice_label' => 'name',
			
			    // used to render a select box, check boxes or radios
			    // 'multiple' => true,
			    // 'expanded' => true,
			))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TipmytipBundle\Entity\Question'
        ));
    }
}
