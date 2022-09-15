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
            formData.append("Name", $("#Name").val());
            $.ajax({
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                enctype: 'multipart/form-data',
                url: "{{route("vendors.add")}}",
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
                            window.location.href = "{{route("vendors.index")}}";
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
        const deleteVendor = (id) => {
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
                    formData.append("ServerVendorID", id);
                    $.ajax({
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: 'multipart/form-data',
                        url: "{{route("vendors.delete")}}",
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
                                    window.location.href = "{{route("vendors.index")}}";
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

        const updateVendor = (id) => {
            let formData = new FormData();
            formData.append("ServerVendorID", id);
            formData.append("Name", $("#Name"+id).val());
            $.ajax({
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                enctype: 'multipart/form-data',
                url: "{{route("vendors.update")}}",
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
                            window.location.href = "{{route("vendors.index")}}";
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
            Tedarikçi ekle
        </div>
        <div class="card-body">
            <form id="productForm" action="{{route("vendors.add")}}" method="post" enctype="multipart/form-data">
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Name">Tedarikçi adı</label>
                            <input type="text" name="Name" id="Name" class="form-control" placeholder="Tedarikçi adı">
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
            Tedarikçiler
        </div>
        <div class="card-body">
            <table class="display" id="urun-listesi">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Ad</th>
                    <th>İşlem</th>
                </tr>
                </thead>
                <tbody>
                @foreach($vendors as $vendor)
                    <tr>
                        <td>{{$vendor->ServerVendorID}}</td>
                        <td>{{$vendor->Name}}</td>
                        <td>
                            <button type="button" data-bs-toggle="modal"
                                    data-bs-target="#updateProduct{{$vendor->ServerVendorID}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                            <div class="modal fade" id="updateProduct{{$vendor->ServerVendorID}}" tabindex="-1"
                                 aria-labelledby="updateProduct{{$vendor->ServerVendorID}}Label"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="updateProduct{{$vendor->ServerVendorID}}Label">
                                                "{{$vendor->Name}}" güncelle</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <form enctype="multipart/form-data" id="updateProductForm{{$vendor->ServerVendorID}}">
                                            <div class="modal-body">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <input type="hidden" name="ServerProductID" id="ServerProductID{{$vendor->ServerVendorID}}"
                                                               value="{{$vendor->ServerVendorID}}">
                                                        <div class="form-group">
                                                            <label for="Name{{$vendor->Name}}">Tedarikçi adı</label>
                                                            <input type="text" name="Name" required id="Name{{$vendor->ServerVendorID}}"
                                                                   class="form-control"
                                                                   placeholder="Tedarikçi adı" value="{{$vendor->Name}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-dismiss="modal">Kapat
                                                </button>
                                                <button type="button" onclick="updateVendor('{{$vendor->ServerVendorID}}')" class="btn btn-primary btn-sm">Güncelle</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <button onclick="deleteVendor('{{$vendor->ServerVendorID}}')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
