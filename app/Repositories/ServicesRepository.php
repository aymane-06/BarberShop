<?php

namespace App\Repositories;

use App\Models\Services;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ServicesRepository.
 */
class ServicesRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Services::class;
    }
    public static  function getAllServices($barberShopId)
    {
        return Services::where('barber_shop_id', $barberShopId)->count();
    }
    public static function getServiceById($id)
    {
        return Services::findOrFail($id);
    }
    public static function getActiveServices($barberShopId)
    {
        return Services::where('barber_shop_id', $barberShopId)->where('is_active', 1)->count();
    }
    public static function getInactiveServices($barberShopId)
    {
        return Services::where('barber_shop_id', $barberShopId)->where('is_active', 0)->count();
    }
    public static function getAVGPrice($barberShopId)
    {
        return Services::where('barber_shop_id', $barberShopId)->avg('price');
    }
    public static function getStatistics($barberShopId)
    {
        return [
            'total_services' => self::getAllServices($barberShopId),
            'active_services' => self::getActiveServices($barberShopId),
            'inactive_services' => self::getInactiveServices($barberShopId),
            'avg_price' => self::getAVGPrice($barberShopId),
        ];
        }

    public static function filterServices($barberShopId, $filters)
    {
        $query = Services::where('barber_shop_id', $barberShopId);

        if (isset($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        if (isset($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (isset($filters['status'])) {
            $query->where('is_active', $filters['status']);
        }
        
        if (isset($filters['sort'])) {
            switch ($filters['sort']) {
            case 'DESC':
                $query->orderBy('created_at', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'duration_asc':
                $query->orderBy('duration', 'asc');
                break;
            case 'duration_desc':
                $query->orderBy('duration', 'desc');
                break;
            }
        }

        return $query->paginate(6);
    } 
}
