<?php

namespace App\Repositories;

interface TempRepository
{
    /**
     * Get's temps by limit
     *
     * @param int
     *
     * @return mixed
     */
    public function recent(int $limit);

    /**
     * Get's today's max and min temps.
     *
     * @return mixed
     */
    public function getStatToday();
}
