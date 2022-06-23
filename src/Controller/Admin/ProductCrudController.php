<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnIndex();
        
        yield FormField::addTab('General')->setIcon('cog');
            yield FormField::addRow();
            yield Field::new('name')->setColumns(6);
            yield SlugField::new('slug')->onlyOnForms()->setColumns(6)->setTargetFieldName('name');
            yield FormField::addRow();
            yield Field::new('code')->setColumns(12);
            yield AssociationField::new('category')->onlyOnIndex();
            yield BooleanField::new('isActive');

        yield FormField::addTab('Content')->setIcon('cogs');
            yield FormField::addRow();
            yield AssociationField::new('category')->onlyOnForms()->setColumns(4);
            yield AssociationField::new('brand')->onlyOnForms()->setColumns(4);
            yield AssociationField::new('presentation')->onlyOnForms()->setColumns(4);       
            
            yield FormField::addRow();
            yield NumberField::new('weightGrammage')->onlyOnForms()->setColumns(4);
            yield IntegerField::new('quantityPerBox')->onlyOnForms()->setColumns(4);
            yield IntegerField::new('storageLifeMonths')->onlyOnForms()->setColumns(4);

            yield FormField::addRow();
            yield TextEditorField::new('body')->onlyOnForms()->setColumns(12);

            yield FormField::addRow();
            yield BooleanField::new('isNew')->onlyOnForms()->setColumns(4);
            yield BooleanField::new('isBestSeller')->onlyOnForms()->setColumns(4);
            yield BooleanField::new('isRecommended')->onlyOnForms()->setColumns(4);
                    
        
        yield DateField::new('createdAt')->hideOnForm();
        yield DateField::new('updatedAt')->onlyOnForms()->hideOnForm();
    }
}
