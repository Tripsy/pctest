<?php

require('vendor/autoload.php');

use Rakit\Validation\Validator;
use Gabriel\Pctest\Src\Label;
use Jenssegers\Blade\Blade;

//read data from json
$json = file_get_contents('php://input');
$data = json_decode($json, true);

//blah condition
if ($data) {
    $flag_source = 'json';

    $data = is_array($data) ? $data : [];
} else {
    $flag_source = 'sample';

    //sample data - used when link is accesed directly
    $data = [
        'first_name'   => 'David',
        'last_name'    => 'Gabriel',
        'company_name' => 'Test',
        'address_1'    => 'Str Zorelelor',
        'address_2'    => 'Nr 1',
        'city'         => 'Craiova',
        'county'       => 'Dolj',
        'country'      => 'Romania',
        'zip_code'     => '12345',
        'phone'        => '07000111222',
        'email'        => 'engine@test.ro',
    ];
}

$validator = new Validator();

//validator -> rules
$validation = $validator->make($data, [
    'first_name'   => 'required|max:25',
    'last_name'    => 'required|max:25',
    'company_name' => 'required|max:25',
    'address_1'    => 'required|max:100',
    'address_2'    => 'max:100',
    'city'         => 'required|max:25',
    'county'       => 'required|max:25',
    'country'      => 'required|max:25',
    'zip_code'     => 'required|max:10',
    'phone'        => 'required|max:15',
    'email'        => 'required|email|max:50',
]);

//validator -> config
$validation->setAliases([
    'first_name'   => 'first name',
    'last_name'    => 'last name',
    'company_name' => 'company name',
    'address_1'    => 'address line 1',
    'address_2'    => 'address line 2',
    'city'         => 'city',
    'county'       => 'county',
    'country'      => 'country',
    'zip_code'     => 'postal code',
    'phone'        => 'phone',
    'email'        => 'email address',
]);

//validator -> run
$validation->validate();

//validator -> check
if ($validation->fails()) { // handling errors
    //vars
    $errors = $validation->errors()->all();

    //init templating
    $blade = new Blade('view', 'cache');

    //output
    echo $blade->make('label/error', [
        'errors' => $errors
    ])->render();
} else { // validation passes
    //build label
    $obj_label = new Label();
    $obj_label->setData($data);

    //condition - label config check
    if ($errors = $obj_label->getErrors()) {
        //init templating
        $blade = new Blade('view', 'cache');

        //output
        echo $blade->make('label/error', [
            'errors' => $errors
        ])->render();
    } else {
        //vars
        $obj_data = $obj_label->getData();

        //init templating
        $blade = new Blade('view', 'cache');

        //output
        echo $blade->make('label/view', array_merge($obj_data, [
            'flag_source' => $flag_source,
            'ident' => $obj_label->getIdent()
        ]))->render();
    }
}