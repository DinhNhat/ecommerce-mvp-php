<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminProductController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function() {
    echo "<h1>Login is required</h1>";
})->name('login');

Route::prefix('admin')->name('admin.')->group(function() {
    
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('products', [AdminProductController::class, 'index'])->name('products')->middleware(Authenticate::class);;
    Route::get('products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('products/store', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('products/{id}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{id}', [AdminProductController::class, 'update'])->name('products.update');
    
    Route::put('products/{id}/toggleAvailability', [AdminProductController::class, 'toggleAvailability'])->name('products.toggleAvailability');
    Route::delete('products/{id}', [AdminProductController::class, 'destroy'])->name('products.destroy');
    Route::get('products/{id}/download', function($id) {

        $product = \App\Models\Product::findOrFail($id);
        $fileExists = Storage::disk('public')->exists($product->file_path_without_storage);
        if ($fileExists) {
            $downloadedUrl = Storage::url(str_replace('/storage/', '', $product->file_path));
            return redirect($downloadedUrl);
            //return Storage::download(str_replace('/storage/', '', $product->file_path), $product->last_file_name);
        } else {
            return redirect()->route('admin.products');
        }

    })->name('products.download');

    #Upload
    Route::post('products/uploadImage', [AdminProductController::class, 'uploadImage'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
    ->name('products.uploadImage');

    Route::get('customers', function() {
        return view('admin.customers');
    })->name('customers');

    Route::get('sales', function() {
        return view('admin.orders');
    })->name('sales');

});
