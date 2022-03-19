<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute musi zostać zaakceptowane.',
    'accepted_if' => ':attribute musi zostać zaakceptowane gdy :other wynosi :value.',
    'active_url' => ':attribute nie jest prawidłowym adresem URL.',
    'after' => ':attribute musi być datą późniejszą niż :date.',
    'after_or_equal' => ':attribute musi być datą równą lub późniejszą niż :date.',
    'alpha' => ':attribute może zawierać tylko litery.',
    'alpha_dash' => ':attribute może zawierać tylko litery, cyfry i podkreślenia.',
    'alpha_num' => ':attribute może zawierać tylko litery i cyfry.',
    'array' => ':attribute musi być tablicą.',
    'before' => ':attribute musi być datą wcześniejszą niż :date.',
    'before_or_equal' => ':attribute musi być datą równą lub wcześniejszą niż :date.',
    'between' => [
        "numeric" => ":attribute musi być wartością pomiędzy :min i :max.",
        "file"    => ":attribute musi mieć pomiędzy :min a :max kilobajtów.",
        "string"  => ":attribute musi mieć pomiędzy :min a :max znaków.",
        "array"   => ":attribute musi mieć pomiędzy :min a :max pozycji.",
    ],
    'boolean' => 'Pole :attribute musi być true lub false.',
    'confirmed' => 'Potwierdzenie :attribute nie pasuje.',
    'current_password' => 'Podane hasło nie jest prawidłowe.',
    'date' => ':attribute nie jest prawidłową datą.',
    'date_equals' => ':attribute musi być datą równą :date.',
    'date_format' => ':attribute nie zgadza się z formatem :format.',
    'different' => ':attribute i :other muszą być różne.',
    'digits' => ':attribute musi mieć :digits cyfr.',
    'digits_between' => ':attribute musi mieć poniędzy :min a :max cyfr.',
    'dimensions' => ':attribute posiada złe wymiary obrazu.',
    'distinct' => 'pole :attribute posiada zduplikowaną wartość.',
    'email' => ':attribute musi być adresem email.',
    'ends_with' => ':attribute musi kończyć się wartością: :values.',
    'exists' => 'Wybrany :attribute jest nieprawidłowy.',
    'file' => ':attribute musi być plikiem.',
    'filled' => ':attribute musi zostać wypełniony.',
    'gt' => [
        'numeric' => ':attribute musi być większy niż :value.',
        'file' => ':attribute musi być większy niż :value kilobajtów.',
        'string' => ':attribute musi być większy niż :value znaków.',
        'array' => ':attribute musi posiadać więcej niż :value pozycji.',
    ],
    'gte' => [
        'numeric' => ':attribute musi być równy lub większy niż :value.',
        'file' => ':attribute musi być równy lub większy niż :value kilobajtów.',
        'string' => ':attribute musi być równy lub większy niż :value znaków.',
        'array' => ':attribute musi posiadać :value lub więcej pozycji.',
    ],
    'image' => ':attribute musi być obrazkiem.',
    'in' => 'Wybrany :attribute jest nieprawidłowy.',
    'in_array' => ':attribute pole nie istnieje w :other.',
    'integer' => ':attribute musi być liczbą.',
    'ip' => ':attribute musi być poprawnym adresem IP.',
    'ipv4' => ':attribute musi być poprawnym adresem IPv4.',
    'ipv6' => ':attribute musi być poprawnym adresem IPv6.',
    'json' => ':attribute musi być poprawnym JSON stringiem.',
    'lt' => [
      'numeric' => ':attribute musi być mniejszy niż :value.',
      'file' => ':attribute musi być mniejszy niż :value kilobajtów.',
      'string' => ':attribute musi być mniejszy niż :value znaków.',
      'array' => ':attribute musi posiadać mniej niż :value pozycji.',
    ],
    'lte' => [
      'numeric' => ':attribute musi być równy lub mniejszy niż :value.',
      'file' => ':attribute musi być równy lub mniejszy niż :value kilobajtów.',
      'string' => ':attribute musi być równy lub mniejszy niż :value znaków.',
      'array' => ':attribute musi posiadać :value lub mniej pozycji.',
    ],
    'max' => [
        'numeric' => ':attribute nie może być większy niż :max.',
        'file' => ':attribute nie może być większy niż :max kilobajtów.',
        'string' => ':attribute nie może być większy niż :max znaków.',
        'array' => ':attribute nie może mieć więcej niż  :max pozycji.',
    ],
    'mimes' => ':attribute musi być plikiem typu: :values.',
    'mimetypes' => ':attribute musi być plikiem typu: :values.',
    'min' => [
      'numeric' => ':attribute nie może być mniejszy niż :max.',
      'file' => ':attribute nie może być mniejszy niż :max kilobajtów.',
      'string' => ':attribute nie może być mniejszy niż :max znaków.',
      'array' => ':attribute nie może mieć mniej niż  :max pozycji.',
    ],
    'multiple_of' => ':attribute musi być wielokrotnością :value.',
    'not_in' => 'Wybrany :attribute jest nieprawidłowy.',
    'not_regex' => ':attribute ma nieprawidłowy format.',
    'numeric' => ':attribute musi być liczbą.',
    'password' => 'Podano nieprawidłowe hasło.',
    'present' => ':attribute jest wymagany.',
    'regex' => 'Format :attribute jest nieprawidłowy.',
    'required' => 'Pole :attribute jest wymagane.',
    'required_if' => 'Pole :attribute jest wymagane, gdy :other ma wartość :value.',
    'required_unless' => 'Pole :attribute jest wymagane, chyba że :other należy do :values.',
    'required_with' => 'Pole :attribute jest wymagane, gdy :values są zdefiniowane.',
    'required_with_all' => 'Pole :attribute jest wymagane, gdy :values są zdefiniowane.',
    'required_without' => 'Pole :attribute jest wymagane, gdy :values nie są zdefiniowane.',
    'required_without_all' => 'Pole :attribute jest wymagane, gdy żadne z :values nie są zdefiniowane.',
    'prohibited' => 'Pole :attribute jest niedozwolone.',
    'prohibited_if' => 'Pole :attribute jest niedozwolone gdy :other wynosi :value.',
    'prohibited_unless' => 'Pole :attribute  jest niedozwolone, chyba że :other należy do :values.',
    'prohibits' => 'Pole :attribute zabrania :other.',
    'same' => ':attribute i :other muszą do siebie pasować.',
    'size' => [
        "numeric" => ":attribute must be :size.",
        "file"    => ":attribute musi mieć :size kilobajtów.",
        "string"  => ":attribute musi mieć :size znaków.",
        "array"   => ":attribute musi zawierać :size pozycji.",
    ],
    'starts_with' => ':attribute musi zaczynać się od: :values.',
    'string' => ':attribute musi być typu string.',
    'timezone' => ':attribute musi być prawidłową strefą czasową.',
    'unique' => ':attribute jest już zajęty.',
    'uploaded' => ':attribute niepowodzenie przesyłania.',
    'url' => ':attribute musi być poprawnym adresem URL.',
    'uuid' => ':attribute musi być poprawnym adresem UUID.',

    'PESEL'           => 'Numer PESEL jest niepoprawny!',
    'REGON'           => 'Numer REGON jest niepoprawny',
    'NIP'             => 'Numer NIP jest niepoprawny!',
    'id_card_number'  => 'Numer dowodu osobistego jest niepoprawny!',
    'post_code'       => 'Kod pocztowy niepoprawny!',
    'PWZ'             => 'Numer PWZ niepoprawny!',
    'passport_number' => 'Numer paszportu jest niepoprawny!',
    
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
