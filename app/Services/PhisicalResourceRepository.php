<?php

namespace App\Services;

use App\Models\PhisicalResource;

class PhisicalResourceRepository
{

    public function create($item)
    {
        return PhisicalResource::create($item);
    }

    public function search(string $keyword = null)
    {
        $query = PhisicalResource::query();

        if (!empty($keyword)) {
            $query = $query->where('name', 'like', '%' . $keyword . '%');
        }
        return $query;
    }

    public function update(PhisicalResource $item, $data)
    {
        return $item->update($data);
    }

    public function delete(PhisicalResource $item)
    {
        $item->delete();
    }
}
