<?php

use Illuminate\Support\Facades\Route;

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
Route::get('errors-403', function() {
    return view('errors.403');
});

Route::group(['namespace' => 'Admin'], function() {

    Route::group(['namespace' => 'Auth'], function() {

        Route::get('/', 'LoginController@login')->name('admin.login');
        Route::post('/', 'LoginController@postLogin');
        Route::get('/register', 'RegisterController@getRegister')->name('admin.register');
        Route::post('/register', 'RegisterController@postRegister');
        Route::get('/logout', 'LoginController@logout')->name('admin.logout');
        Route::get('/forgot/password', 'ForgotPasswordController@forgotPassword')->name('forgot.password');
        Route::post('forgot/password', 'ForgotPasswordController@postPassword');

        Route::get('reset-password/{token}', 'ResetPasswordController@resetPassword')->name('reset.password');
        Route::post('reset-password/{token}', 'ResetPasswordController@postResetPassword')->name('post.reset.password');
    });

    Route::group(['middleware' =>['auth'], 'prefix' => 'admin'], function() {
        Route::get('/home', 'HomeController@index')->name('home');

        Route::group(['prefix' => 'group-permission'], function(){
            Route::get('/','GroupPermissionController@index')->name('group.permission.index');
            Route::get('/create','GroupPermissionController@create')->name('group.permission.create');
            Route::post('/create','GroupPermissionController@store');

            Route::get('/update/{id}','GroupPermissionController@edit')->name('group.permission.update');
            Route::post('/update/{id}','GroupPermissionController@update');

            Route::get('/delete/{id}','GroupPermissionController@destroy')->name('group.permission.delete');
        });

        Route::group(['prefix' => 'permission'], function(){
            Route::get('/','PermissionController@index')->name('permission.index');
            Route::get('/create','PermissionController@create')->name('permission.create');
            Route::post('/create','PermissionController@store');

            Route::get('/update/{id}','PermissionController@edit')->name('permission.update');
            Route::post('/update/{id}','PermissionController@update');

            Route::get('/delete/{id}','PermissionController@delete')->name('permission.delete');
        });

        Route::group(['prefix' => 'role'], function(){
            Route::get('/','RoleController@index')->name('role.index')->middleware('permission:toan-quyen-quan-ly|danh-sach-vai-tro');
            Route::get('/create','RoleController@create')->name('role.create')->middleware('permission:toan-quyen-quan-ly|them-moi-vai-tro');
            Route::post('/create','RoleController@store');

            Route::get('/update/{id}','RoleController@edit')->name('role.update')->middleware('permission:toan-quyen-quan-ly|chinh-sua-vai-tro');
            Route::post('/update/{id}','RoleController@update');

            Route::get('/delete/{id}','RoleController@delete')->name('role.delete')->middleware('permission:toan-quyen-quan-ly|xoa-vai-tro');
        });

        Route::group(['prefix' => 'user'], function(){
            Route::get('/','UserController@index')->name('user.index')->middleware('permission:toan-quyen-quan-ly|danh-sach-nguoi-dung');
            Route::get('/create','UserController@create')->name('user.create')->middleware('permission:toan-quyen-quan-ly|them-moi-nguoi-dung');
            Route::post('/create','UserController@store');

            Route::get('/update/{id}','UserController@edit')->name('user.update')->middleware('permission:toan-quyen-quan-ly|chinh-sua-nguoi-dung');
            Route::post('/update/{id}','UserController@update');

            Route::get('/delete/{id}','UserController@delete')->name('user.delete');
            Route::post('update/status/{id}', 'UserController@updateStatus')->name('user.update.status')->middleware('permission:toan-quyen-quan-ly|xoa-nguoi-dung');
        });

        Route::group(['prefix' => 'profile'], function(){
            Route::get('/', 'ProfileController@index')->name('profile.index');
            Route::post('/update/{id}', 'ProfileController@update')->name('profile.update');
            Route::get('/change/password', 'ProfileController@changePassword')->name('change.password');
            Route::post('post/change/password', 'ProfileController@postChangePassword')->name('post.change.password');
        });

        Route::group(['prefix' => 'shop'], function(){
            Route::get('/','ShopController@index')->name('shop.index')->middleware('permission:toan-quyen-quan-ly|danh-sach-cua-hang-xe');
            Route::get('/create','ShopController@create')->name('shop.create')->middleware('permission:toan-quyen-quan-ly|them-cua-hang-xe');
            Route::post('/create','ShopController@store');

            Route::get('/update/{id}','ShopController@edit')->name('shop.update')->middleware('permission:toan-quyen-quan-ly|chinh-sua-cua-hang-xe');
            Route::post('/update/{id}','ShopController@update');

            Route::get('/delete/{id}','ShopController@delete')->name('shop.delete')->middleware('permission:toan-quyen-quan-ly|xoa-cua-hang-xe');
        });

        Route::group(['prefix' => 'branch'], function(){
            Route::get('/','BranchController@index')->name('branch.index')->middleware('permission:toan-quyen-quan-ly|danh-sach-chi-nhanh-hoac-kho');
            Route::get('/create','BranchController@create')->name('branch.create')->middleware('permission:toan-quyen-quan-ly|them-chi-nhanh-hoac-kho');
            Route::post('/create','BranchController@store');

            Route::get('/update/{id}','BranchController@edit')->name('branch.update')->middleware('permission:toan-quyen-quan-ly|chinh-sua-chi-nhanh-hoac-kho');
            Route::post('/update/{id}','BranchController@update');

            Route::get('/delete/{id}','BranchController@delete')->name('branch.delete')->middleware('permission:toan-quyen-quan-ly|xoa-chi-nhanh-hoac-kho');

            Route::post('/check/quantity','BranchController@checkQuantity')->name('branch.check.quantity');
            Route::get('/products/{id}','BranchController@products')->name('branch.products');
        });


        Route::group(['prefix' => 'trademark'], function(){
            Route::get('/','TrademarkController@index')->name('trademark.index')->middleware('permission:toan-quyen-quan-ly|danh-sach-hang-xe');
            Route::get('/create','TrademarkController@create')->name('trademark.create')->middleware('permission:toan-quyen-quan-ly|them-moi-hang-xe');
            Route::post('/create','TrademarkController@store');

            Route::get('/update/{id}','TrademarkController@edit')->name('trademark.update')->middleware('permission:toan-quyen-quan-ly|chinh-sua-hang-xe');
            Route::post('/update/{id}','TrademarkController@update');

            Route::get('/delete/{id}','TrademarkController@delete')->name('trademark.delete')->middleware('permission:toan-quyen-quan-ly|xoa-hang-xe');
        });

        Route::group(['prefix' => 'category'], function(){
            Route::get('/','CategoryController@index')->name('category.index')->middleware('permission:toan-quyen-quan-ly|danh-sach-dong-xe');
            Route::get('/create','CategoryController@create')->name('category.create')->middleware('permission:toan-quyen-quan-ly|them-dong-xe');
            Route::post('/create','CategoryController@store');

            Route::get('/update/{id}','CategoryController@edit')->name('category.update')->middleware('permission:toan-quyen-quan-ly|chinh-sua-dong-xe');
            Route::post('/update/{id}','CategoryController@update');

            Route::get('/delete/{id}','CategoryController@delete')->name('category.delete')->middleware('permission:toan-quyen-quan-ly|xoa-dong-xe');
        });

        Route::group(['prefix' => 'supplier'], function(){
            Route::get('/','SupplierController@index')->name('supplier.index')->middleware('permission:toan-quyen-quan-ly|danh-sach-nha-cung-cap');
            Route::get('/create','SupplierController@create')->name('supplier.create')->middleware('permission:toan-quyen-quan-ly|them-nha-cung-cap');
            Route::post('/create','SupplierController@store');

            Route::get('/update/{id}','SupplierController@edit')->name('supplier.update')->middleware('permission:toan-quyen-quan-ly|chinh-sua-nha-cung-cap');
            Route::post('/update/{id}','SupplierController@update');

            Route::get('/delete/{id}','SupplierController@delete')->name('supplier.delete')->middleware('permission:toan-quyen-quan-ly|xoa-nha-cung-cap');
        });

        Route::group(['prefix' => 'product'], function(){
            Route::get('/','ProductController@index')->name('product.index')->middleware('permission:toan-quyen-quan-ly|danh-sach-san-pham');
            Route::get('/create','ProductController@create')->name('product.create')->middleware('permission:toan-quyen-quan-ly|them-san-pham');
            Route::post('/create','ProductController@store');

            Route::get('/update/{id}','ProductController@edit')->name('product.update')->middleware('permission:toan-quyen-quan-ly|chinh-sua-san-pham');
            Route::post('/update/{id}','ProductController@update');

            Route::get('/delete/{id}','ProductController@delete')->name('product.delete')->middleware('permission:toan-quyen-quan-ly|xoa-san-pham');

            Route::post('/show','ProductController@show')->name('product.show');

        });

        Route::group(['prefix' => 'customer'], function(){
            Route::get('/','CustomerController@index')->name('customer.index')->middleware('permission:toan-quyen-quan-ly|danh-sach-khach-hang');
            Route::get('/create','CustomerController@create')->name('customer.create')->middleware('permission:toan-quyen-quan-ly|them-moi-khach-hang');
            Route::post('/create','CustomerController@store');

            Route::get('/update/{id}','CustomerController@edit')->name('customer.update')->middleware('permission:toan-quyen-quan-ly|chinh-sua-khach-hang');
            Route::post('/update/{id}','CustomerController@update');

            Route::get('/delete/{id}','CustomerController@delete')->name('customer.delete')->middleware('permission:toan-quyen-quan-ly|xoa-khach-hang');
        });

        Route::group(['prefix' => 'warehouse'], function(){

            Route::group(['prefix' => 'export'], function(){
                Route::get('/','WarehouseExportController@index')->name('warehouse.export.index')->middleware('permission:toan-quyen-quan-ly|danh-sach-nhap-kho');
                Route::get('/create','WarehouseExportController@create')->name('warehouse.export.create')->middleware('permission:toan-quyen-quan-ly|them-nhap-kho');
                Route::post('/create','WarehouseExportController@store');

                Route::get('/update/{id}','WarehouseExportController@edit')->name('warehouse.export.update')->middleware('permission:toan-quyen-quan-ly|chinh-sua-nhap-kho');
                Route::post('/update/{id}','WarehouseExportController@update');

                Route::get('/delete/{id}','WarehouseExportController@delete')->name('warehouse.export.delete')->middleware('permission:toan-quyen-quan-ly|xoa-nhap-kho');

                Route::post('/row','WarehouseExportController@importRow')->name('warehouse.export.row');

                Route::get('/products','WarehouseExportController@warehouseExport')->name('warehouse.export.products')->middleware('permission:toan-quyen-quan-ly|danh-sach-san-pham-da-nhap');
                Route::get('/products/delete','WarehouseExportController@warehouseExportDelete')->name('warehouse.export.products.delete')->middleware('permission:toan-quyen-quan-ly|xoa-san-pham-da-nhap');

                Route::get('/invoice/{id}','WarehouseExportController@exportInvoicePrint')->name('warehouse.export.invoice')->middleware('permission:toan-quyen-quan-ly|hoa-don-nhap-kho');
            });

            Route::group(['prefix' => 'import'], function(){
                Route::get('/','WarehouseImportController@index')->name('warehouse.import.index')->middleware('permission:toan-quyen-quan-ly|danh-sach-nhap-kho');
                Route::get('/create','WarehouseImportController@create')->name('warehouse.import.create')->middleware('permission:toan-quyen-quan-ly|danh-sach-nhap-kho');
                Route::post('/create','WarehouseImportController@store');

                Route::get('/update/{id}','WarehouseImportController@edit')->name('warehouse.import.update')->middleware('permission:toan-quyen-quan-ly|danh-sach-nhap-kho');
                Route::post('/update/{id}','WarehouseImportController@update');

                Route::get('/delete/{id}','WarehouseImportController@delete')->name('warehouse.import.delete')->middleware('permission:toan-quyen-quan-ly|danh-sach-nhap-kho');

                Route::post('/row','WarehouseImportController@importRow')->name('warehouse.import.row');

                Route::get('/products','WarehouseImportController@warehouseImport')->name('warehouse.import.products')->middleware('permission:toan-quyen-quan-ly|danh-sach-nhap-kho');
                Route::get('/products/delete','WarehouseImportController@warehouseImportDelete')->name('warehouse.import.products.delete')->middleware('permission:toan-quyen-quan-ly|xoa-san-pham-da-xuat');

                Route::get('/invoice/{id}','WarehouseImportController@importInvoicePrint')->name('warehouse.import.invoice')->middleware('permission:toan-quyen-quan-ly|hoa-don-xuat-kho');
            });


            Route::group(['prefix' => 'selling'], function(){
                Route::get('/','SellingController@index')->name('selling.index')->middleware('permission:toan-quyen-quan-ly|danh-sach-ban-hang');
                Route::get('/create','SellingController@create')->name('selling.create')->middleware('permission:toan-quyen-quan-ly|them-moi-phieu-mua-hang');
                Route::post('/create','SellingController@store');

                Route::get('/update/{id}','SellingController@edit')->name('selling.update')->middleware('permission:toan-quyen-quan-ly|chinh-sua-phieu-mua-hang');
                Route::post('/update/{id}','SellingController@update');

                Route::get('/delete/{id}','SellingController@delete')->name('selling.delete')->middleware('permission:toan-quyen-quan-ly|xoa-phieu-mua-hang');

                Route::post('/row','SellingController@importRow')->name('selling.row');

                Route::get('/invoice/{id}','SellingController@invoicePrint')->name('selling.invoice')->middleware('permission:toan-quyen-quan-ly|hoa-don-phieu-mua-hang');
            });

            Route::group(['prefix' => 'statistical'], function(){
                Route::get('/','StatisticalController@index')->name('statistical.index')->middleware('permission:toan-quyen-quan-ly|danh-sach-thong-ke');
            });

        });
    });
});

Route::group(['namespace' => 'Page', 'middleware' => 'locale'], function() {
    Route::get('change-language/{language}', 'ChangeLanguageController@changeLanguage')->name('user.change-language');
//    Route::get('/', 'HomeController@index')->name('user.home.index');
});

