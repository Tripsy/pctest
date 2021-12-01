Description
=========================

PHP test project which generate a html label

Requirements
=========================
PHP 7.3 or higher

Composer 2 for installation

Installation
=========================
composer require "tripsy1234/pctest"

Usage
=========================

//generate label output
$label = new Label($data);

if ($errors = $label->getError()) {
    echo implode('<br />', $errors);
} else {
    echo $label->print();
}

Notes
=========================

Run phpUnit tests using following command:
$ vendor\bin\phpunit test

Sameple data:
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

Resources
=========================

https://github.com/jenssegers/blade

https://github.com/rakit/validation
