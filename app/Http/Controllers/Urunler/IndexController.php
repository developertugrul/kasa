<?php

namespace App\Http\Controllers\Urunler;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function index()
    {
        return view('products.index', ["products" => DB::table('Product')->get(), "categories" => DB::table('ProductCategory')->get(),"vendors" => DB::table("Vendor")->get()]);
    }

    public function add(Request $request)
    {
        $request->validate([
            "ServerVendorID" => "required",
            "ServerProductCategoryID" => "required",
            "Name" => "required",
            "PartNumber" => "required",
        ]);
        $last_item = DB::table('Product')->latest("ServerProductID")->first();
        if ($last_item){
            $result = DB::table('Product')->insert([
                "ServerProductID" => $last_item->ServerProductID + 1,
                "ServerVendorID" => $request->ServerVendorID,
                "ServerProductCategoryID" => $request->ServerProductCategoryID,
                "Name" => $request->Name,
                "PartNumber" => $request->PartNumber,
                "Description" => $request->Description,
                "UnitOfIssue" => "EA",
            ]);
        }else {
            $result = DB::table('Product')->insert([
                "ServerProductID" => 10000,
                "ServerVendorID" => $request->ServerVendorID,
                "ServerProductCategoryID" => $request->ServerProductCategoryID,
                "Name" => $request->Name,
                "PartNumber" => $request->PartNumber,
                "Description" => $request->Description,
                "UnitOfIssue" => "EA",
            ]);
        }
        if ($result) {
            return response()->json(["status" => "success", "message" => "Ürün başarıyla eklendi."],201);
        } else {
            return response()->json(["status" => "error", "message" => "Ürün eklenirken bir hata oluştu."],401);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            "ServerProductID" => "required",
            "ServerVendorID" => "required",
            "ServerProductCategoryID" => "required",
            "Name" => "required",
        ]);
        $result = DB::table('Product')->where("ServerProductID", $request->ServerProductID)->update([
            "ServerVendorID" => $request->ServerVendorID,
            "ServerProductCategoryID" => $request->ServerProductCategoryID,
            "Name" => $request->Name,
            "PartNumber" => $request->PartNumber,
            "Description" => $request->Description,
        ]);
        if ($result) {
            return response()->json(["status" => "success", "message" => "Ürün başarıyla güncellendi."],201);
        } else {
            return response()->json(["status" => "error", "message" => "Ürün güncellenirken bir hata oluştu."],401);
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            "ServerProductID" => "required",
        ]);
        $result = DB::table('Product')->where("ServerProductID", $request->ServerProductID)->delete();
        if ($result) {
            return response()->json(["status" => "success", "message" => "Ürün başarıyla silindi."],201);
        } else {
            return response()->json(["status" => "error", "message" => "Ürün silinirken bir hata oluştu."],401);
        }
    }
}
