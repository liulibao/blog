<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/3/12
 * Time: 20:54
 */

namespace App\Http\Controllers\Web\Diary;


use App\Http\Controllers\Web\BaseController;
use App\Repositories\Diary\DiaryRepository;

class DiaryController extends BaseController
{
    protected $diaryRepository;

    public function __construct(DiaryRepository $diaryRepository)
    {
        parent::__construct();
        $this->diaryRepository = $diaryRepository;
    }

    public function index()
    {
        $map = array(
            'deleted_at' => 0
        );
        $list = $this->diaryRepository->findWhere($map)->toArray();

        return view('web.diary.index', compact('list'));
    }
}