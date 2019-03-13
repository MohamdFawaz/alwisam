<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Models\Setting;
use App\Repositories\BaseRepository;
use Hamcrest\Core\Set;


/**
* Class NotificationRepository.
*/
class CategoryRepository extends BaseRepository
{

    public function getCategoryList($categories){
        $category_item = [];
        $category_list = [];
        foreach ($categories as $category){
            $category_item['id'] = $category->id;
            $category_item['name'] = $category->name;
            $category_item['image']  = $category->image;
            $category_item['children']  = $category->child;
            $category_list[] = $category_item;
        }
        return $category_list;
    }

    public function getParentCategory()
    {
        return Category::whereNull('parent')->get();
    }

    public function getChildCategory()
    {
        return Category::whereNotNull('parent')->get();
    }

    public function getAll()
    {
        return Category::with('parentCategory')->get();
    }

    public function update($category_id,$input)
    {
        $category = Category::where('id',$category_id)->first();
        $category->name = $input['name'];
        if (isset($input['image'])){
            $category->image = $input['image'];
        }
        if($category->save()){
            return true;
        }
        return false;
    }
}