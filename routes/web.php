<?php

use App\Livewire\Auth\login;
use App\Livewire\Auth\register;
use App\Livewire\MC;
use App\Livewire\Mobils;
use App\Livewire\Venue;
use App\Livewire\perias;
use App\Livewire\Vendor;
use App\Livewire\catering;
use App\Livewire\Dekorasi;
use App\Livewire\HomePage;
use App\Livewire\Souvenir;
use App\Livewire\Akomodasi;
use App\Livewire\dokumentasi;
use App\Livewire\entertainment;
use Illuminate\Support\Facades\Route;


Route::get('/catering', Catering::class);
Route::get('/dekorasi', dekorasi::class);
Route::get('/dokumentasi', dokumentasi::class);
Route::get('/entertainment', entertainment::class);
Route::get('/mc', MC::class);
Route::get('/Mobil', Mobils::class);
Route::get('/perias', perias::class);
Route::get('/souvenir', Souvenir::class);
Route::get('/venue', Venue::class);
Route::get('/akomodasi', Akomodasi::class);
Route::get('/login', login::class);
Route::get('/register', register::class);

Route::get('/', function () {
    return view('livewire.vendor');
})->name('vendor.page');

Route::get('/transaksi', function () {
    return view('livewire.transaksi');
})->name('transaksi.page');

Route::get('/contact', function () {
    return view('livewire.contact');
})->name('contact.page');
