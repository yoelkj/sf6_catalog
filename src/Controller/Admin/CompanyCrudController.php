<?php

namespace App\Controller\Admin;

use App\Entity\Company;
use App\Entity\Country;
use Doctrine\DBAL\Query\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class CompanyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Company::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield Field::new('name');

        yield Field::new('address')
            //->setTextAlign('right')
            ;
        yield Field::new('phoneMain')
            ;
        yield Field::new('phoneSales')
            ->onlyOnForms();
        yield Field::new('phoneSupport')
            ->onlyOnForms();
        
        yield EmailField::new('emailMain')
            ;
        yield EmailField::new('emailSales')
            ->onlyOnForms();
        yield EmailField::new('emailSupport')
            ->onlyOnForms();

        yield AssociationField::new('language');
        yield AssociationField::new('country')
            /*
            ->autocomplete()
            //->setCrudController(CountryCrudController::class)

            ->formatValue(static function ($value, ?Company $company): ?string {
                if (!$user = $company?->getUser()) {
                    return null;
                }
                return sprintf('%s&nbsp;(%s)', $user->getEmail(), $user->getQuestions()->count());  
            })
            ->setQueryBuilder(function (QueryBuilder $qb) {
                $qb->andWhere('entity.isActive = :isAcctive')
                    ->setParameter('isAcctive', true);
            })
            */
        ;

        /*
        
        yield Field::new('slug')
            ->hideOnIndex();
            ->setFormTypeOption(
                'disabled',
                $pageName !== Crud::PAGE_NEW
            );

        yield TextField::new('answer')
            ->setTemplatePath('admin/field/integer.html.twig');
            ->setMaxLength(50);

        yield TextEditorField::new('question')
        yield TextareaField::new('question')
        yield TextareaField::new('question')
            ->hideOnIndex()
            ->setHelp('Preview:');
            ->setFormTypeOptions([
                'row_attr' => [
                    'data-controller' => 'snarkdown',
                ],
                'attr' => [
                    'data-snarkdown-target' => 'input',
                    'data-action' => 'snarkdown#render',
                ],
            ]);

        */

        yield BooleanField::new('isActive')
            ;

        yield DateField::new('created')->hideOnForm();
        yield DateField::new('updated')->onlyOnForms()->hideOnForm();
    }
    
}
