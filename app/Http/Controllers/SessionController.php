<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class SessionController extends Controller
{
    public function set_session(Request $request)
    {
        Session::put('company_id', $request->company_id);

        return true;
    }
}
