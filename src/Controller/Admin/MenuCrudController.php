<?php

namespace App\Controller\Admin;

use App\Entity\Menu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class MenuCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Menu::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnIndex();
        
        yield CollectionField::new('translations')
            ->useEntryCrudForm()
            ->setColumns(12)
            ->formatValue(static function ($value, ?Menu $menu): ?string {

                $name = $menu?->getTranslateName();
                $num_translations = $menu?->getTranslations()->count();
                return sprintf('%s - %s translation(s)', $name, $num_translations);
        })
        //->renderExpanded()
        /*->setFormTypeOptions(['row_attr' => ['data-controller' => 'translations',],])*/
        ;

        yield AssociationField::new('page')->setColumns(6);
        yield AssociationField::new('category')->setColumns(6);

        yield AssociationField::new('menus', 'Sub menus')->onlyOnForms()->setColumns(12);

        yield IntegerField::new('orderRow')->setColumns(2)->onlyOnForms();
        yield BooleanField::new('isActive');//->setColumns(12)
        yield DateField::new('createdAt')->hideOnForm();
        yield DateField::new('updatedAt')->onlyOnForms()->hideOnForm();
    }
    
}