<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;

class UserForm extends Form
{
    #[Locked]
    public ?int $userId = null;

    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $telefono = '';
    public string $password = '';

    public function cargar(array $datos) : void
    {
        $this->userId = $datos['id'];
        [$this->first_name, $this->last_name] = array_pad(explode(' ', $datos['name'], 2), 2, '');
        $this->email = $datos['email'];
        $this->telefono = $datos['telefono'];
    }

    public function rules() : array
    {
        return [
            'first_name' => ['required', 'string', 'min:2', 'max:255'],
            'last_name'  => ['required', 'string', 'min:2', 'max:255'],
            'telefono'   => ['required', 'digits:10'],
            'email'      => [
                'required', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($this->userId),
            ],
            'password'   => ['nullable', 'string', 'min:8']
        ];
    }
}
