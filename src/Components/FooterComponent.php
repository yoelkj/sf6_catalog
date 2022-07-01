<?php 

namespace App\Components;

use App\Repository\MenuRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('footer')]
class FooterComponent
{
    private MenuRepository $repo_menu;

    public function __construct(MenuRepository $repo_menu)
    {
        $this->repo_menu = $repo_menu;
    }

    public function getMenuItems(): array
    {

        $arr_result = ['withChilds' => [], 'noChilds' => []];
        $arr_rows = $this->repo_menu->getActiveRows();
        
        foreach ($arr_rows as $row) {
            if($row->getMenus()->count()){
                $arr_result['withChilds'][] = $row;
            }else{
                $arr_result['noChilds'][] = $row;
            }
        }

        return $arr_result;
    }

}