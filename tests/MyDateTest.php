<?php

use AvantiDates\AvantiDate;
use AvantiDates\phpDate;
use AvantiDates\DateOperations;

/**
 * Class CustomDateTest
 */
class CustomDateTest extends PHPUnit_Framework_TestCase {

  /**
   * Test testCalculateDays().
   *
   * @dataProvider getDatesAndDaysBetween
   */
  public function testCalculateDays($given, $expected) {
    // Our implementation.
    $avantiDate = new AvantiDate();

    $start = $given['start'];
    $end = $given['end'];
    $avantiDate->calculateDaysBetween($start, $end);
    $this->assertSame($avantiDate->calculateDaysBetween($start, $end), $expected);
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

      // NOTE: Expected result as per current spec.
      array(
        'given' => array(
          'start' => '2014/01/10',
          'end' => '2014/01/01',
        ),
        'expected' => -9,
      ),


      // Different months and days, same years.
      // Explanation
      // Month 1: 31 - 10 = 21
      // Month 2: 59 - 01 - 31= 27
      // FORMULA USED:
      // (total days month2 + days month2) -  (total days month1 + days month1).
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

    );
  }

  /**
   * @dataProvider getYears
   */
  public function testGetYear($given, $expected) {
    // Our implementation.
    $avantiDate = new AvantiDate();

    $this->assertSame($avantiDate->getYear($given), $expected);

  }

  /**
   * DataProvider.
   */
  public function getYears() {
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
    // Our implementation.
    $avantiDate = new AvantiDate();

    $this->assertSame($avantiDate->getMonth($given), $expected);

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
    // Our implementation.
    $avantiDate = new AvantiDate();

    $this->assertSame($avantiDate->getDay($given), $expected);

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
   * Test Dates.
   *
   * @dataProvider getDates
   */
  public function testDates($dateStart, $dateEnd) {

//      $this->assertTotalDays($dateStart, $dateEnd);
  }

  /**
   * DataProvider.
   */
  public function getDates() {
    return array(
      // Simple days in same year.
      array(
        'given' => '2014/01/01',
        'expected' => '2014/01/04',
      ),

      array(
        'given' => '2014/01/01',
        'expected' => '2014/01/04',
      ),

      array(
        'given' => '2014/01/01',
        'expected' => '2014/01/14',
      ),

    );
  }



  // @TODO: simplify using a dateprovider.
    public function testSimpleDays() {

//      $this->assertDays('2014/01/01', '2014/01/04');

    }
//
//    public function testSimpleMonths() {
//
//      $this->assertMonths('2014/01/01', '2014/03/01');
//
//    }
//
//    public function testSimpleYears() {
//
//      $this->assertYears('2014/01/01', '2015/01/01');
//
//    }
//
//    public function testInvertDayTrue() {
//
//      $this->assertInvert('2015/01/02', '2015/01/01');
//
//    }
//
//    public function testInvertMonthTrue() {
//
//      $this->assertInvert('2015/02/02', '2015/01/01');
//
//    }
//
//    public function testInvertYearTrue() {
//
//      $this->assertInvert('2016/01/01', '2015/01/01');
//
//    }
//
//    public function testInvertDayFalse() {
//
//      $this->assertInvert('2015/01/01', '2015/01/02');
//
//    }
//
//    public function testInvertMonthFalse() {
//
//      $this->assertInvert('2015/01/01', '2015/02/01');
//
//    }
//
//    public function testInvertYearFalse() {
//
//      $this->assertInvert('2015/01/01', '2016/01/01');
//
//    }
//
//    public function testComplexTotalDays() {
//
//      $this->assertTotalDays('2013/01/01', '2015/05/15');
//
//    }
//
//    public function testComplexDays() {
//
//      $this->assertDays('2013/03/21', '2015/07/31');
//
//    }
//
//    public function testComplexMonths() {
//
//      $this->assertMonths('2013/06/15', '2015/03/01');
//
//    }
//
//    public function testComplexYears() {
//
//      $this->assertYears('2013/09/13', '2015/07/01');
//
//    }
//
//    public function testLeapYearTotalDays() {
//
//      $this->assertTotalDays('2013/01/01', '2017/05/15');
//
//    }
//
//    public function testLeapYearDays() {
//
//      $this->assertDays('2013/03/21', '2017/07/31');
//
//    }
//
//    public function testLeapYearMonths() {
//
//      $this->assertMonths('2013/06/15', '2017/03/01');
//
//    }
//
//    public function testLeapYearYears() {
//
//      $this->assertYears('2013/09/13', '2017/07/01');
//
//    }
//
//    public function testInvertLeapYearTrue() {
//
//      $this->assertInvert('2017/03/16', '2013/06/18');
//
//    }
//
//    public function testMultipleLeapYearTotalDays() {
//
//      $this->assertTotalDays('2013/01/01', '2029/05/15');
//
//    }
//
//    public function testMultipleLeapYearDays() {
//
//      $this->assertDays('2013/03/21', '2028/07/31');
//
//    }
//
//    public function testMultipleLeapYearMonths() {
//
//      $this->assertMonths('2013/06/15', '2029/03/01');
//
//    }
//
//    public function testMultipleLeapYearYears() {
//
//      $this->assertYears('2013/09/13', '2029/07/01');
//
//    }
//
//    public function testInvertMultipleLeapYearTrue() {
//
//      $this->assertInvert('2029/03/16', '2013/06/18');
//
//    }

//    private function assertYears($s, $e) {
//      $d = MyDate::diff($s, $e);
//      $a = $this->dateDiff($s, $e);
//      $this->assertSame($a->y, $d->years);
//    }
//
//    private function assertMonths($s, $e) {
//      $d = MyDate::diff($s, $e);
//      $a = $this->dateDiff($s, $e);
//      $this->assertSame($a->m, $d->months);
//    }
//
//    private function assertDays($s, $e) {
//      $d = MyDate::diff($s, $e);
//      $a = $this->dateDiff($s, $e);
//      $this->assertSame($a->d, $d->days);
//    }
//
    private function assertTotalDays($start, $end) {

      // Our implementation.
      $avantiDate = new AvantiDate();
      $operationWithAvantiDate = new DateOperations($avantiDate);

      // PHP Implementation to compare with.
      $phpDate = new phpDate($start, $end);
      $operationWithPHPDate = new DateOperations($phpDate);

      $this->assertSame($operationWithAvantiDate->diff($start, $end), $operationWithPHPDate->diff($start, $end));
    }

//
//    private function assertInvert($s, $e) {
//      $d = MyDate::diff($s, $e);
//      $a = $this->dateDiff($s, $e);
//      $this->assertSame((bool)$a->invert, $d->invert);
//    }
//
//    private function dateDiff($start, $end) {
//      $start = DateTime::createFromFormat('Y/m/d', $start);
//      $end = DateTime::createFromFormat('Y/m/d', $end);
//      return $start->diff($end);
//    }
  }
