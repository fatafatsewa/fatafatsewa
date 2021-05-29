<?php
if(file_exists(storage_path('installed'))){
	$check = DB::table('settings')->where('id', 94)->first();
	if($check->value == 'Maintenance'){
		$middleware = ['installer','env'];
	}
	else{
		$middleware = ['installer'];
	}
}
else{
	$middleware = ['installer'];
}
Auth::routes(['verify' => true]);
Route::get('email/verify/{id}/{hash}', 'Web\CustomersController@verifyEmail')->name('verification.verify');
Route::get('/maintance','Web\IndexController@maintance');

Route::group(['namespace' => 'Web','middleware' => ['installer']], function () {
Route::get('/login', 'CustomersController@login');
// Route::get('/login', function() {
// 	return redirect('/');	
// });
Route::post('/process-login', 'CustomersController@processLogin');
Route::get('/logout', 'CustomersController@logout')->middleware('Customer');
});
Route::group(['namespace' => 'Web','middleware' => $middleware], function () {
	Route::get('general_error/{msg}', function($msg) {
		 return view('errors.general_error',['msg' => $msg]);
	});
	// route for to show payment form using get method
		Route::get('pay', 'RazorpayController@pay')->name('pay');
    	Route::post('/paytm-callback', 'PaytmController@paytmCallback');
		Route::get('/store_paytm', 'PaytmController@store');
		// route for make payment request using post method
		Route::post('dopayment', 'RazorpayController@dopayment')->name('dopayment');
		Route::get('/','IndexController@index');
		Route::post('/change_language', 'WebSettingController@changeLanguage');
		Route::post('/change_currency', 'WebSettingController@changeCurrency');
		Route::post('/addToCart', 'CartController@addToCart');
		Route::post('/addToCartFixed', 'CartController@addToCartFixed');
		Route::post('/addToCartResponsive', 'CartController@addToCartResponsive');
		
		
		Route::post('/modal_show', 'ProductsController@ModalShow');
		Route::post('/reviews', 'ProductsController@reviews');
		Route::get('/deleteCart', 'CartController@deleteCart');
		Route::get('/viewcart', 'CartController@viewcart');
		Route::get('/editcart/{id}/{slug}', 'CartController@editcart');
		Route::post('/updateCart', 'CartController@updateCart');
		Route::post('/updatesinglecart', 'CartController@updatesinglecart');
		Route::get('/cartButton', 'CartController@cartButton');

		Route::get('/profile', 'CustomersController@profile')->middleware('Customer');
		Route::get('/change-password', 'CustomersController@changePassword')->middleware('Customer');
		Route::get('/refer-friends', 'CustomersController@referFriends')->middleware('Customer');
		Route::post('/generate-referral-code', 'CustomersController@generateReferralCode')->middleware('Customer');
		
		Route::get('/wishlist', 'CustomersController@wishlist')->middleware('Customer');
		Route::post('/updateMyProfile', 'CustomersController@updateMyProfile')->middleware('Customer');
		Route::post('/updateMyPassword', 'CustomersController@updateMyPassword')->middleware('Customer');
		Route::get('UnlikeMyProduct/{id}', 'CustomersController@unlikeMyProduct')->middleware('Customer');
		Route::post('likeMyProduct', 'CustomersController@likeMyProduct');
		Route::post('addToCompare', 'CustomersController@addToCompare');
		Route::get('compare', 'CustomersController@Compare')->middleware('Customer');
		Route::get('deletecompare/{id}', 'CustomersController@DeleteCompare')->middleware('Customer');
		Route::get('/orders', 'OrdersController@orders')->middleware('Customer');
		Route::get('/view-order/{id}', 'OrdersController@viewOrder')->middleware('Customer');
		Route::post('/updatestatus/', 'OrdersController@updatestatus')->middleware('Customer');
		Route::get('/shipping-address', 'ShippingAddressController@shippingAddress')->middleware('Customer');
		Route::post('/addMyAddress', 'ShippingAddressController@addMyAddress')->middleware('Customer');
		Route::post('/myDefaultAddress', 'ShippingAddressController@myDefaultAddress')->middleware('Customer');
		Route::post('/update-address', 'ShippingAddressController@updateAddress')->middleware('Customer');
		Route::get('/delete-address/{id}', 'ShippingAddressController@deleteAddress')->middleware('Customer');
		Route::post('/ajaxZones', 'ShippingAddressController@ajaxZones');
		//news section
		Route::get('/news', 'NewsController@news');
		Route::get('/news-detail/{slug}', 'NewsController@newsDetail');
		Route::post('/loadMoreNews', 'NewsController@loadMoreNews');
		Route::get('/page', 'IndexController@page');
		Route::get('/shop', 'ProductsController@shop');
		Route::post('/shop', 'ProductsController@shop');
		Route::get('/product-detail/{slug}', 'ProductsController@productDetail')->name("website.product-detail");
		Route::get('/ajax/product-images/{slug}', 'ProductsController@productImages');
	// Route::post('/product/apply-emi', 'ProductsController@applyEmiForm');

		Route::post('/filterProducts', 'ProductsController@filterProducts');
		Route::post('/getquantity', 'ProductsController@getquantity');

		Route::get('/guest_checkout', 'OrdersController@guest_checkout');
		Route::get('/checkout', 'OrdersController@checkout')->middleware('Customer');
		Route::post('/checkout/use-points', 'OrdersController@setPointsSession');
		Route::post('/checkout_shipping_address', 'OrdersController@checkout_shipping_address')->middleware('Customer');
		Route::post('/checkout_billing_address', 'OrdersController@checkout_billing_address')->middleware('Customer');
		Route::post('/checkout_payment_method', 'OrdersController@checkout_payment_method')->middleware('Customer');
		Route::post('/paymentComponent', 'OrdersController@paymentComponent')->middleware('Customer');
		Route::post('/place_order', 'OrdersController@place_order')->middleware('Customer');
		Route::get('/orders', 'OrdersController@orders')->middleware('Customer');
		Route::post('/updatestatus/', 'OrdersController@updatestatus')->middleware('Customer');
		Route::post('/myorders', 'OrdersController@myorders')->middleware('Customer');
		Route::get('/stripeForm', 'OrdersController@stripeForm')->middleware('Customer');
		Route::get('/view-order/{id}', 'OrdersController@viewOrder')->middleware('Customer');
		Route::post('/pay-instamojo', 'OrdersController@payIinstamojo')->middleware('Customer');
		Route::get('/thankyou', 'OrdersController@thankyou')->middleware('Customer');

		//ESEWA PAYMENT ROUTES
		Route::post('/process-esewa', 'OrdersController@processEsewaPayment');
		Route::get('/esewa-completed', 'OrdersController@completeEsewaPayment')->name('esewa-completed');


			//CELLPAY PAYMENT ROUTES
			Route::get('/process-cellpay', 'OrdersController@processCellpayPayment')->name('process-cellpay');
			Route::post('/process-cellpay', 'OrdersController@processCellpayPayment')->name('process-cellpay');
	
		//paystack
		Route::get('/paystack/transaction', 'OrdersController@paystackTransaction')->middleware('Customer');
		Route::get('/paystack/verify/transaction', 'OrdersController@authorizepaystackTransaction')->middleware('Customer');
		
		//paystack
		Route::get('/midtrans/transaction', 'MidtransController@midtransTransaction')->middleware('Customer');
		// Route::get('/midtrans/verify/transaction', 'OrdersController@authorize<idtransTransaction')->middleware('Customer');
		
		Route::get('/checkout/hyperpay', 'OrdersController@hyperpay')->middleware('Customer');
		Route::get('/checkout/hyperpay/checkpayment', 'OrdersController@checkpayment')->middleware('Customer');
		Route::post('/checkout/payment/changeresponsestatus', 'OrdersController@changeresponsestatus')->middleware('Customer');
		Route::post('/apply_coupon', 'CartController@apply_coupon');
		Route::get('/removeCoupon/{id}', 'CartController@removeCoupon')->middleware('Customer');

		Route::get('/signup', 'CustomersController@signup');
		Route::get('/logoutt', 'CustomersController@logout')->middleware('Customer');
		Route::post('/signupProcess', 'CustomersController@signupProcess');
		Route::post('/ajaxsignupProcess', 'CustomersController@ajaxSignupProcess');
		Route::post('/otp-login-process', 'CustomersController@otpLoginProcess');

		Route::get('/forgotPassword', 'CustomersController@forgotPassword');
		Route::get('/recoverPassword', 'CustomersController@recoverPassword');
		Route::post('/processPassword', 'CustomersController@processPassword');


		Route::get('login/{social}', 'CustomersController@socialLogin');
		Route::get('login/{social}/callback', 'CustomersController@handleSocialLoginCallback');
		Route::post('/commentsOrder', 'OrdersController@commentsOrder');
		Route::post('/subscribeNotification/', 'CustomersController@subscribeNotification');
		Route::get('/contact', 'IndexController@contactus');
		Route::post('/processContactUs', 'IndexController@processContactUs');
		
		Route::get('/setcookie', 'IndexController@setcookie');
		Route::get('/newsletter', 'IndexController@newsletter');

		Route::get('/subscribeMail', 'IndexController@subscribeMail');
		Route::get('/setSession', 'IndexController@setSession');

		Route::post('/product/apply-emi/validate', 'EmiController@validateEmiForm');
		Route::post('/product/apply-emi', 'EmiController@applyEmi');

		// Route::get('/warranty-check', 'WarrantyController@index');
		Route::get('/warranty-check', 'WarrantyController@checkWarranty');
		Route::get('/refer-n-earn/{referral}', 'CustomersController@referAndEarn')->name('refer-n-earn');

		Route::get('/exchange-apply', 'ExchangeController@index');
		Route::post('/exchange-apply', 'ExchangeController@postExchange');

		//Repair
		Route::get('/repair-request', 'ExchangeController@repair');
		Route::post('/repair-request', 'ExchangeController@postRepair');
		//OTP
		Route::post('/web/send-otp', 'CustomersController@sendOTP');
		Route::post('/web/validate-otp', 'CustomersController@validateOTP');

		Route::get('/emi-products', 'EmiController@emiProducts');
		//Pre-order
		Route::get('/preorder-request', 'PreOrderController@index')->name('website.pre-order');
		Route::post('/preorder-request', 'PreOrderController@postPreOrder');


		Route::get('/product/search', 'ProductsController@produtSearchSuggestion');

//CAtegory Detail
	Route::get('/category/{category_slug}', 'CategoryController@getCategoryDetail');

		//HOMEPAGE PRODUCT CATEGORY AJAX
		Route::get('/ajax/category/{id}/products', 'IndexController@getAjaxProducts');
	});

	Route::get('/test', 'Web\IndexController@test1');


	// Route::get('/email-test', function() {
	// 	Mail::send('/mail/test-mail', [], function ($m) {
	// 		$m->to('jeewandhakal25@gmail.com')->subject("EMI request has been placed")->getSwiftMessage()
	// 			->getHeaders()
	// 			->addTextHeader('x-mailgun-native-send', 'true');
	// 	});
	// });