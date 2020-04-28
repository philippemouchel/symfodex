<?php


namespace App\Admin;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use App\Entity\Category;
use App\Entity\Type;

final class PokemonAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Content', ['class' => 'col-md-9'])
                ->add('number', IntegerType::class)
                ->add('name', TextType::class)
                ->add('description', TextareaType::class)
                ->add('height', NumberType::class, [
                    'help' => 'millimeters',
                ])
                ->add('weight', NumberType::class, [
                    'help' => 'grams',
                ])
                ->end()
            ->with('Meta data', ['class' => 'col-md-3'])
                ->add('category', ModelType::class, [
                    'class' => Category::class,
                    'property' => 'name',
                ])
                ->add('type', EntityType::class, [
                    'class' => Type::class,
                    'multiple' => true,
                    'choice_label' => 'name',
                ])
                ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
//        $listMapper->addIdentifier('type');
//        $listMapper->addIdentifier('category');
    }
}
