<?php

namespace App\Http\Controllers\BacklinkApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowAdminDashboard extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
       
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('pages.backlinkapp.admin_dashboard');
    }
}
