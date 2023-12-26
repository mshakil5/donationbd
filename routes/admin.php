<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CharityController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\WhyChooseUsController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\FundraiserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventTransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ContactMailController; 
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FundraisingSourceController;
use App\Http\Controllers\Admin\EmailContentController;
use App\Http\Controllers\Admin\GivingLevelController;



/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' =>'admin/', 'middleware' => ['auth', 'is_admin']], function(){
  
    Route::get('/dashboard', [HomeController::class, 'adminHome'])->name('admin.dashboard');
    //profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('profile/{id}', [AdminController::class, 'adminProfileUpdate']);
    Route::post('changepassword', [AdminController::class, 'changeAdminPassword']);
    Route::put('image/{id}', [AdminController::class, 'adminImageUpload']);
    //profile end
    //admin registration
    Route::get('register','App\Http\Controllers\Admin\AdminController@adminindex')->name('admin.registration');
    Route::post('register','App\Http\Controllers\Admin\AdminController@adminstore');
    Route::get('register/{id}/edit','App\Http\Controllers\Admin\AdminController@adminedit');
    Route::put('register/{id}','App\Http\Controllers\Admin\AdminController@adminupdate');
    Route::get('register/{id}', 'App\Http\Controllers\Admin\AdminController@admindestroy');
    //admin registration end
    //user registration
    Route::get('user-register','App\Http\Controllers\Admin\AdminController@userindex')->name('alluser');;
    Route::post('user-register','App\Http\Controllers\Admin\AdminController@userstore');
    Route::get('user-register/{id}/edit','App\Http\Controllers\Admin\AdminController@useredit');
    Route::put('user-register/{id}','App\Http\Controllers\Admin\AdminController@userupdate');
    Route::get('user-register/{id}', 'App\Http\Controllers\Admin\AdminController@userdestroy');
    //user registration end

    //company details
    Route::resource('company-detail','App\Http\Controllers\Admin\CompanyDetailController');
    //company details end

    // create fundraiser from admin
    Route::get('/new-fundraiser', [UserController::class, 'newfundraiser'])->name('admin.newfundraiser');
    Route::get('/fundraiser-balance', [UserController::class, 'fundraiserBalance'])->name('admin.fundraiserBalance');
    Route::post('/new-fundraiser', [UserController::class, 'newfundraiserstore']);
    Route::get('/new-fundraiser/{id}/edit', [UserController::class, 'newfundraiseredit']);
    Route::post('/new-fundraiser-update', [UserController::class, 'newfundraiserupdate']);
    Route::get('/new-fundraiser/{id}', [UserController::class, 'newfundraiserdelete']);

    // donor
    Route::get('/donor', [UserController::class, 'getAllDonor'])->name('admin.alldonor');
    
    Route::get('/new-fundraiser-campaign/{id}', [UserController::class, 'fundraisersCampaign'])->name('admin.usercampaignView');

    // Route::post('/fundraiser-update', [UserController::class, 'fundraiserUpdate']);
    // fundraiser profile
    Route::get('/fundraiser-profile/{id}', [UserController::class, 'fundraiserProfile'])->name('admin.fundraiserProfile');

    // fundraiser donation
    Route::get('/fundraiser-donation/{id}', [FundraiserController::class, 'fundraiserDonation'])->name('admin.fundraiserdonation');
    Route::get('/fundraiser-transaction/{id}', [FundraiserController::class, 'fundraiserTransaction'])->name('admin.fundraisertran');

    // active deactive fundraiser
    Route::get('active-fundraiser', [UserController::class, 'activefundraiser']);

    // create charity from admin
    Route::get('/charity', [CharityController::class, 'getCharityByAdmin'])->name('admin.allcharity');
    Route::get('/charity-balance', [CharityController::class, 'getCharityBalanceByAdmin'])->name('admin.charityBalance');
    Route::post('/charity', [CharityController::class, 'newCharitystore']);
    Route::get('/charity-edit/{id}', [CharityController::class, 'newCharityedit'])->name('admin.charityEdit');
    Route::post('/charity-update', [CharityController::class, 'newCharityupdate']);
    Route::get('/charity/{id}', [CharityController::class, 'newCharitydelete']);
    Route::get('/charityimage/{id}', [CharityController::class, 'newCharityImagedelete']);
    // active deactive fundraiser
    Route::get('active-charity', [CharityController::class, 'activeDeactiveAccount']);
    Route::get('/charity-transaction-view/{id}', [CharityController::class, 'viewTransactionCharityByAdmin'])->name('admin.charityTran');
    Route::post('/charity-pay', [TransactionController::class, 'charityPayStore'])->name('admin.charityPayStore');

    
    // campaign view
    Route::get('/charity-view/{id}', [CharityController::class, 'viewcharityByAdmin'])->name('admin.charityView');
    Route::get('/charity-images/{id}', [CharityController::class, 'charityImageDelete'])->name('admin.charityImgDelete');





    // campaign
    Route::get('/campaign', [CampaignController::class, 'getCampaignByAdmin'])->name('admin.campaign');
    Route::get('/live-campaign', [CampaignController::class, 'getLiveCampaignByAdmin'])->name('admin.livecampaign');
    Route::get('/close-campaign', [CampaignController::class, 'getCloseCampaignByAdmin'])->name('admin.closecampaign');
    Route::post('/campaign', [CampaignController::class, 'storeCampaignByAdmin']);
    Route::get('/campaign-edit/{id}', [CampaignController::class, 'editCampaignByAdmin'])->name('admin.campaignEdit');
    Route::get('/campaign-addinfo/{id}', [CampaignController::class, 'addinfoCampaignByAdmin'])->name('admin.addinfo');
    Route::post('/campaign-update', [CampaignController::class, 'updateCampaignByAdmin']);
    Route::post('/campaign-info-update', [CampaignController::class, 'updateCampaignInfoByAdmin']);
    Route::get('/campaign/{id}', [CampaignController::class, 'deleteCampaignByAdmin']);
    Route::post('/campaign-image-store', [CampaignController::class, 'campaignDocStoreByAdmin']);
    Route::get('/campaign-image-delete/{id}', [CampaignController::class, 'deleteCampaignImageByAdmin']);

    // campaign view
    Route::get('/campaign-view/{id}', [CampaignController::class, 'viewCampaignByAdmin'])->name('admin.campaignView');
    Route::get('/transaction-view/{id}', [CampaignController::class, 'viewTransactionCampaignByAdmin'])->name('admin.transactionView');

    // active deactive campaign
    Route::get('active-campaign', [CampaignController::class, 'activeCampaign']);
    Route::get('active-homepage-campaign', [CampaignController::class, 'activeHomepageCampaign']);
    Route::get('active-comment', [CampaignController::class, 'activeComment']);

    

    // photo
    Route::get('/photo', [ImageController::class, 'index'])->name('admin.photo');
    Route::post('/photo', [ImageController::class, 'store']);
    Route::get('/photo/{id}/edit', [ImageController::class, 'edit']);
    Route::put('/photo/{id}', [ImageController::class, 'update']);
    Route::get('/photo/{id}', [ImageController::class, 'delete']);
    
    // fundraising-source
    Route::get('/fundraising-source', [FundraisingSourceController::class, 'index'])->name('admin.fundraisingsource');
    Route::post('/fundraising-source', [FundraisingSourceController::class, 'store']);
    Route::get('/fundraising-source/{id}/edit', [FundraisingSourceController::class, 'edit']);
    Route::put('/fundraising-source/{id}', [FundraisingSourceController::class, 'update']);
    Route::get('/fundraising-source/{id}', [FundraisingSourceController::class, 'delete']);

    // contact mail 
    Route::get('/contact-mail', [ContactMailController::class, 'index'])->name('admin.contact-mail');
    Route::get('/contact-mail/{id}/edit', [ContactMailController::class, 'edit']);
    Route::put('/contact-mail/{id}', [ContactMailController::class, 'update'])->name('admin.contact.update');

    // why-choose-us
    Route::get('/why-choose-us', [WhyChooseUsController::class, 'index'])->name('admin.whychooseus');
    Route::post('/why-choose-us', [WhyChooseUsController::class, 'store']);
    Route::get('/why-choose-us/{id}/edit', [WhyChooseUsController::class, 'edit']);
    Route::put('/why-choose-us/{id}', [WhyChooseUsController::class, 'update']);
    Route::get('/why-choose-us/{id}', [WhyChooseUsController::class, 'delete']);
    
    // all-data
    Route::get('/all-data', [MasterController::class, 'index'])->name('admin.master');
    Route::post('/all-data', [MasterController::class, 'store']);
    Route::get('/all-data/{id}/edit', [MasterController::class, 'edit']);
    Route::put('/all-data/{id}', [MasterController::class, 'update']);
    
    // email-content
    Route::get('/email-content', [EmailContentController::class, 'index'])->name('admin.emailcontent');
    Route::post('/email-content', [EmailContentController::class, 'store']);
    Route::get('/email-content/{id}/edit', [EmailContentController::class, 'edit']);
    Route::put('/email-content/{id}', [EmailContentController::class, 'update']);
    Route::get('/email-content/{id}', [EmailContentController::class, 'delete']);

    // all-data
    Route::get('/home-top-section', [MasterController::class, 'homeTopSection'])->name('admin.hometopsection');
    Route::post('/home-top-section', [MasterController::class, 'homeTopSectionUpdate']);

    // payment
    Route::get('/fundraiser-pay/{id}', [TransactionController::class, 'fundraiserPay'])->name('admin.fundraiserPay');
    Route::post('/fundraiser-pay', [TransactionController::class, 'fundraiserPayStore'])->name('admin.fundraiserPaystore');

    // giving-level
    Route::get('/giving-level', [GivingLevelController::class, 'index'])->name('admin.givinglevel');
    Route::post('/giving-level', [GivingLevelController::class, 'store']);
    Route::get('/giving-level/{id}/edit', [GivingLevelController::class, 'edit']);
    Route::put('/giving-level/{id}', [GivingLevelController::class, 'update']);
    Route::get('/giving-level/{id}', [GivingLevelController::class, 'delete']);

    
    // event
    Route::get('/event', [EventController::class, 'getEvent'])->name('admin.event');
    Route::get('/event-live', [EventController::class, 'getLiveEvent'])->name('admin.liveevent');
    Route::get('/event-complete', [EventController::class, 'getCompleteEvent'])->name('admin.completeevent');
    Route::get('/event-decline', [EventController::class, 'getDeclineEvent'])->name('admin.declineevent');
    Route::get('/event-view/{id}', [EventController::class, 'viewEventByAdmin'])->name('admin.eventView');
    Route::get('/event-price/{id}', [EventController::class, 'viewEventPriceByAdmin'])->name('admin.eventPrice');
    Route::post('/event', [EventController::class, 'storeEventByAdmin']);
    Route::get('active-event', [EventController::class, 'activeEvent']);
    Route::get('/event-edit/{id}', [EventController::class, 'editEventByAdmin'])->name('admin.eventEdit');
    Route::post('/event-update', [EventController::class, 'updateEventByAdmin']);
    Route::get('/event-ticket-sale/{id}', [EventController::class, 'eventTicketSaleShowByAdmin'])->name('admin.eventSaleRecord');
    Route::get('/event/{id}', [EventController::class, 'deleteByAdmin']);

    Route::get('/event-transaction/{id}', [EventTransactionController::class, 'getEventTranByAdmin'])->name('admin.eventtransaction');
    
    Route::post('/event-pay', [EventTransactionController::class, 'eventPayStore'])->name('admin.eventPayStore');

    
    // charity donation link close request 
    Route::post('/withdraw-close', [DashboardController::class, 'withdrawReqRemove']);

});
//admin part end