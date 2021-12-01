<?php

namespace Gabriel\PcTest\Tests;

use PHPUnit\Framework\TestCase;
use Gabriel\PcTest\Src\Label;

class LabelTest extends TestCase
{
    const DATA_SET = [
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

    /**
     * Check if the class has no syntax error
    *
    */
    public function testIsThereAnySyntaxError()
    {
        $var = new Label(self::DATA_SET);

        $this->assertTrue(is_object($var));
    }

    /**
     * Test all label attributes are present in data set
    *
    */
    public function testAttributes()
    {
        $var = new Label(self::DATA_SET);

        $this->assertEquals(self::DATA_SET, $var->getData());
    }

    /**
     * Test getDataValue for key last_name
    *
    *
    */
    public function testLastName()
    {
        $var = new Label(self::DATA_SET);

        $last_name = $var->getDataValue('last_name');

        $this->assertEquals(self::DATA_SET['last_name'], $last_name);
    }
}
