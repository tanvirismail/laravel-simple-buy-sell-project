<?php

namespace App\Providers;

use App\Product;
use App\Observers\ProductObserver;
use App\Repositories\CategoryEloquent;
use App\Repositories\CategoryInterface;
use App\Repositories\ProductEloquent;
use App\Repositories\ProductInterface;
use App\Repositories\UserEloquent;
use App\Repositories\UserInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CategoryInterface::class, CategoryEloquent::class);
        $this->app->singleton(ProductInterface::class, ProductEloquent::class);
        $this->app->singleton(UserInterface::class, UserEloquent::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Product::observe(ProductObserver::class);


        Validator::extend('lte_db', function($attribute, $value, $parameters, $validator) {
            $table = $parameters[0];
            $column = $parameters[1];
            $id = $parameters[2];
            
            $check_lte_db = DB::table($table)->where([[$column, '<=', $value],['id', '=',$id]])->count();
           
            return $check_lte_db === 0;
        });
        // Validator::replacer('lte_db', function($message, $attribute, $rule, $parameters) {
        //     return str_replace(':value', Input::get($attribute), $message);
        // });

    }
}
