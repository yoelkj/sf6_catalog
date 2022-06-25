<?php

namespace App\Controller\Admin;

use App\Entity\CategoryTranslation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class CategoryTranslationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategoryTranslation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnIndex();
        yield TextEditorField::new('body')->setColumns(12);
        yield Field::new('locale')->setColumns(12);
        yield Field::new('name')->setColumns(12);
        yield SlugField::new('slug')->setColumns(12)->onlyOnForms()->setTargetFieldName('name');
        
    }
    
}
