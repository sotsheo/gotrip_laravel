<?php
$prefix='.html';
 Route::post('/newsletter', array('as' => 'send', 'uses' => 'home\Newsletter_controller@send'));
// Route::get("/recruitment/{page}",'home\Recruitment_controller@index');
// Route::post('/product/{model}', array( 'uses' => 'home\Product_Controller@productRating'));
// Route::get('/san-phamall.html', 'home\Product_Controller@productall');
// // Route::get('/page/{page}', 'home\Page_Controller@page_Detail');

// Route::get('/album/{album}', 'home\Album_Controller@index');
// Front end
// giỏ hàng
Route::get('/order/add/{id}', 'Cart_controller@add');
Route::get('/order/update/{id}/{qty}', 'Cart_controller@update');
Route::any('/order/order', 'Cart_controller@order');
Route::any('/dat-hang.html/{model}', 'Cart_controller@endorder');
Route::any('/gio-hang.html', 'Cart_controller@index');
// shop
Route::get('/shop', 'home\Shop_Controller@index');

Route::get("/",'Home_controller@index');

Route::any("/login".$prefix,'Login_controller@login');
Route::any("/signup".$prefix,'Login_controller@signup');
Route::any("/logout".$prefix,'Login_controller@logout');
Route::post('/loginAjax', array('as' => 'loginAjax', 'uses' => 'Login_controller@loginAjax'));
Route::post('/signupAjax', array('as' => 'signupAjax', 'uses' => 'Login_controller@signupAjax'));
Route::post('/getPosition', array('as' => 'getPosition', 'uses' => 'Login_controller@getPosition'));

Route::get("/site/{page}",'home\Site_controller@index');
Route::get("/seach/",array('as' => 'search', 'uses' => 'Home_controller@search'));
// tin tức 
Route::get("/{url_seo}_cn{model}".$prefix,"home\News_controller@category");
Route::get("/{url_seo}_n{model}".$prefix,"home\News_controller@detail");
Route::get("/{url_seo}_page{model}".$prefix,"home\Page_controller@detail");
// san pham
Route::get("/{url_seo}_cp{model}".$prefix,"home\Product_controller@category");
Route::get("/{url_seo}_pd{model}".$prefix,"home\Product_controller@detail");
// Route::get("/{category}","Home_controller@page");
// Route::get("/{category}/{page}","Home_controller@url_page");

// combo
Route::get("/combo".$prefix,"home\Combo_controller@index");
Route::get("/{url_seo}_ccb{model}".$prefix,"home\Combo_controller@category");
Route::get("/{url_seo}_cb{model}".$prefix,"home\Combo_controller@detail");
Route::get("/combo/order_{model}_{cbtime}","home\ComboOrder_controller@order");
Route::any("/order".$prefix,"home\ComboOrder_controller@index");
Route::any("/order_{code_order}".$prefix,"home\ComboOrder_controller@end");
Route::any('/checkCode', array('as' => 'checkCode', 'uses' => 'home\ComboOrder_controller@checkCode'));
// album
Route::get("/{url_seo}_cab{model}".$prefix,"home\Album_controller@category");
Route::get("/{url_seo}_ab{model}".$prefix,"home\Album_controller@detail");


// hotel
Route::get("/{url_seo}_ht{model}".$prefix,"home\Hotel_controller@hotel");
Route::get("/{url_seo}_rht{model}".$prefix,"home\Hotel_controller@hotelroom");

// hotel
Route::get("/{url_seo}_vd{model}".$prefix,"home\Hotel_controller@category");
Route::get("/{url_seo}_cvd{model}".$prefix,"home\Hotel_controller@detail");









