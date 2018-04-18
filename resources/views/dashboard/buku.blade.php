@extends('master-dashboard')
@section('title', 'BUKU')
@section('style')

@endsection
@section('content-header')

  <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
    <h3 class="content-header-title mb-0 d-inline-block">List Buku</h3>
    <div class="row breadcrumbs-top d-inline-block">
      <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">SMKN 2 Balikpapan</a>
          </li>
          <li class="breadcrumb-item"><a href="#">Perpustakaan</a>
          </li>
          <li class="breadcrumb-item active">List Buku
          </li>
        </ol>
      </div>
    </div>
  </div>
  <div class="content-header-right col-md-6 col-12 mb-2">
    <div class="dropdown float-md-right">
      <button class="btn btn-info round btn-glow px-2" id="tombolTambahBuku" type="button">Tambah Buku</button>
    </div>
  </div>

@endsection
@section('content')

  <!-- MODAL FORM TAMBAH BUKU -->
  <div id="modalFormTambahBuku" style="display: none;">

    <div class="p-1">

      <form action="" method="POST" id="formBuku">

        {{ csrf_field() }}

        <div class="form-group">
          <label for="kodeBuku"><b>Kode Buku</b></label>
          <input type="number" name="kode_buku" class="form-control" id="kodeBuku" placeholder="Masukan kode buku">
        </div>

        <div class="form-group">
          <label for="isbn"><b>ISBN</b></label>
          <input type="number" name="isbn" class="form-control" id="isbn" placeholder="Masukan ISBN">
        </div>

        <div class="form-group">
          <label for="judulBuku"><b>Judul Buku</b></label>
          <input type="text" name="judul_buku" class="form-control" id="judulBuku" placeholder="Masukab judul buku">
        </div>

        <div class="form-group">
          <label for="sinopsis"><b>Sinopsis</b></label>
          <textarea name="sinopsis" class="form-control" id="sinopsis" placeholder="Masukan sinopsis" rows="8" cols="80"></textarea>
        </div>

        <div class="form-group">
          <label for="pengarang"><b>Pengarang</b></label>
          <input type="text" name="pengarang" class="form-control" id="pengarang" placeholder="Masukan pengarang">
        </div>

        <div class="form-group">
          <label for="penerbit"><b>Penerbit</b></label>
          <input type="text" name="penerbit" class="form-control" id="penerbit" placeholder="Masukan penerbit">
        </div>

        <div class="form-control">
          <label for="tahunTerbit"><b>Tahun Terbit</b></label>
          <input type="date" name="tahun_terbit" class="form-control" id="tahunTerbit" placeholder="Pilih tahun terbit">
        </div>

        <div class="mt-2">
          <button type="submit" class="btn btn-info round btn-glow btn-block px-2" id="tombolSubmitBuku"></button>
        </div>

      </form>

    </div>

  </div>
  <!-- END MODAL -->

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Tabel Buku</h4>
          <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
          <div class="heading-elements">
            <ul class="list-inline mb-0">
              <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
              <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
              <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
              <li><a data-action="close"><i class="ft-x"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="card-content collapse show">
          <div class="card-body card-dashboard">
            <p class="card-text">Berikut adalah list dari buku yang ada di perpustakaan.</p>
            <table class="table table-striped table-bordered table-responsive" id="tabelBuku">
              <thead>
                <tr>
                  <th width="10%">Kode Buku</th>
                  <th>Judul Buku</th>
                  <th>Sinopsis</th>
                  <th>Pengarang</th>
                  <th>Penerbit</th>
                  <th>Tahun Terbit</th>
                  <th>ISBN</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($buku as $item)
                  <tr>
                    <td>{{ $item->kode_buku }}</td>
                    <td>{{ $item->judul_buku }}</td>
                    <td>{{ str_limit(strip_tags($item->sinopsis), 20) }}</td>
                    <td>{{ $item->pengarang }}</td>
                    <td>{{ $item->penerbit }}</td>
                    <td>{{ $item->tahun_terbit->format('Y') }}</td>
                    <td>{{ $item->isbn }}</td>
                    <td>
                      <a href="/admin/buku/hapus-buku/{{ $item->id }}" class="btn btn-danger btn-glow btn-sm m-1">
                        <i class="ft-trash-2"></i> <b>HAPUS</b>
                      </a>
                      <a href="#" class="btn btn-info btn-glow btn-sm m-1 tombolEditBuku">
                        <i class="ft-edit-3"></i> <b>EDIT</b>
                        <input type="hidden" value="{{ $item->id }}" class="idBuku">
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th width="10%">Kode Buku</th>
                  <th>Judul Buku</th>
                  <th>Sinopsis</th>
                  <th>Pengarang</th>
                  <th>Penerbit</th>
                  <th>Tahun Terbit</th>
                  <th>ISBN</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('script')

  <script>

    $(".menu-navigasi").removeClass("active");
    $("#listBuku").addClass("active");


    // INIT
    $("#modalFormTambahBuku").iziModal({
      title: "Form Buku",
      subtitle: "Silahkan isi form dibawah ini",
      headerColor: "#1E9FF2",
      zindex: 9999,
      fullscreen: true
    });

    var tabelBuku = $("#tabelBuku").DataTable();
    // END INIT

    $(document).ready(function(){

      $("#pencarian").on("keyup", function(){
        tabelBuku.search(this.value).draw();
      });

      $("#tombolTambahBuku").on("click", function(){
        $("#formBuku").attr("action", "");
        $("#formBuku").attr("action", "/admin/buku/tambah-buku");
        $("#kodeBuku").val('');
        $("#isbn").val('');
        $("#judulBuku").val('');
        $("#pengarang").val('');
        $("#penerbit").val('');
        $("#tahunTerbit").val('');
        $("#tombolSubmitBuku").text("Tambah Buku");

        $("#modalFormTambahBuku").iziModal("open");
        if ($("#sinopsis").hasClass("udahCKE")) {
          CKEDITOR.instances.sinopsis.destroy();
        } else {
          $("#sinopsis").addClass("udahCKE");
        }
        CKEDITOR.replace('sinopsis');
        CKEDITOR.instances.sinopsis.setData('');
      });

      $(".tombolEditBuku").on("click", function(){
        var idBuku = $(this).children(".idBuku").val();
        $.ajax({
          url: "/admin/buku/detail-buku/" + idBuku,
          method: "GET"
        }).done(function(res){
          $("#formBuku").attr("action", "");
          $("#formBuku").attr("action", "/admin/buku/detail-buku/" + idBuku);

          $("#kodeBuku").val(res.kode_buku);
          $("#isbn").val(res.isbn);
          $("#judulBuku").val(res.judul_buku);
          $("#pengarang").val(res.pengarang);
          $("#penerbit").val(res.penerbit);
          $("#tahunTerbit").val(res.tahun_terbit);
          $("#tombolSubmitBuku").text("Edit Buku");

          $("#modalFormTambahBuku").iziModal("open");
          if ($("#sinopsis").hasClass("udahCKE")) {
            CKEDITOR.instances.sinopsis.destroy();
          } else {
            $("#sinopsis").addClass("udahCKE");
          }
          CKEDITOR.replace('sinopsis');
          CKEDITOR.instances.sinopsis.setData(res.sinopsis);
        });
      });

    });

  </script>

@endsection
