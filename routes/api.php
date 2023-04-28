<?php

use App\Http\Controllers\ActiveUsersController;
use App\Http\Controllers\AdvertThemeController;
use App\Http\Controllers\API\DineUserController;
use App\Http\Controllers\API\HouseDetailsController;
use App\Http\Controllers\API\FiftyController;
use App\Http\Controllers\SeventyFiveController;
use App\Http\Controllers\API\HundredController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\customer_review_controller;
use App\Http\Controllers\LikePageController;
use App\Http\Controllers\NearbyServicesController;
use App\Http\Controllers\MPESAController;
use App\Http\Controllers\ReviewPage;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\HouseThemeController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductCategory;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSubCategory;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ShopThemeController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\TargetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// orderItem
Route::post('/add-order-item', [OrderItemController::class, 'addOrderItem']);
Route::get('/get-single-order-items/{id}', [OrderItemController::class, 'getSingleOrderItems']);
Route::get('/get-all-order-items', [OrderItemController::class, 'getAllOrderItems']);

// Active users
Route::post('/add-active-user', [ActiveUsersController::class, 'addActiveUser']);
Route::get('/get-active-user/{id}', [ActiveUsersController::class, 'getActiveUser']);
Route::get('/get-all-active-users/{year}', [ActiveUsersController::class, 'getAllActiveUsers']);
Route::post('/update-active-user/{id}', [ActiveUsersController::class, 'updateActiveUser']);

// Deposit
Route::post('/add-deposit', [DepositController::class, 'addDeposit']);
Route::get('/get-all-user-transactions/{id}', [DepositController::class, 'getAllUserTransaction']);

//  Target
Route::post('/add-target', [TargetController::class, 'addTarget']);
Route::get('/get-single-target/{id}', [TargetController::class, 'getSingleTarget']);
Route::post('/update-single-target/{id}', [TargetController::class, 'updateSingleTarget']);
// Purchases
Route::post('/add-purchase-details', [PurchaseController::class, 'addPurchaseDetails']);
Route::get('/get-single-purchase-details/{id}', [PurchaseController::class, 'getSinglePurchaseDetails']);
Route::get('/get-seller-purchase-details/{id}', [PurchaseController::class, 'getSellerPurchaseDetails']);
Route::get('/get-buyer-purchase-details/{id}', [PurchaseController::class, 'getBuyerPurchaseDetails']);
Route::get('/get-all-purchases', [PurchaseController::class, 'getAllPurchases']);
Route::post('/update-single-purchase-details-shipped/{id}', [PurchaseController::class, 'updateSinglePurchaseDetailsShipped']);
Route::post('/update-single-purchase-details-received/{id}', [PurchaseController::class, 'updateSinglePurchaseDetailsReceived']);


// Subscribers
Route::post('/add-subscription', [SubscriberController::class, 'addSubscription']);

// Advert theme
Route::post('/add-advert-theme', [AdvertThemeController::class, 'addAdvertTheme']);
Route::get('/get-all-advert-themes', [AdvertThemeController::class, 'getAllAdvertThemes']);
Route::get('/get-single-advert-theme/{id}', [AdvertThemeController::class, 'getSingleAdvertTheme']);
Route::post('/update-single-advert-theme/{id}', [AdvertThemeController::class, 'updateSingleAdvertTheme']);
Route::delete('/delete-single-advert-theme/{id}', [AdvertThemeController::class, 'deleteSingleAdvertTheme']);

// shop theme
Route::post('/add-shop-theme', [ShopThemeController::class, 'addShopTheme']);
Route::get('/get-all-shop-themes', [ShopThemeController::class, 'getAllShopThemes']);
Route::get('/get-single-shop-themes/{id}', [ShopThemeController::class, 'getSingleShopThemes']);
Route::post('/update-single-shop-theme/{id}', [ShopThemeController::class, 'updateSingleShopTheme']);
Route::delete('/delete-single-shop-theme/{id}', [ShopThemeController::class, 'deleteSingleShopTheme']);

// House theme
Route::post('/add-house-theme', [HouseThemeController::class, 'addHouseTheme']);
Route::get('/get-all-house-themes', [HouseThemeController::class, 'getAllHouseThemes']);
Route::get('/get-single-house-themes/{id}', [HouseThemeController::class, 'getSingleHouseThemes']);
Route::post('/update-single-house-theme/{id}', [HouseThemeController::class, 'updateSingleHouseTheme']);
Route::delete('/delete-single-house-theme/{id}', [HouseThemeController::class, 'deleteSingleHouseTheme']);

// Blog post category
Route::post('/add-post-category', [PostCategoryController::class, 'addPostCategory']);
Route::get('/get-all-post-category', [PostCategoryController::class, 'getAllPostsCategory']);
Route::delete('/delete-single-post-category/{id}', [PostCategoryController::class, 'deleteSinglePostCategory']);

// Blog posts
Route::post('/add-blog-post', [PostController::class, 'addBlogPost']);
Route::get('/get-all-blog-posts', [PostController::class, 'getBlogPosts']);
Route::get('/get-paginated-blog-posts', [PostController::class, 'getPaginatedBlogPosts']);
Route::get('/get-single-blog-post/{id}', [PostController::class, 'getSingleBlogPost']);
Route::get('/get-single-blog-user-post/{id}', [PostController::class, 'getSingleBlogUserPost']);
Route::post('/update-single-blog-post/{id}', [PostController::class, 'updateSingleBlogPost']);
Route::delete('/delete-single-blog-post/{id}', [PostController::class, 'deleteSingleBlogPost']);

// Product
Route::post('/add-product-item', [ProductController::class, 'storeProductItem']);
Route::get('/get-all-product-items', [ProductController::class, 'getAllProductItems']);
Route::get('/get-all-product-items-real', [ProductController::class, 'getAllProductItemsReal']);
Route::get('/get-single-product-item/{id}', [ProductController::class, 'getSingleProductItem']);
Route::get('/get-all-product-item-with-category/{name}', [ProductController::class, 'getSingleProductItemWithCategory']);
Route::get('/get-all-product-item-with-user', [ProductController::class, 'getSingleProductItemWithUser']);
Route::get('/get-account-products/{id}', [ProductController::class, 'getAccountProducts']);
Route::get('/get-account-single-products/{id}', [ProductController::class, 'getAccountSingleProducts']);
Route::post('/update-single-product-item/{id}', [ProductController::class, 'updateProductSingleItem']);
Route::delete('/delete-single-product-item/{id}', [ProductController::class, 'deleteProductSingleItem']);

// Product subcategory
Route::post('/add-product-subcategory', [ProductSubCategory::class, 'storeProductSubcategory']);
Route::get('/get-all-product-subcategory', [ProductSubCategory::class, 'getAllProductSubCategory']);
Route::get('/get-product-subcategory/{id}', [ProductSubCategory::class, 'getProductSubCategory']);
Route::get('/get-single-product-subcategory/{id}', [ProductSubCategory::class, 'getProductSingleSubcategory']);
Route::post('/update-single-product-subcategory/{id}', [ProductSubCategory::class, 'updateProductSingleSubcategory']);
Route::delete('/delete-single-product-subcategory/{id}', [ProductSubCategory::class, 'deleteProductSingleSubcategory']);

// Product category
Route::post('/add-product-category', [ProductCategory::class, 'storeProductCategory']);
Route::get('/get-product-category', [ProductCategory::class, 'getProductCategory']);
Route::get('/get-single-product-category/{id}', [ProductCategory::class, 'getProductSingleCategory']);
Route::post('/update-single-product-category/{id}', [ProductCategory::class, 'updateProductSingleCategory']);
Route::delete('/delete-single-product-category/{id}', [ProductCategory::class, 'deleteProductSingleCategory']);

// contact page Routes
Route::post('/add-contact-info', [ContactController::class, 'storeContactInfo']);

// CUSTOMER REVIEW PAGE
Route::post('/update-customer-review/{id}', [customer_review_controller::class, 'updateCustomerReview']);
Route::get('/get-all-specific-customer-review/{id}', [customer_review_controller::class, 'getAllSpecificCustomerReviews']);
Route::post('/add-customer-review', [customer_review_controller::class, 'addCustomerReview']);

// REVIEW PAGE
Route::post('/update-review/{id}', [ReviewPage::class, 'updateReview']);
Route::get('/get-all-specific-review/{id}', [ReviewPage::class, 'getAllSpecificReviews']);
Route::get('/get-all-specific-review-for-admin', [ReviewPage::class, 'getAllSpecificReviewsForAdmin']);
Route::post('/add-review', [ReviewPage::class, 'addReview']);

// MPESA ROUTES controllers


Route::get('v1/access-token',[MPESAController::class,'generateAccessToken']);
Route::get('v1/register/url',[MPESAController::class,'mpesaRegisterUrls']);
Route::post('v1/validation',[MPESAController::class,'mpesaValidation']);

// STK
Route::post('v1/stk/push',[MPESAController::class,'customerMpesaSTKPush']);
Route::post('v1/stk/push_call_back',[MPESAController::class,'customerMpesaSTKPushCallBack']);


Route::post('v1/transaction/confirmation',[MPESAController::class,'mpesaConfirmation']);

// Nearby services
Route::post('/update-nearby-services/{id}', [NearbyServicesController::class, 'updateNearbyServices']);
Route::get('/get-nearby-services/{id}', [NearbyServicesController::class, 'getNearbyServices']);
Route::post('/add-nearby-services', [NearbyServicesController::class, 'storeNearbyServices']);

// Like page Routes
Route::post('/add-house-like', [LikePageController::class, 'storeLike']);
Route::get('/get-house-like/{id}', [LikePageController::class, 'getHouseLike']);

//Booking Routes
Route::delete('/delete-customer-booking-two/{id}', [BookingController::class, 'deleteCustomerBookingTwo']);
Route::delete('/delete-customer-booking/{id}', [BookingController::class, 'deleteCustomerBooking']);
Route::get('/get-total-booked-for-admin', [BookingController::class, 'getTotalBookedForAdmin']);
Route::get('/get-total-booked-for-host/{id}', [BookingController::class, 'getTotalBookedForHost']);
Route::get('/get-total-booked/{id}', [BookingController::class, 'getTotalBooked']);
Route::get('/get-booked-info/{id}', [BookingController::class, 'getBookedInfo']);
Route::get('/get-booked-dates/{id}', [BookingController::class, 'getBookedDates']);

Route::get('/get-to-booking-info/{id}', [BookingController::class, 'getToBookingInfo']);
Route::post('/update-booking-info/{id}', [BookingController::class, 'updateBookingInfo']);
Route::post('/booking-email', [BookingController::class, 'bookingEmail']);
Route::post('/add-booking-info', [BookingController::class, 'storeBookingInfo']);

//Thousand Routes
Route::get('/get-join-thousand-details/{id}', [HundredController::class, 'getJoinThousandDetails']);
Route::get('/get-thousand-details/{id}', [HundredController::class, 'getThousandDetails']);

//Hundred Routes
Route::post('/delete-house-part16/{house_id}', [HundredController::class, 'deleteHousePart16']);
Route::post('/delete-house-part15/{house_id}', [HundredController::class, 'deleteHousePart15']);
Route::post('/delete-house-part14/{house_id}', [HundredController::class, 'deleteHousePart14']);
Route::post('/delete-house-part13/{house_id}', [HundredController::class, 'deleteHousePart13']);
Route::post('/delete-house-part12/{house_id}', [HundredController::class, 'deleteHousePart12']);
Route::post('/delete-house-part11/{house_id}', [HundredController::class, 'deleteHousePart11']);
Route::post('/delete-house-part10/{house_id}', [HundredController::class, 'deleteHousePart10']);
Route::post('/delete-house-part9/{house_id}', [HundredController::class, 'deleteHousePart9']);
Route::post('/delete-house-part8/{house_id}', [HundredController::class, 'deleteHousePart8']);
Route::post('/delete-house-part7/{house_id}', [HundredController::class, 'deleteHousePart7']);
Route::post('/delete-house-part6/{house_id}', [HundredController::class, 'deleteHousePart6']);
Route::post('/delete-house-part5/{house_id}', [HundredController::class, 'deleteHousePart5']);
Route::post('/delete-house-part4/{house_id}', [HundredController::class, 'deleteHousePart4']);
Route::post('/delete-house-part3/{house_id}', [HundredController::class, 'deleteHousePart3']);
Route::post('/delete-house-part2/{house_id}', [HundredController::class, 'deleteHousePart2']);
Route::post('/delete-house-part/{house_id}', [HundredController::class, 'deleteHousePart']);

Route::get('/get-hundred-details', [HundredController::class, 'getHundredDetails']);
Route::get('/get-sun-details/{user_id}', [HundredController::class, 'getSunDetails']);
Route::post('/update-hundred-details/{user_id}', [HundredController::class, 'updateHundredDetails']);
Route::post('/add-hundred-details', [HundredController::class, 'storeHundred']);

//Seventy Routes
Route::get('/get-join-seventy-five-details/{id}', [SeventyFiveController::class, 'getJoinFiveDetails']);
Route::get('/get-seventy-five-details/{id}', [SeventyFiveController::class, 'getSeventyFiveDetails']);
Route::get('/get-stars-details/{user_id}', [SeventyFiveController::class, 'getStarsDetails']);
Route::post('/update-seventy_five-details/{user_id}', [SeventyFiveController::class, 'updateSeventyFiveDetails']);
Route::post('/add-seventy_five-details', [SeventyFiveController::class, 'storeSeventyFive']);

// Fifty Routes
Route::get('/get-join-fifty-details/{id}', [FiftyController::class, 'getJoinFiftyDetails']);
Route::get('/get-fifty-details/{id}', [FiftyController::class, 'getFiftyDetails']);
Route::get('/get-moon-details/{user_id}', [FiftyController::class, 'getMoonDetails']);
Route::post('/update-fifty-details/{user_id}', [FiftyController::class, 'updateFiftyDetails']);
Route::post('/add-fifty-details', [FiftyController::class, 'storeFifty']);

// House Details routes
Route::get('/get-all-house-more-details/{id}', [HouseDetailsController::class, 'getAllHouseMoreDetails']);

Route::get('/get-all-home-more-details', [HouseDetailsController::class, 'getAllHomeMoreDetails']);


Route::get('/get-join-magic-details', [HouseDetailsController::class, 'getJoinMagicDetails']);
Route::get('/get-magic-details/{magic_id}', [HouseDetailsController::class, 'getMagicDetails']);
Route::get('/get-hello-details/{user_id}', [HouseDetailsController::class, 'getHelloDetails']);

Route::get('/get-host-houses-details/{user_id}', [HouseDetailsController::class, 'getHostHousesDetails']);

Route::get('/get-zero-details/{id}', [HouseDetailsController::class, 'getZeroDetails']);
Route::get('/get-house-details', [HouseDetailsController::class, 'getHouseDetails']);
Route::post('/update-house-details/{user_id}', [HouseDetailsController::class, 'updateHouseDetails']);
Route::post('/add-house-details', [HouseDetailsController::class, 'storeHouseDetails']);

Route::delete('/delete-house/{id}', [HouseDetailsController::class, 'deleteHouse']);

// Dine users Routes
Route::post('/forgot-password/{e_mail}', [DineUserController::class, 'forgotPassword']);
Route::post('/login', [DineUserController::class, 'getIn']);
Route::get('/get-host-join-details/{id}', [DineUserController::class, 'getHostJoinDetails']);
Route::get('/get-host-specific-details/{id}', [DineUserController::class, 'getHostSpecificDetails']);
Route::get('/get-gifted-specific-details/{id}', [DineUserController::class, 'getGiftedSpecificDetails']);
Route::get('/get-one-host-details/{id}', [DineUserController::class, 'getOneHostDetails']);
Route::delete('/delete-customer/{id}', [DineUserController::class, 'deleteCustomer']);
Route::delete('/delete-host/{id}', [DineUserController::class, 'deleteHost']);
Route::get('/get-all-host-details/{id}', [DineUserController::class, 'getAllHostDetails']);
Route::get('/get-host-details/{id}', [DineUserController::class, 'getHostDetails']);
Route::post('/update-forgotten-password/{email}', [DineUserController::class, 'updateForgottenPassword']);
Route::post('/update-host-online-details/{user_id}', [DineUserController::class, 'updateHostOnlineDetails']);
Route::post('/update-admin-online-details/{user_id}', [DineUserController::class, 'updateAdminOnlineDetails']);
Route::post('/update-blogger-online-details/{user_id}', [DineUserController::class, 'updateBloggerOnlineDetails']);
Route::post('/update-customer-online-details/{user_id}', [DineUserController::class, 'updateCustomerOnlineDetails']);
Route::post('/update-customer-profile-details/{user_id}', [DineUserController::class, 'updateCustomerProfileDetails']);
Route::post('/add-host', [DineUserController::class, 'storeUser']);
Route::post('/add-venturer', [DineUserController::class, 'storeVenturer']);
Route::post('/add-blog-blogger', [DineUserController::class, 'addBlogBlogger']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
