<?php

namespace App\Http\Controllers\UrunKategorileri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function index()
    {
        return view('product-categories.index', ["categories" => DB::table('ProductCategory')->get()]);
    }

    public function add(Request $request)
    {
        $request->validate([
            "Name" => "required|unique:ProductCategory,Name",
        ],[
            "Name.required" => "Kategori adı boş bırakılamaz.",
            "Name.unique" => "Bu kategori adı daha önce kullanılmış.",
        ]);
        $last_item = DB::table('ProductCategory')->latest("ServerProductCategoryID")->first();
        if ($last_item){
            $result = DB::table('ProductCategory')->insert([
                "ServerProductCategoryID" => $last_item->ServerProductCategoryID + 1,
                "Name" => $request->Name,
                "Description" => $request->Description,
            ]);
        }else {
            $result = DB::table('ProductCategory')->insert([
                "ServerProductCategoryID" => 10000,
                "Name" => $request->Name,
                "Description" => $request->Description,
            ]);
        }
        if ($result) {
            return response()->json(["status" => "success", "message" => "Ürün kategorisi başarıyla eklendi."],201);
        } else {
            return response()->json(["status" => "error", "message" => "Ürün kategorisi eklenirken bir hata oluştu."],401);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            "ServerProductCategoryID" => "required",
            "Name" => "required",
        ]);
        $result = DB::table('ProductCategory')->where("ServerProductCategoryID", $request->ServerProductCategoryID)->update([
            "Name" => $request->Name,
            "Description" => $request->Description,
        ]);
        if ($result) {
            return response()->json(["status" => "success", "message" => "Ürün kategorisi başarıyla güncellendi."],201);
        } else {
            return response()->json(["status" => "error", "message" => "Ürün kategorisi güncellenirken bir hata oluştu."],401);
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            "ServerProductCategoryID" => "required",
        ]);
        if (DB::table('Product')->where("ServerProductCategoryID", $request->ServerProductCategoryID)->count() > 0) {
            return response()->json(["status" => "error", "message" => "Bu kategoriye ait ürünler bulunmaktadır. Bu kategoriyi silemezsiniz."],401);
        }
        $result = DB::table('ProductCategory')->where("ServerProductCategoryID", $request->ServerProductCategoryID)->delete();
        if ($result) {
            return response()->json(["status" => "success", "message" => "Ürün kategorisi başarıyla silindi."],201);
        } else {
            return response()->json(["status" => "error", "message" => "Ürün kategorisi silinirken bir hata oluştu."],401);
        }
    }
}
