<?php


use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AboutController;
// use App\Http\Controllers\MainController;
// use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SocialMediaLinkController;
use App\Http\Controllers\PortfolioImageController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PortfolioVideoController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\ImprintController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ImageController;
use App\Http\Middleware\Cookie;

// use App\Models\SocialMediaLink;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [MainController::class,'index'])->name('main');
// Route::get('/portfolio-image/{category_id}',[PortfolioImageController::class , 'getSelectedCategory'])->name('portfolio-image-with-category');
Route::get('/Fotogalerie', [PortfolioImageController::class , 'index'])->name('portfolio-image');
Route::get('/Fotogalerie/{category_id}', [PortfolioImageController::class , 'getCategoryById'])->name('portfolio-image-category');
Route::get('/Videogalerie', [PortfolioVideoController::class,'index'])->name('portfolio-video');
Route::get('/datenschutz', [PrivacyController::class,'index'])->name('privacy_policy');
Route::get('/impressum', [ImprintController::class,'index'])->name('imprint');
Route::get('/advertisement', [AdvertisementController::class,'index'])->name('advertisement');
Route::get('/job', [JobController::class,'index'])->name('job');
//Route::get('/advertisement', function(){ return 'You Can Not Access This Page'; });

/////////////////////////////////////////////////////////////////////////////////////////
Route::middleware([Cookie::class])->group(function () 
{
    Route::get('admin', [SliderController::class,'index']);

    Route::get('admin/home/category',[CategoryController::class,'index'])->name('admin-category');
    Route::get('admin/category/create', [CategoryController::class,'create'])->name('create-category');
    Route::get('admin/category/edit/{id}', [CategoryController::class,'edit'])->name('edit-category');
    Route::post('admin/category/store', [CategoryController::class,'store'])->name('store-category');
    Route::post('admin/category/update/{id}', [CategoryController::class,'update'])->name('update-category');
    Route::post('admin/category/remove/{id}', [CategoryController::class,'destroy'])->name('remove-category');

    Route::get('/admin/image', [ImageController::class,'index'])->name('admin-image');
    Route::post('/image/store', [ImageController::class,'store'])->name('store-image');
    Route::post('/image/remove/{id}', [ImageController::class,'destroy'])->name('remove-image');

    Route::get('/admin/video', 'App\Http\Controllers\VideoController@index')->name('admin-video');
    Route::post('/video/store', 'App\Http\Controllers\VideoController@store')->name('store-video');
    Route::post('/video/remove/{id}', 'App\Http\Controllers\VideoController@destroy')->name('remove-video');

    Route::get('/admin/slider', 'App\Http\Controllers\SliderController@index')->name('admin-slider');
    Route::post('/slider/store', 'App\Http\Controllers\SliderController@store')->name('store-slider-image');
    Route::post('/slider/remove/{id}', 'App\Http\Controllers\SliderController@destroy')->name('remove-slider-image');

    /////////////////// -- About page in Admin -- //////////////////////////

    /////-- About Section --/////
    Route::get(
        '/admin/about/edit',
         [AboutController::class, 'edit']
    )->name('edit-admin-about');

    Route::post(
        '/about/update/{id}'
    , [AboutController::class, 'update']
    )->name('update-admin-about');



    /////-- Services Section --/////
    Route::get(
        '/admin/about/services',
         [ServiceController::class, 'index']
    )->name('admin-about-services');

    Route::post(
        '/admin/about/services/store',
         [ServiceController::class, 'store']
    )->name('store-admin-about-service');

    Route::post(
        '/admin/about/services/destroy/{id}',
         [ServiceController::class, 'destroy']
    )->name('remove-admin-about-service');


    ////////////////////-- Counter page in admin  --///////////////////////////////
    Route::get('/admin/counter', 'App\Http\Controllers\CounterController@index')->name('admin-counter');
    Route::post('/counter/update', 'App\Http\Controllers\CounterController@update')->name('update-counter');
    ////////////////////////////////////////////////////////////////////////////////



    ////////////////////-- Social Media Links page in admin  --///////////////////////////////
    Route::get(
        '/admin/social-media-links',
         [SocialMediaLinkController::class, 'index']
    )->name('admin-social-media-links');
    
    Route::get(
        '/admin/social-media-link/create',
        [SocialMediaLinkController::class, 'create']
    )->name('admin-social-media-link-create');

    Route::post(
        '/admin/social-media-link/store',
     [SocialMediaLinkController::class, 'store']
    )->name('admin-social-media-link-store');
    
    Route::get(
        '/admin/social-media-link/edit/{id}',
     [SocialMediaLinkController::class, 'edit']
    )->name('admin-social-media-link-edit');
    
    Route::post(
        '/admin/social-media-link/update/{id}',
     [SocialMediaLinkController::class, 'update']
    )->name('admin-social-media-link-update');
    
    Route::post(
        '/admin/social-media-link/destroy/{id}',
     [SocialMediaLinkController::class, 'destroy']
    )->name('admin-social-media-link-destroy');
    
    Route::post(
        '/admin/social-media-link/activate/{id}',
     [SocialMediaLinkController::class, 'activate']
    )->name('admin-social-media-link-activate');
    
    // Route::get(
    //     '/social-media-links',
    //      [SocialMediaLinkController::class, 'getSocialMediaLinksToUser']
    // );
    //

    // Route::post('/social-media-link/update', 'App\Http\Controllers\SocialMediaLinkController@update')->name('update-social-media-link');
    // Route::post('/social-media-link/active/{id}', 'App\Http\Controllers\SocialMediaLinkController@activate')->name('activate-social-media-link');
    ////////////////////////////////////////////////////////////////////////////////



    ////////////////////-- Map page in admin  --///////////////////////////////
    //It does not work 
    // Route::get('/admin/map','MapController@index')->name('admin-map');
    // Route::post('/map/update','MapController@update')->name('update-map');
    ////////////////////////////////////////////////////////////////////////////////

    //Route::post('/image-upload-handler','ImageController@store');

    //Route::get('/contact','ContactController@index')->name('contact');
    Route::get('/admin/contact', 'App\Http\Controllers\ContactController@index_admin')->name('admin-contact');
    Route::post('/contact/update', 'App\Http\Controllers\ContactController@update')->name('update-contact');
    ////////////////////////////////////////////////////////////////////////////////
    Route::get('/admin/password', 'App\Http\Controllers\UserController@index')->name('admin-password');
    Route::post('/password/update', 'App\Http\Controllers\UserController@update')->name('update-password');
    ////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////- Admin Imprint Section -///////////////////////////
    Route::get('/admin/imprint', 'App\Http\Controllers\ImprintController@index_admin')->name('admin-imprint');
    Route::post('/imprint/update', 'App\Http\Controllers\ImprintController@update')->name('update-imprint');
    Route::get('/imprint/show', 'App\Http\Controllers\ImprintController@show')->name('show-imprint');
    /////////////////////////////////////////////////////////////////

    ///////////////////////////////- Admin Privacy Policy Section -///////////////////////////
    Route::get('/admin/privacy', 'App\Http\Controllers\PrivacyController@index_admin')->name('admin-privacy');
    Route::post('/privacy/update', 'App\Http\Controllers\PrivacyController@update')->name('update-privacy');
    Route::get('/privacy/show', 'App\Http\Controllers\PrivacyController@show')->name('show-privacy');
    /////////////////////////////////////////////////////////////////

    ///////////////////////////////- Admin Advertisement Section -///////////////////////////
    Route::get('/admin/advertisement', 'App\Http\Controllers\AdvertisementController@index_admin')->name('admin-advertisement');
    Route::post('/advertisement/update', 'App\Http\Controllers\AdvertisementController@update')->name('update-advertisement');
    Route::get('/advertisement/show', 'App\Http\Controllers\AdvertisementController@show')->name('show-advertisement');
    /////////////////////////////////////////////////////////////////

    ///////////////////////////////- Admin Popup Section -///////////////////////////
    Route::get('/admin/popup', 'App\Http\Controllers\PopupController@index_admin')->name('admin-popup');
    Route::post('/popup/toggle', 'App\Http\Controllers\PopupController@toggle')->name('toggle-popup'); //show or hide popup from user page
    Route::post('/popup/update', 'App\Http\Controllers\PopupController@update')->name('update-popup');
    /////////////////////////////////////////////////////////////////

    ///////////////////////////////- Admin Popup Image Link Section -///////////////////////////
    Route::get('/admin/popup-img-link', 'App\Http\Controllers\PopupController@index_popup_admin_img_link')->name('admin-popup-img-link');
    Route::post('/popup/update-popup-img-link', 'App\Http\Controllers\PopupController@update_img_link')->name('update-popup-img-link');
    Route::post('/popup/reset-popup-img-link', 'App\Http\Controllers\PopupController@reset_img_link')->name('reset-popup-img-link');
    /////////////////////////////////////////////////////////////////

    ///////////////////////////////- Admin Tinymce Image Storage Section -///////////////////////////
    Route::get('/admin/tinymce-img', 'App\Http\Controllers\Admin\TinymceImageController@index')->name('admin-tinymce-img');
    Route::post('/tinymce-img/store', 'App\Http\Controllers\Admin\TinymceImageController@store')->name('store-tinymce-img');
    Route::post('/tinymce-img/destroy/{id}', 'App\Http\Controllers\Admin\TinymceImageController@destroy')->name('destroy-tinymce-img');
    /////////////////////////////////////////////////////////////////

    ///////////////////////////////- Admin Job Section -///////////////////////////
    Route::get('/admin/job', 'App\Http\Controllers\Admin\JobController@index')->name('admin-job');
    Route::get('/admin/job/create', 'App\Http\Controllers\Admin\JobController@create')->name('admin-job-create');
    Route::post('/admin/job/store', 'App\Http\Controllers\Admin\JobController@store')->name('admin-job-store');
    Route::get('/admin/job/edit/{id}', 'App\Http\Controllers\Admin\JobController@edit')->name('admin-job-edit');
    Route::post('/admin/job/update/{id}', 'App\Http\Controllers\Admin\JobController@update')->name('admin-job-update');
    Route::post('/admin/job/destroy/{id}', 'App\Http\Controllers\Admin\JobController@destroy')->name('admin-job-destroy');
    /////////////////////////////////////////////////////////////////

    //Route::get('/admin/whatsapp','UserController@index_whatsapp')->name('admin-whatsapp');
    //Route::post('/whatsapp/update','UserController@update_whatsapp')->name('update-whatsapp');

    //////////////////////////////////////////////////////////////
    Route::post('/logout', 'App\Http\Controllers\LoginController@logout')->name('logout');
});

Route::post('/handle-contact', 'App\Http\Controllers\ContactController@handle')->name('handle-contact');

Route::get('/Login', 'App\Http\Controllers\LoginController@index')->name('Login');
Route::post('/handle-login', 'App\Http\Controllers\LoginController@login');
