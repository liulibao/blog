<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/2/25
 * Time: 21:55
 */

namespace App\Services\Web;


use App\Models\DayCount;
use App\Models\SystemCount;
use App\Models\UserVisit;
use Illuminate\Support\Facades\Cache;

class SystemCountService
{
    /**
     * @var SystemCount
     */
    protected $systemCountModel;

    /**
     * @var DayCount
     */
    protected $dayCountModel;

    /**
     * ip缓存的一天时间
     * @var int
     */
    protected $day_cache_time;

    /**
     * ip缓存的key
     * @var
     */
    protected $ip_cache_day_key;

    /**
     * 缓存每日的访问量
     * @var string
     */
    protected $cache_system_visit_num;

    /**
     * 用户每日访问量
     * @var string
     */
    protected $user_day_visit_num;

    /**
     * 获取当前时间
     * @var int
     */
    protected $current_time;

    public function __construct()
    {
        $this->current_time = time();
        $this->day_cache_time = 86400;
        $this->dayCountModel = new DayCount();
        $this->systemCountModel = new SystemCount();
        $this->cache_system_visit_num = 'cache_system_visit_num_' . date('Y_d_m');
        $this->user_day_visit_num = 'user_day_visit_num_' . date('Y_d_m') . '_' . getCurrentIp();
    }

    //今日访客量
    public function dayVisitUserCount()
    {
        return $this->dayCountModel->where('created_at', '>=', date('Y-m-d'))->count();
    }


    /**
     * 保存数据
     * @param $ip
     */
    public function saveData($ip)
    {
        if (!$this->isExists($ip)) {
            $data = array(
                'visit_ip' => $ip
            );
            $this->dayCountModel->insert($data);
        } else {
            $this->saveDayVisitNumToCache($ip);
        }
    }

    /**
     * 判断ip今天是否已经访问过
     * @param $ip
     * @return mixed
     */
    protected function isExists($ip)
    {
        $this->ip_cache_day_key = 'ip_cache_day_key_' . date('y_m_d') . '_' . $ip;

        $isHas = getCache($this->ip_cache_day_key);

        if ($isHas === null || $isHas == 0) {
            $isHas = $this->dayCountModel->where('visit_ip', $ip)
                ->where('created_at', '>=', date('Y-m-d'))->count();

            setCache($this->ip_cache_day_key, $isHas, $this->day_cache_time);
        }

        return $isHas;
    }

    /**
     * 获取系统累计的访问量
     * @return int|mixed
     */
    public function saveSystemVisitNumToCache()
    {
//        $num = 0;
//        $visitNum = getCache($this->cache_system_visit_num);
//        var_dump($visitNum);
//        if ($visitNum === null) {
//            $visitNum = 0;
//        }
//
//        $num += $visitNum;
            $visit_num = $this->systemCountModel->where('id', 1)->value('visit_num');

//        if ($visitNum > 20) { //累计20次统计一次数据库
            $this->systemCountModel->where('id', 1)->increment('visit_num');
//        }

//        setCache($this->cache_system_visit_num, $num, $this->day_cache_time);
//        var_dump($num);

        return $visit_num;
    }

    /**
     * 获取当天的访问量
     * @param string $visit_ip
     */
    public function saveDayVisitNumToCache($visit_ip = '')
    {
//        $visitNum = getCache($this->user_day_visit_num);
//        $visitNum++;

//        if ($visitNum > 20) { //累计20次统计一次数据库
            $this->dayCountModel->where('visit_ip', $visit_ip)->increment('visit_num');
//        }

//        setCache($this->user_day_visit_num, $visitNum, $this->day_cache_time);
    }

    /**
     * 统计用户访问信息
     */
    public function saveDayUserVisitInfo()
    {
        $userVisitModel = new UserVisit();
        $map = array(
            'visit_ip' => getCurrentIp(),
            'visit_url' => getCurrentFullRoute(),
        );

        $num = $userVisitModel->where($map)->count();
        if($num) {

            $userVisitModel->where($map)->increment('visit_num');

        } else {
            $data = array(
                'uid' => 0,
                'visit_ip' => getCurrentIp(),
                'visit_url' => getCurrentFullRoute(),
                'is_member' => 0
            );
            $userVisitModel->insert($data);
        }

    }
}