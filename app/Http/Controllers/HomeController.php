<?php

namespace App\Http\Controllers;
use App\Models\Lembagasurvey;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        $lembaga = Lembagasurvey::where('id',auth()->user()->lembagasurvey->id)->update(
            [
                'status' => 'aktif',
                'updated_at' => Carbon::now()
            ]
        );
        return view('page.dashboard');
    }
}
