<?php


namespace App\Admin;

use App\Entity\Type;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class TypeAdmin extends AbstractAdmin
{
    public function toString($object)
    {
        return $object instanceof Type
            ? $object->getName()
            : 'Type'; // shown in the breadcrumb on the create view
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', TextType::class)
            ->add('description', TextareaType::class, [
                'required' => false,
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('description');
    }
}
