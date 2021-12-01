<?php

namespace Gabriel\PcTest\Src;

use Rakit\Validation\Validator;
use Jenssegers\Blade\Blade;

/**
*
*  Used to create a simple label, output as html, based on provided data after validation
*
*/
class Label implements LabelInterface
{
    private array $error = []; //list with error messages
    private array $data = []; //label data array
    private string $ident; //unique identifier for label

    const LABEL_IDENT_SALT = '3Z#@b^hjZ@1';
    const LABEL_ATTRIBUTES = [
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
    ];

    function __construct(array $data)
    {
        $this->validateData($data, self::LABEL_ATTRIBUTES);

        if (empty($this->getError())) {
            $this->setData($data);
        }
    }

    /**
     * @return array
     */
    public function getError(): array
    {
        return $this->error;
    }

    /**
     * @return string
     */
    public function print(): string
    {
        //init templating
        $blade = new Blade('view', 'cache');

        //return
        return $blade->make('label/view', [
            'data' => $this->getData(),
            'ident' => $this->getIdent()
        ])->render();
    }

    /**
     * @param array $data
     * @param array $rules
     *
     * @return void
     */
    private function validateData(array $data, array $rules): void
    {
        $validator = new Validator();

        //validator -> rules
        $validation = $validator->make($data, $rules);

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
        if ($validation->fails()) {
            $this->setError($validation->errors()->all());
        }
    }

    /**
     * @param array $data
     *
     * @return void
     */
    private function setData(array $data): void
    {
        foreach (self::LABEL_ATTRIBUTES as $key => $value) {
            $this->addDataValue($key, $data[$key]);
        }
    }

    /**
     * @param string $message
     *
     * @return void
     */
    private function setError(array $message): void
    {
        $this->error = array_merge($this->error, $message);
    }

    private function addDataValue(string $key, string $value): void
    {
        $this->data[$key] = $value;
    }

    /**
     * @return void
     */
    private function generateIdent(): void
    {
        $string  = implode('', $this->data);
        $string .= SELF::LABEL_IDENT_SALT;

        $this->setIdent(hash('md5', $string));
    }

    /**
     * @param string $string
     *
     * @return void
     */
    private function setIdent(string $string): void
    {
        $this->ident = $string;
    }

    /**
     * @return string
     */
    public function getIdent(): string
    {
        if (empty($this->ident)) {
            $this->generateIdent();
        }

        return $this->ident;
    }

    /**
     * @return void
     */
    private function resetIdent(): void
    {
        $this->setIdent('');
    }

    /**
     * @param string $key
     * @param string $default value returned either if key not present or key value is empty
     *
     * @return string
     */
    public function getDataValue(string $key, string $default = 'n/a'): string
    {
        if (!empty($this->data[$key])) {
            return $this->data[$key];
        } else {
            return $default;
        }
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}