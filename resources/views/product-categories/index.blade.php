@extends("template.index")
@section("head")
    <title>Ürün Kategorileri</title>
@endsection
@section("footer")
    <script>
        $("form#productForm").submit(function (e) {
            e.preventDefault();
            let formData = new FormData();
            formData.append("Name", $("#Name").val());
            formData.append("Description", $("#Description").val());
            $.ajax({
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                enctype: 'multipart/form-data',
                url: '{{route("product-categories.add")}}',
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
                            window.location.href = "{{route("product-categories.index")}}";
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
        $("form#productUpdateForm").submit(function (e) {
            e.preventDefault();
            let formData = new FormData();
            let form = $(this);
            formData.append("Name", form.find("[name='Name']").val());
            formData.append("Description", form.find("[name='Description']").val());
            formData.append("ServerProductCategoryID", form.find("[name='ServerProductCategoryID']").val());

            console.log(formData);
        });
        const updateCategory = (id) => {
            let formData = new FormData();
            formData.append("Name", $("#Name" + id).val());
            formData.append("ServerProductCategoryID", $("#ServerProductCategoryID" + id).val());
            formData.append("Description", $("#Description" + id).val());
            $.ajax({
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                enctype: 'multipart/form-data',
                url: '{{route("product-categories.update")}}',
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
                            window.location.href = "{{route("product-categories.index")}}";
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

        const deleteCategory = (id) => {
            Swal.fire({
                title: "Emin misiniz?",
                text: "Bu kategoriyi silmek istediğinize emin misiniz?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Evet, sil!",
                cancelButtonText: "Hayır, iptal et!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: '{{route("product-categories.delete")}}',
                        data: {
                            ServerProductCategoryID: id
                        },
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
                                    window.location.href = "{{route("product-categories.index")}}";
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
    </script>
@endsection
@section("content")
    <h1 class="mt-4">Anasayfa</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="{{route("home")}}">Anasayfa</a></li>
        <li class="breadcrumb-item">Ürün kategorileri</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-book-bookmark me-1"></i>
            Ürün Kategorisi ekle
        </div>
        <div class="card-body">
            <form id="productForm"
                  enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Name">Kategori adı</label>
                            <input type="text" name="Name" required id="Name" class="form-control"
                                   placeholder="Kategori adı">
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
            Ürün Kategorileri
        </div>
        <div class="card-body">
            <table class="display" id="urun-listesi">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tedarikçi</th>
                    <th>Açıklama</th>
                    <th>İşlem</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $item)
                    <tr>
                        <td>{{$item->ServerProductCategoryID}}</td>
                        <td>{{$item->Name}}</td>
                        <td>{{$item->Description}}</td>
                        <td>
                            <button type="button" data-bs-toggle="modal"
                                    data-bs-target="#updateCategory{{$item->ServerProductCategoryID}}"
                                    class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                            <!-- Modal -->
                            <div class="modal fade" id="updateCategory{{$item->ServerProductCategoryID}}" tabindex="-1"
                                 aria-labelledby="updateCategory{{$item->ServerProductCategoryID}}Label"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="updateCategory{{$item->ServerProductCategoryID}}Label">
                                                "{{$item->Name}}" güncelle</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <form enctype="multipart/form-data" id="updateCategoryForm{{$item->ServerProductCategoryID}}">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="hidden" name="ServerProductCategoryID" id="ServerProductCategoryID{{$item->ServerProductCategoryID}}"
                                                               value="{{$item->ServerProductCategoryID}}">
                                                        <div class="form-group">
                                                            <label for="Name">Kategori adı</label>
                                                            <input type="text" name="Name" required id="Name{{$item->ServerProductCategoryID}}"
                                                                   class="form-control"
                                                                   placeholder="Kategori adı" value="{{$item->Name}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="Description">Açıklama</label>
                                                            <textarea name="Description" id="Description{{$item->ServerProductCategoryID}}"
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
                                                <button type="button" onclick="updateCategory('{{$item->ServerProductCategoryID}}')" class="btn btn-primary btn-sm">Güncelle</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <button type="button" onclick="deleteCategory('{{$item->ServerProductCategoryID}}')"
                                    class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
