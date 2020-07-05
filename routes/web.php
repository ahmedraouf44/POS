<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/branc-chart', function () {
    return view('branc-chart');
})->middleware('auth');
Route::get('/invoice', function () {
    return view('invoice');
})->middleware('auth');

Route::get('/mail', function () {
    return view('mail');
});

//Route::post('/transfer','BranchController@transfer')->name('transfer')->middleware('auth');

// import Docs
Route::get('/importDocs','Website\StockController@importDocs')->name('importDocs')->middleware('auth');
Route::get('/accept/{id}','Website\StockController@acceptDoc')->name('acceptDoc')->middleware('auth');

// export Docs
Route::get('/exportDocs','Website\StockController@exportDocs')->name('exportDocs')->middleware('auth');
Route::get('/stock', 'Website\StockController@index')->name('stock')->middleware('auth');
Route::post('/transfer','Website\StockController@transfer')->name('transfer')->middleware('auth');

Route::get('/itemBySerial', 'Website\StockController@ItemBySerial')->name('ItemBySerial')->middleware('auth');
Route::get('/', 'Website\StockController@confirmSerial')->name('confirmSerial')->middleware('auth');

Route::get('/nots/{id}','Website\StockController@nots')->name('nots')->middleware('auth');

Route::post('/filter','Website\StockController@filteration')->name('filter')->middleware('auth');

Route::get('/itemMaster','Website\StockController@itemMaster')->name('itemMaster')->middleware('auth');
Route::post('/addMaster','Website\StockController@addMaster')->name('addMaster')->middleware('auth');
Route::post('/updateMaster/{id}','Website\StockController@updateMaster')->name('updateMaster')->middleware('auth');
Route::get('/deleteMaster/{id}','Website\StockController@deleteMaster')->name('deleteMaster')->middleware('auth');

Route::get('/branchStock','Website\StockController@branchStock')->name('branchStock')->middleware('auth');
Route::post('/addBranchStock','Website\StockController@addBranchStock')->name('addBranchStock')->middleware('auth');
Route::post('/updateBranchStock/{id}','Website\StockController@updateBranchStock')->name('updateBranchStock')->middleware('auth');
Route::get('/deleteBranchStock/{id}','Website\StockController@deleteBranchStock')->name('deleteBranchStock')->middleware('auth');

Route::get('/priceList','BranchController@priceList')->name('priceList')->middleware('auth');
Route::post('/addPriceList','BranchController@addPriceList')->name('addPriceList')->middleware('auth');
Route::post('/editPriceList/{id}','BranchController@editPriceList')->name('editPriceList')->middleware('auth');
Route::get('/deletePriceList/{id}','BranchController@deletePriceList')->name('deletePriceList')->middleware('auth');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');

});
Route::get('/branches','BranchController@index')->name('branches')->middleware('auth');
Route::post('/addbranch','BranchController@store')->name('addbranch')->middleware('auth');
Route::post('/editbranch/{id}','BranchController@update')->name('updatebranch')->middleware('auth');
Route::get('/deletebranch/{id}','BranchController@destroy')->name('deletebranch')->middleware('auth');


Route::get('/users','UserController@index')->name('users')->middleware('auth');
Route::post('/adduser','UserController@store')->name('adduser')->middleware('auth');
Route::post('/edituser','UserController@update')->name('updateuser')->middleware('auth');
Route::get('/deleteuser/{id}','UserController@destroy')->name('deleteuser')->middleware('auth');


//Route::get('/category', function () {
//    return view('category');
//});
//

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/category', 'Website\RoomTypeController@index')->name('category')->middleware('auth');//get all data of color,maincategory,sub,roomtype
Route::get('/packages', 'Website\PackageController@index')->name('packages')->middleware('auth');

Route::get('/stock2', 'Website\StockController@index')->name('stock2')->middleware('auth');
Route::get('/viewstock', 'Website\StockController@viewstock')->name('viewstock')->middleware('auth');

Route::get('/pending', 'Website\StockController@pending_transfer')->name('pending')->middleware('auth');

Route::get('/requestPackage', 'Website\StockController@requestPackage')->name('requestPackage')->middleware('auth');
Route::post('/stockrequestsubmit', 'Website\StockController@requestPackageSubmit')->name('stockrequestsubmit')->middleware('auth');







Route::get('/', 'HomeController@index')->name('dashboard')->middleware('auth');
Route::get('/index', 'HomeController@index')->name('dashboard')->middleware('auth');
Route::get('/dashboard', 'HomeController@index')->name('dashboard')->middleware('auth');
Route::get('/charts', 'HomeController@charts')->name('charts')->middleware('auth');
Route::get('/datatable', 'HomeController@datatable')->name('datatable')->middleware('auth');
Route::post('/datatables', 'HomeController@datatables')->name('datatables')->middleware('auth');


Route::get('/orderview', 'OrderController@orderview')->name('orderview')->middleware('auth');
Route::post('/create_order', 'OrderController@orderCreate')->name('create_order')->middleware('auth');

Route::get('/retrivedorderview', 'OrderController@retrivedorderview')->name('retrivedorderview')->middleware('auth');
Route::post('/retrive_order/{order_number}', 'OrderController@retrivedorder')->name('retrivedorder')->middleware('auth');
Route::get('/getitemStockBySerial', 'OrderController@getItemStockBySerial')->name('getitemStockBySerial')->middleware('auth');
Route::get('/getAllSales', 'OrderController@getAllSales')->name('getAllSales')->middleware('auth');

Route::get('/getcustomerByPhone', 'OrderController@getcustomerByPhone')->name('getcustomerByPhone')->middleware('auth');

Route::get('/exports', 'OrderController@exports')->name('exports')->middleware('auth');

Route::get('/getcustomers', 'OrderController@getcustomers')->name('getcustomers')->middleware('auth');
Route::get('/saveCustomer', 'OrderController@saveCustomer')->name('saveCustomer');
Route::get('/getorderByDate', 'OrderController@getorderByDate')->name('getorderByDate');
Route::get('/getExportsByDate', 'OrderController@getExportsByDate')->name('getExportsByDate');
Route::get('/getExports', 'OrderController@getExports')->name('getExports')->middleware('auth');
Route::get('/invoiceGet/{orderNumber}','OrderController@getInvoice')->name('invoiceGet')->middleware('auth');
Route::post('/confirmReservedOrder/{orderNumber}','OrderController@confirmReservedOrder')->name('confirmReservedOrder')->middleware('auth');
Route::post('/create_check','OrderController@create_check')->name('create_check');

//barcode
Route::get('/barcode','BarcodegeneratorController@barcode');
Route::post('/makeExport', 'OrderController@makeExport')->name('makeExport')->middleware('auth');



Route::get('/getColor', 'Website\ColorController@index')->name('getColor');

Route::post('/createRoomType', 'Website\RoomTypeController@store')->name('createRoomType')->middleware('auth');

Route::post('/createMainCategory', 'Website\MainCategoryController@store')->name('createMainCategory')->middleware('auth');
Route::post('/createSubCategory', 'Website\SubCategoryController@store')->name('createSubCategory')->middleware('auth');

Route::get('/getRoomType', 'Website\RoomTypeController@getAll')->name('getRoomType');
Route::get('/getColor', 'Website\ColorController@index')->name('getColor');
// Route::get('/getMainCategory', 'Website\MainCategoryController@index')->name('getMainCategory');