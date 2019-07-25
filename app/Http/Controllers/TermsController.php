<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsController extends Controller
{
    /**
     * Show Terms of Service page.
     *
     * @return Response
     */
    public function service()
    {        
        return view('terms.service');
    }

    /**
     * Show Privacy page.
     *
     * @return Response
     */
    public function privacy()
    {        
        return view('terms.privacy');
    }
}
