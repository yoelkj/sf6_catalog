<?php

namespace App\Controller\Admin;

use App\Entity\Widget;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class WidgetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Widget::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnIndex();

        yield FormField::addRow();
        yield Field::new('name')->setColumns(6);
        yield ColorField::new('bgColor')
                ->setColumns(6)
                ->onlyOnForms()
                //->showSample()
                //->showValue()
                ;

        yield FormField::addRow();
        yield TextEditorField::new('body')->setColumns(12);
        
        yield AssociationField::new('gallery')
                ->setCrudController(GalleryCrudController::class)
                ->setColumns(6);

        yield FormField::addRow();
        yield IntegerField::new('orderRow')->setColumns(6)->onlyOnForms();
        yield ChoiceField::new('template')->setColumns(6)->onlyOnForms()->setChoices([
            'TEMPLATE_SLIDERS' => 'Slider',
            'TEMPLATE_CAROUCEL' => 'Caroucel',
        ]);
        
        yield FormField::addRow();
        yield BooleanField::new('isActive');
        
        yield BooleanField::new('isCore')->onlyOnForms();

        yield DateField::new('createdAt')->hideOnForm();
        yield DateField::new('updatedAt')->onlyOnForms()->hideOnForm();
        

    }
}
