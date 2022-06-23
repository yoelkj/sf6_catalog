<?php

namespace App\Controller\Admin;

use App\Entity\Widget;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class WidgetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Widget::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
