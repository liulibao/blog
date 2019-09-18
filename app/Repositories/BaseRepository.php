<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/11/6
 * Time: 9:58
 */

namespace App\Repositories;


use App\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application as App;
use Illuminate\Support\Facades\Log;


abstract class BaseRepository
{
    /**
     * @var App
     */
    private $app;

    /**
     * @var
     */
    protected $model;

    /**
     * @var
     */
    protected $newModel;

    /**
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * 定义model 类名
     * @return mixed
     */
    public abstract function model();

    /**
     * 获取所有数据
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        return $this->model->get($columns);
    }


    /**
     * 获取model中的关联关系
     * @param array $relations
     * @return $this
     */
    public function with(array $relations)
    {
        return $this->model->with($relations);
    }

    /**
     * @param  string $value
     * @param  string $key
     * @return array
     */
    public function lists($value, $key = null)
    {
        $lists = $this->model->lists($value, $key);
        if (is_array($lists)) {
            return $lists;
        }
        return $lists->all();
    }

    /**
     * 分页
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*'))
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * 保存没有大量分配的模型
     * save a model without massive assignment
     *
     * @param array $data
     * @return bool
     */
    public function saveModel(array $data)
    {
        foreach ($data as $k => $v) {
            $this->model->$k = $v;
        }
        return $this->model->save();
    }


    /**
     * 单条数据的保存
     * @param array $data
     * @param string $cache_key
     * @param bool $is_del_cache
     * @return mixed
     * @throws RepositoryException
     */
    public function create(array $data, $cache_key = '',$is_del_cache = false)
    {
        if(count($data, 1) !== count($data))
            throw new RepositoryException('create method is support single insertion only');

        if($cache_key && !$is_del_cache) {
            throw new RepositoryException('设置第二个参数同时第三个参数应设为true');
        }

        if($cache_key && $is_del_cache) {
            delCache($cache_key);
        }

        return $this->model->create($data);
    }

    /**
     * 更新
     * @param array $data
     * @param $condition
     * @param string $cache_key 缓存key
     * @param bool $is_del_cache
     * @return mixed
     * @throws RepositoryException
     */
    public function update(array $data, $condition, $cache_key = '',$is_del_cache = false)
    {
        if(empty($data)){
            throw new RepositoryException('修改内容不可为空');
        }

        if(isset($data['_token'])){
            unset($data['_token']);
        }

        if($cache_key && !$is_del_cache) {
            throw new RepositoryException('设置第三个参数同时第四个参数应设为true');
        }

        if($cache_key && $is_del_cache) {
            delCache($cache_key);
        }

        if(is_array($condition)){
            $map = $condition;
        } else {
            $map = array('id' => $condition);
        }

        return $this->model->where($map)->update($data);
    }


    /**
     * 根据id删除
     * @param $id
     * @param bool $isSoftDelete
     * @param string $cache_key
     * @param bool $is_del_cache
     * @return mixed
     * @throws RepositoryException
     */
    public function delete($id, $isSoftDelete = false, $cache_key = '',$is_del_cache = false)
    {
        if($isSoftDelete){
            $data = array(
                'deleted_at' => time()
            );

            if($cache_key && !$is_del_cache) {
                throw new RepositoryException('设置第三个参数同时第四个参数应设为true');
            }

            if($cache_key && $is_del_cache) {
                delCache($cache_key);
            }

            return $this->model->where('id', $id)->update($data);
        } else {
            return $this->model->destroy($id);
        }
    }


    /**
     * 更新id 获取数据
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        return $this->model->find($id, $columns);
    }

    /**
     * 根据字段 获取单条数据
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*'))
    {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    /**
     * 根据字段 获取所有数据
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findAllBy($attribute, $value, $columns = array('*'))
    {
        return $this->model->where($attribute, '=', $value)->get($columns);
    }

    /**
     * 根据条件 获取所有数据中的某些字段
     * @param array $where
     * @param array $columns
     * @param bool $or
     *
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function findWhere($where, $columns = ['*'], $or = false)
    {

        $model = $this->model;

        foreach ($where as $field => $value) {
            if ($value instanceof \Closure) {
                $model = (!$or)
                    ? $model->where($value)
                    : $model->orWhere($value);
            } elseif (is_array($value)) {
                if (count($value) === 3) {
                    list($field, $operator, $search) = $value;
                    $model = (!$or)
                        ? $model->where($field, $operator, $search)
                        : $model->orWhere($field, $operator, $search);
                } elseif (count($value) === 2) {
                    list($field, $search) = $value;
                    $model = (!$or)
                        ? $model->where($field, '=', $search)
                        : $model->orWhere($field, '=', $search);
                }
            } else {
                $model = (!$or)
                    ? $model->where($field, '=', $value)
                    : $model->orWhere($field, '=', $value);
            }
        }

        return $model->orderBy('id', 'desc')->get($columns);
    }


    /**
     * 创建Model
     * @return Model
     */
    public function makeModel()
    {
        return $this->setModel($this->model());
    }

    /**
     * 实例化Model
     * @param $eloquentModel
     * @return Model
     * @throws RepositoryException
     */
    public function setModel($eloquentModel)
    {
        $this->newModel = $this->app->make($eloquentModel);

        if (!$this->newModel instanceof Model)
            throw new RepositoryException("Class {$this->newModel} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $this->newModel;
    }

}