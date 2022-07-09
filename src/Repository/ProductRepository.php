<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    private CategoryRepository $repo_category;
    private BrandRepository $repo_brand;
    private PresentationRepository $repo_presentation;
    private TranslatorInterface $translator;

    public function __construct(ManagerRegistry $registry, CategoryRepository $repo_category, BrandRepository $repo_brand, PresentationRepository $repo_presentation, TranslatorInterface $translator)
    {
        parent::__construct($registry, Product::class);
        
        $this->translator = $translator;
        $this->repo_category = $repo_category;
        $this->repo_brand = $repo_brand;
        $this->repo_presentation = $repo_presentation;
    }

    public function add(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getCatalogData($params = [], $only_query = false)
    {

        $brand =        (isset($params["cbo_brand"])) ?$params["cbo_brand"]:'';
        $presentation = (isset($params["cbo_presentation"])) ?$params["cbo_presentation"]:'';
        $category =     (isset($params["cbo_category"])) ? $params["cbo_category"]:'';
        $feature =      (isset($params["cbo_feature"])) ? $params["cbo_feature"]:'';

        $qb = $this->createQueryBuilder('r')
            ->where('r.isActive = :active');

        if($brand){

            if((int)$brand > 0) $qb->andWhere('r.brand = :brand')->setParameter('brand', $brand);
            else $qb->andWhere('r.brand = :brand')->setParameter('brand', $this->repo_brand->findOneBySlug($brand));
        }

        if($category) $qb->andWhere('r.category = :category')->setParameter('category', $category);
        
        if($presentation) $qb->andWhere('r.brand = :brand')->setParameter('brand', $presentation);
        
        if($feature){
            switch (strtolower($feature)) {
                case 'news':
                    $qb->andWhere('r.isNew = 1');
                    break;
                case 'bestsellers':
                    $qb->andWhere('r.isBestSeller = 1');
                break;
                case 'recommendeds':
                    $qb->andWhere('r.isRecommended = 1');
                    break;
            }
        }

        $qb->setParameter('active', true)
        ->orderBy('r.orderRow', 'ASC')
        ;

        
        if($only_query){
            return $qb;
        }else{
            return $qb->setMaxResults(10)->getQuery()->getResult();
        }

    }

    public function getFilterData()
    {
        $arr_result = [];

        //Features
        $arr_st_features = [1 => 'News', 2 => 'Bestsellers', 3 => 'Recommendeds'];
        foreach($arr_st_features as $value){
            $arr_feartures[$value] = $this->translator->trans($value);
        } 
        $arr_result['features'] = $arr_feartures; 
        $arr_result['brands'] = $this->repo_brand->getChoices(); 
        $arr_result['categories'] = $this->repo_category->getChoices();
        $arr_result['presentations'] = $this->repo_presentation->getChoices();

        return $arr_result;
    }

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
