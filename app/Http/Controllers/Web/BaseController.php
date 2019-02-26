<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/2/22
 * Time: 20:30
 */

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Services\Web\ArticleService;
use App\Services\Web\SystemCountService;

class BaseController extends Controller
{
    public function __construct()
    {
        $articleService = new ArticleService();
        $systemCountService = new SystemCountService();
        $systemCountService->saveDayUserVisitInfo();//统计用户访问信息
        $systemCountService->saveData(getCurrentIp());//统计用户访问
        $day_count = $systemCountService->dayVisitUserCount();//统计每天用户访问次数
        $system_count = $systemCountService->saveSystemVisitNumToCache();//统计系统每天的访问量
        //最新文章
        $last_article = $articleService->getWebLastList();
        //最新推文
        $recommend_article = $articleService->getWebLastList(true);
        view()->share('day_count', $day_count);
        view()->share('system_count', $system_count);
        view()->share('last_article', $last_article);
        view()->share('recommend_article', $recommend_article);
    }


}