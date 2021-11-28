<?php

namespace Gabriel\Pctest\Tests;

use PHPUnit\Framework\TestCase;
use Gabriel\Pctest\Src\Label;

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
        $var = new Label;

        $this->assertTrue(is_object($var));
    }

    /**
     * Test all label attributes are present in data set
    *
    */
    public function testAttributesAreSet()
    {
        $var = new Label;

        foreach ($var::LABEL_ATTRIBUTES as $k) {
            $this->assertArrayHasKey($k, self::DATA_SET);
        }
    }

    /**
     * Test getDataValue for key last_name
    *
    *
    */
    public function testLastName()
    {
        $var = new Label;

        $var->setData(self::DATA_SET);

        $last_name = $var->getDataValue('last_name');

        $this->assertEquals(self::DATA_SET['last_name'], $last_name);
    }

    /**
     * Test getDataValue for key last_name
    *
    *
    */
    public function testLAbelAttributeNotExist()
    {
        $var = new Label;

        $var->setData(self::DATA_SET);

        $var->setDataValue('attribute43423422942', 'this_value');

        $this->assertTrue(count($var->getErrors()) == 2, 'this_value doesn\'t exist in LABEL_ATTRIBUTES');
    }
}
