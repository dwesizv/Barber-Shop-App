<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeinadoCreateRequest extends FormRequest
{

    function attributes(): array {
        return [
            'author'        => 'autor del peinado',
            'name'          => 'nombre del peinado',
            'idpelo'        => 'tipo de pelo',
            'description'   => 'descripción del peinado',
            'price'         => 'precio del peinado',
            'image'         => 'imagen del peinado',
            'pdf'           => 'portfolio del peinado',
        ];
    }

    function authorize(): bool {
        return true;
    }

    function messages(): array {
        $required = 'Es obligatorio introducir :attribute.';
        $min = 'La longitud minima del campo :attribute es :min.';
        $max = 'La longitud máximo del campo :attribute es :max.';
        $minNumber = 'La valor minima del campo :attribute es :min.';
        $maxNumber = 'La valor máximo del campo :attribute es :max.';
        $unique = 'El nombre de peinado es único. Ese nombre ya se ha usado.';
        return [
            'author.required'   => $required,
            'author.string'     => 'El nombre del peinado tiene que ser una cadena.',
            'author.min'        => $min,
            'author.max'        => $max,
            'name.unique'       => $unique,
            'idpelo.required'   => $required,
            'idpelo.exists'     => 'El tipo de pelo no está definido.',
            'price.required'    => $required,
            'price.numeric'     => 'El precio del peinado tiene que ser un número.',
            'price.min'         => $minNumber,
            'price.max'         => $maxNumber,
            'price.decimal'     => 'El precio del peinado ha de tener como mucho 2 decimales.',
            'image.image'       => 'El archivo tiene que ser una imagen.',
            'image.size'        => 'La imagen no puede pesar más de 1000 KB.',
        ];
    }

    function rules(): array {
        return [
            'author' => 'required|string|min:2|max:60',
            'name'   => 'unique:peinado,name',
            'idpelo' => 'required|exists:pelo,id',
            'price'  => 'required|numeric|min:0|max:999999.99|decimal:0,2',
            'image'  => 'nullable|image'
        ];
    }
}