<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\user\RoleController;
use App\Http\Controllers\admin\notify\SMSController;
use App\Http\Controllers\admin\content\FAQController;
use App\Http\Controllers\admin\content\MenuController;
use App\Http\Controllers\admin\content\PageController;
use App\Http\Controllers\admin\content\PostController;
use App\Http\Controllers\admin\market\BrandController;
use App\Http\Controllers\admin\market\OrderController;
use App\Http\Controllers\admin\market\StoreController;
use App\Http\Controllers\admin\notify\EmailController;
use App\Http\Controllers\admin\ticket\TicketController;

use App\Http\Controllers\admin\user\CustomerController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\admin\market\CommentController;
use App\Http\Controllers\admin\market\GalleryController;
use App\Http\Controllers\admin\market\PaymentController;
use App\Http\Controllers\admin\market\ProductController;
use App\Http\Controllers\admin\user\AdminUserController;
use App\Http\Controllers\Admin\Market\CategoryController;
use App\Http\Controllers\admin\market\DeliveryController;
use App\Http\Controllers\admin\market\DiscountController;
use App\Http\Controllers\admin\market\PropertyController;
use App\Http\Controllers\admin\setting\SettingController;
use App\Http\Controllers\admin\user\PermissionController;
use App\Http\Controllers\admin\notify\EmailFileController;
use App\Http\Controllers\admin\Ticket\TicketAdminController;
use App\Http\Controllers\admin\Ticket\TicketCategoryController;
use App\Http\Controllers\admin\Ticket\TicketPriorityController;
use App\Http\Controllers\admin\content\CommentController as ContentCommentController;
use App\Http\Controllers\admin\content\CategoryController as ContentCategoryController;

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

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

//MARKET
Route::prefix('admin')->namespace('Admin')->group(function () {

    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.home');

    // Market Route
    Route::prefix('market')->namespace('Market')->group(function () {

        //CATEGORY
        Route::prefix('category')->group(function () {

            Route::get('/', [CategoryController::class, 'index'])->name('admin.market.category.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('admin.market.category.create');
            Route::post('/store', [CategoryController::class, 'store'])->name('admin.market.category.store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.market.category.edit');
            Route::put('/update/{id}', [CategoryController::class, 'update'])->name('admin.market.category.update');
            Route::delete('/destroy/{id}', [CategoryController::class, 'destroy'])->name('admin.market.category.destroy');

        });


        //BRAND
        Route::prefix('brand')->group(function () {

            Route::get('/', [BrandController::class, 'index'])->name('admin.market.brand.index');
            Route::get('/create', [BrandController::class, 'create'])->name('admin.market.brand.create');
            Route::post('/store', [BrandController::class, 'store'])->name('admin.market.brand.store');
            Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('admin.market.brand.edit');
            Route::delete('/destroy/{id}', [BrandController::class, 'destroy'])->name('admin.market.brand.destroy');

        });

        //COMMENT
        Route::prefix('comment')->group(function () {

            Route::get('/', [CommentController::class, 'index'])->name('admin.market.comment.index');
            Route::get('/show', [CommentController::class, 'show'])->name('admin.market.comment.show');
            Route::post('/store', [CommentController::class, 'store'])->name('admin.market.comment.store');
            Route::get('/edit/{id}', [CommentController::class, 'edit'])->name('admin.market.comment.edit');
            Route::put('/update/{id}', [CommentController::class, 'update'])->name('admin.market.comment.update');
            Route::delete('/destroy/{id}', [CommentController::class, 'destroy'])->name('admin.market.comment.destroy');

        });


        //DELIVERY
        Route::prefix('delivery')->group(function () {

            Route::get('/', [DeliveryController::class, 'index'])->name('admin.market.delivery.index');
            Route::get('/create', [DeliveryController::class, 'create'])->name('admin.market.delivery.create');
            Route::post('/store', [DeliveryController::class, 'store'])->name('admin.market.delivery.store');
            Route::get('/edit/{id}', [DeliveryController::class, 'edit'])->name('admin.market.delivery.edit');
            Route::put('/update/{id}', [DeliveryController::class, 'update'])->name('admin.market.delivery.update');
            Route::delete('/destroy/{id}', [DeliveryController::class, 'destroy'])->name('admin.market.delivery.destroy');

        });


        //DISCOUNT
        Route::prefix('discount')->group(function () {

            Route::get('/copan', [DiscountController::class, 'copan'])->name('admin.market.discount.copan');
            Route::get('/copan/create', [DiscountController::class, 'copanCreate'])->name('admin.market.discount.copanCreate');
            Route::get('/common-discount', [DiscountController::class, 'commonDiscount'])->name('admin.market.discount.commonDiscount');
            Route::get('/common-discount/create', [DiscountController::class, 'commonDiscountCreate'])->name('admin.market.discount.commonDiscountCreate');
            Route::get('/amazing-sale', [DiscountController::class, 'amazingSale'])->name('admin.market.discount.amazingSale');
            Route::get('/amazing-sale/create', [DiscountController::class, 'amazingSaleCreate'])->name('admin.market.discount.amazingSaleCreate');

        });


        //ORDERS
        Route::prefix('order')->group(function () {

            Route::get('/', [OrderController::class, 'all'])->name('admin.market.order.all');
            Route::get('/new-order', [OrderController::class, 'newOrders'])->name('admin.market.order.newOrders');
            Route::get('/sending', [OrderController::class, 'sending'])->name('admin.market.order.sending');
            Route::get('/unpaied', [OrderController::class, 'unpaied'])->name('admin.market.order.unpaied');
            Route::get('/canceled', [OrderController::class, 'canceled'])->name('admin.market.order.canceled');
            Route::get('/returned', [OrderController::class, 'returned'])->name('admin.market.order.returned');
            Route::get('/show', [OrderController::class, 'show'])->name('admin.market.order.show');
            Route::get('/change-send-status', [OrderController::class, 'changeSendStatus'])->name('admin.market.order.changeSendStatus');
            Route::get('/change-order-status', [OrderController::class, 'changeOrderStatus'])->name('admin.market.order.changeOrderStatus');
            Route::get('/cancel-order', [OrderController::class, 'cancelOrder'])->name('admin.market.order.cancelOrder');

        });


        //PAYMENTS
        Route::prefix('payment')->group(function () {

            Route::get('/', [PaymentController::class, 'index'])->name('admin.market.payment.index');
            Route::get('/online', [PaymentController::class, 'online'])->name('admin.market.payment.online');
            Route::get('/offline', [PaymentController::class, 'offline'])->name('admin.market.payment.offline');
            Route::get('/attendance', [PaymentController::class, 'attendance'])->name('admin.market.payment.attendance');
            Route::get('/confirm', [PaymentController::class, 'confirm'])->name('admin.market.payment.confirm');

        });


        //PRODUCT
        Route::prefix('product')->group(function () {

            Route::get('/', [ProductController::class, 'index'])->name('admin.market.product.index');
            Route::get('/create', [ProductController::class, 'create'])->name('admin.market.product.create');
            Route::post('/store', [ProductController::class, 'store'])->name('admin.market.product.store');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.market.product.edit');
            Route::put('/update/{id}', [ProductController::class, 'update'])->name('admin.market.product.update');
            Route::delete('/destroy/{id}', [ProductController::class, 'destroy'])->name('admin.market.product.destroy');

            //GALLERY
            Route::get('/gallery', [GalleryController::class, 'index'])->name('admin.market.gallery.index');
            Route::post('/gallery/store', [GalleryController::class, 'store'])->name('admin.market.gallery.store');
            Route::delete('/gallery/store/{id}', [GalleryController::class, 'destroy'])->name('admin.market.gallery.destroy');

        });



         //PROPERTY
         Route::prefix('property')->group(function () {

            Route::get('/', [PropertyController::class, 'index'])->name('admin.market.property.index');
            Route::get('/create', [PropertyController::class, 'create'])->name('admin.market.property.create');
            Route::post('/store', [PropertyController::class, 'store'])->name('admin.market.property.store');
            Route::get('/edit/{id}', [PropertyController::class, 'edit'])->name('admin.market.property.edit');
            Route::put('/update/{id}', [PropertyController::class, 'update'])->name('admin.market.property.update');
            Route::delete('/destroy/{id}', [PropertyController::class, 'destroy'])->name('admin.market.property.destroy');

        });




         //STORE
         Route::prefix('store')->group(function () {

            Route::get('/', [StoreController::class, 'index'])->name('admin.market.store.index');
            Route::get('/add-to-store', [StoreController::class, 'addToStore'])->name('admin.market.store.addToStore');
            Route::post('/store', [StoreController::class, 'store'])->name('admin.market.store.store');
            Route::get('/edit/{id}', [StoreController::class, 'edit'])->name('admin.market.store.edit');
            Route::put('/update/{id}', [StoreController::class, 'update'])->name('admin.market.store.update');
            Route::delete('/destroy/{id}', [StoreController::class, 'destroy'])->name('admin.market.store.destroy');

        });


    });
});


//--------------------------------------------------------------------------

//CONTENT
Route::prefix('content')->namespace('Content')->group(function () {

    //CATEGORY
    Route::prefix('category')->group(function(){
        Route::get('/', [ContentCategoryController::class, 'index'])->name('admin.content.category.index');
        Route::get('/create', [ContentCategoryController::class, 'create'])->name('admin.content.category.create');
        Route::post('/store', [ContentCategoryController::class, 'store'])->name('admin.content.category.store');
        Route::get('/edit/{postCategory}', [ContentCategoryController::class, 'edit'])->name('admin.content.category.edit');
        Route::put('/update/{postCategory}', [ContentCategoryController::class, 'update'])->name('admin.content.category.update');
        Route::delete('/destroy/{postCategory}', [ContentCategoryController::class, 'destroy'])->name('admin.content.category.destroy');
        Route::post('/status/{postCategory}', [ContentCategoryController::class, 'status'])->name('admin.content.category.status');
    });


     //COMMENT
     Route::prefix('comment')->group(function () {

        Route::get('/', [ContentCommentController::class, 'index'])->name('admin.content.comment.index');
        Route::get('/show/{comment}', [ContentCommentController::class, 'show'])->name('admin.content.comment.show');
        Route::delete('/destroy/{comment}', [ContentCommentController::class, 'destroy'])->name('admin.content.comment.destroy');
        Route::post('/status/{comment}', [ContentCommentController::class, 'status'])->name('admin.content.comment.status');
        Route::post('/approved/{comment}', [ContentCommentController::class, 'approved'])->name('admin.content.comment.approved');
        Route::post('/answer/{comment}', [ContentCommentController::class, 'answer'])->name('admin.content.comment.answer');

    });



    //FAQ
    Route::prefix('faq')->group(function () {

        Route::get('/', [FAQController::class, 'index'])->name('admin.content.faq.index');
        Route::get('/create', [FAQController::class, 'create'])->name('admin.content.faq.create');
        Route::post('/store', [FAQController::class, 'store'])->name('admin.content.faq.store');
        Route::get('/edit/{faq}', [FAQController::class, 'edit'])->name('admin.content.faq.edit');
        Route::put('/update/{faq}', [FAQController::class, 'update'])->name('admin.content.faq.update');
        Route::delete('/destroy/{faq}', [FAQController::class, 'destroy'])->name('admin.content.faq.destroy');
        Route::post('/status/{faq}', [FAQController::class, 'status'])->name('admin.content.faq.status');
        Route::post('/image_upload', [FAQController::class, 'upload'])->name('admin.content.faq.upload');

    });

    //MENU
    Route::prefix('menu')->group(function () {

        Route::get('/', [MenuController::class, 'index'])->name('admin.content.menu.index');
        Route::get('/create', [MenuController::class, 'create'])->name('admin.content.menu.create');
        Route::post('/store', [MenuController::class, 'store'])->name('admin.content.menu.store');
        Route::get('/edit/{menu}', [MenuController::class, 'edit'])->name('admin.content.menu.edit');
        Route::put('/update/{menu}', [MenuController::class, 'update'])->name('admin.content.menu.update');
        Route::delete('/destroy/{menu}', [MenuController::class, 'destroy'])->name('admin.content.menu.destroy');
        Route::post('/status/{menu}', [MenuController::class, 'status'])->name('admin.content.menu.status');

    });


    //PAGE
    Route::prefix('page')->group(function () {

        Route::get('/', [PageController::class, 'index'])->name('admin.content.page.index');
        Route::get('/create', [PageController::class, 'create'])->name('admin.content.page.create');
        Route::post('/store', [PageController::class, 'store'])->name('admin.content.page.store');
        Route::get('/edit/{page}', [PageController::class, 'edit'])->name('admin.content.page.edit');
        Route::put('/update/{page}', [PageController::class, 'update'])->name('admin.content.page.update');
        Route::delete('/destroy/{page}', [PageController::class, 'destroy'])->name('admin.content.page.destroy');
        Route::post('/status/{page}', [PageController::class, 'status'])->name('admin.content.page.status');

    });



    //POST
    Route::prefix('post')->group(function () {

        Route::get('/', [PostController::class, 'index'])->name('admin.content.post.index');
        Route::get('/create', [PostController::class, 'create'])->name('admin.content.post.create');
        Route::post('/store', [PostController::class, 'store'])->name('admin.content.post.store');
        Route::get('/edit/{post}', [PostController::class, 'edit'])->name('admin.content.post.edit');
        Route::put('/update/{post}', [PostController::class, 'update'])->name('admin.content.post.update');
        Route::delete('/destroy/{post}', [PostController::class, 'destroy'])->name('admin.content.post.destroy');
        Route::post('/status/{post}', [PostController::class, 'status'])->name('admin.content.post.status');
        Route::post('/commentable/{post}', [PostController::class, 'commentable'])->name('admin.content.post.commentable');

    });
});

//--------------------------------------------------------------------------


//USER
Route::prefix('user')->namespace('User')->group(function () {

    //admin-user
    Route::prefix('admin-user')->group(function(){

        Route::get('/', [AdminUserController::class, 'index'])->name('admin.user.index');
        Route::get('/create', [AdminUserController::class, 'create'])->name('admin.user.create');
        Route::post('/store', [AdminUserController::class, 'store'])->name('admin.user.store');
        Route::get('/edit/{admin}', [AdminUserController::class, 'edit'])->name('admin.user.edit');
        Route::put('/update/{admin}', [AdminUserController::class, 'update'])->name('admin.user.update');
        Route::delete('/destroy/{admin}', [AdminUserController::class, 'destroy'])->name('admin.user.destroy');
        Route::post('/activation/{admin}', [AdminUserController::class, 'changeActive'])->name('admin.user.activation');
        Route::post('/status/{admin}', [AdminUserController::class, 'status'])->name('admin.user.status');
        Route::post('/soft/{admin}', [AdminUserController::class, 'softDelete'])->name('admin.user.soft');

    });

     //customer
     Route::prefix('customer')->group(function(){

        Route::get('/', [CustomerController::class, 'index'])->name('admin.user.customer.index');
        Route::get('/create', [CustomerController::class, 'create'])->name('admin.user.customer.create');
        Route::post('/store', [CustomerController::class, 'store'])->name('admin.user.customer.store');
        Route::get('/edit/{user}', [CustomerController::class, 'edit'])->name('admin.user.customer.edit');
        Route::put('/update/{user}', [CustomerController::class, 'update'])->name('admin.user.customer.update');
        Route::delete('/destroy/{user}', [CustomerController::class, 'destroy'])->name('admin.user.customer.destroy');
        Route::post('/status/{user}', [CustomerController::class, 'status'])->name('admin.user.customer.status');
        Route::post('/activation/{user}', [CustomerController::class, 'changeActive'])->name('admin.user.customer.activation');

    });


    //role
     Route::prefix('role')->group(function(){

        Route::get('/', [RoleController::class, 'index'])->name('admin.user.role.index');
        Route::get('/create', [RoleController::class, 'create'])->name('admin.user.role.create');
        Route::post('/store', [RoleController::class, 'store'])->name('admin.user.role.store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('admin.user.role.edit');
        Route::put('/update/{id}', [RoleController::class, 'update'])->name('admin.user.role.update');
        Route::delete('/destroy/{id}', [RoleController::class, 'destroy'])->name('admin.user.role.destroy');

    });


    //permission
     Route::prefix('permission')->group(function(){

        Route::get('/', [PermissionController::class, 'index'])->name('admin.user.permission.index');
        Route::get('/create', [PermissionController::class, 'create'])->name('admin.user.permission.create');
        Route::post('/store', [PermissionController::class, 'store'])->name('admin.user.permission.store');
        Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('admin.user.permission.edit');
        Route::put('/update/{id}', [PermissionController::class, 'update'])->name('admin.user.permission.update');
        Route::delete('/destroy/{id}', [PermissionController::class, 'destroy'])->name('admin.user.permission.destroy');

    });

});

//--------------------------------------------------------------------------

//NOTIFY
Route::prefix('notify')->namespace('Notify')->group(function(){

     //email
     Route::prefix('email')->group(function(){

        Route::get('/', [EmailController::class, 'index'])->name('admin.notify.email.index');
        Route::get('/create', [EmailController::class, 'create'])->name('admin.notify.email.create');
        Route::post('/store', [EmailController::class, 'store'])->name('admin.notify.email.store');
        Route::get('/edit/{email}', [EmailController::class, 'edit'])->name('admin.notify.email.edit');
        Route::put('/update/{email}', [EmailController::class, 'update'])->name('admin.notify.email.update');
        Route::delete('/destroy/{email}', [EmailController::class, 'destroy'])->name('admin.notify.email.destroy');
        Route::post('/status/{email}', [EmailController::class, 'status'])->name('admin.notify.email.status');

    });

    //email-file
     Route::prefix('email-file')->group(function(){

        Route::get('/{email}', [EmailFileController::class, 'index'])->name('admin.notify.email-file.index');
        Route::get('/{email}/create', [EmailFileController::class, 'create'])->name('admin.notify.email-file.create');
        Route::post('/{email}/store', [EmailFileController::class, 'store'])->name('admin.notify.email-file.store');
        Route::get('/edit/{file}', [EmailFileController::class, 'edit'])->name('admin.notify.email-file.edit');
        Route::put('/update/{file}', [EmailFileController::class, 'update'])->name('admin.notify.email-file.update');
        Route::delete('/destroy/{file}', [EmailFileController::class, 'destroy'])->name('admin.notify.email-file.destroy');
        Route::post('/status/{file}', [EmailFileController::class, 'status'])->name('admin.notify.email-file.status');

    });


    //sms
     Route::prefix('sms')->group(function(){

        Route::get('/', [SMSController::class, 'index'])->name('admin.notify.sms.index');
        Route::get('/create', [SMSController::class, 'create'])->name('admin.notify.sms.create');
        Route::post('/store', [SMSController::class, 'store'])->name('admin.notify.sms.store');
        Route::get('/edit/{sms}', [SMSController::class, 'edit'])->name('admin.notify.sms.edit');
        Route::put('/update/{sms}', [SMSController::class, 'update'])->name('admin.notify.sms.update');
        Route::delete('/destroy/{sms}', [SMSController::class, 'destroy'])->name('admin.notify.sms.destroy');
        Route::post('/status/{sms}', [SMSController::class, 'status'])->name('admin.notify.sms.status');

    });


});

//--------------------------------------------------------------------------

//TICKET
Route::prefix('ticket')->namespace('Ticket')->group(function(){

    Route::prefix('category')->group(function(){

        Route::get('/', [TicketCategoryController::class, 'index'])->name('admin.ticket.category.index');
        Route::get('/create', [TicketCategoryController::class, 'create'])->name('admin.ticket.category.create');
        Route::post('/store', [TicketCategoryController::class, 'store'])->name('admin.ticket.category.store');
        Route::get('/edit/{ticketCategory}', [TicketCategoryController::class, 'edit'])->name('admin.ticket.category.edit');
        Route::put('/update/{ticketCategory}', [TicketCategoryController::class, 'update'])->name('admin.ticket.category.update');
        Route::delete('/destroy/{ticketCategory}', [TicketCategoryController::class, 'destroy'])->name('admin.ticket.category.destroy');
        Route::post('/status/{ticketCategory}', [TicketCategoryController::class, 'status'])->name('admin.ticket.category.status');

    });


    //priority
    Route::prefix('priority')->group(function(){

        Route::get('/', [TicketPriorityController::class, 'index'])->name('admin.ticket.priority.index');
        Route::get('/create', [TicketPriorityController::class, 'create'])->name('admin.ticket.priority.create');
        Route::post('/store', [TicketPriorityController::class, 'store'])->name('admin.ticket.priority.store');
        Route::get('/edit/{ticketPriority}', [TicketPriorityController::class, 'edit'])->name('admin.ticket.priority.edit');
        Route::put('/update/{ticketPriority}', [TicketPriorityController::class, 'update'])->name('admin.ticket.priority.update');
        Route::delete('/destroy/{ticketPriority}', [TicketPriorityController::class, 'destroy'])->name('admin.ticket.priority.destroy');
        Route::post('/status/{ticketPriority}', [TicketPriorityController::class, 'status'])->name('admin.ticket.priority.status');

    });

    //admin
    Route::prefix('admin')->group(function(){

        Route::get('/', [TicketAdminController::class, 'index'])->name('admin.ticket.admin.index');
        Route::get('/set/{admin}', [TicketAdminController::class, 'set'])->name('admin.ticket.admin.set');

    });



    //Main Ticket
    Route::get('/', [TicketController::class, 'index'])->name('admin.ticket.index');
    Route::get('/new-ticket', [TicketController::class, 'newTicket'])->name('admin.ticket.newTicket');
    Route::get('/open-ticket', [TicketController::class, 'openTicket'])->name('admin.ticket.openTicket');
    Route::get('/close-ticket', [TicketController::class, 'closeTicket'])->name('admin.ticket.closeTicket');
    Route::get('/show/{ticket}', [TicketController::class, 'show'])->name('admin.ticket.show');
    Route::post('/answer/{ticket}', [TicketController::class, 'answer'])->name('admin.ticket.answer');
    Route::post('/change/{ticket}', [TicketController::class, 'change'])->name('admin.ticket.change');

});

//--------------------------------------------------------------------------


//SETTING
Route::prefix('setting')->namespace('Setting')->group(function(){

    Route::get('/', [SettingController::class, 'index'])->name('admin.setting.index');
    Route::get('/create', [SettingController::class, 'create'])->name('admin.setting.create');
    Route::get('/store', [SettingController::class, 'store'])->name('admin.setting.store');
    Route::get('/edit/{setting}', [SettingController::class, 'edit'])->name('admin.setting.edit');
    Route::put('/update/{setting}', [SettingController::class, 'update'])->name('admin.setting.update');
    Route::delete('/destroy/{setting}', [SettingController::class, 'destroy'])->name('admin.setting.destroy');

});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


//error when page not found
Route::fallback(function () {
    return view('errors.404.index');
});
