<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index() 
    {
        return view('admin.pakets.index');
    }

    // Tambahkan fungsi ini
    public function create()
    {
        return view('admin.pakets.create');
    }

    public function edit($id)
    {
        // Parameter $id nantinya dipakai untuk memanggil data dari database
        return view('admin.pakets.edit');
    }
}