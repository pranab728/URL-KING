<?php
use App\Http\Controllers\Admin\AdminLanguageController;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DomainController;
use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FontController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\LinkController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PageSettingController;
use App\Http\Controllers\Admin\PaymentGatewayController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SeoToolController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SocialSettingController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Payment\Deposit\FlutterwaveController as PaymentDepositFlutterwaveController;
use App\Http\Controllers\Payment\Deposit\InstamojoController as DepositInstamojoController;
use App\Http\Controllers\Payment\Deposit\MercadopagoController as PaymentDepositMercadopagoController;
use App\Http\Controllers\Payment\Deposit\MollieController;
use App\Http\Controllers\Payment\Deposit\PaypalController as DepositPaypalController;
use App\Http\Controllers\Payment\Deposit\PaystackController as DepositPaystackController;
use App\Http\Controllers\Payment\Deposit\PaytmController as DepositPaytmController;
use App\Http\Controllers\Payment\Deposit\StripeController as DepositStripeController;
use App\Http\Controllers\Payment\Subscription\FlutterwaveController;
use App\Http\Controllers\Payment\Subscription\InstamojoController;
use App\Http\Controllers\Payment\Subscription\MercadopagoController;
use App\Http\Controllers\Payment\Subscription\PaypalController;
use App\Http\Controllers\Payment\Subscription\PaystackController;
use App\Http\Controllers\Payment\Subscription\PaytmController;
use App\Http\Controllers\Payment\Subscription\StripeController;
use App\Http\Controllers\Payment\Deposit\FlutterwaveController as DepositFlutterwaveController;
use App\Http\Controllers\Payment\Subscription\WalletController;
use App\Http\Controllers\User\CustomDomainController;
use App\Http\Controllers\User\DepositController;
use App\Http\Controllers\User\ForgotController;
use App\Http\Controllers\User\LoginController as UserLoginController;
use App\Http\Controllers\User\MessageController as UserMessageController;
use App\Http\Controllers\User\OtpController;
use App\Http\Controllers\User\OverlayController;
use App\Http\Controllers\User\PixelController;
use App\Http\Controllers\User\QRsController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\ShortLinkController;
use App\Http\Controllers\User\SocialRegisterController;
use App\Http\Controllers\User\SplashController;
use App\Http\Controllers\User\SubscriptionController as UserSubscriptionController;
use App\Http\Controllers\User\UserController as UserUserController;
use Illuminate\Support\Facades\Route;

        /*************************Admin Panel Route start from here ************************/


Route::prefix('admin')->group(function(){
//-----------------------------Clear Cache--------------------
Route::get('/cache/clear', function() {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        return redirect()->route('admin.dashboard')->with('cache','System Cache Has Been Removed.');
      })->name('admin.cache.clear');
//-----------------------------Clear cache end----------------

Route::get('/login', [LoginController::class,'showLoginForm'])->name('admin.login');
Route::post('/login', [LoginController::class,'login'])->name('admin.login.submit');


Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard');
Route::get('/profile', [DashboardController::class,'profile'])->name('admin.profile');
Route::get('/password', [DashboardController::class,'passwordreset'])->name('admin.password');
Route::post('/password/update', [DashboardController::class,'changepass'])->name('admin.password.update');
Route::get('/logout', [LoginController::class,'logout'])->name('admin.logout');
Route::post('/profile/update', [DashboardController::class,'profileupdate'])->name('admin.profile.update');


//------------ ADMIN USERS SECTION START------------
Route::get('/users/datatables/{id}', [UserController::class,'datatables'])->name('admin.user.datatables');
Route::get('/users',[UserController::class,'index'])->name('admin.user.index');
Route::get('/banned-users',[UserController::class,'banned'])->name('admin.user.banned');
Route::get('/active-users',[UserController::class,'active'])->name('admin.user.active');
Route::get('/users/ban/{id1}/{id2}', [UserController::class,'ban'])->name('admin.user.ban');
Route::get('/users/{id}/show', [UserController::class,'show'])->name('admin.user.show');
Route::get('/users/edit/{id}', [UserController::class,'edit'])->name('admin.user.edit');
Route::post('/users/edit/{id}', [UserController::class,'update'])->name('admin.user.update');
Route::get('/users/delete/{id}', [UserController::class,'destroy'])->name('admin.user.delete');
Route::get('/users/withdraws', [UserController::class,'withdraws'])->name('admin.withdraw.index');
Route::get('/users/withdraws/datatables', [UserController::class,'withdrawdatatables'])->name('admin.withdraw.datatables');
Route::get('/users/withdraw/{id}/show', [UserController::class,'withdrawdetails'])->name('admin.withdraw.show');
Route::get('/users/withdraws/accept/{id}', [UserController::class,'accept'])->name('admin-withdraw-accept');
Route::get('/users/withdraws/reject/{id}', [UserController::class,'reject'])->name('admin-withdraw-reject');
//------------ ADMIN USERS SECTION END------------


//------------ ADMIN BLOG SECTION ------------
Route::get('/blog/datatables', [BlogController::class,'datatables'])->name('admin.blog.datatables'); //JSON REQUEST
Route::get('/blog', [BlogController::class,'index'])->name('admin.blog.index');
Route::get('/blog/create', [BlogController::class,'create'])->name('admin.blog.create');
Route::post('/blog/create', [BlogController::class,'store'])->name('admin.blog.store');
Route::get('/blog/edit/{id}', [BlogController::class,'edit'])->name('admin.blog.edit');
Route::post('/blog/edit/{id}', [BlogController::class,'update'])->name('admin.blog.update');
Route::get('/blog/delete/{id}', [BlogController::class,'destroy'])->name('admin.blog.delete');

Route::get('/blog/category/datatables', [BlogCategoryController::class,'datatables'])->name('admin.cblog.datatables'); //JSON REQUEST
Route::get('/blog/category', [BlogCategoryController::class,'index'])->name('admin.cblog.index');
Route::get('/blog/category/create', [BlogCategoryController::class,'create'])->name('admin.cblog.create');
Route::post('/blog/category/create', [BlogCategoryController::class,'store'])->name('admin.cblog.store');
Route::get('/blog/category/edit/{id}', [BlogCategoryController::class,'edit'])->name('admin.cblog.edit');
Route::post('/blog/category/edit/{id}', [BlogCategoryController::class,'update'])->name('admin.cblog.update');
Route::get('/blog/category/delete/{id}', [BlogCategoryController::class,'destroy'])->name('admin.cblog.delete');
//------------ ADMIN BLOG SECTION ENDS ------------


Route::get('/services/datatables',[ServiceController::class,'datatables'])->name('admin.service.datatables');
Route::get('/services', [ServiceController::class,'index'])->name('admin.service.index');
Route::get('/service/create', [ServiceController::class,'create'])->name('admin.service.create');
Route::post('/service/create', [ServiceController::class,'store'])->name('admin.service.store');
Route::get('/service/edit/{id}', [ServiceController::class,'edit'])->name('admin.service.edit');
Route::post('/service/edit/{id}', [ServiceController::class,'update'])->name('admin.service.update');
Route::get('/service/delete/{id}', [ServiceController::class,'destroy'])->name('admin.service.delete');

Route::get('/ratings/datatables',[ReviewController::class,'datatables'])->name('admin.rating.datatables');
Route::get('/ratings/create', [ReviewController::class,'create'])->name('admin.rating.create');
Route::post('/ratings/create', [ReviewController::class,'store'])->name('admin.rating.store');
Route::get('/ratings/edit/{id}', [ReviewController::class,'edit'])->name('admin.rating.edit');
Route::post('/ratings/edit/{id}', [ReviewController::class,'update'])->name('admin.rating.update');
Route::get('/ratings/delete/{id}', [ReviewController::class,'destroy'])->name('admin.rating.delete');

// ------------ ROLE SECTION ----------------------
Route::get('/role/datatables', [RoleController::class,'datatables'])->name('admin.role.datatables');
Route::get('/role', [RoleController::class,'index'])->name('admin.role.index');
Route::get('/role/create', [RoleController::class,'create'])->name('admin.role.create');
Route::post('/role/create', [RoleController::class,'store'])->name('admin.role.store');
Route::get('/role/edit/{id}', [RoleController::class,'edit'])->name('admin.role.edit');
Route::post('/role/edit/{id}', [RoleController::class,'update'])->name('admin.role.update');
Route::get('/role/delete/{id}', [RoleController::class,'destroy'])->name('admin.role.delete');
// ------------ ROLE SECTION ENDS ----------------------

//------------ ADMIN STAFF SECTION ------------
Route::get('/staff/datatables', [StaffController::class,'datatables'])->name('admin.staff.datatables');
Route::get('/staff', [StaffController::class,'index'])->name('admin.staff.index');
Route::get('/staff/create', [StaffController::class,'create'])->name('admin.staff.create');
Route::post('/staff/create', [StaffController::class,'store'])->name('admin.staff.store');
Route::get('/staff/edit/{id}', [StaffController::class,'edit'])->name('admin.staff.edit');
Route::post('/staff/update/{id}', [StaffController::class,'update'])->name('admin.staff.update');
Route::get('/staff/delete/{id}', [StaffController::class,'destroy'])->name('admin.staff.delete');
//------------ ADMIN STAFF SECTION ENDS------------

//------------ ADMIN SOCIAL SETTINGS SECTION ------------
Route::get('/social', [SocialSettingController::class,'index'])->name('admin.social.index');
Route::post('/social/update', [SocialSettingController::class,'socialupdate'])->name('admin.social.update');
Route::post('/social/update/all', [SocialSettingController::class,'socialupdateall'])->name('admin.social.update.all');
Route::get('/social/facebook', [SocialSettingController::class,'facebook'])->name('admin.social.facebook');
Route::get('/social/google', [SocialSettingController::class,'google'])->name('admin.social.google');
Route::get('/social/facebook/{status}', [SocialSettingController::class,'facebookup'])->name('admin.social.facebookup');
Route::get('/social/google/{status}', [SocialSettingController::class,'googleup'])->name('admin.social.googleup');
//------------ ADMIN SOCIAL SETTINGS SECTION ENDS------------

//------------ ADMIN GENERAL SETTINGS SECTION ------------

Route::get('/splash', [GeneralSettingController::class,'splash'])->name('admin.general.splash');
Route::get('/general-settings/logo', [GeneralSettingController::class,'logo'])->name('admin.gs.logo');
Route::get('/general-settings/captcha', [GeneralSettingController::class,'captcha'])->name('admin.gs.captcha');
Route::get('/general-settings/favicon', [GeneralSettingController::class,'fav'])->name('admin.gs.fav');
Route::get('/general-settings/loader', [GeneralSettingController::class,'load'])->name('admin.gs.load');
Route::post('/general-settings/update/all', [GeneralSettingController::class,'generalupdate'])->name('admin.gs.update');
Route::get('/general-settings/contents', [GeneralSettingController::class,'contents'])->name('admin.gs.contents');
Route::get('/general-settings/theme', [GeneralSettingController::class,'theme'])->name('admin.gs.theme');
Route::get('/general-settings/breadcumb', [GeneralSettingController::class,'breadcumb'])->name('admin.gs.breadcumb');
Route::get('/general-settings/status/{field}/{status}', [GeneralSettingController::class,'status'])->name('admin.gs.status');
Route::get('/general-settings/footer', [GeneralSettingController::class,'footer'])->name('admin.gs.footer');
Route::get('/general-settings/affilate', [GeneralSettingController::class,'affilate'])->name('admin.gs.affilate');
Route::get('/general-settings/error-banner', [GeneralSettingController::class,'errorbanner'])->name('admin.gs.error.banner');
Route::get('/general-settings/popup', [GeneralSettingController::class,'popup'])->name('admin.gs.popup');
Route::get('/general-settings/maintenance', [GeneralSettingController::class,'maintain'])->name('admin.gs.maintenance');
//------------ ADMIN GENERAL SETTINGS JSON SECTION ENDS------------


//--------------------HOMEPAGE SETIING SECTION------------------
Route::get('/homepage/hero',[PageSettingController::class,'hero'])->name('admin.ps.hero');
Route::get('/homepage/brand',[PageSettingController::class,'brand'])->name('admin.ps.brand');
Route::get('/homepage/pricing',[PageSettingController::class,'pricing'])->name('admin.ps.pricing');
Route::get('/homepage/contact',[PageSettingController::class,'contact'])->name('admin.ps.contact');
Route::post('/page-settings/update/all', [PageSettingController::class,'update'])->name('admin.ps.update');
Route::get('/homepage/customer-review',[PageSettingController::class,'review'])->name('admin.ps.review');

//------------ ADMIN EMAIL SETTINGS SECTION ------------
Route::get('/email-templates/datatables', [EmailController::class,'datatables'])->name('admin.mail.datatables');
Route::get('/email-templates', [EmailController::class,'index'])->name('admin.mail.index');
Route::get('/email-templates/{id}', [EmailController::class,'edit'])->name('admin.mail.edit');
Route::post('/email-templates/{id}', [EmailController::class,'update'])->name('admin.mail.update');
Route::get('/email-config', [EmailController::class,'config'])->name('admin.mail.config');
Route::get('/groupemail', [EmailController::class,'groupemail'])->name('admin.group.show');
Route::post('/groupemailpost', [EmailController::class,'groupemailpost'])->name('admin.group.submit');
//------------ ADMIN EMAIL SETTINGS SECTION ENDS ------------
Route::post('/general-settings/update/mail', [GeneralSettingController::class,'generalMailUpdate'])->name('admin.gs.update.mail');




//------------ ADMIN Subscription Plan SECTION Start------------
Route::get('/subscription/datatables', [SubscriptionController::class,'datatables'])->name('admin.subscription.datatables');
Route::get('/subscription', [SubscriptionController::class,'index'])->name('admin.subscription.index');
Route::get('/subscription/create', [SubscriptionController::class,'create'])->name('admin.subscription.create');
Route::post('/subscription/store', [SubscriptionController::class,'store'])->name('admin.subscription.store');
Route::get('/subscription/edit/{id}', [SubscriptionController::class,'edit'])->name('admin.subscription.edit');
Route::post('/subscription/edit/{id}', [SubscriptionController::class,'update'])->name('admin.subscription.update');
Route::get('/subscription/delete/{id}', [SubscriptionController::class,'destroy'])->name('admin.subscription.delete');
Route::get('/subscription/status/{id1}/{id2}',[SubscriptionController::class,'status'])->name('admin.subscription.status');
Route::get('/subscription/free/{id1}/{id2}',[SubscriptionController::class,'free_status'])->name('admin.free.status');
//------------ ADMIN Subscription Plan SECTION END------------


//Admin Link ROute Start
Route::get('/link/datatables/{id}', [LinkController::class,'datatables'])->name('admin.link.datatables');
Route::get('/link',[LinkController::class,'index'])->name('admin.link.index');
Route::get('/link/status/{id1}/{id2}', [LinkController::class,'status'])->name('admin.link.status');
Route::get('/active-link',[LinkController::class,'active'])->name('admin.link.active');
Route::get('/deactive-link',[LinkController::class,'deactive'])->name('admin.link.deactive');
Route::get('/link/edit/{id}', [LinkController::class,'edit'])->name('admin.link.edit');
Route::post('/link/edit/{id}', [LinkController::class,'update'])->name('admin.link.update');
Route::get('/link/delete/{id}', [LinkController::class,'destroy'])->name('admin.link.delete');
//Admin Link Route End


// Domain Section Start 
Route::get('/domain/datatables', [DomainController::class,'datatables'])->name('admin.domain.datatables');
Route::get('/domain', [DomainController::class,'index'])->name('admin.domain.index');
Route::get('/domain/status/{id1}/{id2}', [DomainController::class,'status'])->name('admin.domain.status');
Route::get('/domain/delete/{id}', [DomainController::class,'delete'])->name('admin.domain.delete');


// Custom Splash Section Start from here

//Custom Splash Start From Here

//------------ ADMIN SEOTOOL SETTINGS SECTION ------------

  Route::get('/seotools/analytics', [SeoToolController::class,'analytics'])->name('admin.seotool.analytics');
  Route::post('/seotools/analytics/update', [SeoToolController::class,'analyticsupdate'])->name('admin.seotool.analytics.update');
  Route::get('/seotools/keywords', [SeoToolController::class,'keywords'])->name('admin.seotool.keywords');
  Route::post('/seotools/keywords/update', [SeoToolController::class,'keywordsupdate'])->name('admin.seotool.keywords.update');
  Route::get('/products/popular/{id}',[SeoToolController::class,'popular'])->name('admin.prod.popular');

//------------ ADMIN SEOTOOL SETTINGS SECTION ------------

//Admin Advertisement Route Start
Route::get('/ad/datatables', [AdvertisementController::class,'datatables'])->name('admin.ad.datatables');
 Route::get('/ad',[AdvertisementController::class,'index'])->name('admin.ad.index');
 Route::post('/ad/store', [AdvertisementController::class,'store'])->name('admin.ad.store');
 Route::post('/ad/update/{id}', [AdvertisementController::class,'update'])->name('admin.ad.update');
 Route::get('/ad/delete/{id}', [AdvertisementController::class,'delete'])->name('admin.ad.delete');
//Admin Advertisement Route End


 //------------ ADMIN PAGE SECTION ------------
 Route::get('/page/datatables', [PageController::class,'datatables'])->name('admin.page.datatables'); //JSON REQUEST
 Route::get('/page', [PageController::class,'index'])->name('admin.page.index');
 Route::get('/page/create', [PageController::class,'create'])->name('admin.page.create');
 Route::post('/page/create', [PageController::class,'store'])->name('admin.page.store');
 Route::get('/page/edit/{id}', [PageController::class,'edit'])->name('admin.page.edit');
 Route::post('/page/update/{id}', [PageController::class,'update'])->name('admin.page.update');
 Route::get('/page/delete/{id}', [PageController::class,'destroy'])->name('admin.page.delete');
 Route::get('/page/status/{id1}/{id2}', [PageController::class,'status'])->name('admin.page.status');


  //------------------------------FAQ PAGE----------------------
  Route::get('/faq/datatables', [FaqController::class,'datatables'])->name('admin.faq.datatables');
  Route::get('/admin-faq', [FaqController::class,'index'])->name('admin.faq.index');
  Route::get('/faq/create', [FaqController::class,'create'])->name('admin.faq.create');
  Route::get('/faq/edit/{id}', [FaqController::class,'edit'])->name('admin.faq.edit');
  Route::get('/faq/delete/{id}', [FaqController::class,'destroy'])->name('admin.faq.delete');
  Route::post('/faq/update/{id}', [FaqController::class,'update'])->name('admin.faq.update');
  Route::post('/faq/create', [FaqController::class,'store'])->name('admin.faq.store');
 // ---------------------------Faq page end---------------------


// Admin Message
Route::post('/user/send/message', [MessageController::class,'usercontact'])->name('admin-send-message');
Route::get('/user/ticket',[MessageController::class,'index'])->name('admin.user.message');
Route::get('/messages/datatables/', [MessageController::class,'datatables'])->name('admin.message.datatables');
Route::get('/message/{id}', [MessageController::class,'message'])->name('admin.message.show');
Route::get('/message/{id}/delete', [MessageController::class,'messagedelete'])->name('admin.message.delete');
Route::post('/message/post', [MessageController::class,'postmessage'])->name('admin.message.store');
Route::get('/message/load/{id}', [MessageController::class,'messageshow'])->name('admin-message-load');
//  Admin Message End

//-----------------------------Paymentys Information----------------------------

   Route::get('/paymentgateway/datatables', [PaymentGatewayController::class,'datatables'])->name('admin.payment.datatables'); //JSON REQUEST
   Route::get('/paymentgateway', [PaymentGatewayController::class,'index'])->name('admin.payment.index');
   Route::get('/paymentgateway/create', [PaymentGatewayController::class,'create'])->name('admin.payment.create');
   Route::post('/paymentgateway/create', [PaymentGatewayController::class,'store'])->name('admin.payment.store');
   Route::get('/paymentgateway/edit/{id}', [PaymentGatewayController::class,'edit'])->name('admin.payment.edit');
   Route::post('/paymentgateway/update/{id}', [PaymentGatewayController::class,'update'])->name('admin.payment.update');
   Route::delete('/paymentgateway/delete/{id}', [PaymentGatewayController::class,'destroy'])->name('admin.payment.delete');
   Route::get('/paymentgateway/status/{id1}/{id2}', [PaymentGatewayController::class,'status'])->name('admin.payment.status');

// MULTIPLE CURRENCY
  Route::get('/general-settings/currency/{status}', [GeneralSettingController::class,'currency'])->name('admin.gs.iscurrency');
  Route::get('/currency/datatables', [CurrencyController::class,'datatables'])->name('admin.currency.datatables'); //JSON REQUEST
  Route::get('/currency',[ CurrencyController::class,'index'])->name('admin.currency.index');
  Route::get('/currency/create', [CurrencyController::class,'create'])->name('admin.currency.create');
  Route::post('/currency/create', [CurrencyController::class,'store'])->name('admin.currency.store');
  Route::get('/currency/edit/{id}', [CurrencyController::class,'edit'])->name('admin.currency.edit');
  Route::post('/currency/update/{id}', [CurrencyController::class,'update'])->name('admin.currency.update');
  Route::get('/currency/delete/{id}', [CurrencyController::class,'destroy'])->name('admin.currency.delete');
  Route::get('/currency/status/{id1}/{id2}', [CurrencyController::class,'status'])->name('admin.currency.status');
//-----------------------------Payment Informations End-------------------------

//-----------------------Admin Language Section Start-----------------------------
Route::get('/general-settings/language/{status}',[ GeneralSettingController::class,'language'])->name('admin.gs.islanguage');
Route::get('/languages/datatables', [LanguageController::class,'datatables'])->name('admin.lang.datatables'); //JSON REQUEST
 Route::get('/languages', [LanguageController::class,'index'])->name('admin.lang.index');
Route::get('/languages/create', [LanguageController::class,'create'])->name('admin.lang.create');
Route::get('/languages/edit/{id}', [LanguageController::class,'edit'])->name('admin.lang.edit');
Route::post('/languages/create', [LanguageController::class,'store'])->name('admin.lang.store');
Route::post('/languages/edit/{id}', [LanguageController::class,'update'])->name('admin.lang.update');
Route::get('/languages/status/{id1}/{id2}', [LanguageController::class,'status'])->name('admin.lang.st');
Route::get('/languages/delete/{id}',[ LanguageController::class,'destroy'])->name('admin.lang.delete');

//------------ ADMIN PANEL LANGUAGE SETTINGS SECTION ------------
Route::get('/adminlanguages/datatables', [AdminLanguageController::class,'datatables'])->name('admin.tlang.datatables'); //JSON REQUEST
Route::get('/adminlanguages', [AdminLanguageController::class,'index'])->name('admin.tlang.index');
Route::get('/adminlanguages/create', [AdminLanguageController::class,'create'])->name('admin.tlang.create');
Route::get('/adminlanguages/edit/{id}', [AdminLanguageController::class,'edit'])->name('admin.tlang.edit');
Route::post('/adminlanguages/create', [AdminLanguageController::class,'store'])->name('admin.tlang.store');
Route::post('/adminlanguages/edit/{id}', [AdminLanguageController::class,'update'])->name('admin.tlang.update');
Route::get('/adminlanguages/status/{id1}/{id2}', [AdminLanguageController::class,'status'])->name('admin.tlang.st');
Route::get('/adminlanguages/delete/{id}', [AdminLanguageController::class,'destroy'])->name('admin.tlang.delete');
//------------ ADMIN PANEL LANGUAGE SETTINGS SECTION ENDS ------------

//------------ ADMIN LANGUAGE SETTINGS SECTION ENDS ------------

//------------ ADMIN SUBSCRIBERS SECTION ------------
Route::get('/subscribers/datatables', [SubscriberController::class,'datatables'])->name('admin.subs.datatables');
Route::get('/subscribers', [SubscriberController::class,'index'])->name('admin.subs.index');
Route::get('/subscribers/download', [SubscriberController::class,'download'])->name('admin.subs.download');
//------------ ADMIN SUBSCRIBERS ENDS --------------


//------------ ADMIN FONT SECTION ------------
Route::get('/fonts/datatables', [FontController::class,'datatables'])->name('admin.font.datatables');
Route::get('/fonts', [FontController::class,'index'])->name('admin.font.index');
Route::get('/font/create', [FontController::class,'create'])->name('admin.font.create');
Route::post('/font/store', [FontController::class,'store'])->name('admin.font.store');
Route::get('/font/edit/{id}', [FontController::class,'edit'])->name('admin.font.edit');
Route::post('/font/update/{id}', [FontController::class,'update'])->name('admin.font.update');
Route::get('/font/status/{id1}/{id2}', [FontController::class,'status'])->name('admin.font.status');
Route::get('/font/delete/{id}', [FontController::class,'destroy'])->name('admin.font.delete');
//------------ ADMIN FONT SECTION ENDS------------
Route::get('/check/movescript', [DashboardController::class,'movescript'])->name('admin-move-script');
Route::get('/generate/backup', [DashboardController::class,'generate_bkup'])->name('admin-generate-backup');
Route::get('/activation', [DashboardController::class,'activation'])->name('admin-activation-form');
Route::post('/activation', [DashboardController::class,'activation_submit'])->name('admin-activate-purchase');
Route::get('/clear/backup', [DashboardController::class,'clear_bkup'])->name('admin-clear-backup');


 // Admin Message Route Start

 Route::post('/user/send/message', [MessageController::class,'usercontact'])->name('admin.send.message');

//  Admin Message Route End

});
/*************************Admin Panel Route start from here ************************/
Route::prefix('user')->group(function() {


    Route::get('/login',[UserLoginController::class,'loginform'])->name('user.loginform');
    Route::post('/login/submit', [UserLoginController::class,'login'])->name('user.login.submit');

    Route::get('/logout',[UserLoginController::class,'logout'])->name('user.logout');

     // User Reset
     Route::get('/reset', [UserUserController::class,'resetform'])->name('user.reset');
     Route::post('/reset', [UserUserController::class,'reset'])->name('user.reset.submit');
     // User Reset End

    //  Two Factor Route

    Route::get('/2fa-security', [UserUserController::class,'showTwoFactorForm'])->name('user.show2faForm');
    Route::post('/createTwoFactor', [UserUserController::class,'createTwoFactor'])->name('user.createTwoFactor');
    Route::post('/disableTwoFactor', [UserUserController::class,'disableTwoFactor'])->name('user.disableTwoFactor');

    // Two factor Route ends here

    Route::get('/otp', [OtpController::class,'index'])->name('user.otp');
    Route::post('/otp', [OtpController::class,'otp'])->name('user.otp.submit');


//------------ USER FORGOT SECTION ------------
    Route::get('/forgot',[ForgotController::class,'index'])->name('user.forgot');
    Route::post('/forgot', [ForgotController::class,'forgot'])->name('user.forgot.submit');
    Route::get('/change-passwordd/{token}', [ForgotController::class,'showChangePassForm'])->name('user.change.token');
    Route::post('/change-password', [ForgotController::class,'changepass'])->name('user.change.password');

  //------------ USER FORGOT SECTION ENDS ------------



    Route::get('/registerform',[RegisterController::class,'registerform'])->name('user.registerform');
    Route::post('/register',[RegisterController::class,'register'])->name('user.register.submit');
    Route::get('/register/verify/{token}', [RegisterController::class,'token'])->name('user.register.token');

    Route::get('/dashboard', [UserUserController::class,'index'])->name('user.dashboard');
    Route::get('/payment/{slug1}/{slug2}', [UserUserController::class,'loadpayment'])->name('user.load.payment');


     // User Profile
     Route::get('/profile', [UserUserController::class,'profile'])->name('user.profile');
     Route::post('/profile', [UserUserController::class,'profileupdate'])->name('user.profile.update');
     // User Profile Ends


    //  User to admin Tickets
// Tickets
     Route::get('admin/tickets', [UserMessageController::class,'adminmessages'])->name('user.message.index');
     Route::post('admin/user/send/message', [UserMessageController::class,'adminusercontact'])->name('user.send.message');
     Route::post('admin/message/post', [UserMessageController::class,'adminpostmessage'])->name('user.message.store');

     Route::get('admin/user/tickets', [UserMessageController::class,'viewall'])->name('user.tickets.all');
     Route::get('admin/user/tickets/{id}', [UserMessageController::class,'singleticket'])->name('ticket.load');
    // ***************Subscription Route Start From Here**********************
    Route::get('/subscription/{slug}',[UserSubscriptionController::class,'subscriptions'])->name('user.subscription');
    Route::post('/subscription-request',[UserSubscriptionController::class,'subrequest'])->name('user-subscription-request-submit');

    

    // Short Link Route

    Route::get('/shorted/link',[ShortLinkController::class,'allshortlink' ])->name('all.short.link');
    Route::get('/link/status/{id1}/{id2}', [ShortLinkController::class,'status'])->name('user.link.status');
    Route::get('/link/edit/{id}', [ShortLinkController::class,'edit'])->name('user.link.edit');
    Route::post('/link/edit/{id}', [ShortLinkController::class,'store'])->name('user.link.store');
    Route::get('/link/delete/{id}',[ShortLinkController::class,'delete'])->name('user.link.delete');


    Route::get('/custom-splash', [SplashController::class,'index'])->name('user.custom-splash');
    Route::get('/create-splash', [SplashController::class,'create'])->name('user.create-splash');
    Route::post('/store-splash', [SplashController::class,'store'])->name('user.store-splash');
    Route::get('/edit-splash/{id}', [SplashController::class,'edit'])->name('user.edit-splash');
    Route::post('/update-splash/{id}', [SplashController::class,'update'])->name('user.update-splash');
    Route::get('/delete-splash/{id}', [SplashController::class,'delete'])->name('user.delete-splash');



    // Overlay Route Start from here
    Route::get('/overlay', [OverlayController::class,'index'])->name('user.overlay');
    Route::get('/create-overlay', [OverlayController::class,'create'])->name('user.create-overlay');
    Route::get('create-overlay/{slug}', [OverlayController::class,'overlay_create'])->name('user.create-overlay.item');

    // Contact Overlay
    Route::post('/contact-overlay', [OverlayController::class,'contact_store'])->name('user.store-contact-overlay');
    Route::get('/edit-contact-overlay/{id}', [OverlayController::class,'contact_edit'])->name('user.edit-contact-overlay');
    Route::post('/update-contact-overlay/{id}', [OverlayController::class,'contact_update'])->name('user.update-contact-overlay');
    Route::get('/delete-contact-overlay/{id}', [OverlayController::class,'contact_delete'])->name('user.delete-contact-overlay');


    // poll overlay route
    Route::post('/poll-overlay', [OverlayController::class,'poll_store'])->name('user.store-poll-overlay');
    Route::get('/edit-poll-overlay/{id}', [OverlayController::class,'poll_edit'])->name('user.edit-poll-overlay');
    Route::post('/update-poll-overlay/{id}', [OverlayController::class,'poll_update'])->name('user.update-poll-overlay');
 

    //Message Overlay 
    Route::post('/message-overlay', [OverlayController::class,'message_store'])->name('user.store-message-overlay');
    Route::get('/edit-message-overlay/{id}', [OverlayController::class,'message_edit'])->name('user.edit-message-overlay');
    Route::post('/update-message-overlay/{id}', [OverlayController::class,'message_update'])->name('user.update-message-overlay');

    Route::post('/overlay/contact/message',[OverlayController::class,'contact'])->name('overlay.contact');
    Route::post('/overlay/poll/message',[OverlayController::class,'poll'])->name('overlay.poll');


    //Custom Domain
    Route::get('/custom-domain', [CustomDomainController::class,'index'])->name('user.custom-domain');
    Route::post('/create-domain', [CustomDomainController::class,'store'])->name('user.store-domain');


    //User Tracking Pixel 
    Route::get('/tracking-pixel', [PixelController::class,'index'])->name('user.tracking-pixel');
    Route::get('/create-pixel', [PixelController::class,'create'])->name('user.create-pixel');
    Route::post('/store-pixel', [PixelController::class,'store'])->name('user.store-pixel');
    Route::get('/edit-pixel/{id}', [PixelController::class,'edit'])->name('user.edit-pixel');
    Route::post('/update-pixel/{id}', [PixelController::class,'update'])->name('user.update-pixel');
    Route::get('/delete-pixel/{id}', [PixelController::class,'delete'])->name('user.delete-pixel');


    //User QR Code
    Route::get('/qr-code', [QRsController::class,'index'])->name('user.qr-code');
    Route::get('/create-qr', [QRsController::class,'create'])->name('user.create-qr');

    // text route start from here
    Route::post('/text/store-qr', [QRsController::class,'text_store'])->name('user.store-text-qr');
    Route::get('/edit-text-qr/{id}', [QRsController::class,'text_edit'])->name('user.edit-text-qr');
    Route::post('/update-text-qr/{id}', [QRsController::class,'text_update'])->name('user.update-text-qr');
    Route::get('/delete-text-qr/{id}', [QRsController::class,'delete'])->name('user.delete-text-qr');


    //  SMS Route Start from here
    Route::post('/sms/store-qr', [QRsController::class,'sms_store'])->name('user.store-sms-qr');
    Route::get('/edit-sms-qr/{id}', [QRsController::class,'sms_edit'])->name('user.edit-sms-qr');
    Route::post('/update-sms-qr/{id}', [QRsController::class,'sms_update'])->name('user.update-sms-qr');

    // Wifi Route Start from here
    Route::post('/wifi/store-qr', [QRsController::class,'wifi_store'])->name('user.store-wifi-qr');
    Route::get('/edit-wifi-qr/{id}', [QRsController::class,'wifi_edit'])->name('user.edit-wifi-qr');
    Route::post('/update-wifi-qr/{id}', [QRsController::class,'wifi_update'])->name('user.update-wifi-qr');


    // Vcard Route Start from here
    Route::post('/vcard/store-qr', [QRsController::class,'vcard_store'])->name('user.store-vcard-qr');
    Route::get('/edit-vcard-qr/{id}', [QRsController::class,'vcard_edit'])->name('user.edit-vcard-qr');
    Route::post('/update-vcard-qr/{id}', [QRsController::class,'vcard_update'])->name('user.update-vcard-qr');
    

    // Expired Link Route Start From here
    Route::get('/expired/link',[ShortLinkController::class,'allexpiredlink' ])->name('all.expired.link');
    Route::get('/deactive/link',[ShortLinkController::class,'alldeactivelink' ])->name('all.deactive.link');

    Route::get('plan/log',[UserUserController::class,'planlog'])->name('user.plan.log');

// User all Transaction\
    Route::get('/transaction',[UserUserController::class,'transaction'])->name('user.transaction');
    Route::get('/deposit/log',[UserUserController::class,'deposit_log'])->name('user.deposit.log');

    Route::get('/withdraw',[UserUserController::class,'withdraw'])->name('user.withdraw');
    Route::post('/withdraw/create', [UserUserController::class,'withdraw_store'])->name('user.wwt.store');


    // Subscription Payment Redirect
    Route::get('/payment/cancle',[UserSubscriptionController::class,'paycancle'])->name('user.payment.cancle');
    Route::get('/payment/return',[UserSubscriptionController::class,'payreturn'])->name('user.payment.return');
    Route::get('/shop/check',[UserSubscriptionController::class,'check'] )->name('user.shop.check');
    // Paypal
    Route::post('/paypal-submit', [PaypalController::class,'store'])->name('user.paypal.submit');
    Route::get('/paypal-notify',  [PaypalController::class,'notify'])->name('user.paypal.notify');

    // // Stripe
    Route::post('/stripe-submit', [StripeController::class,'store'])->name('user.stripe.submit');

    // // Instamojo
    Route::post('/instamojo-submit', [InstamojoController::class,'store'])->name('user.instamojo.submit');
    Route::get('/instamojo-notify', [InstamojoController::class,'notify'])->name('user.instamojo.notify');

    // // Paystack
    Route::post('/paystack-submit', [PaystackController::class,'store'])->name('user.paystack.submit');

    // // PayTM
    Route::post('/paytm-submit', [PaytmController::class,'store'])->name('user.paytm.submit');
    Route::post('/paytm-notify', [PaytmController::class,'notify'])->name('user.paytm.notify');

    // // Molly
    Route::post('/molly-submit', 'Payment\Subscription\MollieController@store')->name('user.molly.submit');
    Route::get('/molly-notify', 'Payment\Subscription\MollieController@notify')->name('user.molly.notify');

    // // RazorPay
    Route::post('/razorpay-submit', 'Payment\Subscription\RazorpayController@store')->name('user.razorpay.submit');
    Route::post('/razorpay-notify', 'Payment\Subscription\RazorpayController@notify')->name('user.razorpay.notify');

    // // Authorize.Net
    Route::post('/authorize-submit', 'Payment\Subscription\AuthorizeController@store')->name('user.authorize.submit');

    // // Mercadopago
    Route::post('/mercadopago-submit', [MercadopagoController::class,'store'])->name('user.mercadopago.submit');

    // Wallet Subscription Controller
   Route::post('wallet/submit', [WalletController::class,'store'])->name('user.wallet.submit');

    // // Flutter Wave
    Route::post('/flutter-submit', [FlutterwaveController::class,'store'])->name('user.flutter.submit');
    Route::get('/flutterwave/notify', [FlutterwaveController::class, 'notify'])->name('user.flutterwave.notify');
    // // 2checkout
    Route::post('/twocheckout-submit', 'Payment\Subscription\TwoCheckoutController@store')->name('user.twocheckout.submit');

    // // SSLCommerz
    Route::post('/ssl-submit', 'Payment\Subscription\SslController@store')->name('user.ssl.submit');
    Route::post('/ssl-notify', 'Payment\Subscription\SslController@notify')->name('user.ssl.notify');

    // // Voguepay
    Route::post('/voguepay-submit', 'Payment\Subscription\VoguepayController@store')->name('user.voguepay.submit');


    // Deposite Route Start From Here
    Route::get('/deposit',[DepositController::class,'index'])->name('user.deposit');
    Route::get('/modal-popup/{id}',[DepositController::class,'modal'])->name('user.withdraw.popup');

    Route::get('/deposit/payment/cancle', [DepositController::class,'paycancle'])->name('deposit.payment.cancle');
    Route::get('/deposit/payment/return', [DepositController::class,'payreturn'])->name('deposit.payment.return');

     // Paypal
     Route::post('/deposit/paypal-submit', [DepositPaypalController::class,'store'])->name('deposit.paypal.submit');
     Route::get('/deposit/paypal-notify', [DepositPaypalController::class,'notify'])->name('deposit.paypal.notify');

      // Stripe
    Route::post('/deposit/stripe-submit', [DepositStripeController::class,'store'])->name('deposit.stripe.submit');

      // Instamojo
      Route::post('/deposit/instamojo-submit', [DepositInstamojoController::class,'store'])->name('deposit.instamojo.submit');
      Route::post('/deposit/instamojo-notify', [DepositInstamojoController::class,'notify'])->name('deposit.instamojo.notify');
      
          // Paystack
    Route::post('/deposit/paystack-submit', [DepositPaystackController::class,'store'])->name('deposit.paystack.submit');

    // PayTM
    Route::post('/deposit/paytm-submit', [DepositPaytmController::class,'store'])->name('deposit.paytm.submit');;
    Route::post('/deposit/paytm-notify', [DepositPaytmController::class,'notify'])->name('deposit.paytm.notify');

// Molly
Route::post('/deposit/molly-submit', [MollieController::class,'store'])->name('deposit.molly.submit');
Route::get('/deposit/molly-notify', [MollieController::class,'notify'])->name('deposit.molly.notify');

 // Flutter Wave
 Route::post('/deposit/flutter-submit', [PaymentDepositFlutterwaveController::class,'store'])->name('deposit.flutter.submit');
 Route::post('/dflutter/notify',  [PaymentDepositFlutterwaveController::class,'notify'])->name('deposit.flutter.notify');

 // RazorPay
 Route::post('/deposit/razorpay-submit', [RazorpayController::class,'store'])->name('deposit.razorpay.submit');
 Route::post('/deposit/razorpay-notify', [RazorpayController::class,'notify'])->name('deposit.razorpay.notify');

 // Mercadopago
 Route::post('/deposit/mercadopago-submit', [PaymentDepositMercadopagoController::class,'store'])->name('deposit.mercadopago.submit');

 // Flutter Wave
 Route::post('/deposit/flutter-submit', [DepositFlutterwaveController::class,'store'])->name('deposit.flutter.submit');

});

Route::post('the/genius/ocean/2441139', [FrontendController::class,'subscription']);
Route::get('finalize', [FrontendController::class,'finalize']);
Route::get('/',[FrontendController::class,'index'])->name('front.index');
Route::post('/subscriber/store', [FrontendController::class,'subscribe'])->name('front.subscribe');

Route::get('/currency/{id}', [FrontendController::class,'currency'])->name('front.currency');
Route::get('/language/{id}', [FrontendController::class,'language'])->name('front.language');

Route::get('/add/{id}/{alias}',[FrontendController::class,'addredirect'])->name('add.redirect');
Route::get('/conv/view',[FrontendController::class,'convview'])->name('conv.view');
Route::post('/short/link',[FrontendController::class,'createshort'])->name('front.shortlink');

Route::get('/blogs',[FrontendController::class,'blogs'])->name('front.blog');
Route::get('/blog/{slug}',[FrontendController::class,'single_blog'])->name('front.blog.single');
Route::get('/blog/category/{slug}',[FrontendController::class,'blogcategory'])->name('front.blogcategory');
Route::get('/blog/tag/{slug}',[FrontendController::class,'blogtags'])->name('front.blogtags');
Route::get('/front/faq',[FrontendController::class,'faq'])->name('front.faq');
Route::get('/front/contact',[FrontendController::class,'contact'])->name('front.contact');
Route::get('/subscriptions/plan',[FrontendController::class,'subscriptions'])->name('user.package');
 // LOGIN WITH FACEBOOK OR GOOGLE SECTION
 Route::get('auth/{provider}', [SocialRegisterController::class,'redirectToProvider'])->name('social-provider');
 Route::get('auth/{provider}/callback', [SocialRegisterController::class,'handleProviderCallback']);
 // LOGIN WITH FACEBOOK OR GOOGLE SECTION ENDS

Route::post('/contact/form',[FrontendController::class,'contactemail'])->name('front.contact.submit');
 Route::get('/{slug}',[FrontendController::class,'page'])->name('front.page');
Route::get('/{alias}',[FrontendController::class,'redirect'])->name('front.url');