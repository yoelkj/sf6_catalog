<?php

namespace App\Controller\Admin;

use App\Entity\GalleryImages;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GalleryImagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GalleryImages::class;
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
