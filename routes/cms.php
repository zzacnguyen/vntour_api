<?php
	//BẤM CTRL F ĐỂ TÌM CÁC LINK HIỆN CÓ

/*
1. TRANG CHỦ
2. THÊM TASK
3. XOÁ TASK
4. NGƯỜI DÙNG - ADMIN
5. NGƯỜI DÙNG - MODERTAROR
6. NGƯỜI DÙNG - DOANH NGHIỆP
7. NGƯỜI DÙNG - CỘNG TÁC VIÊN
8. NGƯỜI DÙNG - HƯỚNG DẪN VIÊN DU LỊCH
9. TẤT CẢ NGƯỜI DÙNG
10. DANH SÁCH ĐỊA ĐIỂM
11. THÊM ĐỊA ĐIỂM - GET
12. THÊM ĐỊA ĐIỂM - POST
13. THÊM DỊCH VỤ - GET
14. THÊM DỊCH VỤ - POST
15. DỊCH VỤ - DANH SÁCH
16. VUI CHƠI GIẢI TRÍ - GET
17. THÊM ĐIỂM CHO DỊCH VỤ - GET
18. THÊM ĐIỂM CHO DỊCH VỤ  - POST
19. SỬA ĐIỂM CHO DỊCH VỤ - GET
20. SỬA ĐIỂM CHO DỊCH VỤ  - POST
21. LẤY DANH SÁCH ĐIỂM - DỊCH  VỤ - GET
22. DANH MỤC LOẠI HÌNH SỰ KIỆN
23. THÊM/ SỬA / XOÁ LOẠI HÌNH SỰ KIỆN

4. 







*/





	// Route::get('qt-test', 'CMS_ModuleController@_DISPLAY_NEW_USER');
	

	//TRANG CHỦ
	Route::get('lvtn-dashboard', 'CMS_ModuleController@getDashboard')->name('ADMIN_DASHBOARD');
	

	//THÊM TASK
	Route::post('lvtn-dashboard', 'CMS_AddDataController@_POST_TASK');
	

	//XOÁ TASK
	Route::get('delete-task/{id}', 'CMS_DeleteDataController@_DELETE_TASK')->name('DELETE_TASK');







	//NGƯỜI DÙNG - ADMIN
	Route::get('lvnt-list-admin','CMS_ComponentController@_DISPLAY_LIST_ADMIN_USER')->name('ALL_LIST_ADMIN');


	//NGƯỜI DÙNG - MODERTAROR
	Route::get('lvnt-list-mod','CMS_ComponentController@_DISPLAY_LIST_MODERATOR_USER')->name('ALL_LIST_MOD');
	Route::get('lvtn-active-mod/user={user_id}', 'CMS_AddDataController@AcctiveMod')->name('ACCTIVE_MOD');
	Route::get('lvtn-unactive-mod/user={user_id}', 'CMS_AddDataController@UnAcctiveMod')->name('UNACCTIVE_MOD');




	//NGƯỜI DÙNG - DOANH NGHIỆP
	Route::get('lvnt-list-enterpirse','CMS_ComponentController@_DISPLAY_LIST_ENTERPRISE')->name('ALL_LIST_ENTERPRISE');

	Route::get('lvtn-active-enterpirse/user={user_id}', 'CMS_AddDataController@ACCTIVE_ENTERPRISE')->name('ACCTIVE_ENTERPRISE');
	Route::get('lvtn-unactive-enterpirse/user={user_id}', 'CMS_AddDataController@UNACCTIVE_ENTERPRISE')->name('UNACCTIVE_ENTERPRISE');



	//NGƯỜI DÙNG - CỘNG TÁC VIÊN
	Route::get('lvnt-list-partner','CMS_ComponentController@_DISPLAY_LIST_PARTNER')->name('ALL_LIST_PARTNER');
	


	////NGƯỜI DÙNG - HƯỚNG DẪN VIÊN DU LỊCH
	Route::get('lvnt-list-tour-guide','CMS_ComponentController@_DISPLAY_LIST_TOURGUIDE')->name('ALL_LIST_TOURGUIDE');
	// Route::get('lvnt-list-tour-guide','CMS_ComponentController@_DISPLAY_LIST_TOURGUIDE')->name('ALL_LIST_TOURGUIDE');
	Route::get('lvtn-active-tourguide/user={user_id}', 'CMS_AddDataController@ACCTIVE_TOURGUIDE')->name('ACCTIVE_TOURGUIDE');
	Route::get('lvtn-unactive-tourguide/user={user_id}', 'CMS_AddDataController@UNACCTIVE_TOURGUIDE')->name('UNACCTIVE_TOURGUIDE');

	//TẤT CẢ NGƯỜI DÙNG
	Route::get('lvtn-list-user', 'CMS_ComponentController@_DISPLAY_LIST_ALL_USER')->name('ALL_LIST_USER');
	Route::get('lvtn-list-user-wait', 'CMS_ComponentController@_DISPLAY_LIST_WAITMOD_USER')->name('_DISPLAY_LIST_WAITMOD_USER');



	//DANH SÁCH ĐỊA ĐIỂM
	Route::get('lvtn-list-address', 'CMS_ComponentController@_DISPLAY_TOURIST_PLACES')->name('ALL_LIST_PLACE');
	Route::get('lvtn-list-address-unactive', 'CMS_ComponentController@_DISPLAY_TOURIST_PLACES_UNACTIVE')->name('_DISPLAY_TOURIST_PLACES_UNACTIVE');

	//THÊM ĐỊA ĐIỂM - GET
	Route::get('lvtn-add-tourist-places', 'CMS_ModuleController@_GETVIEW_ADD_TOURIST_PLACES')->name('ADD_TOURIST_PLACES');
	Route::get('lvtn-active-place/id={user_id}', 'CMS_AddDataController@ACCTIVE_PLACES')->name('ACCTIVE_PLACES');

	Route::get('lvtn-active2-place/id={user_id}', 'CMS_AddDataController@ACCTIVE_PLACES2')->name('ACCTIVE_PLACES2');

	Route::get('lvtn-unactive-place/id={user_id}', 'CMS_AddDataController@UNACCTIVE_PLACES')->name('UNACCTIVE_PLACES');
	Route::get('lvtn-unactive2-place/id={user_id}', 'CMS_AddDataController@UNACCTIVE_PLACES2')->name('UNACCTIVE_PLACES2');
	//THÊM ĐỊA ĐIỂM - POST
	Route::post('lvtn-add-tourist-places', 'CMS_AddDataController@_POST_TOURIST_PLACES');

	//THÊM DỊCH VỤ - GET
	Route::get('lvtn-add-services', 'CMS_ModuleController@_GETVIEW_ADD_SERVICES')->name('_GETVIEW_ADD_SERVICES');
	//THÊM DỊCH VỤ - POST


	//DỊCH VỤ - DANH SÁCH
	Route::get('lvnt-list-services','CMS_ComponentController@_DISPLAY_LIST_SERVICES')->name('ALL_LIST_SERVICES');


	Route::post('lvtn-add-services', 'CMS_AddDataController@_POST_ADD_SERVICES');

	//DANH SÁCH DỊCH VỤ
		//VUI CHƠI GIẢI TRÍ - GET
		Route::get('lvtn-services-entertaiments', 'CMS_ComponentController@_GET_VIEW_LIST_SERVICES_BY_ENTERTAIMENTS')->name('_GET_VIEW_SERVICES_BY_ENTERTAIMENTS');
		Route::get('lvtn-services-food', 'CMS_ComponentController@_GET_VIEW_LIST_SERVICES_BY_FOODANDDRINK')->name('_GET_VIEW_LIST_SERVICES_BY_FOODANDDRINK');
		Route::get('lvtn-services-hotels', 'CMS_ComponentController@_GET_VIEW_LIST_SERVICES_BY_HOTEL')->name('_GET_VIEW_LIST_SERVICES_BY_HOTEL');
		Route::get('lvtn-services-sightseeing', 'CMS_ComponentController@_GET_VIEW_LIST_SERVICES_BY_SIGHTSEEING')->name('_GET_VIEW_LIST_SERVICES_BY_SIGHTSEEING');

		Route::get('lvtn-services-transport', 'CMS_ComponentController@_GET_VIEW_LIST_SERVICES_BY_TRANSPORT')->name('_GET_VIEW_LIST_SERVICES_BY_TRANSPORT');
		// Route::get('lvtn-')
		//ĂN UỐNG - ẨM THỰC


		//KHÁCH SẠN NƠI Ở




		// THAM QUAN



		// VUI CHƠI GIẢI TRÍ


	//DANH MỤC ĐIỂM

//
	Route::get('lvtn-list-point', 'CMS_ComponentController@_DISPLAY_LIST_POINT')->name('_GET_LIST_ALL_POINT');
	Route::get('lvtn-add-point', 'CMS_ModuleController@_GET_ADD_POINT')->name('_GET_ADD_POINT');
	Route::post('lvtn-add-point', 'CMS_AddDataController@_POST_ADD_POINT');
	Route::get('lvtn-edit-point/{id}', 'CMS_ModuleController@_GET_EDIT_POINT' )->name('_GET_EDIT_POINT');
	Route::post('lvtn-edit-point/{id}', 'CMS_EditDataController@_POST_EDIT_POINT');


	//DANH MỤC LOẠI HÌNH SỰ KIỆN
	Route::get('lvtn-list-type-events', 'CMS_ModuleController@_GETVIEW_LIST_TYPE_EVENT' )->name('_GET_EVENT_TYPES');
	Route::get('lvtn-add-type-events', 'CMS_ModuleController@_GETVIEW_ADD_TYPES_EVENT' )->name('_GETVIEW_ADD_TYPES_EVENT');

	Route::post('lvtn-add-type-events', 'CMS_AddDataController@ADD_TYPES_EVENT' );
	Route::get('lvtn-add-type-events-ajax/ten={ten}', 'CMS_AddDataController@ADD_TYPES_EVENT_AJAX' );
	
	Route::get('lvtn-edit-type-events/{id}', 'CMS_ModuleController@_GETVIEW_EDIT_EVENT_TYPES' )->name('_GETVIEW_EDIT_EVENT_TYPES');
	Route::post('lvtn-edit-type-events/{id}', 'CMS_EditDataController@EDIT_TYPES_EVENT' );

	//DANH MỤC MẠNG XÃ HỘI
	Route::get('lvtn-list-social', 'CMS_ModuleController@_GETVIEW_LIST_SOCIAL')->name('_GETVIEW_LIST_SOCIAL');
	Route::get('lvtn-add-social', 'CMS_ModuleController@_GETVIEW_ADD_SOCIAL')->name('_GETVIEW_ADD_SOCIAL');
	Route::post('lvtn-add-social', 'CMS_AddDataController@ADD_SOCIAL');



	Route::get('lvtn-using-sytem', 'CMS_ComponentController@_GETVIEW_USAGE_MANUAL')->name('_GETVIEW_USAGE_MANUAL');

	Route::get('lvtn-unactive-service/{id}', 'CMS_EditDataController@EDIT_STATUS_UNACTIVE_SERVICES')->name('EDIT_STATUS_UNACTIVE_SERVICES');
		Route::get('lvtn-unactive-service2/{id}', 'CMS_EditDataController@EDIT_STATUS_UNACTIVE_SERVICES2')->name('EDIT_STATUS_UNACTIVE_SERVICES2');

	Route::get('lvtn-list-services-unactive', 'CMS_ComponentController@LIST_UNACTICE_SERVICES')->name('LIST_UNACTICE_SERVICES'); 
	Route::get('lvtn-list-services-spam', 'CMS_ComponentController@LIST_SPAM_SERVICES')->name('LIST_SPAM_SERVICES'); 

	Route::get('lvtn-delete-services/{id}', 'CMS_DeleteDataController@DELETE_SERVICES')->name('DELETE_SERVICES');

	// Route::get('lvtn-list-services-spam', 'CMS_ComponentController@LIST_SPAM_SERVICES')->name('LIST_SPAM_SERVICES'); 

	Route::get('lvtn-places-details/{id}', 'CMS_ComponentController@_PLACES_DETAILS')->name('_PLACES_DETAILS');

	Route::get('lvtn-active-places/{id}', 'CMS_EditDataController@_DETAIL_ACTIVE_PLACE')->name('_AJAX_ACTIVE_PLACE');
	Route::get('lvtn-unactive-places/{id}', 'CMS_EditDataController@_DETAIL_UNACTIVE_PLACE')->name('_AJAX_UNACTIVE_PLACE');
	Route::get('lvtn-spam-places/{id}', 'CMS_EditDataController@_DETAIL_SPAM_PLACE')->name('_AJAX_SPAM_PLACE');
	Route::get('lvtn-unspam-places/{id}', 'CMS_EditDataController@_DETAIL_UNSPAM_PLACE')->name('_AJAX_UNSPAM_PLACE');
	Route::get('lvtn-services-details/{id}', 'CMS_ComponentController@_SERVICE_DETAILS')->name('_SERVICE_DETAILS');


	Route::get('lvtn-active-services/{id}', 'CMS_EditDataController@_DETAIL_ACTIVE_SERVICE')->name('_AJAX_ACTIVE_SERVICES');
	Route::get('lvtn-unactive-services/{id}', 'CMS_EditDataController@_DETAIL_UNACTIVE_SERVICES')->name('_DETAIL_UNACTIVE_SERVICES');
	Route::get('lvtn-spam-services/{id}', 'CMS_EditDataController@_AJAX_SPAM_SERVICES')->name('_AJAX_SPAM_SERVICES');
	Route::get('lvtn-unspam-services/{id}', 'CMS_EditDataController@_DETAIL_UNSPAM_SERVICES')->name('_DETAIL_UNSPAM_SERVICES');
	Route::get('lvtn-services-details/{id}', 'CMS_ComponentController@_SERVICE_DETAILS')->name('_SERVICE_DETAILS');


	Route::get('lvtn-login', 'CMS_ComponentController@login_admin')->name('login_admin');
	Route::post('login-admin','loginController@login_admin')->name('login-admin');

	// thong bao 
	Route::get('get-event-admin','EventsController@get_event_admin');

	Route::get('ajax-edit-point/id={id}&diem={point_rate}&tieude={point_title}&mota={point_description}', 'CMS_EditDataController@EditPoint');

	Route::get('crawer-places', 'CMS_CrawlerController@Crawler');
	Route::get('/web/crawler/thecodingstuff', function() {
	    $crawler = Goutte::request('GET', 'https://thecodingstuff.com');
	    $crawler->filter('h2.blog-entry-title a')->each(function ($node) {
	      dump($node->text());
	    });
	});


	Route::get('get-view-crawler', 'CMS_CrawlerController@getViewLink')->name('getViewLink');
	Route::post('get-view-crawler', 'CMS_CrawlerController@CrawlerStep1');
	// Route::get('get-view-crawler-step-1', 'CMS_CrawlerController@CrawlerStep1')->name('getViewLink');



	Route::post('crawler-1', 'CMS_CrawlerController@Post1');
	Route::post('crawler-2', 'CMS_CrawlerController@Post2');
	Route::post('crawler-3', 'CMS_CrawlerController@Post3');
	Route::post('crawler-4', 'CMS_CrawlerController@Post4');
	Route::post('crawler-5', 'CMS_CrawlerController@Post5');
	Route::post('crawler-6', 'CMS_CrawlerController@Post6');
	Route::post('crawler-7', 'CMS_CrawlerController@Post7');
	Route::post('crawler-8', 'CMS_CrawlerController@Post8');
	Route::post('crawler-9', 'CMS_CrawlerController@Post9');
	Route::post('crawler-10', 'CMS_CrawlerController@Post10');

