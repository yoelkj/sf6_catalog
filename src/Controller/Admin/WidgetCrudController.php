<?php

namespace App\Controller\Admin;

use App\Entity\Widget;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class WidgetCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Widget::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnIndex();
        yield Field::new('orderRow')->onlyOnIndex();

        yield ChoiceField::new('template')->setColumns(12)->onlyOnForms()->setChoices([
            'Content Caroucel' => 'TEMPLATE_CONTENT_CAROUCEL',
            'Main Caroucel' => 'TEMPLATE_MAIN_CAROUCEL',
            'Office' => 'TEMPLATE_OFFICE',
            'Subscription' => 'TEMPLATE_SUBSCRIPTION',
            'Video' => 'TEMPLATE_VIDEO',
        ]);

        yield FormField::addRow();
        yield CollectionField::new('translations')
                ->useEntryCrudForm()
                //->renderExpanded()
                ->setColumns(12)
                ->formatValue(static function ($value, ?Widget $widget): ?string {
                    $name = $widget?->getTranslateName();
                    $num_translations = $widget?->getTranslations()->count();
                    return sprintf('%s - %s translation(s)', $name, $num_translations);
                });

        yield FormField::addRow();
        yield ImageField::new('bgImage')
            ->setBasePath('uploads/widgets/bg')
            ->setUploadDir('public/uploads/widgets/bg')
            ->setUploadedFileNamePattern('[slug]-bg-[timestamp].[extension]')
            //->setFormTypeOption('upload_new', function(){})
            ->onlyOnForms()
            ->setColumns(6);

        yield ColorField::new('bgColor')
                ->setColumns(3)
                ->onlyOnForms()
                ->showValue();

        yield ColorField::new('textColor')
            ->setColumns(3)
            ->onlyOnForms()
            ->showValue();

        yield FormField::addRow();
        yield AssociationField::new('gallery')
                ->setCrudController(GalleryCrudController::class)
                ->setColumns(6);
        yield IntegerField::new('orderRow')->setColumns(6)->onlyOnForms();
        
        yield FormField::addRow();
        yield BooleanField::new('isActive')->setColumns(4);
        yield BooleanField::new('isCore')->setColumns(4)->onlyOnForms();

        yield DateField::new('createdAt')->hideOnForm();
        yield DateField::new('updatedAt')->onlyOnForms()->hideOnForm();
        

    }
}
