<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/2/25
 * Time: 21:33
 */

namespace App\Repositories\Count;


use App\Models\SystemCount;
use App\Repositories\BaseRepository;

class SystemCountRepository extends BaseRepository
{

    /**
     * 定义model 类名
     * @return mixed
     */
    public function model()
    {
        return SystemCount::class;
    }


}