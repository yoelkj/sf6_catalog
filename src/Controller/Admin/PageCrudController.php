<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class PageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Page::class;
    }

    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')
            ->onlyOnForms()
            ->hideOnForm();

        yield FormField::addTab('General')->setIcon('cog');    
            yield Field::new('name')->setColumns(6);
            yield SlugField::new('slug')->setTargetFieldName('name')->setColumns(6);

            yield FormField::addRow();
            yield IntegerField::new('orderRow')->onlyOnForms()->setColumns(2);; 
            yield BooleanField::new('isActive');
            yield BooleanField::new('isCore');

        yield FormField::addTab('Content')->setIcon('cogs');
            yield ImageField::new('bgImage')
                ->setBasePath('uploads/pages/bg')
                ->setUploadDir('public/uploads/pages/bg')
                ->setUploadedFileNamePattern('[slug]-bg-[timestamp].[extension]')
                //->setFormTypeOption('upload_new', function(){})
                ->onlyOnForms()
                ->setColumns(6);
            yield ImageField::new('bodyImage')
                ->setBasePath('uploads/pages/body')
                ->setUploadDir('public/uploads/pages/body')
                ->setUploadedFileNamePattern('[slug]-body-[timestamp].[extension]')
                //->setFormTypeOption('upload_new', function(){})
                ->onlyOnForms()
                ->setColumns(6);
            
            yield UrlField::new('bodyVideo')->setColumns(12);

            yield FormField::addRow();

            yield TextEditorField::new('body')->setColumns(12);
        

        /*
        yield AssociationField::new('galleries')
            ->autocomplete()
            ->setFormTypeOption('by_reference', false);
        */
          
        yield DateField::new('createdAt')->hideOnForm();
        yield DateField::new('updatedAt')->onlyOnForms()->hideOnForm();
    }
    
}
