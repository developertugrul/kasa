@extends("template.index")
@section("head")
    <title>Dashboard</title>
@endsection
@section("footer")

@endsection
@section("content")
    <h1 class="mt-4">Anasayfa</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Anasayfa</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Ürünler
        </div>
        <div class="card-body">
            <table class="display" id="urun-listesi">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tedarikçi</th>
                    <th>Kategori</th>
                    <th>Ürün Adı</th>
                    <th>PartNumber</th>
                    <th>İşlem</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $item)
                    <tr>
                        <td>{{$item->ServerProductID}}</td>
                        <td>{{$item->ServerVendorID}}</td>
                        <td>{{$item->ServerProductCategoryID}}</td>
                        <td>{{$item->Name}}</td>
                        <td>{{$item->PartNumber}}</td>
                        <td>
                            <a href="" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tedarikçiler
        </div>
        <div class="card-body">
            <table class="display" id="tedarikci-listesi">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tedarikçi Adı</th>
                    <th>İşlem</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Tedarikçi Adı</th>
                    <th>İşlem</th>
                </tr>
                </tfoot>
                <tbody>
                @foreach($vendors as $item)
                    <tr>
                        <td>{{$item->ServerVendorID}}</td>
                        <td>{{$item->Name}}</td>
                        <td>
                            <a href="" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
