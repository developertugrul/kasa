<?php

namespace App\Http\Controllers\Tedarikciler;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function index()
    {
        return view('vendors.index', ["vendors" => DB::table('Vendor')->get()]);
    }


    public function add(Request $request)
    {
        $request->validate([
            "Name" => "required|unique:Vendor,Name",
        ],[
            "Name.required" => "Tedarikçi adı boş bırakılamaz.",
            "Name.unique" => "Bu Tedarikçi adı daha önce kullanılmış.",
        ]);
        $last_item = DB::table('Vendor')->latest("ServerVendorID")->first();
        if ($last_item){
            $result = DB::table('Vendor')->insert([
                "ServerVendorID" => $last_item->ServerVendorID + 1,
                "Name" => $request->Name,
            ]);
        }else {
            $result = DB::table('ProductCategory')->insert([
                "ServerVendorID" => 10000,
                "Name" => $request->Name,
            ]);
        }
        if ($result) {
            return response()->json(["status" => "success", "message" => "Tedarikçi başarıyla eklendi."],201);
        } else {
            return response()->json(["status" => "error", "message" => "Ürün Tedarikçisi eklenirken bir hata oluştu."],401);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            "ServerVendorID" => "required",
            "Name" => "required",
        ]);
        $result = DB::table('Vendor')->where("ServerVendorID", $request->ServerVendorID)->update([
            "Name" => $request->Name,
        ]);
        if ($result) {
            return response()->json(["status" => "success", "message" => "Tedarikçi başarıyla güncellendi."],201);
        } else {
            return response()->json(["status" => "error", "message" => "Tedarikçi güncellenirken bir hata oluştu."],401);
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            "ServerVendorID" => "required",
        ]);
        $productCount = DB::table('Product')->where("ServerVendorID", $request->ServerVendorID)->count();
        if ($productCount > 0){
            return response()->json(["status" => "error", "message" => "Bu Tedarikçiye ait ürünler bulunduğu için silinemez."],401);
        }else{
            $result = DB::table('Vendor')->where("ServerVendorID", $request->ServerVendorID)->delete();
            if ($result) {
                return response()->json(["status" => "success", "message" => "Tedarikçi başarıyla silindi."],201);
            } else {
                return response()->json(["status" => "error", "message" => "Tedarikçi silinirken bir hata oluştu."],401);
            }
        }
    }
}
