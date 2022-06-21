<?php

namespace App\Controller\Admin;

use App\Entity\Country;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class CountryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Country::class;
    }

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

        yield Field::new('isActive')
            ;

        yield DateField::new('created')->hideOnForm();
        yield DateField::new('updated')->onlyOnForms()->hideOnForm();

    }
    
}
