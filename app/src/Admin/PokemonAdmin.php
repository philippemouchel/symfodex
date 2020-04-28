<?php


namespace App\Admin;

use App\Entity\Category;
use App\Entity\Type;
use App\Entity\Pokemon;
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

final class PokemonAdmin extends AbstractAdmin
{
    public function toString($object)
    {
        return $object instanceof Pokemon
            ? '#' . $object->getFormattedNumber() . ' ' . $object->getName()
            : 'Pokemon'; // shown in the breadcrumb on the create view
    }

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
        $datagridMapper
            ->add('name')
            ->add('category', null, [], EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
            ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('number')
            ->addIdentifier('name')
            ->add('description')
            ->add('type.name')
            ->add('category.name');
    }
}
