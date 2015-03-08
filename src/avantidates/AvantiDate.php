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
   * Calculate difference between two dates.
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
   * Return if $date is a valid date.
   *
   * @param $date
   *
   * @return bool
   *   True if it's valid.
   */
  public function isValidDate($date) {

    return TRUE;
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
  public function calculateDaysBetween($start, $end) {
    // Return value.
    $numberDays = 0;

    $yearStart = $this->getYear($start);
    $monthStart = $this->getMonth($start);
    $dayStart = $this->getDay($start);

    $yearEnd = $this->getYear($end);
    $monthEnd = $this->getMonth($end);
    $dayEnd = $this->getDay($end);

    // 1st, is same year?
    if ($yearEnd == $yearStart && $monthStart == $monthEnd) {
      $numberDays = $dayEnd - $dayStart;
    }
    elseif ($yearStart == $yearEnd) {
      $daysBeforEndMonth = $this->getDaysPriorToMonth($monthEnd - 1) + $dayEnd;
      $daysBeforStartMonth = $this->getDaysPriorToMonth($monthStart - 1) + $dayStart;
      $numberDays = $daysBeforEndMonth - $daysBeforStartMonth;

    }
    else {
      // Calculate for different years.

    }

    return intval($numberDays);
  }

  /**
   *
   * @param $month
   * @return int
   */
  public function getDaysPriorToMonth($month) {
    $number_days = 0;
    // 0 to n - 1 array format vs 1 to n human readable format.
    $currentMonth = $month - 1;

    // @todo: is leap?
//    $this->isLeapYear($year) {
//    $days = array(31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334);
//  }
//    else {}
    $days = array(31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334);

    // Month - 1 as we want to know previous month to the current one.
    if ($currentMonth >= 0) {
      // Previous to January, passed days will be 0.
      $number_days = $days[$currentMonth];
    }

    return $number_days;
  }

  /**
   * Return if the year is Leap or not
   *
   * @param $year
   *   Year to calculate.
   *
   * @return bool
   *   TRUE if $year is Leap, FALSE otherwise.
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
   * @todo: worth using regex instead? Probably not.
   *
   * @param $date
   *   Input date in yyyy/mm/dd format.
   *
   * @return int
   */
  public function getYear($date) {
    return intval(substr($date, 0,4));
  }

  /**
   * Get the month in $date.
   *
   * @param $date
   *   Input date in yyyy/mm/dd format.
   *
   * @return int
   */
  public function getMonth($date) {
    return intval(substr($date, 5,2));
  }

  /**
   * Get the day in $date.
   *
   * @param $date
   *   Input date in yyyy/mm/dd format.
   *
   * @return int
   */
  public function getDay($date) {
    return intval(substr($date, 8,2));
  }

}
