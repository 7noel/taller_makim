<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Finances\Exchange;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Modules\Operations\Order;

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
            $cambio = 0;
            $t_cs = getTipoCambioMes(date('Y'), date('m'));
            foreach ($t_cs as $key => $t_c) {
                if (isset($t_c->fecha)) {
                    if (is_null($last_tc) or $t_c->fecha > $last_tc->fecha) {
                        $cambio = Exchange::create(['my_company'=>1, 'fecha'=>$t_c->fecha, 'venta'=>$t_c->venta, 'compra'=>$t_c->compra]);
                    }
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

    public function uploadPhoto(Request $request)
    {
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            // Validar que sea una imagen y pese menos de 5MB
            $request->validate([
                'photo' => 'image|mimes:jpeg,jpg,png|max:5120',
            ]);

            // Generar nombre único
            $filename = now()->format('Ymd_His') . '_' . Str::random(6) . '.jpg';

            // Guardar en disco (ej: public/photos)
            $path = $file->storeAs('public/photos', $filename);

            return response()->json([
                'status' => 'success',
                'filename' => 'photos/' . $filename // importante: quitar 'public/' para que se use en storage
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'No se subió ninguna imagen'], 422);
    }

    public function prueba()
    {
        $orders = Order::with('quote')->has('quote')->where('order_type', 'output_quotes')->whereNull('inventory')->get();
        // dd($orders);
        foreach ($orders as $key => $order) {
            $inventory = $order->inventory ?? (object) [];
            $inventory->seguro = $order->quote->inventory->seguro;
            $inventory->contact_name = $order->quote->inventory->contact_name;
            $inventory->contact_email = $order->quote->inventory->contact_email;
            $inventory->contact_mobile = $order->quote->inventory->contact_mobile;
            //dd($order);
            $order->inventory = $inventory;
            $order->save();
        }
        return "finnnn";
    }
}
