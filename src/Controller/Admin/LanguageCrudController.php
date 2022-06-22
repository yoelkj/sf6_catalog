<?php

namespace App\Controller\Admin;

use App\Entity\Language;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class LanguageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Language::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->disable(Action::DETAIL)
            //->setPermission(Action::INDEX, 'ROLE_MODERATOR')
            //->setPermission(Action::DETAIL, 'ROLE_MODERATOR')
            //->setPermission(Action::EDIT, 'ROLE_MODERATOR');
            //->setPermission(Action::NEW, 'ROLE_SUPER_ADMIN')
            //->setPermission(Action::DELETE, 'ROLE_SUPER_ADMIN');
            //->setPermission(Action::BATCH_DELETE, 'ROLE_SUPER_ADMIN');
            ;
    }

    
    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')
            ->onlyOnIndex();
        yield Field::new('name');
        yield Field::new('code');
        yield Field::new('orderRow')->onlyOnForms();
        yield Field::new('isActive');

        yield AssociationField::new('countries')
            ->autocomplete()
            ->setFormTypeOption('by_reference', false);

        yield DateField::new('created')->hideOnForm();
        yield DateField::new('updated')->onlyOnForms()->hideOnForm();
        
    }
    
}
