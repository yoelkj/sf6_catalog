<?php

namespace App\Controller\Admin;

use App\Entity\Menu;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use Symfony\Component\Routing\Generator\UrlGenerator;

class MenuCrudController extends AbstractCrudController
{
    private EntityManagerInterface $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public static function getEntityFqcn(): string
    {
        return Menu::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $context = $this;

        yield IdField::new('id')->onlyOnIndex();
        //yield IntegerField::new('orderRow')->onlyOnIndex();
        yield FormField::addRow();
        yield BooleanField::new('isParent')->onlyOnIndex();
        yield CollectionField::new('translations')
            ->useEntryCrudForm()
            ->setColumns(12)
            ->formatValue(static function ($value, ?Menu $menu) use ($context): ?string {

                $name = $menu?->getTranslateName();
                $num_translations = $menu?->getTranslations()->count();
                
                
                $obj_page = $menu->getPage();
                $obj_page_translation = ($obj_page) ? $obj_page->getTranslation() : null;
                $page_slug = ($obj_page_translation) ? $obj_page_translation->getSlug() : '';

                $urlpage = '';

                if ($page_slug){

                    if($obj_page->getIsCatalog() == true){
                        
                        $catalog_params = [];
                        
                        $obj_brand = $menu->getBrand();
                        $obj_presentation = $menu->getPresentation();
                        $obj_presentation_trans = ($obj_presentation) ? $obj_presentation->getTranslation() : null;
                        $obj_category = $menu->getCategory();
                        $obj_category_trans = ($obj_category) ? $obj_category->getTranslation() : null;
                        
                        $brand_slug = ($obj_brand && $obj_brand->getSlug()) ? $obj_brand->getSlug() : null;
                        $presentation_slug = ($obj_presentation_trans && $obj_presentation_trans->getSlug()) ? $obj_presentation_trans->getSlug() : null;
                        $category_slug = ($obj_category_trans && $obj_category_trans->getSlug()) ? $obj_category_trans->getSlug() : null;
                        $feature = ($menu->getFeature()) ? $menu->getFeature() : null;

                        $catalog_params['slug'] = $page_slug;

                        if($brand_slug) $catalog_params['brand'] = $brand_slug;
                        if($presentation_slug) $catalog_params['presentation'] = $presentation_slug;
                        if($category_slug) $catalog_params['category'] = $category_slug;
                        if($feature) $catalog_params['feature'] = $feature;
                        
                        $urlpage = ($page_slug) ? $context->generateUrl('app_catalog', $catalog_params, UrlGenerator::ABSOLUTE_URL) : '';
                    }else{  
                        $urlpage = ($page_slug) ? $context->generateUrl('app_page', ['slug'=> $page_slug], UrlGenerator::ABSOLUTE_URL) : '';
                    }

                }
                
                
                return sprintf('%s - %s translation(s) <br> <a target="_blank" href="%s">%s</a>', $name, $num_translations, $urlpage, $urlpage);
        })
        //->renderExpanded()
        /*->setFormTypeOptions(['row_attr' => ['data-controller' => 'translations',],])*/
        ;

        yield FormField::addRow();
        yield AssociationField::new('page')->setColumns(12);
        
        yield FormField::addRow();
        yield AssociationField::new('brand')->onlyOnForms()->setColumns(3);
        yield AssociationField::new('category')->onlyOnForms()->setColumns(3);
        yield AssociationField::new('presentation')->onlyOnForms()->setColumns(3);

        
        $arr_features_options = $this->em->getRepository(Product::class)->getFeaturesOptions();
        $arr_fo = [];
        foreach ($arr_features_options as $key => $value) $arr_fo[$value] = $key;
        yield ChoiceField::new('feature')->setColumns(3)->onlyOnForms()->setChoices(
            $arr_fo
        );

        yield FormField::addRow();
        yield AssociationField::new('menus', 'Sub menus')->onlyOnForms()->setColumns(12);
        
        yield FormField::addRow();
        yield IntegerField::new('orderRow')->setColumns(2);
        yield BooleanField::new('isParent')->onlyOnForms();//->setColumns(12)
        yield BooleanField::new('isActive');//->setColumns(12)
        yield DateField::new('createdAt')->hideOnForm();
        yield DateField::new('updatedAt')->onlyOnForms()->hideOnForm();
    }
    
}
