<?php

namespace AvantiDates;

use AvantiDates\Interfaces\DateInterface;

/**
 * @todo: move to CustomDate
 * Class MyDate
 */
class AvantiDate implements DateInterface {

  private $daysInLeapYear;
  private $daysInYear;

  protected $dateStart;
  protected $dateEnd;

  /**
   *
   * @param $start
   * @param $end
   * @return object
   */
  public function diff($start, $end) {

    $this->days = $this->calculateDays($start, $end);

    // Sample object:
    return (object)array(
      'years' => null,
      'months' => null,
      'days' => null,
      'total_days' => null,
      'invert' => null
    );

  }

  /**
   * Calculate number of days between two dates.
   *
   * @param $start
   *   Start date.
   * @param $end
   *   End date.
   *
   * @return int
   *   Number of days between start and end date.
   */
  public function calculateDays($start, $end) {
    // Is leap Year?
    $yearStart = $this->getYear('start');
    $yearEnd = $this->getYear('end');

    return 0;
  }

  /**
   * Return if the year is Leap or not
   *
   * @param $year
   *   Year to calculate.
   *
   * @return bool
   *   True if $year is Leap.
   */
  public function isLeapYear($year) {

    if ($year % 4) {
      if ($year % 100) {
        if ($year % 400) {
          $leapYear = TRUE;
        }
        else {
          $leapYear = FALSE;
        }
      }
      else {
        $leapYear = TRUE;
      }
    }
    else {
      $leapYear = FALSE;
    }

    return $leapYear;
  }

  /**
   * Get year in $date.
   *
   * @todo: getMonth, getDay
   *
   * @param $date
   * @return string
   */
  public function getYear($date) {
    if ($date == 'start') {
      return substr($this->dateStart, 0,3);
    }
    else {
      return substr($this->dateEnd, 0,3);
    }
  }


}
