<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
    
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    protected $prefix;
    protected $controller;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // setlocale(LC_TIME, 'Spanish');
        // \Carbon::setUtf8(true);
        $uri = \Request::server('REQUEST_URI');
        $uri = explode('?', $uri);
        $url = explode('/', $uri[0]);
        array_shift($url);
        $this->prefix = array_shift($url);
        $this->controller = array_shift($url) ?? 'exchanges';
        $_views = $this->views();
        $_routes = $this->routes();
        $_labels = $this->labels($this->controller);
        $_icons = $this->icons();
        View::share('views', $_views);
        View::share('routes', $_routes);
        View::share('labels', $_labels);
        View::share('icons', $_icons);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function views()
    {
        return [
            'scripts' => $this->prefix . '.' . $this->controller. '.scripts',
            'table' => $this->prefix . '.' . $this->controller. '.partials.table',
            'fields' => $this->prefix . '.' . $this->controller. '.partials.fields',
            'edit' => $this->prefix . '.' . $this->controller. '.edit',
            'delete' => $this->prefix . '.' . $this->controller. '.delete',
            'filter' => $this->prefix . '.' . $this->controller. '.partials.filter',
        ];
    }

    public function routes()
    {
        return [
            'index' => $this->controller. '.index',
            'create' => $this->controller. '.create',
            'store' => $this->controller. '.store',
            'edit' => $this->controller. '.edit',
            'update' => $this->controller. '.update',
            'delete' => $this->controller. '.destroy',
            'filter' => $this->controller. '.filter',
            'show' => $this->controller. '.show',
        ];
    }

    public function icons()
    {
        return [
            'poll' => '<i class="fas fa-poll"></i>',
            'store' => '<i class="fas fa-store"></i>',
            'view' => '<i class="fas fa-eye"></i>',
            'add' => '<i class="fas fa-plus"></i>',
            'edit' => '<i class="fas fa-pencil-alt"></i>',
            'remove' => '<i class="far fa-trash-alt"></i>',
            'email' => '<i class="far fa-envelope"></i>',
            'send' => '<i class="far fa-paper-plane"></i>',
            'printer' => '<i class="fas fa-print"></i>',
            'pdf' => '<i class="fas fa-file-pdf"></i>',
            'xml' => '<i class="far fa-file-code"></i>',
            'list' => '<i class="fas fa-list"></i>',
            'more' => '<i class="fas fa-ellipsis-v"></i>',
            'config' => '<i class="fas fa-cog"></i>',
            'credit-card' => '<i class="fas fa-credit-card"></i>',
            'pay' => '<i class="fab fa-cc-amazon-pay"></i>',
            'shopping' => '<i class="fas fa-shopping-cart"></i>',
            'file' => '<i class="fas fa-file-alt"></i>',
            'warning' => '<i class="fas fa-exclamation-triangle"></i>',
            'facebook' => '<i class="fab fa-facebook"></i>',
            'save' => '<i class="far fa-save"></i>',
            'search' => '<i class="fas fa-search"></i>',
            'shipping' => '<i class="fas fa-shipping-fast"></i>',
            'config' => '<i class="fas fa-cog"></i>',
            'history' => '<i class="fas fa-history"></i>',
            'check' => '<i class="fas fa-check"></i>',
            'external' => '<i class="fas fa-external-link-square-alt"></i>',
            'invoice' => '<i class="fas fa-file-invoice"></i>',
            'close' => '<i class="fas fa-times"></i>',
            'car' => '<i class="fas fa-car"></i>',
        ];
    }

    public function labels($pre='exchanges')
    {
        // $pre = $this->controller;
        $arr = [
            'polls' => [
                'index'=>'Encuestas',
                'index.create'=>'Crear Encuesta',
                'create'=>'Nueva Encuesta:',
                'create.create'=>'Crear Encuesta',
                'show'=>'Vizualizando Encuesta',
                'edit'=>'Editar Encuesta: ',
                'edit.update'=>'Actualizar Encuesta',
                'edit.delete'=>'Eliminar Encuesta',
            ],
            'document_controls' => [
                'index'=>'Controles de Documento',
                'index.create'=>'Crear Control de Documento',
                'create'=>'Nueva Control de Documento:',
                'create.create'=>'Crear Control de Documento',
                'show'=>'Vizualizando Control de Documento',
                'edit'=>'Editar Control de Documento: ',
                'edit.update'=>'Actualizar Control de Documento',
                'edit.delete'=>'Eliminar Control de Documento',
            ],
            'exchanges' => [
                'index'=>'Tipo de Cambio',
                'index.create'=>'Crear Tipo de Cambio',
                'create'=>'Nuevo Tipo de Cambio:',
                'create.create'=>'Crear Tipo de Cambio',
                'show'=>'Vizualizando Tipo de Cambio',
                'edit'=>'Editar Tipo de Cambio: ',
                'edit.update'=>'Actualizar Tipo de Cambio',
                'edit.delete'=>'Eliminar Tipo de Cambio',
            ],
            'companies' => [
                'index'=>'Empresas',
                'index.create'=>'Crear Empresa',
                'create'=>'Registrar Empresa',
                'create.create'=>'Registrar Empresa',
                'show'=>'Vizualizando Empresa:',
                'edit'=>'Editar Empresa: ',
                'edit.update'=>'Actualizar Empresa',
                'edit.delete'=>'Eliminar Empresa',
            ],
            'output_vouchers' => [
                'index'=>'Comprobantes de Venta',
                'index.create'=>'Crear Comprobante',
                'create'=>'Nueva Comprobante de Venta',
                'create.create'=>'Crear Comprobante de Venta',
                'show'=>'Vizualizando Comprobante de Venta:',
                'edit'=>'Editar Comprobante de Venta: ',
                'edit.update'=>'Actualizar Comprobante de Venta',
                'edit.delete'=>'Eliminar Comprobante de Venta',
            ],
            'input_vouchers' => [
                'index'=>'Comprobantes de Compra',
                'index.create'=>'Registrar Comprobante',
                'create'=>'Nueva Comprobante de Compra',
                'create.create'=>'Crear Comprobante de Compra',
                'show'=>'Vizualizando Comprobante de Compra:',
                'edit'=>'Editar Comprobante de Compra: ',
                'edit.update'=>'Actualizar Comprobante de Compra',
                'edit.delete'=>'Eliminar Comprobante de Compra',
            ],
            'output_letters' => [
                'index'=>'Letras Generadas',
                'index.create'=>'Crear Letra',
                'create'=>'Nueva Letra',
                'create.create'=>'Crear Letra',
                'show'=>'Vizualizando Letra:',
                'edit'=>'Editar Letra: ',
                'edit.update'=>'Actualizar Letra',
                'edit.delete'=>'Eliminar Letra',
            ],
            'input_letters' => [
                'index'=>'Letras Registradas',
                'index.create'=>'Crear Letra',
                'create'=>'Nueva Letra',
                'create.create'=>'Crear Letra',
                'show'=>'Vizualizando Letra:',
                'edit'=>'Editar Letra: ',
                'edit.update'=>'Actualizar Letra',
                'edit.delete'=>'Eliminar Letra',
            ],
            'output_swaps' => [
                'index'=>'Canjes generados',
                'index.create'=>'Crear Canje',
                'create'=>'Nueva Canje',
                'create.create'=>'Crear Canje',
                'show'=>'Vizualizando Canje:',
                'edit'=>'Editar Canje: ',
                'edit.update'=>'Actualizar Canje',
                'edit.delete'=>'Eliminar Canje',
            ],
            'input_swaps' => [
                'index'=>'Canjes Registrados',
                'index.create'=>'Registrar Canje',
                'create'=>'Nueva Canje',
                'create.create'=>'Registrar Canje',
                'show'=>'Vizualizando Canje:',
                'edit'=>'Editar Canje: ',
                'edit.update'=>'Actualizar Canje',
                'edit.delete'=>'Eliminar Canje',
            ],
            'checkitem_groups' => [
                'index'=>'Grupo de Hoja Semaforo',
                'index.create'=>'Crear Grupo',
                'create'=>'Nuevo Grupo',
                'create.create'=>'Crear Grupo',
                'show'=>'Vizualizando Grupo:',
                'edit'=>'Editar Grupo: ',
                'edit.update'=>'Actualizar Grupo',
                'edit.delete'=>'Eliminar Grupo',
            ],
            'service_checklists' => [
                'index'=>'Hojas Semáforo',
                'index.create'=>'Crear Hoja Semáforo',
                'create'=>'Nueva Hoja Semáforo',
                'create.create'=>'Crear Hoja Semáforo',
                'show'=>'Vizualizando Hoja Semáforo:',
                'edit'=>'Editar Hoja Semáforo: ',
                'edit.update'=>'Actualizar Hoja Semáforo',
                'edit.delete'=>'Eliminar Hoja Semáforo',
            ],
            'appointments' => [
                'index'=>'Citas',
                'index.create'=>'Crear Cita',
                'create'=>'Nueva Cita',
                'create.create'=>'Crear Cita',
                'show'=>'Vizualizando Cita:',
                'edit'=>'Editar Cita: ',
                'edit.update'=>'Actualizar Cita',
                'edit.delete'=>'Eliminar Cita',
            ],
            'employees' => [
                'index'=>'Empleados',
                'index.create'=>'Crear Empleado',
                'create'=>'Nuevo Empleado',
                'create.create'=>'Crear Empleado',
                'show'=>'Vizualizando Empleado:',
                'edit'=>'Editar Empleado: ',
                'edit.update'=>'Actualizar Empleado',
                'edit.delete'=>'Eliminar Empleado',
            ],
            'jobs' => [
                'index'=>'Cargos',
                'index.create'=>'Crear Cargo',
                'create'=>'Nuevo Cargo',
                'create.create'=>'Crear Cargo',
                'show'=>'Vizualizando Cargo:',
                'edit'=>'Editar Cargo: ',
                'edit.update'=>'Actualizar Cargo',
                'edit.delete'=>'Eliminar Cargo',
            ],
            'providers' => [
                'index'=>'Proveedores',
                'index.create'=>'Crear Proveedor',
                'create'=>'Nueva Proveedor',
                'create.create'=>'Crear Proveedor',
                'show'=>'Vizualizando Proveedor:',
                'edit'=>'Editar Proveedor: ',
                'edit.update'=>'Actualizar Proveedor',
                'edit.delete'=>'Eliminar Proveedor',
            ],
            'brands' => [
                'index'=>'Marcas de Vehículos',
                'index.create'=>'Crear Marca',
                'create'=>'Nueva Marca',
                'create.create'=>'Crear Marca',
                'show'=>'Vizualizando Marca:',
                'edit'=>'Editar Marca: ',
                'edit.update'=>'Actualizar Marca',
                'edit.delete'=>'Eliminar Marca',
            ],
            'purchases' => [
                'index'=>'Compras',
                'index.create'=>'Crear Compra',
                'create'=>'Nueva Compra',
                'create.create'=>'Crear Compra',
                'show'=>'Vizualizando Compra:',
                'edit'=>'Editar Compra: ',
                'edit.update'=>'Actualizar Compra',
                'edit.delete'=>'Eliminar Compra',
            ],
            'shippers' => [
                'index'=>'Transportistas',
                'index.create'=>'Crear Transportista',
                'create'=>'Nueva Transportista',
                'create.create'=>'Crear Transportista',
                'show'=>'Vizualizando Transportista:',
                'edit'=>'Editar Transportista: ',
                'edit.update'=>'Actualizar Transportista',
                'edit.delete'=>'Eliminar Transportista',
            ],
            'cars' => [
                'index'=>'Vehículos',
                'index.create'=>'Crear Vehículo',
                'create'=>'Nuevo Vehículo',
                'create.create'=>'Crear Vehículo',
                'show'=>'Vizualizando Vehículo:',
                'edit'=>'Editar Vehículo: ',
                'edit.update'=>'Actualizar Vehículo',
                'edit.delete'=>'Eliminar Vehículo',
            ],
            'clients' => [
                'index'=>'Clientes',
                'index.create'=>'Crear Cliente',
                'create'=>'Nuevo Cliente',
                'create.create'=>'Crear Cliente',
                'show'=>'Vizualizando Cliente:',
                'edit'=>'Editar Cliente: ',
                'edit.update'=>'Actualizar Cliente',
                'edit.delete'=>'Eliminar Cliente',
            ],
            'input_notes' => [
                'index'=>'Notas de Ingreso',
                'index.create'=>'Crear Nota de Ingreso',
                'create'=>'Nueva Nota de Ingreso',
                'create.create'=>'Crear Nota de Ingreso',
                'show'=>'Vizualizando Nota de Ingreso:',
                'edit'=>'Editar Nota de Ingreso: ',
                'edit.update'=>'Actualizar Nota de Ingreso',
                'edit.delete'=>'Eliminar Nota de Ingreso',
            ],
            'output_notes' => [
                'index'=>'Notas de Salida',
                'index.create'=>'Crear Nota de Salida',
                'create'=>'Nueva Nota de Salida',
                'create.create'=>'Crear Nota de Salida',
                'show'=>'Vizualizando Nota de Salida:',
                'edit'=>'Editar Nota de Salida: ',
                'edit.update'=>'Actualizar Nota de Salida',
                'edit.delete'=>'Eliminar Nota de Salida',
            ],

            'output_quotes' => [
                'index'=>'Cotizaciones',
                'index.create'=>'Crear Cotización',
                'create'=>'Nueva Cotización',
                'create.create'=>'Crear Cotización',
                'show'=>'Vizualizando Cotización:',
                'edit'=>'Editar Cotización: ',
                'edit.update'=>'Actualizar Cotización',
                'edit.delete'=>'Eliminar Cotización',
            ],
            'output_orders' => [
                'index'=>'Ordenes de Trabajo',
                'index.create'=>'Crear Orden de Trabajo',
                'create'=>'Nueva Orden de Trabajo',
                'create.create'=>'Crear Orden de Trabajo',
                'show'=>'Vizualizando Orden de Trabajo:',
                'edit'=>'Editar Orden de Trabajo: ',
                'edit.update'=>'Actualizar Orden de Trabajo',
                'edit.delete'=>'Eliminar Orden de Trabajo',
            ],

            'input_quotes' => [
                'index'=>'Requerimientos',
                'index.create'=>'Crear Requerimiento',
                'create'=>'Nuevo Requerimiento',
                'create.create'=>'Crear Requerimiento',
                'show'=>'Vizualizando Requerimiento:',
                'edit'=>'Editar Requerimiento: ',
                'edit.update'=>'Actualizar Requerimiento',
                'edit.delete'=>'Eliminar Requerimiento',
            ],

            'input_orders' => [
                'index'=>'Ordenes de Compra',
                'index.create'=>'Crear Orden de Compra',
                'create'=>'Nueva Orden de Compra',
                'create.create'=>'Crear Orden de Compra',
                'show'=>'Vizualizando Orden de Compra:',
                'edit'=>'Editar Orden de Compra: ',
                'edit.update'=>'Actualizar Orden de Compra',
                'edit.delete'=>'Eliminar Orden de Compra',
            ],
            'users' => [
                'index'=>'Usuarios',
                'index.create'=>'Crear Usuario',
                'create'=>'Nuevo Usuario',
                'create.create'=>'Crear Usuario',
                'show'=>'Vizualizando Usuario:',
                'edit'=>'Editar Usuario: ',
                'edit.update'=>'Actualizar Usuario',
                'edit.delete'=>'Eliminar Usuario',
            ],
            'roles' => [
                'index'=>'Roles',
                'index.create'=>'Crear Rol',
                'create'=>'Nuevo Rol',
                'create.create'=>'Crear Rol',
                'show'=>'Vizualizando Rol:',
                'edit'=>'Editar Rol: ',
                'edit.update'=>'Actualizar Rol',
                'edit.delete'=>'Eliminar Rol',
            ],
            'permissions' => [
                'index'=>'Permisos',
                'index.create'=>'Crear Permiso',
                'create'=>'Nuevo Permiso',
                'create.create'=>'Crear Permiso',
                'show'=>'Vizualizando Permiso:',
                'edit'=>'Editar Permiso: ',
                'edit.update'=>'Actualizar Permiso',
                'edit.delete'=>'Eliminar Permiso',
            ],
            'permission_groups' => [
                'index'=>'Grupos',
                'index.create'=>'Crear Grupo',
                'create'=>'Nuevo Grupo',
                'create.create'=>'Crear Grupo',
                'show'=>'Vizualizando Grupo:',
                'edit'=>'Editar Grupo: ',
                'edit.update'=>'Actualizar Grupo',
                'edit.delete'=>'Eliminar Grupo',
            ],
            'units' => [
                'index'=>'Unidades',
                'index.create'=>'Crear Unidad',
                'create'=>'Nueva Unidad',
                'create.create'=>'Crear Unidad',
                'show'=>'Vizualizando Unidad:',
                'edit'=>'Editar Unidad: ',
                'edit.update'=>'Actualizar Unidad',
                'edit.delete'=>'Eliminar Unidad',
            ],
            'warehouses' => [
                'index'=>'Almacenes',
                'index.create'=>'Crear Almacén',
                'create'=>'Nuevo Almacén',
                'create.create'=>'Crear Almacén',
                'show'=>'Vizualizando Almacén:',
                'edit'=>'Editar Almacén: ',
                'edit.update'=>'Actualizar Almacén',
                'edit.delete'=>'Eliminar Almacén',
            ],
            'categories' => [
                'index'=>'Categorías',
                'index.create'=>'Crear Categoría',
                'create'=>'Nueva Categoría',
                'create.create'=>'Crear Categoría',
                'show'=>'Vizualizando Categoría:',
                'edit'=>'Editar Categoría: ',
                'edit.update'=>'Actualizar Categoría',
                'edit.delete'=>'Eliminar Categoría',
            ],
            'sub_categories' => [
                'index'=>'SubCategorías',
                'index.create'=>'Crear SubCategoría',
                'create'=>'Nueva SubCategoría',
                'create.create'=>'Crear SubCategoría',
                'show'=>'Vizualizando SubCategoría:',
                'edit'=>'Editar SubCategoría: ',
                'edit.update'=>'Actualizar SubCategoría',
                'edit.delete'=>'Eliminar SubCategoría',
            ],
            'products' => [
                'index'=>'Repuestos',
                'index.create'=>'Crear Repuesto',
                'create'=>'Nuevo Repuesto',
                'create.create'=>'Crear Repuesto',
                'show'=>'Vizualizando Repuesto:',
                'edit'=>'Editar Repuesto: ',
                'edit.update'=>'Actualizar Repuesto',
                'edit.delete'=>'Eliminar Repuesto',
            ],
            'services' => [
                'index'=>'Servicios',
                'index.create'=>'Crear Servicio',
                'create'=>'Nuevo Servicio',
                'create.create'=>'Crear Servicio',
                'show'=>'Vizualizando Servicio:',
                'edit'=>'Editar Servicio: ',
                'edit.update'=>'Actualizar Servicio',
                'edit.delete'=>'Eliminar Servicio',
            ],
            'tickets' => [
                'index'=>'Tickets',
                'index.create'=>'Crear Ticket',
                'create'=>'Nuevo Ticket',
                'create.create'=>'Crear Ticket',
                'show'=>'Vizualizando Ticket:',
                'edit'=>'Editar Ticket: ',
                'edit.update'=>'Actualizar Ticket',
                'edit.delete'=>'Eliminar Ticket',
            ],
            'banks' => [
                'index'=>'Cuentas',
                'index.create'=>'Crear Cuenta',
                'create'=>'Nueva Cuenta',
                'create.create'=>'Crear Cuenta',
                'show'=>'Vizualizando Cuenta:',
                'edit'=>'Editar Cuenta: ',
                'edit.update'=>'Actualizar Cuenta',
                'edit.delete'=>'Eliminar Cuenta',
            ],
            'payments' => [
                'index'=>'Pagos',
                'index.create'=>'Crear Pago',
                'create'=>'Nuevo Pago',
                'create.create'=>'Crear Pago',
                'show'=>'Vizualizando Pago:',
                'edit'=>'Editar Pago: ',
                'edit.update'=>'Actualizar Pago',
                'edit.delete'=>'Eliminar Pago',
            ],
            'payment_conditions' => [
                'index'=>'Condiciones de Pago',
                'index.create'=>'Crear Condición de Pago',
                'create'=>'Nueva Condición de Pago',
                'create.create'=>'Crear Condición de Pago',
                'show'=>'Vizualizando Condición de Pago:',
                'edit'=>'Editar Condición de Pago: ',
                'edit.update'=>'Actualizar Condición de Pago',
                'edit.delete'=>'Eliminar Condición de Pago',
            ],
            'marcas' => [
                'index'=>'Marcas de Repuestos',
                'index.create'=>'Crear Marca',
                'create'=>'Nueva Marca',
                'create.create'=>'Crear Marca',
                'show'=>'Vizualizando Marca:',
                'edit'=>'Editar Marca: ',
                'edit.update'=>'Actualizar Marca',
                'edit.delete'=>'Eliminar Marca',
            ],
            'appointments' => [
                'index'=>'Cita',
                'index.create'=>'Crear Cita',
                'create'=>'Nueva Cita',
                'create.create'=>'Crear Cita',
                'show'=>'Vizualizando Cita:',
                'edit'=>'Editar Cita: ',
                'edit.update'=>'Actualizar Cita',
                'edit.delete'=>'Eliminar Cita',
            ],

        ];
        if (isset($arr[$pre])) {
            return $arr[$pre];
        }
        return [];
    }
}
