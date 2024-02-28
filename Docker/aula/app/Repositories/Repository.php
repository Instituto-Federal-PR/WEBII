<?php 

namespace App\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;

class Repository {

    protected $model;

    protected function __construct(object $model) {
        $this->model = $model;
    }

    public function selectAll() {
        return $this->model->all();
    }

    public function selectAllWith(array $orm) {
        return $this->model::with($orm)->get();
    }
   
    public function findById($id) {
        return $this->model->find($id);
    }

    public function findByIdWith(array $orm, $id) {
        return $this->model::with($orm)->find($id);
    }
                    
    public function findByCompositeId($keys, $ids) {
        return $this->model::where($this->createRule($keys, $ids))->first();
    }

    public function findByCompositeIdWith($keys, $ids, $orm) {
        return $this->model::with($orm)->where($this->createRule($keys, $ids))->first();
    }

    public function findDeletedById($id) {
        return $this->model->onlyTrashed()->find($id);
    }

    public function findFirstById($id) {
        return $this->model->find($id)->first();
    }

    public function findByColumn($column, $value) {
        return $this->model->where($column, $value)->get();
    }

    public function findFirstByColumn($column, $value) {
        return $this->model->where($column, $value)->first();
    }

    public function save($obj) {

        try {   
            $obj->save();     
            return true;
        } catch(Exception $e) { dd($e); }
        
        return false;
    }

    public function saveAndReturnId($obj) {

        try {   
            $obj->save();     
            return $obj->id;
        } catch(Exception $e) { dd($e); }

        return -1;
    }

    public function updateCompositeId($keys, $ids, $table, $values) {

        try {        
            DB::table($table)
                ->where($this->createRule($keys, $ids))
                ->update($values);
            return true;
        } catch(Exception $e) { dd($e); }
    
        return false;
    }

    public function delete($id) {

        $obj = $this->findById($id);
        if(isset($obj)) {
            try {        
                $obj->delete();
                return true;
            } catch(Exception $e) { dd($e); }
        }
        return false;
    }

    public function deleteCompositeId($keys, $ids, $table) {

        try {        
            DB::table($table)->where($this->createRule($keys, $ids))->delete();
            return true;
        } catch(Exception $e) { dd($e); }
    
        return false;
    }

    public function restore($id) {

        $obj = $this->findDeletedById($id);        
        if(isset($obj)) {
            try {        
                $obj->restore();
                return true;
            } catch(Exception $e) { dd($e); }
        }
        return false;
    }

    public function createRule($keys, $ids) {
        $arr = array();
        for($pos=0; $pos<count($ids); $pos++) { 
            $arr[$pos] = [ $keys[$pos], (integer) $ids[$pos] ];
        }
        return $arr;
    }
}