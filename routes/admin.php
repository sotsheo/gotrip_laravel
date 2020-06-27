<?php 
// admin

    Route::any("/",array('as' => 'index', 'uses' => 'Login_controller@index'))->middleware("checklogins");
    Route::post('/login', array('as' => 'login', 'uses' => 'Login_controller@login'));
    // Route::post('/login', array('as' => 'login', 'uses' => 'Login_controller@login'));
    Route::get("/register", 'Login_controller@register')->middleware("checklogins");
    Route::any('/registers', array('as' => 'register', 'uses' => 'Login_controller@registers'))->middleware("checklogins");
    Route::get('/logout', array('as' => 'logout', 'uses' => 'Login_controller@logout'));
    Route::any('/setLang', array('as' => 'lang', 'uses' => 'Site\Website_controller@setLang'))->middleware("checklogins");

    // setting website
    Route::group(['prefix' => 'setting'],function(){
        Route::any("/",array('as' => 'setting', 'uses' => 'Site\Setting_controller@index'))->middleware("checklogins");
        Route::any('/update', array('as' => 'update_setting', 'uses' => 'Site\Setting_controller@update'))->middleware("checklogins");


    });
  // support
    Route::group(['prefix' => 'support'],function(){
        Route::get("/","Support\Support_controller@index")->middleware("checklogins");
        Route::any('/update_support', array('as' => 'update_support', 'uses' => 'Support\Support_controller@update_support'))->middleware("checklogins");

        Route::get('/delete/{id}', 'Support\Support_controller@delete')->middleware("checklogins");
    });
    

    // news
    Route::group(['prefix' => 'news'],function(){
        Route::get("/", 'news\News_controller@index')->middleware("checklogins");
          // Add 
         Route::post('/getNewsTogether', array('as' => 'getNewsTogether', 'uses' => 'news\News_controller@getNewsTogether'))->middleware("checklogins");
        Route::any("/create","news\News_controller@create")->middleware("checklogins");
        //  Edit
        Route::any("/update/{model}","news\News_controller@update")->middleware("checklogins");
         // Delete
        Route::any("/delete/{model}","news\News_controller@delete")->middleware("checklogins");
        
    });
    // catgory_ news
    Route::group(['prefix' => 'category_news'],function(){
        Route::get("/","news\NewsCategory_controller@index")->middleware("checklogins");
        // Add 
        Route::any("/create","news\NewsCategory_controller@create")->middleware("checklogins");
        //  Edit
        Route::any("/update/{model}","news\NewsCategory_controller@update")->middleware("checklogins");
        // Delete
        Route::any("/delete/{model}","news\NewsCategory_controller@delete")->middleware("checklogins");
        Route::any('/get_news_category', array('as' => 'get_news_category', 'uses' => 'News\NewsCategory_controller@get_news_category'))->middleware("checklogins");

    });
    // catgory_banner
    Route::group(['prefix' => 'category_banner'],function(){
        Route::get("/","banner\BannerCategory_controller@index")->middleware("checklogins");
        // Add
        Route::any("/create","banner\BannerCategory_controller@create")->middleware("checklogins");
        
        //  Edit
        Route::any("/update/{model}","banner\BannerCategory_controller@update")->middleware("checklogins")->middleware("checklogins");
        
        // Delete
        Route::get("/delete/{model}","banner\BannerCategory_controller@delete")->middleware("checklogins");
        Route::any("/get_category_banner",array('as' => 'get_category_banner', 'uses' => 'banner\BannerCategory_controller@get_category_banner'));
    });

    // banner
    Route::group(['prefix' => 'banner'],function(){
        Route::get("/","banner\Banner_controller@index")->middleware("checklogins");
        // Add
        Route::any("/create","banner\Banner_controller@create")->middleware("checklogins");
       
        //  Edit
        Route::any("/update/{model}","banner\Banner_controller@update")->middleware("checklogins");
        
        // Delete
        Route::any("/delete/{model}","banner\Banner_controller@delete")->middleware("checklogins");
    });
    
    // menu
    Route::group(['prefix' => 'menu'],function(){
        Route::get("/","menu\Menu_controller@index")->middleware("checklogins");

        Route::any("/create_category","menu\Menu_controller@create_category")->middleware("checklogins");
        //Route::any('/menu_category', array('as' => 'create_category_menu', 'uses' => 'menu\Menu_controller@create_category_menu'))->middleware("checklogins");

        // Insert menu item
        Route::any("/create_id/{category}","menu\Menu_controller@create_menu_id");
       


        // Edit menu
        Route::any("/update_menu/{model}","menu\Menu_controller@update_menu");
        Route::any('/update_menu_p', array('as' => 'update_menu_p', 'uses' => 'Menu\Menu_controller@update_menu_p'))->middleware("checklogins");

        // Delete menu
        Route::any("/delete_menu/{model}","menu\Menu_controller@delete_menu")->middleware("checklogins");
         // delete menu category
        Route::any("/delete_category/{model}","menu\Menu_controller@delete_category")->middleware("checklogins");
        Route::any("/update_category/{model}","menu\Menu_controller@update_category")->middleware("checklogins");
        Route::any('/update_category_p', array('as' => 'update_category_p', 'uses' => 'menu\Menu_controller@update_category_p'))->middleware("checklogins");
        
        Route::post('/menu_get', array('as' => 'menu_get', 'uses' => 'menu\Menu_controller@menu_get'))->middleware("checklogins");

    });

   // Sản phẩm
    Route::group(['prefix' => 'category_product'],function(){
        Route::any("/","product\ProductCategory_controller@index")->middleware("checklogins");

        // create category_product
        Route::any("/create","product\ProductCategory_controller@create")->middleware("checklogins");


        // edit category_product
        Route::any("/update/{model}","product\ProductCategory_controller@update")->middleware("checklogins");
    
        Route::any("/delete/{model}","product\ProductCategory_controller@delete")->middleware("checklogins");

        Route::any('/get_product_category', array('as' => 'get_product_category', 'uses' => 'product\ProductCategory_controller@get_product_category'))->middleware("checklogins");
        

    });

    // product
    Route::group(['prefix' => 'product'],function(){
        Route::get("/","product\Product_controller@index")->middleware("checklogins");
        Route::post('/getProductTogether', array('as' => 'getProductTogether', 'uses' => 'product\Product_controller@getProductTogether'))->middleware("checklogins");
        Route::any('/search', array('as' => 'product', 'uses' => 'product\Product_controller@product'))->middleware("checklogins");
        Route::any("/create","product\Product_controller@create")->middleware("checklogins");
        Route::any('/uploadFileImages', array('as' => 'uploadFileImages', 'uses' => 'product\Product_controller@uploadFileImages'))->middleware("checklogins");
        Route::any('/removeImg', array('as' => 'removeImg', 'uses' => 'product\Product_controller@removeImg'))->middleware("checklogins");
        Route::any('/addproductTogether', array('as' => 'addproductTogether', 'uses' => 'product\Product_controller@addproductTogether'))->middleware("checklogins");
        Route::any('/addnewsTogether', array('as' => 'addnewsTogether', 'uses' => 'product\Product_controller@addnewsTogether'))->middleware("checklogins");
        Route::any("/update/{model}","product\Product_controller@update")->middleware("checklogins");
        Route::any("/coppy/{model}","product\Product_controller@coppy")->middleware("checklogins");
        Route::any("/delete/{model}","product\Product_controller@delete")->middleware("checklogins");
        
    });
     // product_group
    Route::group(['prefix' => 'product_group'],function(){
        Route::get("/","product\Product_group_controller@index")->middleware("checklogins");
        Route::any("/create","product\Product_group_controller@create")->middleware("checklogins");
        Route::any("/update/{model}","product\Product_group_controller@update")->middleware("checklogins");
        Route::post('/add_ajax', array('as' => 'add_ajax', 'uses' => 'product\Product_group_controller@add_ajax'))->middleware("checklogins");
        Route::post('/update_list', array('as' => 'update_list', 'uses' => 'product\Product_group_controller@update_list'))->middleware("checklogins");
        Route::get("/delete/{model}","product\Product_group_controller@delete")->middleware("checklogins");
    });

    
     // support
    Route::group(['prefix' => 'support'],function(){
        Route::get("/","support\Support_controller@index")->middleware("checklogins");
        Route::any('/update_support', array('as' => 'update_support', 'uses' => 'support\Support_controller@update_support'))->middleware("checklogins");

        Route::any('/delete/{id}', 'support\Support_controller@delete')->middleware("checklogins");
    });

    // widget
    Route::group(['prefix' => 'html'],function(){
        Route::get("/","site\Html_controller@index")->middleware("checklogins");

        Route::any("/create","site\Html_controller@create")->middleware("checklogins");

        Route::any("/update/{model}","site\Html_controller@update")->middleware("checklogins");
        Route::any('/get_html', array('as' => 'get_html', 'uses' => 'site\Html_controller@get_html'))->middleware("checklogins");
        Route::get("/delete/{model}","site\Html_controller@delete");
    });

    // Recruitment
    Route::group(['prefix' => 'recruitment'],function(){
        Route::get("/","site\Recruitment_controller@index")->middleware("checklogins");

        Route::any("/create","site\Recruitment_controller@create")->middleware("checklogins");

        Route::any("/update/{model}","site\Recruitment_controller@update")->middleware("checklogins");

        Route::get("/delete/{model}","site\Recruitment_controller@delete");
    });



     // newsletter
    Route::group(['prefix' => 'newsletter'],function(){
        Route::get("/","news\Newsletter_controller@index")->middleware("checklogins");
        Route::any('/create_newsletter', array('as' => 'create_newsletter', 'uses' => 'news\Newsletter_controller@create_newsletter'));
        Route::get("/delete/{model}","news\Newsletter_controller@delete")->middleware("checklogins");
    });

    
     // pagecontent
    Route::group(['prefix' => 'pagecontent'],function(){
        Route::get("/","news\PageContent_controller@index")->middleware("checklogins");
        Route::any("/create","news\PageContent_controller@create")->middleware("checklogins");
        Route::any('/update_page/', array('as' => 'update_page', 'uses' => 'news\PageContent_controller@update_page'))->middleware("checklogins");
        Route::any("/update/{model}","news\PageContent_controller@update")->middleware("checklogins");
        Route::any("/delete/{model}","news\PageContent_controller@delete")->middleware("checklogins");
        Route::any('/get_page_content/', array('as' => 'get_page_content', 'uses' => 'news\PageContent_controller@get_page_content'))->middleware("checklogins");
        
    });
    
    Route::group(['prefix' => 'introduce'],function(){
        Route::get("/","site\Introduce_controller@index")->middleware("checklogins");
        Route::any('/update_introduce/', array('as' => 'update_introduce', 'uses' => 'site\Introduce_controller@update_introduce'))->middleware("checklogins");
        
    });

     // widget
    Route::group(['prefix' => 'widget'],function(){
        Route::get("/","Widget_controller@index")->middleware("checklogins");

        Route::any("/create","Widget_controller@create")->middleware("checklogins");

        Route::any("/update/{id}","Widget_controller@update")->middleware("checklogins");

        Route::any("/delete/{id}","Widget_controller@delete");
        Route::any('/getDataWidget', array('as' => 'getDataWidget', 'uses' => 'WidgetAdmin_controller@getDataWidget'))->middleware("checklogins");
         
    });
     // manufacturer
   Route::group(['prefix' => 'manufacturer'],function(){
       Route::get("/","product\Manufacturer_controller@index")->middleware("checklogins");

       Route::any("/create","product\Manufacturer_controller@create")->middleware("checklogins");

       Route::any("/update/{model}","product\Manufacturer_controller@update")->middleware("checklogins");

       Route::get("/delete/{model}","product\Manufacturer_controller@delete")->middleware("checklogins");
   });


     // video
    Route::group(['prefix' => 'category_video'],function(){
        Route::get("/","video\VideoCategory_controller@index")->middleware("checklogins");
        Route::any("/create","video\VideoCategory_controller@create")->middleware("checklogins");
        Route::any("/update/{model}","video\VideoCategory_controller@update")->middleware("checklogins");
        Route::get("/delete/{model}","video\VideoCategory_controller@delete")->middleware("checklogins");
    });

    

     // video
    Route::group(['prefix' => 'video'],function(){
        Route::get("/","video\Video_controller@index")->middleware("checklogins");

        Route::any("/create","video\Video_controller@create")->middleware("checklogins");

        Route::any("/update/{model}","video\Video_controller@update")->middleware("checklogins");

        Route::get("/delete/{model}","video\Video_controller@delete")->middleware("checklogins");
    });


     // album_category
    Route::group(['prefix' => 'album_category'],function(){
        Route::get("/","album\AlbumCategory_controller@index")->middleware("checklogins");

        Route::any("/create","album\AlbumCategory_controller@create")->middleware("checklogins");

        Route::any("/update/{model}","album\AlbumCategory_controller@update")->middleware("checklogins");

        Route::get("/delete/{model}","album\AlbumCategory_controller@delete")->middleware("checklogins");
    });

    // album
    Route::group(['prefix' => 'album'],function(){
        Route::get("/","album\Album_controller@index")->middleware("checklogins");

        Route::any("/create","album\Album_controller@create")->middleware("checklogins");

        Route::any("/update/{model}","album\Album_controller@update")->middleware("checklogins");
        Route::get("/delete/{model}","album\Album_controller@delete")->middleware("checklogins");
        Route::any('/uploadFileAlbum', array('as' => 'uploadFileAlbum', 'uses' => 'album\Album_controller@uploadFileAlbum'))->middleware("checklogins");
        Route::any('/removeFileAlbum', array('as' => 'removeFileAlbum', 'uses' => 'album\Album_controller@removeFileAlbum'))->middleware("checklogins");
    });

// Shop
    Route::group(['prefix' => 'shop'],function(){
        Route::get("/","site\Shop_controller@index")->middleware("checklogins");
        Route::any("/create","site\Shop_controller@create")->middleware("checklogins");
        Route::any("/update/{model}","site\Shop_controller@update")->middleware("checklogins");
        Route::any("/delete/{model}","site\Shop_controller@delete")->middleware("checklogins");
        Route::any('/uploadFileShop', array('as' => 'uploadFileShop', 'uses' => 'site\Shop_controller@uploadFileShop'))->middleware("checklogins");
        Route::any('/removeFileShop', array('as' => 'removeFileShop', 'uses' => 'site\Shop_controller@removeFileShop'))->middleware("checklogins");
        Route::any('/getDistrictShop', array('as' => 'getDistrictShop', 'uses' => 'site\Shop_controller@getDistrictShop'))->middleware("checklogins");
    });
    Route::group(['prefix' => 'au'],function(){
        Route::get("/","au\Authorities_controller@index")->middleware("checklogins");
        Route::get("/delete/{id}","au\Authorities_controller@delete")->middleware("checklogins");
        Route::any("/create","au\Authorities_controller@create")->middleware("checklogins");
        Route::any('/create_au', array('as' => 'create_au', 'uses' => 'au\Authorities_controller@create_au'))->middleware("checklogins");
        Route::any('/addRouter', array('as' => 'addRouter', 'uses' => 'au\Authorities_controller@addRouter'))->middleware("checklogins");
        Route::any('/moveRouter', array('as' => 'moveRouter', 'uses' => 'au\Authorities_controller@moveRouter'))->middleware("checklogins");
        Route::any("/update/{id}","au\Authorities_controller@update")->middleware("checklogins");
        Route::any('/update_au', array('as' => 'update_au', 'uses' => 'au\Authorities_controller@update_au'))->middleware("checklogins");
    });
    Route::group(['prefix' => 'user'],function(){
        Route::get("/","user\User_controller@index")->middleware("checklogins");
        Route::any("/create","user\User_controller@create")->middleware("checklogins");
        Route::any('/create_au', array('as' => 'create_user', 'uses' => 'user\User_controller@create_user'))->middleware("checklogins");
        Route::any("/delete/{model}","user\User_controller@delete")->middleware("checklogins");
        Route::any("/update/{model}","user\User_controller@update")->middleware("checklogins");
        Route::any('/update_user', array('as' => 'update_user', 'uses' => 'user\User_controller@update_user'))->middleware("checklogins");
    });

    Route::group(['prefix' => 'cart'],function(){
        Route::get("/","cart\Cart_controller@index")->middleware("checklogins");
        Route::any("/update/{model}","cart\Cart_controller@update")->middleware("checklogins");
        Route::post("/changeprocess/",array('as' => 'changeprocess', 'uses' => 'cart\Cart_controller@changeprocess'))->middleware("checklogins");
        Route::get("/delete/{model}","cart\Cart_controller@delete")->middleware("checklogins");
    });

    // máy bay 
    Route::group(['prefix' => 'flight'],function(){
        Route::get("/","flight\Flight_controller@index")->middleware("checklogins");
        Route::any("/create","flight\Flight_controller@create")->middleware("checklogins");
        Route::any("/update/{model}","flight\Flight_controller@update")->middleware("checklogins");
         Route::get("/delete/{model}", "flight\Flight_controller@delete")->middleware("checklogins");

        Route::get("/category","flight\FlightCategory_controller@index")->middleware("checklogins");
        Route::any("/category/create","flight\FlightCategory_controller@index")->middleware("checklogins");
        Route::any("/category/update/{model}","flight\FlightCategory_controller@update")->middleware("checklogins");
        Route::any('/category/delete/{model}', array('as' => 'retore', 'uses' => 'flight\FlightCategory_controller@delete'))->middleware("checklogins");

        Route::get("/airline","flight\Airline_controller@index")->middleware("checklogins");
        Route::any("/airline/create","flight\Airline_controller@create")->middleware("checklogins");
        Route::any("/airline/update/{model}","flight\Airline_controller@update")->middleware("checklogins");
        Route::any('/airline/delete/{model}', array('as' => 'retore', 'uses' => 'flight\Airline_controller@delete'))->middleware("checklogins");
    });

    // combo
     Route::group(['prefix' => 'combo'],function(){
        Route::get("/","combo\Combo_controller@index")->middleware("checklogins");
        Route::any("/create","combo\Combo_controller@create")->middleware("checklogins");
        Route::any("/update/{model}","combo\Combo_controller@update")->middleware("checklogins");
        Route::get("/delete/{model}", "combo\Combo_controller@delete")->middleware("checklogins");
        Route::any('/uploadImages', array('as' => 'uploadImagesCombo', 'uses' => 'combo\Combo_controller@uploadImages'))->middleware("checklogins");
        Route::any('/removeImages', array('as' => 'removeImagesCombo', 'uses' => 'combo\Combo_controller@removeImages'))->middleware("checklogins");
        
        Route::get("/category","combo\ComboCategory_controller@index")->middleware("checklogins");
        Route::any("/category/create","combo\ComboCategory_controller@create")->middleware("checklogins");
        Route::any("/category/update/{model}","combo\ComboCategory_controller@update")->middleware("checklogins");
        Route::any('/category/delete/{model}', array('as' => 'retore', 'uses' => 'combo\ComboCategory_controller@delete'))->middleware("checklogins");
       

        Route::get("/time","combo\ComboTime_controller@index")->middleware("checklogins");
        Route::any("/time/create/{model}","combo\ComboTime_controller@create")->middleware("checklogins");
        Route::any("/time/update/{model}","combo\ComboTime_controller@update")->middleware("checklogins");
        Route::any('/time/delete/{model}', array('as' => 'retore', 'uses' => 'flight\ComboTime_controller@delete'))->middleware("checklogins");
    });

    Route::group(['prefix' => 'code'],function(){
        Route::get("/","code\Code_controller@index")->middleware("checklogins");
        Route::any("/create","code\Code_controller@create")->middleware("checklogins");
        Route::any("/update/{model}","code\Code_controller@update")->middleware("checklogins");
        Route::get("/delete/{model}", "code\Code_controller@delete")->middleware("checklogins");
    });

     // hotel
     Route::group(['prefix' => 'hotel'],function(){
        Route::get("/","hotel\Hotel_controller@index")->middleware("checklogins");
        Route::any("/create","hotel\Hotel_controller@create")->middleware("checklogins");
        Route::any("/update/{model}","hotel\Hotel_controller@update")->middleware("checklogins");
        Route::get("/delete/{model}", "hotel\Hotel_controller@delete")->middleware("checklogins");
        Route::any('/uploadImages', array('as' => 'uploadImagesHotel', 'uses' => 'hotel\Hotel_controller@uploadImages'))->middleware("checklogins");

        Route::any('/removeKm', array('as' => 'removeKm', 'uses' => 'hotel\Hotel_controller@removeKm'))->middleware("checklogins");
        Route::any('/getKm', array('as' => 'getKm', 'uses' => 'hotel\Hotel_controller@getKm'))->middleware("checklogins");

        Route::any('/removeImages', array('as' => 'removeImagesHotel', 'uses' => 'hotel\Hotel_controller@removeImages'))->middleware("checklogins");

        Route::get("/room","hotel\HotelRoom_controller@index")->middleware("checklogins");
        Route::any("/room/create","hotel\HotelRoom_controller@create")->middleware("checklogins");
        Route::any("/room/update/{model}","hotel\HotelRoom_controller@update")->middleware("checklogins");
        Route::any('/room/delete/{model}', array('as' => 'retore', 'uses' => 'hotel\HotelRoom_controller@delete'))->middleware("checklogins");
         Route::any('/room/uploadImages', array('as' => 'uploadImagesHotelRoom', 'uses' => 'hotel\HotelRoom_controller@uploadImages'))->middleware("checklogins");
        Route::any('/room/removeImages', array('as' => 'removeImagesHotelRoom', 'uses' => 'hotel\HotelRoom_controller@removeImages'))->middleware("checklogins");
        Route::any('/items/getroom', array('as' => 'getHotelRoom', 'uses' => 'hotel\HotelRoom_controller@getRoom'));

        Route::get("/items","hotel\HotelItems_controller@index")->middleware("checklogins");
        Route::any("/items/create","hotel\HotelItems_controller@create")->middleware("checklogins");
        Route::any("/items/update/{model}","hotel\HotelItems_controller@update")->middleware("checklogins");
        Route::any('/items/delete/{model}', array('as' => 'retore', 'uses' => 'hotel\HotelItems_controller@delete'))->middleware("checklogins");

        Route::get("/room/items","hotel\HotelRoomItems_controller@index")->middleware("checklogins");
        Route::any("/room/items/create","hotel\HotelRoomItems_controller@create")->middleware("checklogins");
        Route::any("/room/items/update/{model}","hotel\HotelRoomItems_controller@update")->middleware("checklogins");
        Route::any('/room/items/delete/{model}', array('as' => 'retore', 'uses' => 'hotel\HotelRoomItems_controller@delete'))->middleware("checklogins");

    });


    Route::group(['prefix' => 'history'],function(){
        Route::get("/","history\History_controller@index")->middleware("checklogins");
        Route::get("/update/{model}","history\History_controller@update")->middleware("checklogins");
        Route::any('/retore', array('as' => 'retore', 'uses' => 'history\History_controller@retore'))->middleware("checklogins");
        Route::any('/restore/{model}',  'history\History_controller@restore')->middleware("checklogins");
    });

    // manage 
    Route::group(['prefix' => 'management'],function(){
        Route::group(['prefix' => 'product'],function(){
            Route::get("/","management\product\Product_controller@index")->middleware("checklogins");

        });
    });

    Route::group(['prefix' => 'restore'],function(){
        Route::any("/","Restore_controller@index")->middleware("checklogins");
        Route::post("/getDate",array('as' => 'getDate', 'uses' => 'Restore_controller@getDate'))->middleware("checklogins");
});
