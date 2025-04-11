<?php


use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserViewController;
use App\Http\Controllers\UserViewsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StatsController;

Route::get('/', [HomeController::class, 'index'])->name('home');

//AGRUPAR RUTAS QUE REQUIEREN AUTENTICACIÓN
Route::middleware('auth')->group(function () {
    //RUTA PARA DASHBOARD DE USUARIO
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    //RUTA PARA DASHBOARD DE ADMINISTRADOR
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard')->middleware('admin'); //MIDDLEWARE PARA VERIFICAR SI ES ADMIN
});



//RUTAS DE AUTENTICACION
Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register');
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

//RUTAS DE LAS CATEGORIAS
Route::middleware(['auth', 'admin'])->group(function (){
    Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');

    Route::get('/categories/create', [CategoryController::class, 'create'])
    ->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])
    ->name('categories.store');

    Route::get('/categories/{category}', [CategoryController::class, 'show'])
    ->name('categories.show');

    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
    ->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])
    ->name('categories.update');

    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
    ->name('categories.destroy');
});
    

//RUTAS DE LOS PRODUCTOS

Route::middleware(['auth', 'admin'])->group(function (){
    Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

    Route::get('/products/create', [ProductController::class, 'create'])
    ->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])
    ->name('products.store');

    Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
    ->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])
    ->name('products.update');

    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
    ->name('products.destroy');
});

//RUTAS DE LAS VENTAS

Route::middleware(['auth', 'admin'])->group(function (){
    Route::get('/sales', [SaleController::class, 'index'])
    ->name('sales.index');

    Route::get('/sales/create', [SaleController::class, 'create'])
    ->name('sales.create');
    Route::post('/sales', [SaleController::class, 'store'])
    ->name('sales.store');

    Route::get('/sales/{sale}', [SaleController::class, 'show'])
    ->name('sales.show');

    Route::get('/sales/{sale}/edit', [SaleController::class, 'edit'])
    ->name('sales.edit');
    Route::put('/sales/{sale}', [SaleController::class, 'update'])
    ->name('sales.update');

    Route::delete('/sales/{sale}', [SaleController::class, 'destroy'])
    ->name('sales.destroy');

});    

//RUTAS DE AUTORES

Route::middleware(['auth', 'admin'])->group(function (){
    Route::get('/authors', [AuthorController::class, 'index'])
    ->name('authors.index');

    Route::get('/authors/create', [AuthorController::class, 'create'])
    ->name('authors.create');
    Route::post('/authors', [AuthorController::class, 'store'])
    ->name('authors.store');

    Route::get('/authors/{author}', [AuthorController::class, 'show'])
    ->name('authors.show');

    Route::get('/authors/{author}/edit', [AuthorController::class, 'edit'])
    ->name('authors.edit');
    Route::put('/authors/{author}', [AuthorController::class, 'update'])
    ->name('authors.update');

    Route::delete('/authors/{author}', [AuthorController::class, 'destroy'])
    ->name('authors.destroy');
});

//RUTAS DE COMPRAS

Route::middleware(['auth'])->group(function (){
    // Ruta para mostrar el carrito/comprar
    Route::get('/products/{product}/purchase', [PurchaseController::class, 'showPurchaseForm'])
         ->name('products.purchase');
         
    // Ruta para procesar la compra
    Route::post('/products/{product}/purchase', [PurchaseController::class, 'processPurchase'])
         ->name('product.process-purchase');
         
    // Ruta para ver compras del usuario
    Route::get('/my-purchases', [PurchaseController::class, 'userPurchases'])
         ->name('purchases.index');

});


// Rutas del carrito
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/process-checkout', [CartController::class, 'processCheckout'])->name('cart.process-checkout');
});


     
//RUTA VER LIBROS (USUARIOS)

Route::get('/user/books', [UserController::class, 'index'])
->name('books.index');
Route::get('/user/books/{product}', [UserController::class, 'show'])
->name('books.show');