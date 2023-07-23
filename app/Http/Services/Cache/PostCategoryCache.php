<?php


namespace App\Http\Services\Cache;

use App\Models\Content\PostCategory as PostCategoryModel;


class PostCategoryCache{

    CONST CACHE_KEY = "POST_CATEGORY";


    public function all($orderBy){

        $key = "all.{$orderBy}";
        $cacheKey = $this->getCacheKey($key);


        return cache()->remember($cacheKey, now()->addMinute(10), function() use($orderBy){
            return PostCategoryModel::orderBy($orderBy,  'DESC')->simplePaginate(5);
        });
    }

    public function getCacheKey($key){
        $key = strtoupper($key);

        return self::CACHE_KEY . "." .  $key;
    }
}

?>
