<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnIndex();
        //yield Field::new('name');
        //yield SlugField::new('slug')->onlyOnForms()->setTargetFieldName('name');
        //yield TextEditorField::new('body');


        yield CollectionField::new('translations')
            ->useEntryCrudForm()
            
            //->renderExpanded()
            
            ->setColumns(12)
            
            ->formatValue(static function ($value, ?Category $category): ?string {
                $num_translations = $category?->getTranslations()->count();
                return sprintf('%s translation(s)', $num_translations);
            })

            /*
            ->setFormTypeOptions([
                'row_attr' => [
                    'data-controller' => 'translations',
                ],
            ])
            */
            
            ;
        

        yield BooleanField::new('isActive');
        yield DateField::new('createdAt')->hideOnForm();
        yield DateField::new('updatedAt')->onlyOnForms()->hideOnForm();
    }
    
}
