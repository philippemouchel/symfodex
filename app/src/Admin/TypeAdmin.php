<?php


namespace App\Admin;

use App\Entity\Type;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

final class TypeAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', TextType::class)
            ->add('slug', TextType::class)
            ->add('color', TextType::class, [
                'help' => 'HTML color (name, HEXA or RGB). See <a href="https://www.w3schools.com/colors/" target="_blank">Colors Tutorial on W3C</a>.
<br>Gradient 50/50 available, please separate the two colors with <strong>","</strong>.',
                'help_html' => true,
            ])
            ->add('bootstrapColor', ChoiceType::class, [
                'help' => 'Among Bootstrap4 colors. See <a href="https://getbootstrap.com/docs/4.0/components/badge/#contextual-variations" target="_blank">Colors on Boostrap.com</a>.',
                'help_html' => true,
                'choices' => [
                    'Primary' => 'primary',
                    'Secondary' => 'secondary',
                    'Success' => 'success',
                    'Danger' => 'danger',
                    'Warning' => 'warning',
                    'Info' => 'info',
                    'Light' => 'light',
                    'Dark' => 'dark',
                    'None' => '',
                ],
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('color');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('slug')
            ->add('name')
            ->add('color')
            ->add('bootstrapColor');
    }
}
