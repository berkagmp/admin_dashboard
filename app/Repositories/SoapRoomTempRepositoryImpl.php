<?php

namespace App\Repositories;

use App\Model\SoapRoom;

class SoapRoomTempRepositoryImpl implements TempRepository
{
    /**
     * Get's temps by limit
     *
     * @param int
     *
     * @return mixed
     */
    public function recent(int $limit)
    {
        return SoapRoom::orderByDesc('id')->limit($limit)->get();
    }

    /**
     * Get's today's max and min temps.
     *
     * @return mixed
     */
    public function getStatToday()
    {
        $today = 'date(created_at) = current_date()';

        $max_temp = SoapRoom::orderByDesc('temp')
            ->whereRaw($today)
            ->selectRaw("'MAX TEMP' as type, temp, created_at")
            ->limit(1);
        $max_humidity = SoapRoom::orderByDesc('humidity')
            ->whereRaw($today)
            ->selectRaw("'MAX HUMIDITY' as type, humidity, created_at")
            ->limit(1);
        $min_temp = SoapRoom::orderBy('temp')
            ->whereRaw($today)
            ->selectRaw("'MIN TEMP' as type, temp, created_at")
            ->limit(1);
        $min_humidity = SoapRoom::orderBy('humidity')
            ->whereRaw($today)
            ->selectRaw("'MIN HUMIDITY' as type, humidity, created_at")
            ->limit(1);

        return $max_temp
            ->union($max_humidity)
            ->union($min_temp)
            ->union($min_humidity)
            ->get();
    }
}
