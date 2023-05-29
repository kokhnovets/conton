<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\Users\Orders\ShowDetailOrderController;
use App\Http\Controllers\Admin\Users\ShowAllUsersController;
use App\Http\Controllers\Admin\Users\ShowDetailAdminUserController;
use App\Http\Controllers\Delivery\DestroyDeliveryController;
use App\Http\Controllers\Delivery\StoreDeliveryController;
use App\Http\Controllers\Delivery\StoreStatusController;
use App\Http\Controllers\Delivery\UpdateOrderController;
use App\Http\Controllers\Feedback\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\Order\ShowOrderController;
use App\Http\Controllers\Order\StoreOrderController;
use App\Http\Controllers\PolicyAndTerms\ShowPolicyOrTermsController;
use App\Http\Controllers\PublicPage\ShowPagesController;
use App\Http\Controllers\Settings\DeleteController;
use App\Http\Controllers\Settings\ShowSettingsController;
use App\Http\Controllers\Settings\UpdateSettingsController;
use App\Http\Controllers\Sitemap\SitemapController;
use App\Http\Controllers\Travel\Offer\StoreOfferController;
use App\Http\Controllers\Travel\Offer\UpdateOfferController;
use App\Http\Controllers\Travel\ShowAllController;
use App\Http\Controllers\Travel\ShowController;
use App\Http\Controllers\User\DeleteOrderController;
use App\Http\Controllers\User\ShowUserController;
use App\Http\Controllers\User\UpdateUserController;
use App\Http\Controllers\Users\ShowDetailUserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\Deliveries\ShowDetailDeliveryController;
use App\Http\Controllers\Admin\Users\Ban\BanController;
use App\Http\Controllers\Admin\Users\Ban\UnbanController;
use App\Http\Controllers\Admin\Users\Restore\RestoreController;

// Страницы для информации пользователей:
Route::controller(ShowPagesController::class)->group(function () {
    Route::get('/', 'showIndex')->name('index'); // Главная страница
    Route::get('/about', 'showAbout')->name('about'); // Страница "О нас"
});

Route::controller(ShowPolicyOrTermsController::class)->group(function () {
    Route::get('/terms', 'showTerms')->name('terms'); // Страница условия использования
    Route::get('/policy', 'showPolicy')->name('policy'); // Страница политики конфиденциальности
});

// Страницы авторизации и регистрации, обработка входных данных:
Auth::routes(['verfiy' => true]);
// Переадресация после успешной авторизации на страницу с действиями:
Route::group(['prefix' => 'home', 'middleware' => ['forbid-banned-user', 'logs-out-banned-user', 'auth', 'verified']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

// Открытие настроек личного кабинета и сохранение изменений:
Route::group(['prefix' => 'account/settings', 'middleware' => ['forbid-banned-user', 'logs-out-banned-user', 'auth', 'verified']], function () {
    // Открытие настроек:
    Route::controller(ShowSettingsController::class)->group(function () {
        Route::get('/', 'showSettings')->name('user.settings'); // Открытие страницы с настройками
        Route::get('/profile', 'showSettingsProfile')->name('user.settings.profile'); // Открытие настройки профиля
        Route::get('/details', 'showSettingsDetails')->name('user.settings.details'); // Открытие настройки деталей аккаунта
        Route::get('/phone', 'showSettingsPhone')->name('user.settings.phone'); // Открытие настройки телефона
    });
    // Сохранение настроек:
    Route::controller(UpdateSettingsController::class)->group(function () {
        Route::patch('/profile/update', 'updateSettingsProfile')->name('user.update.profile'); // Сохранение настройки профиля
        Route::patch('/details/update', 'updateSettingsDetails')->name('user.update.details'); // Сохранение настройки деталей аккаунта
        Route::patch('/phone/update', 'updateSettingsPhone')->name('user.update.phone'); // Сохранение настройки телефона
    });
    // Удаление аккаунта пользователя:
    Route::controller(DeleteController::class)->group(function () {
        Route::post('/details/delete', 'deleteUserAccount')->name('user.delete.account');
    });
});

//Отображение формы, отображение данных с форм и добавление заказа, а также отмена создания заказа:
Route::group(['prefix' => 'order', 'middleware' => ['forbid-banned-user', 'logs-out-banned-user', 'auth', 'verified']], function () {
    Route::get('/', [ShowOrderController::class, 'showAddOrderForm'])->name('order.add');
    Route::post('/show', [StoreOrderController::class, 'validateAndShowOrder'])->name('order.validate.show');
    Route::post('/create', [StoreOrderController::class, 'storeOrder'])->name('order.store');
    Route::post('/revoke', [StoreOrderController::class, 'revokeOrder'])->name('order.revoke');
});

// Отображение всех актуальных заказов и детали одного заказа, а также создание оффера к заказам и изменение:
Route::group(['prefix' => 'travel', 'middleware' => ['forbid-banned-user', 'logs-out-banned-user', 'auth', 'verified']], function () {
    Route::get('/', [ShowAllController::class, 'showAllOrders'])->name('travel');
    Route::get('/{order}', [ShowController::class, 'showOrder'])->name('order.show');

    Route::group(['prefix' => '{order}/offer'], function() {
        Route::post('/', [StoreOfferController::class, 'storeOffer'])->name('order.store.offer');
    });
    Route::group(['prefix' => '{order}/offer'], function() {
        Route::patch('/', [UpdateOfferController::class, 'updateOffer'])->name('order.update.offer');
    });
});

// Пользовательские заказы, поездки, просмотр конкретного заказа или поездки, редактирование и удаление заказов:
Route::group(['prefix' => 'user', 'middleware' => ['forbid-banned-user', 'logs-out-banned-user', 'auth', 'verified']], function () {
    Route::controller(ShowUserController::class)->group(function () {
        Route::prefix('orders')->group(function () {
            Route::get('/', 'showUserOrders')->name('user.orders');
            Route::get('/posted', 'showUserOrdersPosted')->name('user.orders.posted');
            Route::get('/active', 'showUserOrdersActive')->name('user.orders.active');
            Route::get('/completed', 'showUserOrdersCompleted')->name('user.orders.completed');
            Route::get('/posted/{order}', 'showUserOrderPosted')->name('user.orders.posted.detail');
            Route::get('/active/{order}', 'showUserOrderActive')->name('user.orders.active.detail');
            Route::get('/completed/{order}', 'showUserOrderCompleted')->name('user.orders.completed.detail');
        });
        Route::prefix('trips')->group(function () {
            Route::get('/', 'showUserTrips')->name('user.trips');
            Route::get('/active', 'showUserTripsActive')->name('user.trips.active');
            Route::get('/completed', 'showUserTripsCompleted')->name('user.trips.completed');
            Route::get('/active/{order}', 'showUserTripActive')->name('user.trips.active.detail');
            Route::get('/completed/{order}', 'showUserTripCompleted')->name('user.trips.completed.detail');
        });
    });
    // Редактирование пользовательских заказов:
    Route::controller(UpdateUserController::class)->group(function () {
        Route::get('/orders/{order}/edit', 'showEditUserOrder')->name('user.orders.edit.show');
        Route::patch('/orders/{order}', 'updateUserOrder')->name('user.orders.edit.update');
    });
    Route::delete('/orders/{order}/delete', [DeleteOrderController::class, 'destroyOrder'])->name('user.orders.delete');
    // Создание доставки:
    Route::post('/orders/{order}/create-delivery', [StoreDeliveryController::class, 'storeDeliveries'])->name('user.delivery.store');

    // Подтверждение успешной доставки:
    Route::patch('/orders/{order}/susses', [UpdateOrderController::class, 'sussesDeliveries'])->name('user.delivery.susses');

    // Отмена доставки:
    Route::delete('/orders/{order}/delete-delivery', [DestroyDeliveryController::class, 'destroyDeliveries'])->name('user.delivery.destroy');

    // Создание статуса доставки:
    Route::post('/orders/{order}/status', [StoreStatusController::class, 'storeStatuses'])->name('user.delivery.status');
});
// Отображение всех новостей и просмотр одной статьи:
Route::group(['prefix' => 'news'], function () {
    Route::get('/', [NewsController::class, 'showAllNews'])->name('news');
    Route::get('/{news}', [NewsController::class, 'showDetailNews'])->name('news.show');
});
// Sitemap:
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

// Обратная связь
Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.show');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

Route::get('/users/{user}',[ShowDetailUserController::class, '__invoke'])->name('user.detail.show');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin', 'verified']], function () {
    Route::get('/', [IndexController::class, 'index'])->name('admin');
    Route::prefix('/users')->group(function () {
        Route::get('/', [ShowAllUsersController::class, 'index'])->name('admin.users');
        Route::get('/{user}', [ShowDetailAdminUserController::class, 'orders'])->name('admin.users.detail');
        Route::get('/{user}/orders', [ShowDetailAdminUserController::class, 'orders'])->name('admin.users.detail.orders');
        Route::get('/{user}/orders/{order}', [ShowDetailOrderController::class, 'order'])->name('admin.users.orders.detail');
        Route::get('/{user}/deliveries', [ShowDetailAdminUserController::class, 'deliveries'])->name('admin.users.detail.deliveries');
        Route::get('/{user}/deliveries/{order}', [ShowDetailDeliveryController::class, 'delivery'])->name('admin.users.deliveries.detail');
        // Бан и разбан пользователей
        Route::patch('/banned/{user}', [BanController::class, 'banned'])->name('admin.users.banned');
        Route::patch('/unbanned/{user}', [UnbanController::class, 'unbanned'])->name('admin.users.unbanned');
        // Восставление удаленного аккаунта
        Route::patch('/restore/{user}', [RestoreController::class, 'restore'])->name('admin.users.restore');
    });
    Route::prefix('/orders')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\Orders\ShowAllController::class, 'index'])->name('admin.orders');
        Route::get('/{order}', [\App\Http\Controllers\Admin\Orders\ShowDetailController::class, 'index'])->name('admin.orders.detail');
        Route::delete('/delete/{order}', [\App\Http\Controllers\Admin\Orders\ShowDetailController::class, 'destroy'])->name('admin.orders.detail.destroy');
    });
    Route::prefix('/news')->group(function () {
        Route::get('/add', [\App\Http\Controllers\Admin\News\ShowController::class, 'index'])->name('admin.news.show.form');
        Route::post('/', [\App\Http\Controllers\Admin\News\StoreController::class, 'store'])->name('admin.news.store');
    });
    Route::prefix('/feedbacks')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\Feedback\ShowController::class, 'index'])->name('admin.feedbacks');
        Route::patch('/{feedback}', [\App\Http\Controllers\Admin\Feedback\ResponseController::class, 'index'])->name('admin.feedbacks.response');
    });
});


// Подтверждение почты после регистрации:
Route::group(['prefix' => 'email', 'middleware' => ['auth']], function () {
    Route::group(['prefix' => 'verify'], function () {
        Route::get('/', function () {
            return view('auth.verify');
        })->name('verification.notice');
        Route::get('/{id}/{hash}', function (EmailVerificationRequest $request) {
            $request->fulfill();
            return redirect('/home');
        })->middleware('signed')->name('verification.verify');
    });
    Route::post('/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Ссылка для подтверждения отправлена на ваш электронный адрес!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});







