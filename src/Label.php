<?php

namespace Gabriel\Pctest\Src;

/**
*
*  Builds label
*
*/
class Label
{
    private array $error = []; //list with error messages
    private array $data = []; //label data array
    private string $ident; //unique identifier for label

    const LABEL_IDENT_SALT = '3Z#@b^hjZ@1';
    const LABEL_ATTRIBUTES = [
        'first_name',
        'last_name',
        'company_name',
        'address_1',
        'address_2',
        'city',
        'county',
        'country',
        'zip_code',
        'phone',
        'email',
    ];

    function __construct()
    {
    }

    /**
     * @param string $message
     *
     * @return void
     */
    private function pushError(string $message): void
    {
        $this->error[] = $message;
    }

    public function getErrors(): array
    {
        return $this->error;
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return void
     */
    public function setDataValue(string $key, string $value): void
    {
        if (in_array($key, self::LABEL_ATTRIBUTES)) {
            $this->data[$key] = $value;

            //reset unique identifier
            $this->resetIdent();
        } else {
            $this->pushError($key.' not defined as label attribute');
        }
    }

    /**
     * @param array $data
     *
     * @return void
     */
    public function setData(array $data): void
    {
        foreach ($data as $key => $value) {
            $this->setDataValue($key, $value);
        }

        $this->generateIdent();
    }

    private function resetIdent(): void
    {
        $this->ident = '';
    }

    /**
     * @return void
     */
    private function generateIdent(): void
    {
        $string  = implode('', $this->data);
        $string .= SELF::LABEL_IDENT_SALT;

        $this->ident = hash('md5', $string); //max 32 chars
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
     * @param string $default value returned either if key not present or key value is empty
     *
     * @return array
     */
    public function getData(string $default = 'n/a'): array
    {
        $data = [];

        foreach (self::LABEL_ATTRIBUTES as $key) {
            $data[$key] = $this->getDataValue($key, $default);
        }

        return $data;
    }
}