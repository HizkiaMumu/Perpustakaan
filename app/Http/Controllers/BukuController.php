<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku;

class BukuController extends Controller
{

    public function tambahBuku(Request $request){
      $data = $request->all();
      $buku = Buku::create($data);
      return redirect()->back()->with("OK", "Berhasil menambahkan buku.");
    }

    public function hapusBuku($id){
      $buku = Buku::findOrFail($id);
      $buku->delete();
      return redirect()->back()->with("OK", "Berhasil menghapus buku.");
    }

    public function detailBuku($id){
      $buku = Buku::findOrFail($id);
      return $buku;
    }

    public function editBuku(Request $request, $id){
      $buku = Buku::findOrFail($id);

      $buku->kode_buku = $request->kode_buku;
      $buku->isbn = $request->isbn;
      $buku->judul_buku = $request->judul_buku;
      $buku->sinopsis = $request->sinopsis;
      $buku->pengarang = $request->pengarang;
      $buku->penerbit = $request->penerbit;
      $buku->tahun_terbit = $request->tahun_terbit;

      $buku->save();
      return redirect()->back()->with("OK", "Berhasil mengedit buku.");
    }

}
