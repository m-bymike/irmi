<?php

namespace Irma\Http\Controllers;

use Irma\Services\IrmaClient;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param IrmaClient $client
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IrmaClient $client)
    {
        $user = \Auth::user();
        $client->login($user->irma_user, $user->irma_pw);

        return view('home', [
            'reservations' => $client->getUserReservations($user->irma_user),
        ]);
    }

    public function profile()
    {
        $user = \Auth::user();

        return view('auth.profile', [
            'user' => $user,
        ]);
    }
}
