<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookAccessTypeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookFileTypeController;
use App\Http\Controllers\BookLanguageController;
use App\Http\Controllers\BooksTypeController;
use App\Http\Controllers\BookSubjectController;
use App\Http\Controllers\BookTextController;
use App\Http\Controllers\BookTextTypeController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChairController;
use App\Http\Controllers\DebtorController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\MagazineIssueController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReferenceGenderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UdcController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\WhereController;
use App\Http\Controllers\WhoController;
use App\Http\Livewire\Admin\Books\AddBookInventor;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/uz');

Route::group(['prefix' => '{langugae}', 'where' => ['locale' => '[a-zA-Z]{2}'], 'middleware' => 'setlocale'], function () {

    Route::get('/', [App\Http\Controllers\SiteController::class, 'index'])->name('welcome');
    Route::get('/categories', [App\Http\Controllers\SiteController::class, 'categories'])->name('site.categories');
    Route::get('/categories/{slug}', [App\Http\Controllers\SiteController::class, 'category'])->name('site.category');

    Route::get('/udcs', [App\Http\Controllers\SiteController::class, 'udcs'])->name('site.udcs');
    Route::get('/books', [App\Http\Controllers\SiteController::class, 'books'])->name('site.books');
    Route::get('/books/{slug}', [App\Http\Controllers\SiteController::class, 'book'])->name('site.book');
    Route::get('/journals', [App\Http\Controllers\SiteController::class, 'journals'])->name('site.journals');
    Route::get('/journals/{slug}', [App\Http\Controllers\SiteController::class, 'journal'])->name('site.journal');
    Route::get('/journals/{slug}/{subslug}', [App\Http\Controllers\SiteController::class, 'magazine'])->name('site.magazine');

    Route::get('/books/{slug}/pdf', [App\Http\Controllers\SiteController::class, 'bookpdf'])->name('site.bookpdf');
    
    // Route::get('/product', 'App\Http\Controllers\SiteController@products')->name('site.products');
    // Route::get('/product/{slug}', 'App\Http\Controllers\SiteController@product')->name('site.product');
    // Route::get('/product/{slug}', ShowProduct::class)->name('site.product');
    // Route::get('/product/{slug}/{color}', ShowProduct::class)->name('site.productcolor');
    // Route::get('/cart', 'App\Http\Controllers\SiteController@cart')->name('site.cart');
    // Route::get('/cart/{slug}', 'App\Http\Controllers\SiteController@cartProduct')->name('site.cartProduct');
    
   
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Auth::routes();
    // Route::prefix('admin')->middleware(['auth', 'SuperAdmin'])->group(function () {
    Route::prefix('admin')->middleware(['auth'])->group(function () {
        Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

        Route::post('files', 'App\Http\Controllers\FileController@store')->name('file.store');
        Route::post('files/remove', 'App\Http\Controllers\FileController@remvoeFile')->name('file.remove');

        Route::resource('debtors', DebtorController::class);
        Route::get('take-give', [App\Http\Controllers\DebtorsController::class, 'takegive'])->name('debtors.takegive');
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.index');
        Route::resource('books-types', BooksTypeController::class);
        Route::delete('books-types/{id}', [BooksTypeController::class, 'delete'])->name('books-types.delete');
        Route::resource('organizations', OrganizationController::class);
        Route::resource('/book-languages', BookLanguageController::class);
        Route::resource('/book-texts', BookTextController::class);
        Route::resource('/book-text-types', BookTextTypeController::class);
        Route::resource('/book-access-types', BookAccessTypeController::class);
        Route::resource('/reference-genders', ReferenceGenderController::class);

        Route::get('users/card', 'App\Http\Controllers\UserController@card')->name('users.card');

        Route::resource('users', UserController::class);
        Route::resource('/user-types', UserTypeController::class);
        Route::get('my', 'App\Http\Controllers\UserProfileController@userProfile')->name('admin.my');
        Route::resource('authors', AuthorController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('branches', BranchController::class);
        Route::get('findCityWithStateID/{id}', 'App\Http\Controllers\BranchController@findCityWithStateID');

        Route::resource('articles', ArticleController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('book-file-types', BookFileTypeController::class);
        Route::resource('book-subjects', BookSubjectController::class);
        Route::resource('subjects', SubjectController::class);
        Route::resource('wheres', WhereController::class);
        Route::resource('whos', WhoController::class);
        Route::resource('imports', ImportController::class);

        Route::get('books/inventar', 'App\Http\Controllers\BookController@inventar')->name('admin.inventar');
        Route::get('books/inventarone/{id}', 'App\Http\Controllers\BookController@printinventar')->name('books.inventarone');
        Route::get('books/inventarshow/{id}', 'App\Http\Controllers\BookController@inventarshow')->name('books.inventarshow');
        Route::get('books/exportInventarAllByFromTo', 'App\Http\Controllers\BookController@exportInventarAllByFromTo')->name('books.exportInventarAllByFromTo');

        Route::resource('books', BookController::class);
        Route::get('books/{id}/{infoid}', 'App\Http\Controllers\BookController@addinventar')->name('admin.add-book-inventar');
        Route::resource('journals', JournalController::class);

        Route::resource('magazine-issues', MagazineIssueController::class);
        Route::resource('udcs', UdcController::class);
        Route::resource('orders', OrderController::class);

        Route::get('cart', [CartController::class, 'cart'])->name('cart');
        Route::get('addtocart/{id}', [CartController::class, 'addToCart'])->name('addtocart');
        Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');
        Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove.from.cart');
        Route::get('order', [CartController::class, 'order'])->name('order');
        Route::get('myorders', [CartController::class, 'myorders'])->name('myorders');
        
        Route::resource('faculties', FacultyController::class);
        Route::resource('chairs', ChairController::class);
        Route::resource('groups', GroupController::class);
    
    });
    // Route::prefix('admin')->middleware(['auth', 'Admin'])->group(function () {
    //     Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

    //     Route::post('files', 'App\Http\Controllers\FileController@store')->name('file.store');
    //     Route::post('files/remove', 'App\Http\Controllers\FileController@remvoeFile')->name('file.remove');

    //     Route::resource('debtors', DebtorController::class);
    //     Route::get('take-give', [App\Http\Controllers\DebtorsController::class, 'takegive'])->name('debtors.takegive');
    //     Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.index');
    //      Route::resource('books-types', BooksTypeController::class);
    //     Route::delete('books-types/{id}', [BooksTypeController::class, 'delete'])->name('books-types.delete');
    //     Route::resource('organizations', OrganizationController::class);
    //     Route::resource('/book-languages', BookLanguageController::class);
    //     Route::resource('/book-texts', BookTextController::class);
    //     Route::resource('/book-text-types', BookTextTypeController::class);
    //     Route::resource('/book-access-types', BookAccessTypeController::class);
    //     Route::resource('/reference-genders', ReferenceGenderController::class);

    //     Route::get('users/card', 'App\Http\Controllers\UserController@card')->name('users.card');

    //     Route::resource('users', UserController::class);
    //     Route::resource('/user-types', UserTypeController::class);
    //     Route::get('my', 'App\Http\Controllers\UserProfileController@userProfile')->name('admin.my');
    //     Route::resource('authors', AuthorController::class);
    //     Route::resource('roles', RoleController::class);
    //     Route::resource('permissions', PermissionController::class);
    //     Route::resource('branches', BranchController::class);
    //     Route::get('findCityWithStateID/{id}','App\Http\Controllers\BranchController@findCityWithStateID');

    //     Route::resource('articles', ArticleController::class);
    //     Route::resource('departments', DepartmentController::class);
    //     Route::resource('book-file-types', BookFileTypeController::class);
    //     Route::resource('book-subjects', BookSubjectController::class);
    //     Route::get('books/inventar', 'App\Http\Controllers\BookController@inventar')->name('admin.inventar');
    //     Route::get('books/inventarone/{id}', 'App\Http\Controllers\BookController@printinventar')->name('books.inventarone');
    //     Route::get('books/inventarshow/{id}', 'App\Http\Controllers\BookController@inventarshow')->name('books.inventarshow');
    //     Route::get('books/exportInventarAllByFromTo', 'App\Http\Controllers\BookController@exportInventarAllByFromTo')->name('books.exportInventarAllByFromTo');

    //     Route::resource('books', BookController::class);
    //     Route::get('books/{id}/{infoid}', 'App\Http\Controllers\BookController@addinventar')->name('admin.add-book-inventar');
    //     Route::resource('journals', JournalController::class);
    //     Route::resource('magazine-issues', MagazineIssueController::class);
    //     Route::resource('udcs', UdcController::class);
    // });
    // Route::prefix('admin')->middleware(['auth', 'Manager'])->group(function () {
    //     Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

    //     Route::post('files', 'App\Http\Controllers\FileController@store')->name('file.store');
    //     Route::post('files/remove', 'App\Http\Controllers\FileController@remvoeFile')->name('file.remove');

    //     Route::resource('debtors', DebtorController::class);
    //     Route::get('take-give', [App\Http\Controllers\DebtorsController::class, 'takegive'])->name('debtors.takegive');
    //     Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.index');
    //      Route::resource('books-types', BooksTypeController::class);
    //     Route::delete('books-types/{id}', [BooksTypeController::class, 'delete'])->name('books-types.delete');
    //     Route::resource('organizations', OrganizationController::class);
    //     Route::resource('/book-languages', BookLanguageController::class);
    //     Route::resource('/book-texts', BookTextController::class);
    //     Route::resource('/book-text-types', BookTextTypeController::class);
    //     Route::resource('/book-access-types', BookAccessTypeController::class);
    //     Route::resource('/reference-genders', ReferenceGenderController::class);

    //     Route::get('users/card', 'App\Http\Controllers\UserController@card')->name('users.card');

    //     Route::resource('users', UserController::class);
    //     Route::resource('/user-types', UserTypeController::class);
    //     Route::get('my', 'App\Http\Controllers\UserProfileController@userProfile')->name('admin.my');
    //     Route::resource('authors', AuthorController::class);
    //     // Route::resource('roles', RoleController::class);
    //     // Route::resource('permissions', PermissionController::class);
    //     Route::resource('branches', BranchController::class);
    //     Route::get('findCityWithStateID/{id}','App\Http\Controllers\BranchController@findCityWithStateID');

    //     Route::resource('articles', ArticleController::class);
    //     Route::resource('departments', DepartmentController::class);
    //     Route::resource('book-file-types', BookFileTypeController::class);
    //     Route::resource('book-subjects', BookSubjectController::class);
    //     Route::get('books/inventar', 'App\Http\Controllers\BookController@inventar')->name('admin.inventar');
    //     Route::get('books/inventarone/{id}', 'App\Http\Controllers\BookController@printinventar')->name('books.inventarone');
    //     Route::get('books/inventarshow/{id}', 'App\Http\Controllers\BookController@inventarshow')->name('books.inventarshow');
    //     Route::get('books/exportInventarAllByFromTo', 'App\Http\Controllers\BookController@exportInventarAllByFromTo')->name('books.exportInventarAllByFromTo');

    //     Route::resource('books', BookController::class);
    //     Route::get('books/{id}/{infoid}', 'App\Http\Controllers\BookController@addinventar')->name('admin.add-book-inventar');
    //     Route::resource('journals', JournalController::class);
    //     Route::resource('magazine-issues', MagazineIssueController::class);
    //     Route::resource('udcs', UdcController::class);
    // });

    // , 'Author'
    Route::prefix('admin')->middleware(['auth'])->group(function () {
        Route::get('sisauthor', 'App\Http\Controllers\SisAuthorController@index')->name('admin.sisauthor');
    });

    Route::prefix('admin')->middleware(['auth', 'Reader'])->group(function () {
        Route::get('reader', 'App\Http\Controllers\ReaderController@index')->name('admin.readerindex');
        Route::get('breader', 'App\Http\Controllers\ReaderController@book')->name('admin.readerbook');
        Route::get('breader/{id}', 'App\Http\Controllers\ReaderController@showbook')->name('admin.readershowbook');
    });

    Route::prefix('admin')->middleware(['auth', 'User'])->group(function () {
        Route::get('usreader', 'App\Http\Controllers\ReaderController@user')->name('admin.userindex');
    });

    Route::prefix('admin')->middleware(['auth'])->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
    });
    Route::prefix('admin')->middleware(['auth', 'User'])->group(function () {
        // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
    });
});
