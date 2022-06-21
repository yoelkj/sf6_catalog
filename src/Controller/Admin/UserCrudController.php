<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AvatarField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        yield IdField::new('id')
            ->onlyOnForms()
            ->hideOnForm();

        yield AvatarField::new('avatar')
            ->formatValue(static function ($value, User $user) {
                return $user->getAvatarUrl();
            })
            ->hideOnForm();
        yield ImageField::new('avatar')
            ->setBasePath('uploads/avatars')
            ->setUploadDir('public/uploads/avatars')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
            //->setFormTypeOption('upload_new', function(){})
            ->onlyOnForms();

        yield TextField::new('password')
            ->onlyOnForms()
            ->hideOnForm();

        /*
        yield TextField::new('password')
            ->onlyOnForms()
            ->setFormType(PasswordType::class)
            ->setFormTypeOption('empty_data', '')
            ->setRequired(false)
            ->setHelp('If the right is not given, leave the field blank.');
        */
        
        
        yield EmailField::new('email');
        yield TextField::new('name');
        
        /*
        yield ArrayField::new('roles')
            ->setHelp('Available roles: ROLE_ADMIN, ROLE_USER');
        */
        $roles = ['ROLE_ADMIN', 'ROLE_USER'];
        yield ChoiceField::new('roles')
            ->setChoices(array_combine($roles, $roles))
            ->allowMultipleChoices()
            ->renderExpanded()
            ->renderAsBadges();

        yield BooleanField::new('isVerified');
        yield BooleanField::new('isActive');

        yield DateField::new('created')->hideOnForm();
        yield DateField::new('updated')->onlyOnForms()->hideOnForm();


        /*
        ->onlyOnIndex();
        ->onlyOnForms();
        
        */
        

        /*
        return [
            IdField::new('id'),
            TextField::new('name'),
        ];
        */
    }

    public function configureCrud(Crud $crud): Crud
    {
        //'language.isActive' => 'DESC',
        return parent::configureCrud($crud)
            ->setDefaultSort([
                
                'isActive' => 'DESC',
                'created' => 'DESC',
            ]);
    }
    
}
