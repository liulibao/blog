<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/2/25
 * Time: 21:42
 */

namespace App\Repositories\Count;


use App\Models\DayCount;
use App\Repositories\BaseRepository;

class DayCountRepository extends BaseRepository
{

    /**
     * 定义model 类名
     * @return mixed
     */
    public function model()
    {
        return DayCount::class;
    }


}