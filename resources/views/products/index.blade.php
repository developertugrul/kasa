@extends("template.index")
@section("head")
    <title>Ürünler</title>
@endsection
@section("footer")
    <script>
        $("form#productForm").submit(function (e) {
            e.preventDefault();
            let formData = new FormData();
            formData.append("ServerVendorID", $("#ServerVendorID").val());
            formData.append("ServerProductCategoryID", $("#ServerProductCategoryID").val());
            formData.append("Name", $("#Name").val());
            formData.append("PartNumber", $("#PartNumber").val());
            formData.append("Description", $("#Description").val());
            $.ajax({
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                enctype: 'multipart/form-data',
                url: "{{route("products.add")}}",
                headers: {
                    "X-CSRF-TOKEN": "{{csrf_token()}}",
                    "Accept": "application/json"
                },
                success: function (response) {
                    console.log(response);
                    Swal.fire({
                        title: "Başarılı",
                        text: response.message,
                        icon: "success",
                        confirmButtonText: "Tamam"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{route("products.index")}}";
                        }
                    });
                },
                error: function (response) {
                    console.log(response);
                    Swal.fire({
                        title: "Hata",
                        text: response.responseJSON.message,
                        icon: "error",
                        confirmButtonText: "Tamam"
                    });
                }
            });
        });

        const deleteProduct = (id) => {
            Swal.fire({
                title: "Emin misiniz?",
                text: "Bu işlem geri alınamaz!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Evet",
                cancelButtonText: "Hayır"
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData();
                    formData.append("ServerProductID", id);
                    $.ajax({
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: 'multipart/form-data',
                        url: "{{route("products.delete")}}",
                        headers: {
                            "X-CSRF-TOKEN": "{{csrf_token()}}",
                            "Accept": "application/json"
                        },
                        success: function (response) {
                            console.log(response);
                            Swal.fire({
                                title: "Başarılı",
                                text: response.message,
                                icon: "success",
                                confirmButtonText: "Tamam"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{route("products.index")}}";
                                }
                            });
                        },
                        error: function (response) {
                            console.log(response);
                            Swal.fire({
                                title: "Hata",
                                text: response.responseJSON.message,
                                icon: "error",
                                confirmButtonText: "Tamam"
                            });
                        }
                    });
                }
            });
        };

        const updateProduct = (id) => {
            let formData = new FormData();
            formData.append("ServerProductID", id);
            formData.append("ServerVendorID", $("#ServerVendorID" + id).val());
            formData.append("ServerProductCategoryID", $("#ServerProductCategoryID" + id).val());
            formData.append("Name", $("#Name" + id).val());
            formData.append("PartNumber", $("#PartNumber" + id).val());
            formData.append("Description", $("#Description" + id).val());
            $.ajax({
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                enctype: 'multipart/form-data',
                url: "{{route("products.update")}}",
                headers: {
                    "X-CSRF-TOKEN": "{{csrf_token()}}",
                    "Accept": "application/json"
                },
                success: function (response) {
                    console.log(response);
                    Swal.fire({
                        title: "Başarılı",
                        text: response.message,
                        icon: "success",
                        confirmButtonText: "Tamam"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{route("products.index")}}";
                        }
                    });
                },
                error: function (response) {
                    console.log(response);
                    Swal.fire({
                        title: "Hata",
                        text: response.responseJSON.message,
                        icon: "error",
                        confirmButtonText: "Tamam"
                    });
                }
            });
        };
    </script>
@endsection
@section("content")
    <h1 class="mt-4">Anasayfa</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Anasayfa</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-book-bookmark me-1"></i>
            Ürün ekle
        </div>
        <div class="card-body">
            <form id="productForm" action="{{route("products.add")}}" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="ServerVendorID">Ürün tedarikçisi</label>
                            <select name="ServerVendorID" required id="ServerVendorID" class="form-control">
                                <option value="">Seçiniz</option>
                                @foreach($vendors as $vendor)
                                    <option value="{{$vendor->ServerVendorID}}">{{$vendor->Name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="ServerProductCategoryID">Ürün kategorisi</label>
                            <select name="ServerProductCategoryID" required id="ServerProductCategoryID"
                                    class="form-control">
                                <option value="">Seçiniz</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->ServerProductCategoryID}}">{{$category->Name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Name">Ürün adı</label>
                            <input type="text" name="Name" required id="Name" class="form-control"
                                   placeholder="Ürün adı">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="PartNumber">Part numarası</label>
                            <input type="text" name="PartNumber" required id="PartNumber" class="form-control"
                                   placeholder="Part numarası">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Description">Açıklama</label>
                            <textarea name="Description" id="Description" class="form-control"
                                      placeholder="Açıklama"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 pt-3">
                        <button class="btn btn-success btn-sm" type="submit">Kaydet</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
                    <th>Ürün Adı</th>
                    <th>Tedarikçi</th>
                    <th>Kategori</th>
                    <th>PartNumber</th>
                    <th>İşlem</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $item)
                    @php
                        $vendor_identity = "";
                        foreach ($vendors as $vendor){
                            if ($vendor->ServerVendorID == $item->ServerVendorID){
                                $vendor_identity = $vendor->Name;
                            }
                        } @endphp
                    <tr>
                        <td>{{$item->ServerProductID}}</td>
                        <td>{{$item->Name}}</td>
                        <td>{{$vendor_identity}}</td>
                        <td>
                            @php $category_list = []; @endphp
                            @foreach($categories as $category)
                                @php $category_list[] = $category->ServerProductCategoryID; @endphp
                                @if($category->ServerProductCategoryID == $item->ServerProductCategoryID)
                                    {{$category->Name}}
                                @endif
                            @endforeach
                            @if(!in_array($item->ServerProductCategoryID, $category_list))
                                <span class="small">Kategori bulunamadı</span>
                            @endif
                        </td>
                        <td>{{$item->PartNumber}}</td>
                        <td>
                            <button type="button" data-bs-toggle="modal"
                                    data-bs-target="#updateProduct{{$item->ServerProductID}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                            <div class="modal fade" id="updateProduct{{$item->ServerProductID}}" tabindex="-1"
                                 aria-labelledby="updateProduct{{$item->ServerProductID}}Label"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="updateProduct{{$item->ServerProductID}}Label">
                                                "{{$item->Name}}" güncelle</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <form enctype="multipart/form-data" id="updateProductForm{{$item->ServerProductID}}">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="ServerVendorID">Ürün tedarikçisi</label>
                                                            <select name="ServerVendorID" required id="ServerVendorID{{$item->ServerProductID}}"
                                                                    class="form-control">
                                                                <option value="">Seçiniz</option>
                                                                @foreach($vendors as $vendor)
                                                                    <option value="{{$vendor->ServerVendorID}}"
                                                                            @if($vendor->ServerVendorID == $item->ServerVendorID) selected @endif>{{$vendor->Name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="ServerProductCategoryID">Ürün kategorisi</label>
                                                            <select name="ServerProductCategoryID" required
                                                                    id="ServerProductCategoryID{{$item->ServerProductID}}"
                                                                    class="form-control">
                                                                <option value="">Seçiniz</option>
                                                                @foreach($categories as $category)
                                                                    <option value="{{$category->ServerProductCategoryID}}"
                                                                            @if($category->ServerProductCategoryID == $item->ServerProductCategoryID) selected @endif>{{$category->Name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="hidden" name="ServerProductID" id="ServerProductID{{$item->ServerProductID}}"
                                                               value="{{$item->ServerProductID}}">
                                                        <div class="form-group">
                                                            <label for="Name{{$item->Name}}">Ürün adı</label>
                                                            <input type="text" name="Name" required id="Name{{$item->ServerProductID}}"
                                                                   class="form-control"
                                                                   placeholder="Ürün adı" value="{{$item->Name}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="PartNumber{{$item->PartNumber}}">Part No</label>
                                                            <input type="text" name="PartNumber" required id="PartNumber{{$item->ServerProductID}}"
                                                                   class="form-control"
                                                                   placeholder="Part No" value="{{$item->PartNumber}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="Description">Açıklama</label>
                                                            <textarea name="Description" id="Description{{$item->ServerProductID}}"
                                                                      class="form-control"
                                                                      placeholder="Açıklama">{{$item->Description}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-dismiss="modal">Kapat
                                                </button>
                                                <button type="button" onclick="updateProduct('{{$item->ServerProductID}}')" class="btn btn-primary btn-sm">Güncelle</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <button onclick="deleteProduct('{{$item->ServerProductID}}')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
