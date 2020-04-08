<?php

namespace app\tests\unit;

use app\components\PersonalCode;
use PHPUnit_Framework_TestCase;

require "../../components/PersonalCode.php";

class PersonalCodeTest extends PHPUnit_Framework_TestCase
{

    public function testValidPersonalCode()
    {
        $personalCode = 38512120002; // 12/12/1985
        $age = 34;

        $personalCode = new PersonalCode($personalCode);
        $this->assertEquals($age, $personalCode->getAge());
    }

    public function testInvalidCode()
    {
        $personalCode = 43204020028; // 02/04/1932
        $age = 85;

        $personalCode = new PersonalCode($personalCode);
        $this->assertEquals($age, $personalCode->getAge());
    }
}