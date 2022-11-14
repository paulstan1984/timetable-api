<?php

namespace App\Services;

use App\Models\ServiceProvider;
use Illuminate\Http\Request;

class DatabaseRepository
{
    public function search($keyword = null)
    {
        $query = null;
        
        if (!empty($keyword)) {
            $query = ServiceProvider::where('name', 'like', '%' . $keyword . '%')->get();
        } else {
            $query = ServiceProvider::all();
        }

        return $query->makeHidden(['created_at', 'updated_at']);
    }
}
