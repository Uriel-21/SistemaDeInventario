<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;

class UserForm extends Form
{
    #[Locked]
    public ?int $userId = null;

    public string $name = '';
    public string $email = '';
    public string $telefono = '';
    public string $password = '';

    public function cargar(array $datos) : void
    {
        $this->userId = $datos['id'];
        $this->name = $datos['name'];
        $this->email = $datos['email'];
        $this->telefono = $datos['telefono'];
    }

    public function rules() : array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'telefono'   => ['required', 'digits:10'],
            'email'      => [
                'required', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($this->userId),
            ],
            'password'   => ['nullable', 'string', 'min:8']
        ];
    }
}
