<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    public function getValidatedInput()
    {
        $inputs = $this->all();
        $rules  = $this->rules();

        $validated_input = [];
        foreach ($rules as $name => $rule) {
            if(strpos($name, ".")) {
                $name = substr($name, 0, strcspn($name,'.'));
            }

            if (array_key_exists($name, $inputs)) {
                $validated_input[$name] = $inputs[$name];
            }
        }

        return $validated_input;
    }

    public function createArrayRules($name, $array, $rule)
    {
        $rules = [];
        foreach ($array as $key => $val) {
            $rules[$name . "." .  $key] = $rule;
        }

        return $rules;
    }

    public function inputInt($key = NULL, $default = NULL)
    {
        $inputs = parent::input($key, $default);

        if ($inputs == "") {
            $inputs = $default;
        }

        return $inputs;
    }

    public function controller()
    {
        $route = $this->route();
        return $route ? $route->getController() : null;
    }
}
