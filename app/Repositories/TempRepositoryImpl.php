<?php

namespace App\Repositories;

use App\Model\Temp;

class TempRepositoryImpl implements TempRepository
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
        return Temp::orderByDesc('id')->limit($limit)->get();
    }

    /**
     * Get's today's max and min temps.
     *
     * @return mixed
     */
    public function getStatToday()
    {
        $today = 'date(created_at) = current_date()';

        $max_cpu = Temp::orderByDesc('cpu')
            ->whereRaw($today)
            ->selectRaw("'MAX CPU' as type, cpu, created_at")
            ->limit(1);
        $max_gpu = Temp::orderByDesc('gpu')
            ->whereRaw($today)
            ->selectRaw("'MAX GPU' as type, gpu, created_at")
            ->limit(1);
        $min_cpu = Temp::orderBy('cpu')
            ->whereRaw($today)
            ->selectRaw("'MIN CPU' as type, cpu, created_at")
            ->limit(1);
        $min_gpu = Temp::orderBy('gpu')
            ->whereRaw($today)
            ->selectRaw("'MIN GPU' as type, gpu, created_at")
            ->limit(1);

        return $max_cpu
            ->union($max_gpu)
            ->union($min_cpu)
            ->union($min_gpu)
            ->get();
    }
}
