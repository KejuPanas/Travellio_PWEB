<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return view('admin.bookings.index');
    }

    public function show($id)
    {
        // Parameter $id dipakai untuk mencari data booking spesifik dari database
        return view('admin.bookings.show');
    }
}