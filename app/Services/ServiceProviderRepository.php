<?php

namespace App\Services;

use App\Models\ServiceProvider;

class ServiceProviderRepository
{

    public function create($item){
        return ServiceProvider::create($item);
    }

    public function search($keyword = null)
    {
        $query = ServiceProvider::query();
        
        if (!empty($keyword)) {
            $query = $query->where('name', 'like', '%' . $keyword . '%');
        } 
        return $query;
    }

    public function update(){

    }

    public function delete(){

    }

}
