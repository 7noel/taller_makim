<table class="{{ config('options.styles.table') }}">
<thead class="{{ config('options.styles.thead') }}">
<tr>
<th><strong>Local</strong></th>
<th><strong>Correlativo</strong></th>
<th><strong>Fecha</strong></th>
<th><strong>Hora</strong></th>
<th><strong>Aseguradora</strong></th>
<th><strong>Cliente</strong></th>
<th><strong>Contacto</strong></th>
<th><strong>Celular</strong></th>
<th><strong>Placa</strong></th>
<th><strong>Marca</strong></th>
<th><strong>Modelo</strong></th>
<th><strong>Año</strong></th>
<th><strong>Color</strong></th>
<th><strong>Km</strong></th>
<th><strong>Estado</strong></th>
<th><strong>Presupuesto</strong></th>
<th><strong>Fecha Presupuesto</strong></th>
<th><strong>Importe Presupuesto</strong></th>
<th><strong>Fecha Aprobación</strong></th>
<th><strong>Siniestro</strong></th>
<!-- <th><strong>Estado Presupuesto</strong></th> -->
</tr>
</thead>

<tbody>

@foreach($models as $row)

@php
$inv = $row->inventory;
$quote = $row->quote;

/* PRIORIDAD: presupuesto primero */
$source = $quote ?? $inv;

/* STATUS */
$status = optional($inv)->status ?? optional($quote)->status;

if ($status=='APROB') {
    $clase = 'badge badge-primary';
} elseif ($status=='CERR') {
    $clase = 'badge badge-success';
} elseif ($status=='ANUL') {
    $clase = 'badge badge-danger';
} else {
    $clase = 'badge badge-info';
}
@endphp

<tr>

<td>{{ optional($inv)->series }}</td>

<td>{{ optional($inv)->sn }}</td>

<td>{{ optional(optional($inv)->created_at)->format('d/m/Y') }}</td>

<td>{{ optional(optional($inv)->created_at)->format('H:i:s') }}</td>

<td>{{ optional(optional($source)->insurance_company)->brand_name ?? 'PARTICULAR' }}</td>

<td>{{ optional(optional($source)->company)->company_name }}</td>

<td>{{ optional(optional($source)->inventory)->contact_name }}</td>

<td>{{ optional(optional($source)->inventory)->contact_mobile }}</td>

<td>{{ optional($source)->placa }}</td>

<td>{{ optional(optional(optional($source)->car)->brand)->name }}</td>

<td>{{ optional(optional(optional($source)->car)->modelo)->name }}</td>

<td>{{ optional(optional($source)->car)->year }}</td>

<td>{{ optional(optional($source)->car)->color }}</td>

<td>{{ optional($source)->kilometraje }}</td>

<td class="status">
@if($status)
<span class="{{ $clase }}">{{ $status }}</span>
@endif
</td>

<td>
@if($quote)
{{ $quote->series }}-{{ $quote->number }}
@endif
</td>

<td>
@if($quote)
{{ optional($quote->created_at)->format('d/m/Y') }}
@endif
</td>

<!-- <td>{{ optional($quote)->status }}</td> -->

<td>
    @if($quote)
        {{ config('options.table_sunat.moneda_sunat.'.$quote->currency_id) }}
        {{ optional($quote)->total }}
    @endif
</td>

<td>{{ data_get($inv, 'pre_aprobacion.f_pre_aprobacion', '') }}</td>
<td>{{ optional($quote)->claim_number }}</td>

</tr>

@endforeach

</tbody>
</table>