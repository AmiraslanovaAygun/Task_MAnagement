<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;

class Helper
{

    public static function isActiveMenu($url, $className = 'active')
    {
        return request()->url() == $url ? $className : '';
    }

    public static function isActive()
    {
        $routes = [
            'admin.dashboard' => 'ƏSAS SƏHİFƏ',
            'admin.project' => 'PROYEKTLƏR',
            'admin.task' => 'TAPŞIRIQLAR',
            'admin.user' => 'İSTİFADƏÇİLƏR',
            'admin.profile' => 'PROFİLİM'
        ];

        $currentRoute = Route::currentRouteName();

        return $routes[$currentRoute] ?? ' ';
    }
}
    
