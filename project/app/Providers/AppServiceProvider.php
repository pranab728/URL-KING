<?php

namespace App\Providers;

use App\Models\Admin\Currency;
use App\Models\Admin\Font;
use App\Models\Admin\Language;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Paginator::useBootstrap();

        view()->composer('*',function($settings){


            $settings->with('gs', DB::table('generalsettings')->find(1));
            $settings->with('ps', DB::table('pagesettings')->find(1));
            $settings->with('pages', DB::table('pages')->where('status',1)->get());
            $settings->with('default_font', Font::where('is_default','=',1)->first());
            $settings->with('seo',  DB::table('seotools')->first());
            $settings->with('socialsetting', cache()->remember('socialsettings', now()->addDay(), function () {
                return DB::table('socialsettings')->first();
            }));

            if (Session::has('currency'))
            {
                $settings->with('curr', Currency::find(Session::get('currency')));

            }
            else
            {
                $settings->with('curr',  Currency::where('is_default','=',1)->first());

            }

            if (Session::has('language'))
            {
                $settings->with('langg',  cache()->remember('session_language', now()->addDay(), function () {
                    return Language::find(Session::get('language'));
                }));
            }
            else
            {
                $settings->with('langg', cache()->remember('session_language', now()->addDay(), function () {
                    return Language::where('is_default','=',1)->first();
                }));
            }

             //lANGUAGE uPDATE
             if (\Request::is('admin') || \Request::is('admin/*')) {
                $data = DB::table('adminpanel_languages')->where('is_default','=',1)->first();
                App::setlocale($data->name);
            }
            else {

                if (Session::has('language')) {
                    $data = DB::table('languages')->find(Session::get('language'));

                    App::setlocale($data->name);
                }
                else {
                    $data = DB::table('languages')->where('is_default','=',1)->first();
                    App::setlocale($data->name);
                }
            }








        });
    }

   

}
