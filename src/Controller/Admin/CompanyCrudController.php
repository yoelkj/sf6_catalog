<?php

namespace App\Controller\Admin;

use App\Entity\Company;
use App\Entity\Country;
use Doctrine\DBAL\Query\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
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
            ->formatValue(static function ($value, Company $company): ?string {
                if (!$user = $company->getUser()) {
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

        yield Field::new('isActive')
            ;

        yield DateField::new('created')->hideOnForm();
        yield DateField::new('updated')->onlyOnForms()->hideOnForm();
    }
    
}
