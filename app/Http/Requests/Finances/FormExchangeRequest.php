<?php namespace App\Http\Requests\Finances;

use App\Http\Requests\Request;

class FormExchangeRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'fecha'=>'required',
			'my_company'=>'required|numeric',
			'venta'=>'required|numeric',
			'compra'=>'required|numeric',
		];
	}

}
