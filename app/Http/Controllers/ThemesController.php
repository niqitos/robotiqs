<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cookie;

class ThemesController extends Controller
{
    /**
     * Update theme.
     *
     * @return Response
     */
    public function update(Request $request)
    {   
        $theme = $request->theme === 'dark' 
            ? 'light' 
            : 'dark';

        Cookie::queue('theme', $theme, 525600);
        
        return response()->json([
            'theme' => $theme
        ]);
    }

}
