<?php

namespace App\Controller\Admin;

use App\Entity\Country;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class CountryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Country::class;
    }

    /*
    public function configureFilters(Filters $filters): Filters
    {
        return parent::configureFilters($filters)
            ->add('createdAt')
            ->add('name')
            ->add('isActive')
            ;
    }
    */

    public function configureFields(string $pageName): iterable
    {
        
        yield IdField::new('id')
            ->onlyOnIndex();
        yield Field::new('name')
            //->setTextAlign('right')
            ;
        yield Field::new('code')
            ;
        
        //yield TextField::new('flag')
        //    ->onlyOnForms();

        yield AssociationField::new('language');

        yield BooleanField::new('isActive')
            ;

        yield DateField::new('createdAt')->hideOnForm();
        yield DateField::new('updatedAt')->onlyOnForms()->hideOnForm();

    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->remove(Crud::PAGE_DETAIL, Action::DELETE)             
            ;       
    }
    
}
