<?php

namespace App\Services;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Builder;

class ReservationRepository
{

    public function create($item)
    {
        return Reservation::create($item);
    }

    public function search(string $keyword = null)
    {
        $query = Reservation::with('phisical_resource.service_provider');

        if (!empty($keyword)) {
            $query = $query
                ->where('client_name', 'like', '%' . $keyword . '%')
                ->orWhere('client_phone', 'like', '%' . $keyword . '%')
                ->orWhere('client_email', 'like', '%' . $keyword . '%')
                ->orWhereHas('phisical_resource',  function (Builder $query) use ($keyword) {
                    $query
                        ->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('description', 'like', '%' . $keyword . '%');
                });
        }
        return $query;
    }

    public function update(Reservation $item, $data)
    {
        return $item->update($data);
    }

    public function delete(Reservation $item)
    {
        $item->delete();
    }
}
