<?php

use App\Models\Trip;
use App\Models\user;
use App\Models\Cargo;
use App\Models\Horse;
use App\Models\Wallet;
use App\Models\Company;
use App\Models\Trailer;
use App\Models\Customer;
use App\Models\Destination;
use App\Models\Transporter;
use App\Models\LoadingPoint;
use App\Models\ClearingAgent;
use App\Models\OffloadingPoint;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\HorseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TrailerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FuelPriceController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\FuelStationController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransporterController;
use App\Http\Controllers\LoadingPointController;
use App\Http\Controllers\ClearingAgentController;
use SebastianBergmann\CodeCoverage\Driver\Driver;
use App\Http\Controllers\OffloadingPointController;
use App\Http\Controllers\ServiceProviderController;

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



Route::get('/', [PagesController::class, 'index'])->name('landing_page');

Route::get('/login',[LoginController::class, 'getLogin'])->name('login');
Route::post('/login',[LoginController::class, 'postLogin'])->name('postLogin');
Route::get('/signup',[LoginController::class, 'getSignup'])->name('signup');
Route::post('/signup',[LoginController::class, 'postSignup'])->name('post-signup');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');


Route::get('/posts/all/', [PostController::class, 'posts'])->name('posts.posts');
Route::get('/services/all/', [ServiceController::class, 'services'])->name('services.services');
Route::get('/faqs/all/', [FaqController::class, 'faqs'])->name('faqs.faqs');
Route::get('/teams/all/', [TeamController::class,'teams'])->name('teams.teams');
Route::get('/testimonials/all/', [TestimonialController::class,'testimonials'])->name('testimonials.testimonials');
Route::get('/partners/all/', [PartnerController::class, 'partners'])->name('partners.partners');


Route::get('/about',[PagesController::class, 'about'])->name('about');
Route::get('/contact-us',[PagesController::class, 'contactUs'])->name('contact_us');



Route::group(['middleware' => 'auth'], function(){

    Route::resource('/partners',PartnerController::class);
    Route::resource('/posts',PostController::class);
    Route::resource('/testimonials',TestimonialController::class);
    Route::resource('/services',ServiceController::class);
    Route::resource('/teams',TeamController::class);
    Route::resource('/faqs',FaqController::class);
    Route::resource('/transporters',TransporterController::class);
    Route::resource('/companies',CompanyController::class);
    Route::resource('/horses',HorseController::class);
    Route::resource('/trailers',TrailerController::class);
    Route::resource('/wallets',WalletController::class);
    Route::resource('/drivers',DriverController::class);
    Route::resource('/clearing_agents',ClearingAgentController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/service_providers',ServiceProviderController::class);
    Route::resource('/customers',CustomerController::class);
    Route::resource('/trips',TripController::class);
    Route::resource('/destinations',DestinationController::class);
    Route::resource('/loading_points',LoadingPointController::class);
    Route::resource('/offloading_points',OffloadingPointController::class);
    Route::resource('/cargos',CargoController::class);
    Route::resource('/orders',OrderController::class);
    Route::resource('/quotations',QuotationController::class);
    Route::resource('/invoices',InvoiceController::class);
    Route::resource('/fuel_stations',FuelStationController::class);
    Route::resource('/fuel_prices',FuelPriceController::class);
    Route::resource('/branches',BranchController::class);
    Route::resource('/transactions',TransactionController::class);
    Route::resource('/documents',DocumentController::class);
    Route::resource('/bank_accounts',BankAccountController::class);
    Route::resource('/drivers',DriverController::class);
    Route::resource('/vendors',VendorController::class);
    Route::resource('/transactions',TransactionController::class);
    Route::resource('/charges',ChargeController::class);

    Route::get('/companies/{company}/profile',[CompanyController::class,'getProfile'])->name('company-profile');

    Route::get('/users/{id}/profile',[UserController::class,'getProfile'])->name('profile');
    Route::post('/users/{id}/change-password',[UserController::class,'changePassword'])->name('password.change');
    Route::post('/users/{id}/profile-update',[UserController::class,'profile'])->name('postProfile');

    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

});