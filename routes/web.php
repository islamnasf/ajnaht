<?php

use App\Http\Controllers\VendorController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController as ControllersCategoryController;
use App\Http\Controllers\DocsController;
use App\Http\Controllers\GallaryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SiteDataController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('auth.login');
// });
// Route::middleware('guest')->group(function () {
// // Route::get('/', [AuthenticatedSessionController::class, 'create'])
// //                 ;
// //             });
Route::get('/', [SiteDataController::class, 'landing'])->name('website');
Route::get('/hotels', [SiteDataController::class, 'hotels'])->name('hotels');


Route::middleware(['auth', 'verified', 'role:مسؤول'])
    ->group(function () {
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
//docs
route::group(['prefix' => 'dashboard/docs/'], function () {
    Route::get('show', [DocsController::class, 'index'])->name('getDocs');
    //docstype
    Route::get('show/docs/type', [DocsController::class, 'docsType'])->name('getDocsType');
    Route::post('store/type', [DocsController::class, 'storeDocsType'])->name('storeDocsType');
    Route::post('update/type/{id}', [DocsController::class, 'updateDocsType'])->name('updateDocsType');
    Route::post('delete/type/{id}', [DocsController::class, 'deleteDocsType'])->name('deleteDocsType');
//add docs
Route::get('add/docs', [DocsController::class, 'addDocs'])->name('addDocument');
Route::post('store/new/docs', [DocsController::class, 'storeNewDocs'])->name('storeNewDocs');
Route::get('show/all/docs', [DocsController::class, 'showAllDocs'])->name('showAllDocs');
Route::get('docs/expiring', [DocsController::class, 'showExpiringDocs'])->name('showExpiringDocs');

//
Route::get('show/all/files/{id}', [DocsController::class, 'showAllfiles'])->name('showAllfiles');
Route::post('update/docs/{id}', [DocsController::class, 'updateDocs'])->name('updateDocs');
Route::post('archive/docs/{id}', [DocsController::class, 'archiveDocs'])->name('archiveDocs');
Route::post('unarchive/docs/{id}', [DocsController::class, 'unarchiveDocs'])->name('unarchiveDocs');
Route::get('show/all/archived/docs', [DocsController::class, 'showAllArchiveDocs'])->name('showAllArchiveDocs');
//add file
Route::post('store/new/file/{id}', [DocsController::class, 'storeDocsFile'])->name('storeDocsFile');
Route::post('delete/file/{id}', [DocsController::class, 'deleteDocsFile'])->name('deleteDocsFile');



});

//Category
route::group(['prefix' => 'dashboard/category/'], function () {
    Route::get('show', [ControllersCategoryController::class, 'index'])->name('getCategory');
    Route::post('store', [ControllersCategoryController::class, 'store'])->name('storeCategory');
    Route::post('delete/{service}', [ControllersCategoryController::class, 'delete'])->name('deleteCategory');
    Route::post('update/{service}', [ControllersCategoryController::class, 'update'])->name('updateCategory');
    // Route::get('active/{service}', [ServiceController::class, 'toggle'])->name('activeCategory');
});
//sub category
route::group(['prefix' => 'dashboard/sub/category/'], function () {
    Route::get('show', [SubCategoryController::class, 'index'])->name('getSubCategory');
    Route::get('show/cat_id', [SubCategoryController::class, 'showSubcategories'])->name('showSubcategories');

    Route::post('store', [SubCategoryController::class, 'store'])->name('storeSubCategory');
    Route::post('delete/{service}', [SubCategoryController::class, 'delete'])->name('deleteSubCategory');
    Route::post('update/{service}', [SubCategoryController::class, 'update'])->name('updateSubCategory');
    // Route::get('active/{service}', [SubCategoryController::class, 'toggle'])->name('activeCategory');
});
//vendor
route::group(['prefix' => 'dashboard/sub/category/vendor'], function () {
    Route::get('show', [VendorController::class, 'index'])->name('getVendor');
    Route::post('store', [VendorController::class, 'store'])->name('storeVendor');
    Route::post('delete/{service}', [VendorController::class, 'delete'])->name('deleteVendor');
    Route::post('update/{service}', [VendorController::class, 'update'])->name('updateVendor');
});
route::group(['prefix' => 'dashboard/sub/category/vendor/product'], function () {
    Route::get('show/{vendor}', [ProductController::class, 'index'])->name('getProduct');
    Route::post('store/{vendor}', [ProductController::class, 'store'])->name('storeProduct');
    Route::post('delete/{product}', [ProductController::class, 'delete'])->name('deleteProduct');
    Route::post('update/{product}', [ProductController::class, 'update'])->name('updateProduct');
});

Route::prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('updateusers');
    Route::post('/user/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    // Route::get('/providers/{id}/toggle-status', [UserController::class, 'toggleProviderStatus'])->name('admin.providers.toggle-status');
});

//

route::group(['prefix' => 'dashboard/reservation'], function () {
    Route::get('show', [ReservationController::class, 'index'])->name('getReservation');
        Route::get('showReservations/{hotel}', [ReservationController::class, 'showReservations'])->name('showReservations');
Route::post('/reservations/store', [ReservationController::class, 'store'])->name('reservations.store');

});


//



route::group(['prefix' => 'dashboard/site'], function () {
    Route::get('show', [SiteDataController::class, 'index'])->name('getSiteData');
    Route::post('/reservations/update', [SiteDataController::class, 'updateSiteData'])->name('siteData.update');

});

});









require __DIR__.'/auth.php';
