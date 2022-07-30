<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['id', 'name', 'price', 'description_short', 'status'];

    public function loadListWithPager($params = []){
        $query = DB::table($this->table)
        ->select(($this->fillable));
        return $query->paginate(10);
    }

    public function saveAdd($params){
        $data = array_merge($params['cols']);

        $res = DB::table($this->table)->insertGetId($data);
        return $res;
    }

    public function loadOne($id, $params = null) {
        $query = DB::table($this->table)
        ->where('id', '=', $id);
        return $query->first();
    }

    public function saveUpdate($params){
        if(empty($params['cols']['id'])){
            Session::flash("error", "Không xác định bản ghi cập nhật");
            return null;
        }
        $dataUpdate = [];
        foreach ($params['cols'] as $colName => $val) {
            if($colName == 'id') continue;
            if(in_array($colName, $this->fillable)){
                $dataUpdate[$colName] = (strlen($val) == 0) ? null : $val;
            }
        }
        $res = DB::table($this->table)
            ->where('id', $params['cols']['id'])
            ->update($dataUpdate);
        return $res;
    }
}
