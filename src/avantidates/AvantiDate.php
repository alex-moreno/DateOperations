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
      $numberDays = ($this->getDaysPriorToMonth($monthEnd) - $dayEnd) - ($this->getDaysPriorToMonth($monthStart) - $dayStart);
    }

    return intval($numberDays);
  }


  /**
   *
   * @param $month
   * @return mixed
   */
  public function getDaysPriorToMonth($month) {
    $days = array(31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334);

    return $days[$month-1];
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
   * @return string
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
   * @return string
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
   * @return string
   */
  public function getDay($date) {
    return intval(substr($date, 8,2));
  }

}
