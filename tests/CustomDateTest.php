<?php

use DateOperations\CustomDate;
use DateOperations\phpDate;
use DateOperations\DateOperations;

/**
 * Class CustomDateTest
 */
class CustomDateTest extends PHPUnit_Framework_TestCase {

  private $customDate;

  /**
   * Initial set ups.
   */
  public function setUp() {
    $this->customDate = new CustomDate();
  }

  /**
   * Test testCalculateDays().
   *
   * @dataProvider getDatesAndDaysBetween
   */
  public function testCalculateDays($given, $expected) {
    $this->assertSame($this->customDate->calculateDaysBetween($given['start'], $given['end']), $expected);
  }

  /**
   * DataProvider.
   */
  public function getDatesAndDaysBetween() {
    return array(
      // Simple days in same month and year.
      array(
        'given' => array(
          'start' => '2014/01/01',
          'end' => '2014/01/04',
        ),
        'expected' => 3,
      ),

      array(
        'given' => array(
          'start' => '2014/01/01',
          'end' => '2014/01/01',
        ),
        'expected' => 0,
      ),

      array(
        'given' => array(
          'start' => '2014/01/01',
          'end' => '2014/01/15',
        ),
        'expected' => 14,
      ),

      array(
        'given' => array(
          'start' => '2014/01/01',
          'end' => '2014/01/25',
        ),
        'expected' => 24,
      ),

      // Different months and days, same years.
      array(
        'given' => array(
          'start' => '2014/01/10',
          'end' => '2014/02/01',
        ),
        'expected' => 22,
      ),

      array(
        'given' => array(
          'start' => '2014/01/10',
          'end' => '2014/02/10',
        ),
        'expected' => 31,
      ),

      array(
        'given' => array(
          'start' => '2014/02/10',
          'end' => '2014/06/10',
        ),
        'expected' => 120,
      ),

      array(
        'given' => array(
          'start' => '2014/01/10',
          'end' => '2014/12/30',
        ),
        'expected' => 354,
      ),

      array(
        'given' => array(
          'start' => '2014/04/18',
          'end' => '2014/12/30',
        ),
        'expected' => 256,
      ),

      array(
        'given' => array(
          'start' => '2014/01/01',
          'end' => '2014/12/30',
        ),
        'expected' => 363,
      ),

      // @todo: test Leap days.

      // @todo: test dates between years.
      array(
        'given' => array(
          'start' => '2012/01/01',
          'end' => '2014/12/30',
        ),
        'expected' => 1094,
      ),

      array(
        'given' => array(
          'start' => '2012/01/01',
          'end' => '2014/12/20',
        ),
        'expected' => 1084,
      ),

      array(
        'given' => array(
          'start' => '2013/01/01',
          'end' => '2014/12/30',
        ),
        'expected' => 728,
      ),

      array(
        'given' => array(
          'start' => '2013/01/01',
          'end' => '2014/10/30',
        ),
        'expected' => 667,
      ),

      array(
        'given' => array(
          'start' => '2013/01/01',
          'end' => '2024/10/30',
        ),
        'expected' => 4320,
      ),

      array(
        'given' => array(
          'start' => '1000/01/01',
          'end' => '2024/10/30',
        ),
        'expected' => 374311,
      ),

      array(
        'given' => array(
          'start' => '1000/01/01',
          'end' => '8000/10/30',
        ),
        'expected' => 2557000,
      ),

    );
  }

  /**
   * @dataProvider getDates
   */
  public function testGetYear($given, $expected) {
    $this->assertSame($this->customDate->getYear($given), $expected);
  }

  /**
   * DataProvider.
   */
  public function getDates() {
    return array(
      array(
        'given' => '2014/01/01',
        'expected' => 2014,
      ),

      array(
        'given' => '2020/01/01',
        'expected' => 2020,
      ),

      array(
        'given' => '3014/01/01',
        'expected' => 3014,
      ),

      array(
        'given' => '1014/01/01',
        'expected' => 1014,
      ),

      array(
        'given' => '2022/01/01',
        'expected' => 2022,
      ),

    );

  }

  /**
   * @dataProvider getMonths
   */
  public function testGetMonth($given, $expected) {
    $this->assertSame($this->customDate->getMonth($given), $expected);

  }

  /**
   * DataProvider.
   */
  public function getMonths() {
    return array(
      array(
        'given' => '2014/01/01',
        'expected' => 01,
      ),

      array(
        'given' => '2020/12/01',
        'expected' => 12,
      ),

      array(
        'given' => '3014/11/01',
        'expected' => 11,
      ),

      array(
        'given' => '1014/05/01',
        'expected' => 5,
      ),

      array(
        'given' => '2022/03/01',
        'expected' => 3,
      ),

    );
  }

  /**
   * @dataProvider getDays
   */
  public function testGetDay($given, $expected) {
    $this->assertSame($this->customDate->getDay($given), $expected);
  }

  /**
   * DataProvider.
   */
  public function getDays() {
    return array(
      array(
        'given' => '2014/01/01',
        'expected' => 01,
      ),

      array(
        'given' => '2020/11/10',
        'expected' => 10,
      ),

      array(
        'given' => '3014/01/30',
        'expected' => 30,
      ),

      array(
        'given' => '1014/12/20',
        'expected' => 20,
      ),

      array(
        'given' => '2022/6/06',
        'expected' => 6,
      ),

    );

  }

  /**
   * Test Leap years
   *
   * @dataProvider getYears()
   */
  public function testIsLeapYear($year, $expected) {
    $this->assertEquals($this->customDate->isLeapYear($year), $expected);
  }

  /**
   * DataProvider.
   */
  public function getYears() {
    return array(
      array(
        'given' => '2013',
        'expected' => FALSE,
      ),

      array(
        'given' => '2014',
        'expected' => FALSE,
      ),

      array(
        'given' => '2016',
        'expected' => TRUE,
      ),

      array(
        'given' => '2000',
        'expected' => TRUE,
      ),

      array(
        'given' => '2400',
        'expected' => TRUE,
      ),

      array(
        'given' => '2012',
        'expected' => TRUE,
      ),

      array(
        'given' => '2200',
        'expected' => FALSE,
      ),

      array(
        'given' => '1800',
        'expected' => FALSE,
      ),

      array(
        'given' => '1700',
        'expected' => FALSE,
      ),

      array(
        'given' => '1600',
        'expected' => TRUE,
      ),

      array(
        'given' => '1601',
        'expected' => FALSE,
      ),

      array(
        'given' => '1700',
        'expected' => FALSE,
      ),

      array(
        'given' => '2100',
        'expected' => FALSE,
      ),

      array(
        'given' => '2500',
        'expected' => FALSE,
      ),

      array(
        'given' => '3400',
        'expected' => FALSE,
      ),

      array(
        'given' => '3900',
        'expected' => FALSE,
      ),

      array(
        'given' => '3800',
        'expected' => FALSE,
      ),

      array(
        'given' => '1900',
        'expected' => FALSE,
      ),

      array(
        'given' => '3300',
        'expected' => FALSE,
      ),

      array(
        'given' => '3700',
        'expected' => FALSE,
      ),

      array(
        'given' => '2160',
        'expected' => TRUE,
      ),

      array(
        'given' => '2332',
        'expected' => TRUE,
      ),

      array(
        'given' => '2032',
        'expected' => TRUE,
      ),

    );
  }

  /**
   * @dataProvider getDatesAndDaysBetween
   */
  public function testAssertTotalDays($given, $expected) {
    // Custom implementation.
    $operationWithAvantiDate = new DateOperations($this->customDate);
    $customDiff = $operationWithAvantiDate->diff($given['start'], $given['end']);

    // PHP Implementation to compare with.
    $operationWithPHPDate = new DateOperations(new phpDate($given['start'], $given['end']));
    $nativeDiff = $operationWithPHPDate->diff($given['start'], $given['end']);

    // Testing days.
    $this->assertSame($customDiff->days, $nativeDiff->days);

    // @todo: Testing months.
//    $this->assertSame($customDiff->m, $nativeDiff->m);

    // @todo: Testing years.
    // Testing years.
//    $this->assertSame($customDiff->y, $nativeDiff->y);
  }

}
