<?php

namespace App\Tests\Service;

use App\Service\DateHelper;
use DateTime;
use PHPUnit\Framework\TestCase;

class DateHelperTest extends TestCase
{   
    public function testInitSinceDateFunctionReturnsDatetime(): void
    {
        $dateHelper = new DateHelper();    

        $input = null;
        $response = $dateHelper->initSinceDate($input);        
        $this->assertInstanceOf('Datetime', $response);

        $input = '2021-04-10T04:57:53';
        $response = $dateHelper->initSinceDate($input);        
        $this->assertInstanceOf('Datetime', $response);        
    }

    public function testInitUntilDateFunctionReturnsDatetime(): void
    {
        $dateHelper = new DateHelper();    

        $input = null;
        $response = $dateHelper->initUntilDate($input);        
        $this->assertInstanceOf('Datetime', $response);

        $input = '2021-04-10T04:57:53';
        $response = $dateHelper->initUntilDate($input);        
        $this->assertInstanceOf('Datetime', $response);        
    }

    public function testCountNumberOfWeeksBetweenDatesFunctionReturnsInt(): void
    {
        $dateHelper = new DateHelper();   

        $date1 = new DateTime();
        $date2 = new DateTime();
        $response = $dateHelper->countNumberOfWeeksBetweenDates($date1, $date2);
        $this->assertIsInt($response);
    }

    public function testCountNumberOfWeeksBetweenDatesFunctionReturnsGreaterOrEqualTo1(): void
    {
        $dateHelper = new DateHelper();  

        $date1 = new DateTime();
        $date2 = new DateTime();
        $response = $dateHelper->countNumberOfWeeksBetweenDates($date1, $date2);
        $this->assertGreaterThanOrEqual(1, $response);

        $date1 = new DateTime('2000-01-01');
        $date2 = new DateTime();
        $response = $dateHelper->countNumberOfWeeksBetweenDates($date1, $date2);
        $this->assertGreaterThanOrEqual(1, $response);
    }

    public function testCountNumberOfWeeksBetweenDatesFunctionReturnsCorrectValue(): void
    {
        $dateHelper = new DateHelper();  

        $date1 = new DateTime('2021-01-01');
        $date2 = new DateTime('2021-02-01');
        $response = $dateHelper->countNumberOfWeeksBetweenDates($date1, $date2);
        $this->assertEquals(5, $response);
    }
}
 