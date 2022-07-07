<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
    
    public function __construct(ManagerRegistry $registry, CategoryRepository $repo_category, BrandRepository $repo_brand)
    {
        parent::__construct($registry, Product::class);
        
        $this->repo_category = $repo_category;
        $this->repo_brand = $repo_brand;
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

    public function getCatalogData($brand, $category): array
    {
        $arr_result = [];

        $obj_brand = ($brand && $brand != 'all' && $brand != 'todos') ? $this->repo_brand->findOneBySlug($brand) : null;
        $obj_category = ($category && $category != 'all' && $category != 'todos') ? $this->repo_category->getCategoryBySlug($category) : null;
        
        $qb = $this->createQueryBuilder('r')
            ->where('r.isActive = :active');

        if($obj_category) $qb->andWhere('r.category = :category')->setParameter('category', $obj_category);
        if($obj_brand) $qb->andWhere('r.brand = :brand')->setParameter('brand', $obj_brand);
        
        $qb->setParameter('active', true);

        $arr_result['data'] = $qb->orderBy('r.orderRow ASC')->getQuery()->getResult();
        $arr_result['brand'] = $obj_brand; 
        $arr_result['category'] = $obj_category;

        return $arr_result;

    }

    public function getFilterData()
    {
        $arr_result = [];

        $arr_brands =
        $arr_categories = 
        $arr_features = 
        $arr_presentations = [];

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
