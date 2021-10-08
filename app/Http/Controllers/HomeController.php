<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Finances\Exchange;

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
        $last_tc = Exchange::orderBy('fecha', 'desc')->first();
        if (is_null($last_tc) or $last_tc->fecha < date('Y-m-d')) {
            $cambio=0;
            $t_cs = getTipoCambioMes(date('Y'), date('m'));
            foreach ($t_cs as $key => $t_c) {
                if (is_null($last_tc) or $t_c->fecha > $last_tc->fecha) {
                    $cambio = Exchange::create(['my_company'=>1, 'fecha'=>$t_c->fecha, 'venta'=>$t_c->venta, 'compra'=>$t_c->compra]);
                }
            }
        }
        $items = $this->allLinks();
        return view('home', compact('items'));
        // return view('home');
    }

    public function allLinks()
    {
        return [
            'home'          => [],
            'about'         => [],
            'contact-us'    => [],
            'login'         => [],
            'register'      => [],
            'options'       => ['submenu' => [
                                    'about'     => [],
                                    'company'   => []
                                    ],
                                ]
        ];
    }
}
