<?php

use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\FundraiserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CharityController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\CharityCampaignController;
use App\Http\Controllers\EventTransactionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

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

// cache clear
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
 });
//  cache clear

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::post('/loginto', [LoginController::class, 'loginToDonate'])->name('logintodonate');
Route::get('authorized/google', [SocialLoginController::class, 'redirectToGoogle']);
Route::get('authorized/google/callback', [SocialLoginController::class, 'handleGoogleCallback']);


Route::get('authorized/facebook', [SocialLoginController::class, 'redirectToFacebook']);
Route::get('authorized/facebook/callback', [SocialLoginController::class, 'handleFacebookCallback']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [FrontendController::class, 'index'])->name('homepage');
Route::get('/about', [FrontendController::class, 'about'])->name('frontend.about');
Route::get('/work', [FrontendController::class, 'work'])->name('frontend.work');
Route::get('/contact', [FrontendController::class, 'contact'])->name('frontend.contact');
Route::get('/privacy', [FrontendController::class, 'privacy'])->name('frontend.privacy');
Route::get('/terms', [FrontendController::class, 'terms'])->name('frontend.terms');
Route::get('/faq', [FrontendController::class, 'faq'])->name('frontend.faq');
Route::get('/non-profit', [FrontendController::class, 'nonprofit'])->name('frontend.nonprofit');
Route::get('/individual', [FrontendController::class, 'individual'])->name('frontend.individual');
Route::get('/fundriser', [FrontendController::class, 'fundriser'])->name('frontend.fundriser');

Route::post('/contact-submit', [FrontendController::class, 'visitorContact'])->name('contact.submit');
Route::get('/campaign/{id}', [FrontendController::class, 'campaignDetails'])->name('frontend.campaignDetails');

Route::get('/event/{id}', [FrontendController::class, 'eventDetails'])->name('frontend.eventDetails');

Route::get('/charity-info/{id}', [FrontendController::class, 'charityDetails'])->name('frontend.charityDetails');
/*----------------------Charity Registration-----------------------*/
Route::get('/charity-registration', [CharityController::class, 'charity'])->name('charity.register');
Route::post('/charity-registration', [CharityController::class, 'charityregistration'])->name('charity.registration');


// get event type
Route::post('gettype', [EventController::class, 'getEventTicketType']);

//search
Route::post('/get-charity-campaign', [CharityController::class, 'getCharityForCampaign']);

Route::get('charity/charity-images/{id}', [CharityController::class, 'charityImageDelete']);

// campaign donate
Route::get('/campaign-donate/{id}', [CampaignController::class, 'campaignDonate'])->name('frontend.campaignDonate');
Route::get('/charity-donate/{id}', [CharityController::class, 'charityDonate'])->name('frontend.charityDonate');

// payment
Route::post('/campaign-payment', [StripeController::class,'CampaignPyament'])->name("stripe.post");
Route::post('/charity-payment', [StripeController::class,'charityPyament'])->name("charitypayment");
Route::post('/event-payment', [StripeController::class,'eventPyament'])->name("eventpayment");



Route::post('campaign-pay', [PaypalController::class, 'campaignpaymentpay'])->name('campaignpayment');
Route::get('campaign-success', [PaypalController::class, 'campaignpaymentsuccess']);
Route::get('campaign-error', [PaypalController::class, 'campaignpaymenterror']);



Route::post('charity-pay', [PaypalController::class, 'charitypaymentpay'])->name('paypalcharitypayment');
Route::get('charity-success', [PaypalController::class, 'charitypaymentsuccess']);
Route::get('charity-error', [PaypalController::class, 'charitypaymenterror']);


// event paypal payments
Route::post('pay', [PaypalController::class, 'pay'])->name('payment');
Route::get('success', [PaypalController::class, 'success']);
Route::get('error', [PaypalController::class, 'error']);

// event booking 

Route::post('event-book', [EventController::class, 'freeEventbooked']); 


/*------------------------------------------
--------------------------------------------
All Normal Authenticate Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['middleware' => ['auth']], function(){

    // start a new campaign
    Route::get('/start-a-new-campaign', [CampaignController::class, 'step1_show_startCampaign'])->name('newcampaign_show');
    Route::post('/start-a-new-campaign', [CampaignController::class, 'step1_post_startCampaign'])->name('newcampaign_post');

    Route::get('/campaign-information', [CampaignController::class, 'step2_show_CampaignGeneralInfo'])->name('newcampaigngeninfo_show');
    Route::post('/campaign-information', [CampaignController::class, 'step2_post_CampaignGeneralInfo'])->name('newcampaigngeninfo_post');

    Route::get('/campaign-basic-information', [CampaignController::class, 'step3_show_CampaignBasicInfo'])->name('campaignBasicInfo_show');
    Route::post('/campaign-basic-information', [CampaignController::class, 'step3_post_CampaignBasicInfo'])->name('campaignBasicInfo_post');

    //step 4
    Route::get('/campaign-personal-information', [CampaignController::class, 'step4_show_CampaignPersonalInfo'])->name('campaignPersonalInfo_show');
    Route::post('/campaign-personal-information', [CampaignController::class, 'step4_post_CampaignPersonalInfo'])->name('campaignPersonalInfo_post');

    //step 5
    Route::get('/campaign-bank-information', [CampaignController::class, 'step5_show_startCampaignBankInfo'])->name('campaignBankInfo_show');
    Route::post('/campaign-bank-information', [CampaignController::class, 'step5_post_startCampaignBankInfo'])->name('campaignBankInfo_post');

    //step 6
    Route::get('/campaign-terms-condition', [CampaignController::class, 'step6_show_CampaignTermsCondition'])->name('campaignTermCondition_show');
    Route::post('/campaign-confirmations', [CampaignController::class, 'step6_post_Campaignconfirmation'])->name('campaignTermCondition_post');

    // new campaign data store
    Route::post('/campaign-confirmations', [CampaignController::class, 'startCampaign_dataStore'])->name('campaignConfirmation_post');


    Route::post('/campaign-message', [FrontendController::class, 'campaignMessage'])->name('campaign.message');

    // comment 
    Route::post('/campaign-comment', [CommentController::class, 'campaignComment'])->name('campaign.comment');
    
    // Route::get('stripe', [StripeController::class, 'stripe']);
    
    Route::get('/referral/campaign', [FundraiserController::class, 'getCampaignReferralLink']);
    Route::post('/referral/campaign', [FundraiserController::class, 'storeCampaignReferralLink'])->name('user.confirmrefcapmaign');

    
    
    
    
    // image download
    Route::get('image-download/{id}', [CampaignController::class, 'downloadImage'])->name('download.campaignimage');
    Route::get('feature-image-download/{id}', [CampaignController::class, 'downloadFeatureImage'])->name('download.featureimage');
    Route::get('bankdoc-download/{id}', [CampaignController::class, 'downloadBankDoc'])->name('download.bankdoc');


});



/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' =>'user/', 'middleware' => ['auth', 'is_user']], function(){

    Route::post('profile-update', [UserController::class, 'updateProfile'])->name('user.updateprofile');
    Route::get('user-profile', [HomeController::class, 'userHome'])->name('user.profile');
    Route::get('donation-history', [DonationController::class, 'donationHistory'])->name('user.donationhistory');
    Route::get('my-campaign', [FundraiserController::class, 'activeCampaign'])->name('user.activecampaign');
    Route::get('ref-campaign', [FundraiserController::class, 'referralCampaign'])->name('user.refcampaign');
    Route::get('all-transaction', [TransactionController::class, 'allTransaction'])->name('user.alltransaction');
    Route::get('start-a-new-campaign', [CampaignController::class, 'newCampaign'])->name('user.newcampaign');
    Route::post('fund-raise', [CampaignController::class, 'newCampaignStore'])->name('user.newcampaignstore');

    Route::post('/campaign-update', [CampaignController::class, 'updateCampaignByUser']);
    Route::post('/campaign-image-store', [CampaignController::class, 'campaignDocStoreByUser']);
    Route::get('/campaign-image-delete/{id}', [CampaignController::class, 'deleteCampaignImageByAdmin']);

    
    Route::get('/campaign-transaction/{id}', [CampaignController::class, 'getCamTranByUser'])->name('user.camtransaction');

    // campaign edit 
    Route::get('campaign-edit/{id}', [CampaignController::class, 'campaignEdit'])->name('user.campaignedit');


    
    Route::get('my-event', [EventController::class, 'getEventByUser'])->name('user.myevent');
    Route::get('my-event-document', [EventController::class, 'getEventDocByUser'])->name('user.eventdocument');
    // start a new event
    Route::get('/start-a-new-event', [EventController::class, 'start_new_event'])->name('start_new_event');
    Route::post('create-a-event', [EventController::class, 'eventCreateByUser']);

    Route::get('/event-edit/{id}', [EventController::class, 'eventEditByUser'])->name('user.eventEdit');
    Route::get('/event-ticket-sale/{id}', [EventController::class, 'eventTicketSaleShowByUser'])->name('user.eventTicketSales');
    Route::post('update-event', [EventController::class, 'eventUpdateByUser']);
    Route::get('/event-price/{id}', [EventController::class, 'viewEventPriceByUser'])->name('user.eventPrice');

    
    Route::post('event-withdraw-request', [EventController::class, 'eventWithReqByUser']);

    Route::get('/event-transaction/{id}', [EventTransactionController::class, 'getEventTran'])->name('user.eventtransaction');

    
    // charity campaign
    Route::get('/charity-campaign', [FrontendController::class, 'charityCampaign'])->name('frontend.charityCampaign');
    
    Route::get('/start-a-charity-campaign/{id}', [CharityCampaignController::class, 'startCharityCampaign'])->name('frontend.startcharitycampaign');
    Route::post('/create-a-charity-campaign', [CharityCampaignController::class, 'storeCharityCampaign']);

});
  
/*------------------------------------------
--------------------------------------------
All Agent Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' =>'charity/', 'middleware' => ['auth', 'is_agent']], function(){
  
    Route::get('charity-profile', [HomeController::class, 'charityHome'])->name('charity.profile');
    Route::post('profile-update', [UserController::class, 'updateCharityProfile'])->name('charity.updateprofile');
    Route::get('all-transaction', [TransactionController::class, 'allCharityTransaction'])->name('charity.alltransaction');
    Route::get('charity-details', [CharityController::class, 'charityDetails'])->name('charity.charity_details');
    Route::get('bank-information', [CharityController::class, 'charityBankDetails'])->name('charity.bank_details');

    
    Route::post('charity-images', [CharityController::class, 'charityImageStore'])->name('charity.image');
    Route::get('charity-images/{id}', [CharityController::class, 'charityImageDelete']);
    
    Route::post('charity-description', [CharityController::class, 'charityDescription'])->name('charity.description');
    Route::post('charity-bank-info', [CharityController::class, 'charitybankInfo']);
    Route::post('withdraw-request', [CharityController::class, 'charityWithReq']);

});
  

