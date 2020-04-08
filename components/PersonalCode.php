<?php

namespace app\components;

use DateTime;
use Exception;

class PersonalCode
{
    private $code = null;
    private $birthDate = null;

    /**
     * PersonalIdCode constructor.
     * @param string $code
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }


    /**
     * @return DateTime
     * @throws Exception
     */
    public function getBirthDate(): string
    {
        if (is_null($this->birthDate)) {
            $year = $this->getBirthCentury() + substr($this->code, 1, 2);
            $month = substr($this->code, 3, 2);
            $day = substr($this->code, 5, 2);
            $this->birthDate = $year . '-' . $month . '-' . $day;

        }
        return $this->birthDate;
    }


    /**
     * @return int
     */
    public function getBirthCentury(): int
    {
        $firstNo = substr($this->code, 0, 1);
        return 1700 + ceil($firstNo / 2) * 100;
    }

    /**
     * @param $personal_code
     * @return int
     */
    function getAge():int
    {
        $personal_code = strval($this->code);
        if ($personal_code[0] == 1 || $personal_code[0] == 2) {
            return $this->calculateAge(substr($personal_code, 1, 6), '18');
        } elseif ($personal_code[0] == 3 || $personal_code[0] == 4) {
            return $this->calculateAge(substr($personal_code, 1, 6), '19');
        } else {
            return $this->calculateAge(substr($personal_code, 1, 6), '20');
        }
    }


    /**
     * @param $birthday
     * @param $century
     * @return int
     */
    function calculateAge($birthday, $century):int
    {
        $birthday = $century . $birthday;
        $age = date("Ymd") - date($birthday);
        $age = substr($age, 0, -4);
        if ($age < 0) {
            $age = 0;
        }
        return $age;

    }


}