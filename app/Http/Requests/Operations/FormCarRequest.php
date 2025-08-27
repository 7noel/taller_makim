<?php

namespace App\Http\Requests\Operations;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FormCarRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'placa' => strtoupper(trim((string) $this->input('placa'))),
            'vin'   => strtoupper(trim((string) $this->input('vin'))),
        ]);
    }

    public function rules()
    {
        // {car} con Route Model Binding o {id}
        $carId = optional($this->route('car'))->id ?? $this->route('car');

        $uniquePlaca = Rule::unique('cars', 'placa')
            ->where(fn($q) => $q->whereNull('deleted_at')); // solo no-eliminados
        $uniqueVin   = Rule::unique('cars', 'vin')
            ->where(fn($q) => $q->whereNull('deleted_at'));
        
        if ($carId) {
            $uniquePlaca = $uniquePlaca->ignore($carId);
            $uniqueVin   = $uniqueVin->ignore($carId);
        }

        return [
            'placa'       => ['required', 'string', 'max:20', $uniquePlaca],
            // 'vin'         => ['required', 'string', 'max:20', $uniqueVin],
            'company_id'  => ['required', 'integer'],
            'brand_id'    => ['required', 'integer'],
            'modelo_id'   => ['required', 'integer'],
            'year'        => ['required', 'integer'],
        ];
    }
}
