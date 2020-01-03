<?php



Route::get('/', function () {return view('pages.index');});
//auth & user
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password-change', 'HomeController@changePassword')->name('password.change');
Route::post('/password-update', 'HomeController@updatePassword')->name('password.update');
Route::get('/user/logout', 'HomeController@Logout')->name('user.logout');

//admin=======
Route::get('admin/home', 'AdminController@index')->name('admin.home');
Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');
        // Password Reset Routes...
Route::get('admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/reset/password/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/update/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');
Route::get('/admin/Change/Password','AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update','AdminController@Update_pass')->name('admin.password.update'); 
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');


///admin section-----------

/// category routes
//Route::resource('admin/category','Admin\Category\CategoryController');

Route::get('admin/category','Admin\Category\CategoryController@category')->name('categories');
Route::post('admin/store/category','Admin\Category\CategoryController@storecategory')->name('store.category');

Route::get('admin/delete/category/{id}','Admin\Category\CategoryController@deletecategory')->name('delete.category');
Route::get('admin/edit/category/{id}','Admin\Category\CategoryController@editcategory')->name('edit.category');

Route::post('admin/update/category/{id}','Admin\Category\CategoryController@updatecategory')->name('update.category');


//Brand routes--------
Route::get('admin/brand','Admin\Category\BrandController@brand')->name('brands');
Route::post('admin/store/brand','Admin\Category\BrandController@storeBrand')->name('store.brand');
Route::get('admin/delete/brand/{id}','Admin\Category\BrandController@deleteBrand')->name('delete.brand');
Route::get('admin/edit/brand/{id}','Admin\Category\BrandController@editBrand')->name('edit.brand');
Route::post('admin/update/brand/{id}','Admin\Category\BrandController@updatcBrand')->name('update.brand');

///Sub Categories -----
Route::get('admin/subcategory','Admin\Category\SubCategoryController@subCategory')->name('subCategories');
Route::post('admin/store/subcategory','Admin\Category\SubCategoryController@store_subCategory')->name('store.subcategory');
Route::get('admin/delete/subcategory/{id}','Admin\Category\SubCategoryController@delete_subCategory')->name('delete.subcategory');
Route::get('admin/edit/subcategory/{id}','Admin\Category\SubCategoryController@edit_subCategory')->name('edit.subcategory');
Route::post('admin/update/subcategory/{id}','Admin\Category\SubCategoryController@update_subCategory')->name('update.subcategory');


///////coupons routes---------------
Route::get('admin/coupon','Admin\CouponsController@coupon')->name('coupons');
Route::post('admin/store/coupon','Admin\CouponsController@store_coupon')->name('store.coupon');
Route::get('admin/delete/coupon/{id}','Admin\CouponsController@delete_coupon')->name('delete.coupon');
Route::get('admin/edit/coupon/{id}','Admin\CouponsController@edit_coupon')->name('edit.coupon');
Route::post('admin/update/coupon/{id}','Admin\CouponsController@update_coupon')->name('update.coupon');

//// Newsletters --------------
Route::get('admin/newslater','Admin\NewslatersBackendController@newslaters')->name('newslaters');
Route::get('admin/delete/newslater/{id}','Admin\NewslatersBackendController@delete_newslater')->name('delete.newslater');
/// Products -------
Route::get('admin/product','Admin\ProductsController@allProducts')->name('product.all');
Route::get('admin/add/product','Admin\ProductsController@addProducts')->name('product.add');
Route::post('admin/store/product','Admin\ProductsController@store_product')->name('store.product');



////  Subcategory with AJAX---
Route::get('get/subcategory/{category_id}','Admin\ProductsController@getSubCategory');

///////////// Frontend -----------
Route::post('store/newslaters','Frontend\NewslatersController@store_newslaters')->name('store.newslater');
