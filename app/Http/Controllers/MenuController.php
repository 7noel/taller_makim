<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\Finances\CompanyRepo;

class MenuController extends Controller
{
    protected $repo;

    public function links()
    {
        //session(['my_company' => 100]);
        //$arrayLinks = [];
        $arrayLinks = $this->arrayLinks();

        if (\Auth::user()->is_superuser == true) {
            return $arrayLinks;
        }

        $permissions = \Auth::user()->getMyPermissions()->pluck('action');
        foreach ($arrayLinks as $k => $module) {
            foreach ($module as $key => $link) {
                if (!isset($link['route'])) {
                    unset($arrayLinks[$k][$key]);
                } elseif (!$permissions->search($link['route'])) {
                    unset($arrayLinks[$k][$key]);
                }
            }
            if (count($arrayLinks[$k]) == 0) {
                unset($arrayLinks[$k]);
            }
        }

        return $arrayLinks;

    }
    
    private function arrayLinks()
    {
        $links = [
            'Config'=>[
                ['name' => 'Usuarios', 'route' => 'users.index'],
                ['name' => 'Roles', 'route' => 'roles.index', 'div' => '1'],
                ['name' => 'Grupos', 'route' => 'permission_groups.index'],
                ['name' => 'Permisos', 'route' => 'permissions.index'],
            ],
            'Almacén'=>[
                // ['name' => 'Notas de Ingreso', 'route' => 'input_notes.index'],
                // ['name' => 'Notas de Salida', 'route' => 'output_notes.index'],
                ['name' => 'Repuestos', 'route' => 'products.index'],
                ['name' => 'Servicios', 'route' => 'services.index'],
                // ['name' => 'Almacenes', 'route' => 'warehouses.index'],
                // ['name' => 'Categorías', 'route' => 'categories.index'],
                ['name' => 'Sub Categorías', 'route' => 'sub_categories.index'],
                ['name' => 'Unidades', 'route' => 'units.index'],
                ['name' => 'Marcas', 'route' => 'marcas.index'],
            ],
            'RR HH'=>[
                ['name' => 'Empleados', 'route' => 'employees.index'],
                ['name' => 'Cargos', 'route' => 'jobs.index'],
            ],
            'Finanzas'=>[
                // ['name' => 'Emite Canje de Letras', 'route' => 'output_swaps.index'],
                // ['name' => 'Recibe Letras', 'route' => 'input_letters.index'],
                ['name' => 'Cuentas', 'route' => 'banks.index'],
                ['name' => 'Tipo de Cambio', 'route' => 'exchanges.index'],
                ['name' => 'Control de Documentos', 'route' => 'document_controls.index'],
                ['name' => 'Condiciones de Pago', 'route' => 'payment_conditions.index'],
            ],
            'Taller'=>[
                ['name' => 'Citas', 'route' => 'appointments.index'],
                ['name' => 'Cotizaciones', 'route' => 'output_quotes.index'],
                ['name' => 'Ordenes', 'route' => 'output_orders.index'],
                ['name' => 'Facturación', 'route' => 'output_vouchers.index'],
                ['name' => 'Marcas', 'route' => 'brands.index', 'div' => '1'],
                ['name' => 'Vehículos', 'route' => 'cars.index'],
                ['name' => 'Clientes', 'route' => 'clients.index'],
                // ['name' => 'Transportistas', 'route' => 'shippers.index'],
            ],
            'Logística'=>[
                // ['name' => 'Requerimientos', 'route' => 'input_quotes.index'],
                ['name' => 'Ordenes de Compra', 'route' => 'input_orders.index'],
                ['name' => 'Compras', 'route' => 'input_vouchers.index'],
                ['name' => 'Proveedores', 'route' => 'providers.index', 'div' => '1'],
            ],
            'Reportes'=>[
                ['name' => 'Nacimiento', 'route' => 'cars.nacimiento'],
            ],
        ];
        return $links;
    }
}