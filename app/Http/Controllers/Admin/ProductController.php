<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->v=[];
    }

    public function index() {
        $objProduct = new Product();
        $this->v['title'] = 'Người Dùng';
        $this->v['list'] = $objProduct->loadListWithPager();
        return view("Admin.Product.index", $this->v);
    }

    public function add(ProductRequest $request){
        $this->v['title'] = "Thêm Sinh Viên";
        $method_route = 'route_Backend_Sinhvien_Add';
        if($request->isMethod('post')){
            $params = [];
            $params['cols'] = $request->post();
            unset($params['cols']['_token']);
            $modelsProduct = new Product();
            $res = $modelsProduct->saveAdd($params);
            if($res == null) {
                return redirect()->route($method_route);
            } else if ($res > 0) {
                Session::flash('success', "Thêm Mới Thành Công !");
                return redirect('/admin/product');
            } else {
                Session::flash('error', "Lỗi Thêm Mới Không Thành Công !");
                return redirect()->route($method_route);
            }
        }
        return view("Admin.Product.add", $this->v);
    }

    public function edit($id) {
        $this->v['title'] = "Chi tiết người dùng";
        $modelsProduct = new Product();
        $sinhvien = $modelsProduct->loadOne($id);
        $this->v['request'] = $sinhvien;
        return view('Admin.Product.edit', $this->v);
    }

    public function update($id, Request $request) {
        $method_route = "route_Backend_Products_Update";
        $params = [];
        $params['cols'] = $request->post();
        unset($params['cols']['_token']);
        $modelsProduct = new Product();
        $params['cols']['id'] = $id;
        $res = $modelsProduct->saveUpdate($params);
        if($res == null){
            return redirect()->route($method_route, ['id'=>$id]);
        } elseif ($res > 0){
            Session::flash('success', "Cập nhật bản ghi $id thành công !");
            return redirect('/sinhvien');
        } else {
            Session::flash('error', "Lỗi nhập bản ghi $id !");
            return redirect()->route($method_route, ['id'=>$id]);
        }
    }
}
