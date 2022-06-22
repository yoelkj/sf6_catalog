<?php

namespace App\Controller\Admin;

use App\Entity\Company;
use App\Entity\Country;
use Doctrine\DBAL\Query\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;

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

        yield FormField::addTab('General')->setIcon('info');
            yield Field::new('name')->setColumns(6);
            yield Field::new('address')->setColumns(6)
                //->setTextAlign('right')
                ;
            yield Field::new('phoneMain')->setColumns(6);
            yield EmailField::new('emailMain')->setColumns(6);
            yield Field::new('phoneSales')->setColumns(6)->onlyOnForms();
            yield EmailField::new('emailSales')->setColumns(6)->onlyOnForms();
            yield Field::new('phoneSupport')->setColumns(6)->onlyOnForms();
            yield EmailField::new('emailSupport')->setColumns(6)->onlyOnForms();

            yield BooleanField::new('isActive')
            ;

        yield FormField::addTab('Customization')->setIcon('media');
            yield ImageField::new('logo')
                ->setColumns(6)
                ->setBasePath('uploads/logo')
                ->setUploadDir('public/uploads/logo')
                ->setUploadedFileNamePattern('logo-[timestamp].[extension]')
                //->setFormTypeOption('upload_new', function(){})
                ->onlyOnForms();
            yield ColorField::new('bgColorMain')
                ->setColumns(6)
                ->onlyOnForms()
                //->showSample()
                //->showValue()
                ;
            
            yield ImageField::new('favicon')
                ->setColumns(6)
                ->setBasePath('uploads/favicon')
                ->setUploadDir('public/uploads/favicon')
                ->setUploadedFileNamePattern('favicon-[timestamp].[extension]')
                //->setFormTypeOption('upload_new', function(){})
                ->onlyOnForms();
            
            yield ColorField::new('bgColorSecondary')
                ->setColumns(6)
                ->onlyOnForms()
                //->showSample()
                //->showValue()
                ;
    
        yield FormField::addTab('Localization')->setIcon('media');
            yield AssociationField::new('country')->setColumns(6);
            /*
            ->autocomplete()
            //->setCrudController(CountryCrudController::class
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

            yield AssociationField::new('language')->setColumns(6);
            yield Field::new('province')->onlyOnForms()->setColumns(6);
            yield Field::new('city')->onlyOnForms()->setColumns(6);
            
            yield Field::new('postal_code')->onlyOnForms()->setColumns(6);
            yield FormField::addRow();
            yield Field::new('taxIdent')->onlyOnForms()->setColumns(4);
            yield Field::new('taxNumber')->onlyOnForms()->setColumns(4);
            yield PercentField::new('taxPorcent')->setColumns(4)->onlyOnForms()->setNumDecimals(2);
    
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

        

        yield DateField::new('created')->hideOnForm();
        yield DateField::new('updated')->onlyOnForms()->hideOnForm();
    }
    
}
