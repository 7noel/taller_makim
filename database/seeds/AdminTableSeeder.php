<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Security\User;
use App\Modules\Base\Table;
use App\Modules\Security\Role;
use App\Modules\Security\PermissionGroup;
use App\Modules\Security\Permission;
use App\Modules\Operations\Brand;
use App\Modules\Operations\Modelo;
// use App\Modules\Base\UnitType;
// use App\Modules\Storage\Unit;
// use App\Modules\Base\Currency;
// use App\Modules\Finances\Exchange;
use App\Modules\Finances\Company;
// use App\Modules\Storage\Category;
// use App\Modules\Storage\SubCategory;
// use App\Modules\Storage\Product;
// use App\Modules\Storage\Stock;
// use App\Modules\Storage\ProductAccessory;
use App\Modules\Storage\Warehouse;
// use App\Modules\Logistics\Brand;
// use App\Modules\Base\DocumentType;
// use App\Modules\Base\DocumentControl;
// use App\Modules\Finances\PaymentCondition;
// use App\Modules\Sales\Modelo;
// use App\Modules\HumanResources\Job;
// use App\Modules\HumanResources\Employee;
// use App\Modules\Finances\Bank;

use Faker\Factory as Faker;

class AdminTableSeeder extends Seeder {

    public function run()
    {
        Company::create(['company_name'=>'MULTISERVICIOS MAKIM-MAKIM E.I.R.L.', 'id_type'=>'6', 'doc'=>'20601157480', 'address'=>'AV. SEPARADORA INDUSTRIAL NRO. 3598 URB. MAYORAZGO', 'ubigeo_code'=>'150103', 'country' => 'PE', 'entity_type' => 'my_company']);
        Company::create(['company_name'=>'JAVIER POLO', 'paternal_surname'=>'POLO', 'maternal_surname'=>'', 'name'=>'JAVIER', 'id_type'=>'1', 'doc'=>'99999999', 'address'=>'AV. SEPARADORA INDUSTRIAL NRO. 3598 URB. MAYORAZGO', 'ubigeo_code'=>'150103', 'country' => 'PE', 'entity_type' => 'employees', 'job_id'=>53, 'my_company'=>1]);

        User::create(['name' => 'Noel', 'email' => 'noel.logan@gmail.com', 'password' => '123', 'is_superuser' => true]);
        User::create(['name' => 'JAVIER POLO', 'email' => 'jpolo@makim.pe', 'password' => '123', 'is_superuser' => true]);
        User::create(['name' => 'Usuario', 'email' => 'usuario@makim.pe', 'password' => '123', 'is_superuser' => true]);
        

        Table::create(['type' => 'document_controls', 'my_company' => 1, 'relation_id' => 1, 'description'=>'FACTURA', 'name'=>'F001', 'value_1'=>0, 'value_3'=>1, 'code'=>'01']); // 1
        Table::create(['type' => 'document_controls', 'my_company' => 1, 'relation_id' => 2, 'description'=>'BOLETA', 'name'=>'B001', 'value_1'=>0, 'value_3'=>1, 'code'=>'03']); // 2
        Table::create(['type' => 'document_controls', 'my_company' => 1, 'relation_id' => 3, 'description'=>'NOTA DE CRÉDITO', 'name'=>'FC01', 'value_1'=>0]); // 3
        Table::create(['type' => 'document_controls', 'my_company' => 1, 'relation_id' => 3, 'description'=>'NOTA DE CRÉDITO', 'name'=>'BC01', 'value_1'=>0]); // 4
        Table::create(['type' => 'document_controls', 'my_company' => 1, 'relation_id' => 4, 'description'=>'NOTA DE DÉBITO', 'name'=>'FD01', 'value_1'=>0]); // 5
        Table::create(['type' => 'document_controls', 'my_company' => 1, 'relation_id' => 4, 'description'=>'NOTA DE DÉBITO', 'name'=>'BD01', 'value_1'=>0]); // 6
        
        Table::create(['type' => 'units', 'my_company' => 1, 'name' => 'UNIDAD', 'symbol' => 'und', 'relation_id' => 0, 'value_1' => 1, 'code' => 'NIU']); // 7
        Table::create(['type' => 'units', 'my_company' => 1, 'name' => 'PARES', 'symbol' => 'prs', 'relation_id' => 0, 'value_1' => 2, 'code' => 'NIU']); // 8
        Table::create(['type' => 'units', 'my_company' => 1, 'name' => 'DECENA', 'symbol' => 'dec', 'relation_id' => 0, 'value_1' => 10, 'code' => 'NIU']); // 9
        Table::create(['type' => 'units', 'my_company' => 1, 'name' => 'CIENTO', 'symbol' => 'cto', 'relation_id' => 0, 'value_1' => 100, 'code' => 'NIU']); // 10
        Table::create(['type' => 'units', 'my_company' => 1, 'name' => 'GRUEZA', 'symbol' => 'dec', 'relation_id' => 0, 'value_1' => 1728, 'code' => 'NIU']); // 11
        Table::create(['type' => 'units', 'my_company' => 1, 'name' => 'MILLAR', 'symbol' => 'mill', 'relation_id' => 0, 'value_1' => 1000, 'code' => 'NIU']); // 12
        Table::create(['type' => 'units', 'my_company' => 1, 'name' => 'SET', 'symbol' => 'set', 'relation_id' => 0, 'value_1' => 1, 'code' => 'NIU']); // 13
        Table::create(['type' => 'units', 'my_company' => 1, 'name' => 'METRO', 'symbol' => 'mt', 'relation_id' => 3, 'value_1' => 1, 'code' => 'NIU']); // 14
        Table::create(['type' => 'units', 'my_company' => 1, 'name' => 'KILOGRAMO', 'symbol' => 'kg', 'relation_id' => 1, 'value_1' => 1, 'code' => 'NIU']); // 15

        Table::create(['type' => 'exchanges', 'my_company' => 1, 'name' => date('Y-m-d'), 'relation_id' => 2, 'value_1' => 3, 'value_2' => 3]); // 16

        Table::create(['type' => 'categories', 'my_company' => 1, 'name' => 'SERVICIO', 'code' => '01']); // 17
        Table::create(['type' => 'categories', 'my_company' => 1, 'name' => 'REPUESTO', 'code' => '01']); // 18

        Table::create(['type' => 'sub_categories', 'my_company' => 1, 'name' => 'MECANICA', 'relation_id' => 17]); // 2168
        Table::create(['type' => 'sub_categories', 'my_company' => 1, 'name' => 'PLANCHADO', 'relation_id' => 17]); // 2169
        Table::create(['type' => 'sub_categories', 'my_company' => 1, 'name' => 'PINTURA', 'relation_id' => 17]); // 2170
        Table::create(['type' => 'sub_categories', 'my_company' => 1, 'name' => 'ACCESORIOS', 'relation_id' => 18]); // 2171
        Table::create(['type' => 'sub_categories', 'my_company' => 1, 'name' => 'FILTROS', 'relation_id' => 18]); // 2172
        Table::create(['type' => 'sub_categories', 'my_company' => 1, 'name' => 'LUBRICANTES', 'relation_id' => 18]); // 2173
        Table::create(['type' => 'sub_categories', 'my_company' => 1, 'name' => 'NEUMATICOS', 'relation_id' => 18]); // 2174
        Table::create(['type' => 'sub_categories', 'my_company' => 1, 'name' => 'CHASIS', 'relation_id' => 18]); // 2175
        Table::create(['type' => 'sub_categories', 'my_company' => 1, 'name' => 'MOTOR', 'relation_id' => 18]); // 2176
        Table::create(['type' => 'sub_categories', 'my_company' => 1, 'name' => 'OTROS', 'relation_id' => 18]); // 2177

        Table::create(['type' => 'brands', 'my_company' => 1, 'name' => 'ADVANCED']); // 2178
        Table::create(['type' => 'brands', 'my_company' => 1, 'name' => 'EUROCOLUMBUS']); // 2179
        Table::create(['type' => 'brands', 'my_company' => 1, 'name' => 'FAMED LODZ']); // 2180
        Table::create(['type' => 'brands', 'my_company' => 1, 'name' => 'FAMED ZYWIEC']); // 2181
        Table::create(['type' => 'brands', 'my_company' => 1, 'name' => 'GMM']); // 2182
        Table::create(['type' => 'brands', 'my_company' => 1, 'name' => 'HERSILL']); // 2183
        Table::create(['type' => 'brands', 'my_company' => 1, 'name' => 'NEUMOVENT']); // 2184
        Table::create(['type' => 'brands', 'my_company' => 1, 'name' => 'PROHS']); // 2185
        Table::create(['type' => 'brands', 'my_company' => 1, 'name' => 'TSE']); // 2186
        Table::create(['type' => 'brands', 'my_company' => 1, 'name' => 'ZOLL']); // 2187

        PermissionGroup::create(['name' => 'SISTEMAS']);
        PermissionGroup::create(['name' => 'ADMINISTRACION']);
        PermissionGroup::create(['name' => 'ALMACEN']);
        PermissionGroup::create(['name' => 'LOGISTICA']);
        PermissionGroup::create(['name' => 'VENTAS']);
        PermissionGroup::create(['name' => 'FINANZAS']);
        PermissionGroup::create(['name' => 'RECURSOS HUMANOS']);
        PermissionGroup::create(['name' => 'PRODUCCION']);
        PermissionGroup::create(['name' => 'CONTABILIDAD']);

        Role::create(['my_company' => '1', 'name' => 'ADMINISTRADOR DE SISTEMA']);
        Role::create(['my_company' => '1', 'name' => 'GERENTE GENERAL']);
        Role::create(['my_company' => '1', 'name' => 'ADMINISTRADOR']);
        Role::create(['my_company' => '1', 'name' => 'ASISTENTE ADMINISTRATIVO']);
        Role::create(['my_company' => '1', 'name' => 'CREDITO Y FINANZAS']);
        Role::create(['my_company' => '1', 'name' => 'FACTURADOR']);
        Role::create(['my_company' => '1', 'name' => 'ASISTENTE CONTABLE']);
        Role::create(['my_company' => '1', 'name' => 'VENDEDOR']);

        // 2117 es el ultimo id de table (después de cargar ubigeo y paises)
        
        Table::create(['type' => 'id_type', 'name' => 'REGISTRO UNICO DE CONTRIBUYENTE', 'symbol' => 'RUC', 'code' => '6']); // 2118
        Table::create(['type' => 'id_type', 'name' => 'DOCUMENTO NACIONAL DE IDENTIDAD', 'symbol' => 'DNI', 'code' => '1']); // 2119
        Table::create(['type' => 'id_type', 'name' => 'CARNET DE EXTRANJERÍA', 'symbol' => 'CEX', 'code' => '4']); // 2120
        Table::create(['type' => 'id_type', 'name' => 'PASAPORTE', 'symbol' => 'PAS', 'code' => '7']); // 2121
        Table::create(['type' => 'id_type', 'name' => 'CED. DIPLOMATICA DE IDENTIDAD', 'symbol' => 'CED', 'code' => 'A']); // 2122
        Table::create(['type' => 'id_type', 'name' => 'DOC.TRIB.NO.DOM.SIN.RUC', 'symbol' => 'NDO', 'code' => '0']); // 2123
        Table::create(['type' => 'id_type', 'name' => 'VARIOS', 'symbol' => 'S/D', 'code' => '-']); // 2124


        Table::create(['type' => 'jobs', 'my_company' => 1, 'name' => 'ANALISTA DE SISTEMAS']); // 2125
        Table::create(['type' => 'jobs', 'my_company' => 1, 'name' => 'GERENTE GENERAL']); // 2126
        Table::create(['type' => 'jobs', 'my_company' => 1, 'name' => 'ADMINISTRADOR']); // 2127
        Table::create(['type' => 'jobs', 'my_company' => 1, 'name' => 'ASISTENTE ADMINISTRATIVO']); // 2128
        Table::create(['type' => 'jobs', 'my_company' => 1, 'name' => 'CREDITO Y FINANZAS']); // 2129
        Table::create(['type' => 'jobs', 'my_company' => 1, 'name' => 'FACTURADOR']); // 2130
        Table::create(['type' => 'jobs', 'my_company' => 1, 'name' => 'ASISTENTE CONTABLE']); //2131
        Table::create(['type' => 'jobs', 'my_company' => 1, 'name' => 'ASESOR']); // 2132

        Brand::create(['name' => 'HONDA', 'my_company'=>1]);
        Brand::create(['name' => 'CREVROLET', 'my_company'=>1]);
        Brand::create(['name' => 'BMW', 'my_company'=>1]);
        Brand::create(['name' => 'SUBARU', 'my_company'=>1]);
        Brand::create(['name' => 'KIA', 'my_company'=>1]);

        // MODELOS DE VEHICULOS
        Modelo::create(['name' => 'FIT', 'brand_id' => 1]);
        Modelo::create(['name' => 'CIVIC', 'brand_id' => 1]);
        Modelo::create(['name' => 'ACCORD', 'brand_id' => 1]);
        Modelo::create(['name' => 'LEGEND', 'brand_id' => 1]);
        Modelo::create(['name' => 'WRV', 'brand_id' => 1]);
        Modelo::create(['name' => 'HRV', 'brand_id' => 1]);
        Modelo::create(['name' => 'CRV', 'brand_id' => 1]);
        Modelo::create(['name' => 'PILOT', 'brand_id' => 1]);
        Modelo::create(['name' => 'ODISSEY', 'brand_id' => 1]);
        Modelo::create(['name' => 'RIDGELINE', 'brand_id' => 1]);
        Modelo::create(['name' => 'SPARK', 'brand_id' => 2]);
        Modelo::create(['name' => 'SAIL', 'brand_id' => 2]);
        Modelo::create(['name' => 'SPIN', 'brand_id' => 2]);
        Modelo::create(['name' => 'SONIC', 'brand_id' => 2]);
        Modelo::create(['name' => 'AVEO', 'brand_id' => 2]);
        Modelo::create(['name' => 'COBALT', 'brand_id' => 2]);
        Modelo::create(['name' => 'CRUZE', 'brand_id' => 2]);
        Modelo::create(['name' => 'MALIBÚ', 'brand_id' => 2]);
        Modelo::create(['name' => 'TRACKER', 'brand_id' => 2]);
        Modelo::create(['name' => 'CAPTIVA', 'brand_id' => 2]);
        Modelo::create(['name' => 'TRAVERSE', 'brand_id' => 2]);
        Modelo::create(['name' => 'TAHOE', 'brand_id' => 2]);
        Modelo::create(['name' => 'SUBURBAN', 'brand_id' => 2]);
        Modelo::create(['name' => 'COLORADO', 'brand_id' => 2]);
        Modelo::create(['name' => 'PRISMA', 'brand_id' => 2]);
        Modelo::create(['name' => 'EQUINOX', 'brand_id' => 2]);
        Modelo::create(['name' => 'ONIX', 'brand_id' => 2]);
        Modelo::create(['name' => 'ORLANDO', 'brand_id' => 2]);
        Modelo::create(['name' => 'N300 MAX', 'brand_id' => 2]);
        Modelo::create(['name' => 'N300 MOVE', 'brand_id' => 2]);
        Modelo::create(['name' => 'N300 CARGO', 'brand_id' => 2]);
        Modelo::create(['name' => 'N300 WORK', 'brand_id' => 2]);
        Modelo::create(['name' => 'TRAILBLAZER', 'brand_id' => 2]);
        Modelo::create(['name' => '230I', 'brand_id' => 3]);
        Modelo::create(['name' => '230I XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '320I', 'brand_id' => 3]);
        Modelo::create(['name' => '320I XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '328D', 'brand_id' => 3]);
        Modelo::create(['name' => '328D XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '330E', 'brand_id' => 3]);
        Modelo::create(['name' => '330I', 'brand_id' => 3]);
        Modelo::create(['name' => '330I GT XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '330I XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '340I', 'brand_id' => 3]);
        Modelo::create(['name' => '340I GT XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '340I XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '430I', 'brand_id' => 3]);
        Modelo::create(['name' => '430I GRAN COUPE', 'brand_id' => 3]);
        Modelo::create(['name' => '430I XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '430I XDRIVE GRAN COUPE', 'brand_id' => 3]);
        Modelo::create(['name' => '440I', 'brand_id' => 3]);
        Modelo::create(['name' => '440I GRAN COUPE', 'brand_id' => 3]);
        Modelo::create(['name' => '440I XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '440I XDRIVE GRAN COUPE', 'brand_id' => 3]);
        Modelo::create(['name' => '528I', 'brand_id' => 3]);
        Modelo::create(['name' => '528I XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '530E', 'brand_id' => 3]);
        Modelo::create(['name' => '530E XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '530I', 'brand_id' => 3]);
        Modelo::create(['name' => '530I XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '530I GT', 'brand_id' => 3]);
        Modelo::create(['name' => '530I GT XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '535D', 'brand_id' => 3]);
        Modelo::create(['name' => '535D XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '535I', 'brand_id' => 3]);
        Modelo::create(['name' => '535I GT', 'brand_id' => 3]);
        Modelo::create(['name' => '535I XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '540I', 'brand_id' => 3]);
        Modelo::create(['name' => '540I XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '540I GT', 'brand_id' => 3]);
        Modelo::create(['name' => '540I GT XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '550I', 'brand_id' => 3]);
        Modelo::create(['name' => '550I GT XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '550I XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '640I', 'brand_id' => 3]);
        Modelo::create(['name' => '640I GRAN COUPE', 'brand_id' => 3]);
        Modelo::create(['name' => '640I XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '640I XDRIVE GRAN COUPE', 'brand_id' => 3]);
        Modelo::create(['name' => '650I', 'brand_id' => 3]);
        Modelo::create(['name' => '650I GRAN COUPE', 'brand_id' => 3]);
        Modelo::create(['name' => '650I XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '650I XDRIVE GRAN COUPE', 'brand_id' => 3]);
        Modelo::create(['name' => '740E XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '740I', 'brand_id' => 3]);
        Modelo::create(['name' => '740I XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => '750I', 'brand_id' => 3]);
        Modelo::create(['name' => '750I XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => 'M2', 'brand_id' => 3]);
        Modelo::create(['name' => 'M235I', 'brand_id' => 3]);
        Modelo::create(['name' => 'M235I XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => 'M240I', 'brand_id' => 3]);
        Modelo::create(['name' => 'M240I XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => 'M3', 'brand_id' => 3]);
        Modelo::create(['name' => 'M4', 'brand_id' => 3]);
        Modelo::create(['name' => 'M5', 'brand_id' => 3]);
        Modelo::create(['name' => 'M550I XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => 'M6', 'brand_id' => 3]);
        Modelo::create(['name' => 'M6 GRAN COUPE', 'brand_id' => 3]);
        Modelo::create(['name' => 'M760I XDRIVE', 'brand_id' => 3]);
        Modelo::create(['name' => 'X1', 'brand_id' => 3]);
        Modelo::create(['name' => 'X2', 'brand_id' => 3]);
        Modelo::create(['name' => 'X3', 'brand_id' => 3]);
        Modelo::create(['name' => 'X4', 'brand_id' => 3]);
        Modelo::create(['name' => 'X5', 'brand_id' => 3]);
        Modelo::create(['name' => 'X6', 'brand_id' => 3]);
        Modelo::create(['name' => 'I3', 'brand_id' => 3]);
        Modelo::create(['name' => 'I3S', 'brand_id' => 3]);
        Modelo::create(['name' => 'I8', 'brand_id' => 3]);
        Modelo::create(['name' => 'BRZ', 'brand_id' => 4]);
        Modelo::create(['name' => 'FORESTER', 'brand_id' => 4]);
        Modelo::create(['name' => 'IMPREZA', 'brand_id' => 4]);
        Modelo::create(['name' => 'LEGACY', 'brand_id' => 4]);
        Modelo::create(['name' => 'OUTBACK', 'brand_id' => 4]);
        Modelo::create(['name' => 'WRX STI', 'brand_id' => 4]);
        Modelo::create(['name' => 'XV', 'brand_id' => 4]);
        Modelo::create(['name' => 'SOLUTO', 'brand_id' => 5]);
        Modelo::create(['name' => 'PICANTO', 'brand_id' => 5]);
        Modelo::create(['name' => 'RIO', 'brand_id' => 5]);
        Modelo::create(['name' => 'CERATO', 'brand_id' => 5]);
        Modelo::create(['name' => 'OPTIMA', 'brand_id' => 5]);
        Modelo::create(['name' => 'STINGER', 'brand_id' => 5]);
        Modelo::create(['name' => 'SOUL', 'brand_id' => 5]);
        Modelo::create(['name' => 'SPORTAGE', 'brand_id' => 5]);
        Modelo::create(['name' => 'SORENTO', 'brand_id' => 5]);
        Modelo::create(['name' => 'GRAND CARNIVAL', 'brand_id' => 5]);
        Modelo::create(['name' => 'MOHAVE', 'brand_id' => 5]);
        Modelo::create(['name' => 'K2700', 'brand_id' => 5]);

/*        

        Employee::create(['name' => 'NOEL', 'paternal_surname'=>'HUILLCA', 'maternal_surname'=>'HUAMANI', 'full_name'=>'HUILLCA HUAMANI NOEL', 'id_type_id'=>'2', 'doc'=>'44243484', 'job_id'=>'1', 'gender'=>'0', 'address'=>'JR. LAS GROSELLAS 910', 'ubigeo_id'=>'1306', 'user_id'=>'1', 'email_company' => '']);
        Employee::create(['name' => 'JUAN', 'paternal_surname'=>'MIRANDA', 'maternal_surname'=>'HUAMANI', 'full_name'=>'JUAN MIRANDA', 'id_type_id'=>'2', 'doc'=>'12345678', 'job_id'=>'2', 'gender'=>'0', 'address'=>'direccion', 'ubigeo_id'=>'1307', 'user_id'=>'2', 'email_company' => 'juanmiranda@miraldi.com.pe']);
        Employee::create(['name' => 'HUGO', 'paternal_surname'=>'MIRANDA', 'maternal_surname'=>'HUAMANI', 'full_name'=>'HUGO MIRANDA', 'id_type_id'=>'2', 'doc'=>'12345678', 'job_id'=>'3', 'gender'=>'0', 'address'=>'direccion', 'ubigeo_id'=>'1307', 'user_id'=>'3', 'email_company' => 'hugomiranda@miraldi.com.pe']);
        Employee::create(['name' => 'NERIDA', 'paternal_surname'=>'ESPINOZA', 'maternal_surname'=>'HUAMANI', 'full_name'=>'NERIDA ESPINOZA', 'id_type_id'=>'2', 'doc'=>'12345678', 'job_id'=>'4', 'gender'=>'0', 'address'=>'direccion', 'ubigeo_id'=>'1307', 'user_id'=>'4', 'email_company' => 'neridaespinoza@miraldi.com.pe']);
        Employee::create(['name' => 'YESENIA', 'paternal_surname'=>'HUACCALLO', 'maternal_surname'=>'HUAMANI', 'full_name'=>'YESENIA HUACCALLO', 'id_type_id'=>'2', 'doc'=>'12345678', 'job_id'=>'5', 'gender'=>'0', 'address'=>'direccion', 'ubigeo_id'=>'1307', 'user_id'=>'5', 'email_company' => 'yeseniahuaccallo@miraldi.com.pe']);
        Employee::create(['name' => 'KARITO', 'paternal_surname'=>'BECERRA', 'maternal_surname'=>'HUAMANI', 'full_name'=>'KARITO BECERRA', 'id_type_id'=>'2', 'doc'=>'12345678', 'job_id'=>'6', 'gender'=>'0', 'address'=>'direccion', 'ubigeo_id'=>'1307', 'user_id'=>'6', 'email_company' => 'karitobecerra@miraldi.com.pe']);
        Employee::create(['name' => 'YESSICA', 'paternal_surname'=>'INOÑAN', 'maternal_surname'=>'HUAMANI', 'full_name'=>'YESSICA INOÑAN', 'id_type_id'=>'2', 'doc'=>'12345678', 'job_id'=>'7', 'gender'=>'0', 'address'=>'direccion', 'ubigeo_id'=>'1307', 'user_id'=>'7', 'email_company' => 'yessicainonan@miraldi.com.pe']);
        Employee::create(['name' => 'KATYA', 'paternal_surname'=>'MORAN', 'maternal_surname'=>'HUAMANI', 'full_name'=>'KATYA MORAN', 'id_type_id'=>'2', 'doc'=>'12345678', 'job_id'=>'7', 'gender'=>'0', 'address'=>'direccion', 'ubigeo_id'=>'1307', 'user_id'=>'8', 'email_company' => 'katyamoran@miraldi.com.pe']);
        Employee::create(['name' => 'RANDI', 'paternal_surname'=>'TUCTO', 'maternal_surname'=>'HUAMANI', 'full_name'=>'RANDI TUCTO', 'id_type_id'=>'2', 'doc'=>'12345678', 'job_id'=>'8', 'gender'=>'0', 'address'=>'direccion', 'ubigeo_id'=>'1307', 'user_id'=>'9', 'email_company' => 'randitucto@miraldi.com.pe']);
        Employee::create(['name' => 'VICTOR', 'paternal_surname'=>'LA ROSA', 'maternal_surname'=>'HUAMANI', 'full_name'=>'VICTOR LA ROSA', 'id_type_id'=>'2', 'doc'=>'12345678', 'job_id'=>'8', 'gender'=>'0', 'address'=>'direccion', 'ubigeo_id'=>'1307', 'user_id'=>'10', 'email_company' => 'victorlarosa@miraldi.com.pe']);
        Employee::create(['name' => 'JOSEPH', 'paternal_surname'=>'TUCTO', 'maternal_surname'=>'HUAMANI', 'full_name'=>'JOSEPH TUCTO', 'id_type_id'=>'2', 'doc'=>'12345678', 'job_id'=>'8', 'gender'=>'0', 'address'=>'direccion', 'ubigeo_id'=>'1307', 'user_id'=>'11', 'email_company' => 'joseptucto@miraldi.com.pe']);
        Employee::create(['name' => 'DAVID', 'paternal_surname'=>'ESPINOZA', 'maternal_surname'=>'HUAMANI', 'full_name'=>'DAVID ESPINOZA', 'id_type_id'=>'2', 'doc'=>'12345678', 'job_id'=>'8', 'gender'=>'0', 'address'=>'direccion', 'ubigeo_id'=>'1307', 'user_id'=>'12', 'email_company' => 'davidespinoza@miraldi.com.pe']);



        Company::create(['company_name'=>'IMPORTACIONES MIRALDI S.A.C.', 'id_type_id'=>'1', 'doc'=>'20601787700', 'address'=>'AV. LAS VEGAS MZA. A LOTE. 19B URB. INDUSTRIAL (CRUCE AV PEDRO MIOTTA Y BELISARIO SUAREZ)', 'ubigeo_id'=>'1307', 'country_id' => 1465, 'is_my_company'=>1]);
        Company::create(['company_name'=>'HERRAMAX PERU E.I.R.L.', 'id_type_id'=>'1', 'doc'=>'20602227066', 'address'=>'JR. HUAROCHIRI NRO. 550 INT. 1025 (A UNA CUADRA DE LA PLAZA 2 DE MAYO)', 'ubigeo_id'=>'1275', 'country_id' => 1465, 'is_my_company'=>1]);
        Company::create(['company_name'=>'MIRALDI Y CIA. S.A.C.', 'id_type_id'=>'1', 'doc'=>'20501767540', 'address'=>'AV. LAS VEGAS MZA. A LOTE. 19-B (PEDRO MIOTA CON BELIZARIO)', 'ubigeo_id'=>'1307', 'country_id' => 1465, 'is_my_company'=>1]);

*/
        // Usuarios
        Permission::create(['name' => 'Contraseña Editar', 'action' => 'change_password', 'permission_group_id' => 1]);
        Permission::create(['name' => 'Contraseña Actualizar', 'action' => 'update_password', 'permission_group_id' => 1]);
        Permission::create(['name' => 'Usuarios Listar', 'action' => 'users.index', 'permission_group_id' => 1]);
        Permission::create(['name' => 'Usuarios Ver', 'action' => 'users.show', 'permission_group_id' => 1]);
        Permission::create(['name' => 'Usuarios Crear', 'action' => 'users.create', 'permission_group_id' => 1]);
        Permission::create(['name' => 'Usuarios Editar', 'action' => 'users.edit', 'permission_group_id' => 1]);
        Permission::create(['name' => 'Usuarios Eliminar', 'action' => 'users.destroy', 'permission_group_id' => 1]);
        // Roles
        Permission::create(['name' => 'Roles Listar', 'action' => 'roles.index', 'permission_group_id' => 1]);
        Permission::create(['name' => 'Roles Ver', 'action' => 'roles.show', 'permission_group_id' => 1]);
        Permission::create(['name' => 'Roles Crear', 'action' => 'roles.create', 'permission_group_id' => 1]);
        Permission::create(['name' => 'Roles Editar', 'action' => 'roles.edit', 'permission_group_id' => 1]);
        Permission::create(['name' => 'Roles Eliminar', 'action' => 'roles.destroy', 'permission_group_id' => 1]);
        // Grupos
        Permission::create(['name' => 'Grupos Listar', 'action' => 'permission_groups.index', 'permission_group_id' => 1]);
        Permission::create(['name' => 'Grupos Ver', 'action' => 'permission_groups.show', 'permission_group_id' => 1]);
        Permission::create(['name' => 'Grupos Crear', 'action' => 'permission_groups.create', 'permission_group_id' => 1]);
        Permission::create(['name' => 'Grupos Editar', 'action' => 'permission_groups.edit', 'permission_group_id' => 1]);
        Permission::create(['name' => 'Grupos Eliminar', 'action' => 'permission_groups.destroy', 'permission_group_id' => 1]);
        // Permisos
        Permission::create(['name' => 'Permisos Listar', 'action' => 'permissions.index', 'permission_group_id' => 1]);
        Permission::create(['name' => 'Permisos Ver', 'action' => 'permissions.show', 'permission_group_id' => 1]);
        Permission::create(['name' => 'Permisos Crear', 'action' => 'permissions.create', 'permission_group_id' => 1]);
        Permission::create(['name' => 'Permisos Editar', 'action' => 'permissions.edit', 'permission_group_id' => 1]);
        Permission::create(['name' => 'Permisos Eliminar', 'action' => 'permissions.destroy', 'permission_group_id' => 1]);
        // Tipos de Unidad
        Permission::create(['name' => 'Tipos de Unidad Listar', 'action' => 'unit_types.index', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Tipos de Unidad Ver', 'action' => 'unit_types.show', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Tipos de Unidad Crear', 'action' => 'unit_types.create', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Tipos de Unidad Editar', 'action' => 'unit_types.edit', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Tipos de Unidad Eliminar', 'action' => 'unit_types.destroy', 'permission_group_id' => 3]);
        // Unidad
        Permission::create(['name' => 'Unidad Listar', 'action' => 'units.index', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Unidad Ver', 'action' => 'units.show', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Unidad Crear', 'action' => 'units.create', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Unidad Editar', 'action' => 'units.edit', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Unidad Eliminar', 'action' => 'units.destroy', 'permission_group_id' => 3]);
        // Categorías
        Permission::create(['name' => 'Categorías Listar', 'action' => 'categories.index', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Categorías Ver', 'action' => 'categories.show', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Categorías Crear', 'action' => 'categories.create', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Categorías Editar', 'action' => 'categories.edit', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Categorías Eliminar', 'action' => 'categories.destroy', 'permission_group_id' => 3]);
        // Sub Categorías
        Permission::create(['name' => 'Sub Categorías Listar', 'action' => 'sub_categories.index', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Sub Categorías Ver', 'action' => 'sub_categories.show', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Sub Categorías Crear', 'action' => 'sub_categories.create', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Sub Categorías Editar', 'action' => 'sub_categories.edit', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Sub Categorías Eliminar', 'action' => 'sub_categories.destroy', 'permission_group_id' => 3]);
        // Marcas
        Permission::create(['name' => 'Marcas Listar', 'action' => 'brands.index', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Marcas Ver', 'action' => 'brands.show', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Marcas Crear', 'action' => 'brands.create', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Marcas Editar', 'action' => 'brands.edit', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Marcas Eliminar', 'action' => 'brands.destroy', 'permission_group_id' => 3]);
        // Almacenes
        Permission::create(['name' => 'Almacenes Listar', 'action' => 'warehouses.index', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Almacenes Ver', 'action' => 'warehouses.show', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Almacenes Crear', 'action' => 'warehouses.create', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Almacenes Editar', 'action' => 'warehouses.edit', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Almacenes Eliminar', 'action' => 'warehouses.destroy', 'permission_group_id' => 3]);
        // Productos
        Permission::create(['name' => 'Productos Listar', 'action' => 'products.index', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Productos Ver', 'action' => 'products.show', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Productos Crear', 'action' => 'products.create', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Productos Editar', 'action' => 'products.edit', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Productos Eliminar', 'action' => 'products.destroy', 'permission_group_id' => 3]);
        // Tickets de E/S
        Permission::create(['name' => 'Tickets de E/S Listar', 'action' => 'tickets.index', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Tickets de E/S Ver', 'action' => 'tickets.show', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Tickets de E/S Crear', 'action' => 'tickets.create', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Tickets de E/S Editar', 'action' => 'tickets.edit', 'permission_group_id' => 3]);
        Permission::create(['name' => 'Tickets de E/S Eliminar', 'action' => 'tickets.destroy', 'permission_group_id' => 3]);
        // Documentos Identidad
        Permission::create(['name' => 'Documentos Identidad Listar', 'action' => 'id_types.index', 'permission_group_id' => 2]);
        Permission::create(['name' => 'Documentos Identidad Ver', 'action' => 'id_types.show', 'permission_group_id' => 2]);
        Permission::create(['name' => 'Documentos Identidad Crear', 'action' => 'id_types.create', 'permission_group_id' => 2]);
        Permission::create(['name' => 'Documentos Identidad Editar', 'action' => 'id_types.edit', 'permission_group_id' => 2]);
        Permission::create(['name' => 'Documentos Identidad Eliminar', 'action' => 'id_types.destroy', 'permission_group_id' => 2]);
        // Empresas
        Permission::create(['name' => 'Empresas Listar', 'action' => 'companies.index', 'permission_group_id' => 6]);
        Permission::create(['name' => 'Empresas Ver', 'action' => 'companies.show', 'permission_group_id' => 6]);
        Permission::create(['name' => 'Empresas Crear', 'action' => 'companies.create', 'permission_group_id' => 6]);
        Permission::create(['name' => 'Empresas Editar', 'action' => 'companies.edit', 'permission_group_id' => 6]);
        Permission::create(['name' => 'Empresas Eliminar', 'action' => 'companies.destroy', 'permission_group_id' => 6]);
        // Monedas
        Permission::create(['name' => 'Monedas Listar', 'action' => 'currencies.index', 'permission_group_id' => 6]);
        Permission::create(['name' => 'Monedas Ver', 'action' => 'currencies.show', 'permission_group_id' => 6]);
        Permission::create(['name' => 'Monedas Crear', 'action' => 'currencies.create', 'permission_group_id' => 6]);
        Permission::create(['name' => 'Monedas Editar', 'action' => 'currencies.edit', 'permission_group_id' => 6]);
        Permission::create(['name' => 'Monedas Eliminar', 'action' => 'currencies.destroy', 'permission_group_id' => 6]);
        // Documentos Comprobantes
        Permission::create(['name' => 'Documentos Comprobantes Listar', 'action' => 'document_types.index', 'permission_group_id' => 2]);
        Permission::create(['name' => 'Documentos Comprobantes Ver', 'action' => 'document_types.show', 'permission_group_id' => 2]);
        Permission::create(['name' => 'Documentos Comprobantes Crear', 'action' => 'document_types.create', 'permission_group_id' => 2]);
        Permission::create(['name' => 'Documentos Comprobantes Editar', 'action' => 'document_types.edit', 'permission_group_id' => 2]);
        Permission::create(['name' => 'Documentos Comprobantes Eliminar', 'action' => 'document_types.destroy', 'permission_group_id' => 2]);
        // Condiciones de Pago
        Permission::create(['name' => 'Condiciones de Pago Listar', 'action' => 'payment_conditions.index', 'permission_group_id' => 6]);
        Permission::create(['name' => 'Condiciones de Pago Ver', 'action' => 'payment_conditions.show', 'permission_group_id' => 6]);
        Permission::create(['name' => 'Condiciones de Pago Crear', 'action' => 'payment_conditions.create', 'permission_group_id' => 6]);
        Permission::create(['name' => 'Condiciones de Pago Editar', 'action' => 'payment_conditions.edit', 'permission_group_id' => 6]);
        Permission::create(['name' => 'Condiciones de Pago Eliminar', 'action' => 'payment_conditions.destroy', 'permission_group_id' => 6]);
        // Tipos de Cambio
        Permission::create(['name' => 'Tipos de Cambio Listar', 'action' => 'exchanges.index', 'permission_group_id' => 6]);
        Permission::create(['name' => 'Tipos de Cambio Ver', 'action' => 'exchanges.show', 'permission_group_id' => 6]);
        Permission::create(['name' => 'Tipos de Cambio Crear', 'action' => 'exchanges.create', 'permission_group_id' => 6]);
        Permission::create(['name' => 'Tipos de Cambio Editar', 'action' => 'exchanges.edit', 'permission_group_id' => 6]);
        Permission::create(['name' => 'Tipos de Cambio Eliminar', 'action' => 'exchanges.destroy', 'permission_group_id' => 6]);
        // Cargos
        Permission::create(['name' => 'Cargos Listar', 'action' => 'jobs.index', 'permission_group_id' => 7]);
        Permission::create(['name' => 'Cargos Ver', 'action' => 'jobs.show', 'permission_group_id' => 7]);
        Permission::create(['name' => 'Cargos Crear', 'action' => 'jobs.create', 'permission_group_id' => 7]);
        Permission::create(['name' => 'Cargos Editar', 'action' => 'jobs.edit', 'permission_group_id' => 7]);
        Permission::create(['name' => 'Cargos Eliminar', 'action' => 'jobs.destroy', 'permission_group_id' => 7]);
        // Empleados
        Permission::create(['name' => 'Empleados Listar', 'action' => 'employees.index', 'permission_group_id' => 7]);
        Permission::create(['name' => 'Empleados Ver', 'action' => 'employees.show', 'permission_group_id' => 7]);
        Permission::create(['name' => 'Empleados Crear', 'action' => 'employees.create', 'permission_group_id' => 7]);
        Permission::create(['name' => 'Empleados Editar', 'action' => 'employees.edit', 'permission_group_id' => 7]);
        Permission::create(['name' => 'Empleados Eliminar', 'action' => 'employees.destroy', 'permission_group_id' => 7]);
        // Cotizaciones orders
        Permission::create(['name' => 'Cotizaciones Listar', 'action' => 'orders.index', 'permission_group_id' => 5]);
        Permission::create(['name' => 'Cotizaciones Ver', 'action' => 'orders.show', 'permission_group_id' => 5]);
        Permission::create(['name' => 'Cotizaciones Crear', 'action' => 'orders.create', 'permission_group_id' => 5]);
        Permission::create(['name' => 'Cotizaciones Editar', 'action' => 'orders.edit', 'permission_group_id' => 5]);
        Permission::create(['name' => 'Cotizaciones Eliminar', 'action' => 'orders.destroy', 'permission_group_id' => 5]);
        // Compras
        Permission::create(['name' => 'Compras Listar', 'action' => 'purchases.index', 'permission_group_id' => 4]);
        Permission::create(['name' => 'Compras Ver', 'action' => 'purchases.show', 'permission_group_id' => 4]);
        Permission::create(['name' => 'Compras Crear', 'action' => 'purchases.create', 'permission_group_id' => 4]);
        Permission::create(['name' => 'Compras Editar', 'action' => 'purchases.edit', 'permission_group_id' => 4]);
        Permission::create(['name' => 'Compras Eliminar', 'action' => 'purchases.destroy', 'permission_group_id' => 4]);
        // // Control de Documentos
        // Permission::create(['name' => 'Control de Documentos Listar', 'action' => '.index', 'permission_group_id' => '4']);
        // Permission::create(['name' => 'Control de Documentos Ver', 'action' => '.show', 'permission_group_id' => '4']);
        // Permission::create(['name' => 'Control de Documentos Crear', 'action' => '.create', 'permission_group_id' => '4']);
        // Permission::create(['name' => 'Control de Documentos Editar', 'action' => '.edit', 'permission_group_id' => '4']);
        // Permission::create(['name' => 'Control de Documentos Eliminar', 'action' => '.destroy', 'permission_group_id' => '4']);
        // // Medios de Pago
        // Permission::create(['name' => 'Medios de Pago Listar', 'action' => '.index', 'permission_group_id' => '4']);
        // Permission::create(['name' => 'Medios de Pago Ver', 'action' => '.show', 'permission_group_id' => '4']);
        // Permission::create(['name' => 'Medios de Pago Crear', 'action' => '.create', 'permission_group_id' => '4']);
        // Permission::create(['name' => 'Medios de Pago Editar', 'action' => '.edit', 'permission_group_id' => '4']);
        // Permission::create(['name' => 'Medios de Pago Eliminar', 'action' => '.destroy', 'permission_group_id' => '4']);


        Warehouse::create(['my_company' => 1, 'name' => 'ALMACEN PRINCIPAL', 'ubigeo_code' => 150103, 'address' => 'DIRECCION']);
        // Warehouse::create(['my_company' => 1, 'name' => 'ALMACEN HERRAMAX', 'ubigeo' => 150135, 'address' => 'DIRECCION']);
        // Warehouse::create(['my_company' => 1, 'name' => 'ALMACEN MIRALDI', 'ubigeo' => 150135, 'address' => 'DIRECCION']);


/*
        Bank::create(['label' => 'HERRAMAX BCP SOLES', 'number' => '194-2438503-0-42', 'CCI' => '', 'company_id' => 2, 'currency_id' => 1, 'value' => 0]);
        Bank::create(['label' => 'IMPORTACIONES BCP SOLES', 'number' => '194-2386744-0-23', 'CCI' => '', 'company_id' => 2, 'currency_id' => 1, 'value' => 0]);
        Bank::create(['label' => 'IMPORTACIONES BCP DOLARES', 'number' => '194-2394196-1-06', 'CCI' => '', 'company_id' => 2, 'currency_id' => 2, 'value' => 0]);
        Bank::create(['label' => 'MIRALDI BCP SOLES', 'number' => '194-2447511-0-32', 'CCI' => '', 'company_id' => 2, 'currency_id' => 1, 'value' => 0]);
        Bank::create(['label' => 'MIRALDI BCP DOLARES', 'number' => '194-2441216-1-56', 'CCI' => '', 'company_id' => 2, 'currency_id' => 2, 'value' => 0]);
        Bank::create(['label' => 'MIRALDI BCP SOLES AHORROS', 'number' => '194-38124038-0-28', 'CCI' => '', 'company_id' => 2, 'currency_id' => 1, 'value' => 0]);
*/
    }
}