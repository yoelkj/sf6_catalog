<?php

namespace App\Controller\Admin;

use App\Entity\GalleryImages;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;

class GalleryImagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GalleryImages::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnIndex();
        
        yield FormField::addRow();
        yield AssociationField::new('gallery')->setColumns(8);
        yield AssociationField::new('language')->setColumns(8);

        yield FormField::addRow();
        yield ImageField::new('image')
            ->setBasePath('uploads/gallery')
            ->setUploadDir('public/uploads/gallery')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
            //->setFormTypeOption('upload_new', function(){})
            ->onlyOnForms()->setColumns(8);
        yield IntegerField::new('orderRow')->setColumns(8)->onlyOnForms();
        
        yield BooleanField::new('isActive');//->setColumns(12)

        yield DateField::new('createdAt')->hideOnForm();
        yield DateField::new('updatedAt')->onlyOnForms()->hideOnForm();

    }

    public function configureFilters(Filters $filters): Filters
    {
        return parent::configureFilters($filters)
            ->add('createdAt')
            ->add('gallery')
            ->add('language')
            
            ->add(BooleanFilter::new('isActive'))
            //->add(BooleanFilter::new('enabled')->setFormTypeOption('expanded', false));
            
            ;
    }

}
