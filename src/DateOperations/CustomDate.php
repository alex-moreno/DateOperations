<?php

namespace DateOperations;

use DateOperations\Interfaces\DateInterface;

/**
 * @todo: move to CustomDate
 * Class MyDate
 */
class CustomDate implements DateInterface {

  const MONTHS = 12;

  private $daysInLeapYear;
  private $daysInYear;

  protected $dateStart;
  protected $dateEnd;

  public function __construct() {
    $this->daysInYear = array(31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334, 365);
    $this->daysInLeapYear = array(31, 60, 91, 121, 152, 182, 213, 244, 274, 305, 335, 366);
  }

  /**
   * Calculate difference between two dates.
   *
   * @param $start
   *   Date from.
   * @param $end
   *   Date to.
   *
   * @return object
   *   Object with the difference.
   */
  public function diff($start, $end) {

    $totalDays = $this->calculateDaysBetween($start, $end);

    // @todo
    // Once we know the number of days, we can approximate the years.
    $totalYears = $totalDays / $this->daysInYear[$this::MONTHS-1];

    // @todo
    // And the months.
    $totalMonths = $totalDays / $this::MONTHS;

    // Sample object:
    return (object)array(
      'y' => $totalYears,
      'm' => $totalMonths,
      'days' => $totalDays,
      'invert' => null
    );
  }

  /**
   * Given two years, calculate years past between.
   *
   * @param $start
   *   First year.
   * @param $end
   *   Second year.
   *
   * @return int
   *   Number of years between year $start and year $end
   */
  public function calculateYearsBetween($start, $end) {
    $numberYears = 0;
    $yearStart = $this->getYear($start);
    $yearEnd = $this->getYear($end);

    return $numberYears;
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

    // @todo: move to parent.
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
      $daysBeforeEndMonth = $this->getDaysRemainingMonth($monthEnd,$dayEnd, $this->isLeapYear($yearEnd));
      $daysBeforeStartMonth = $this->getDaysRemainingMonth($monthStart,$dayStart, $this->isLeapYear($yearStart));

      $numberDays = $daysBeforeEndMonth - $daysBeforeStartMonth;
    }
    // Calculate days for different years.
    else {
      // 1. Days spent in first year = total days - days until given date.
      $numberDaysFirstYear = $this->getDaysRemainingMonth(12, 31 , $this->isLeapYear($yearStart))
      - $this->getDaysRemainingMonth($monthStart - 1, $dayStart , $this->isLeapYear($yearStart));

      // 2. Days between years.
      $numberDays = $this->getDaysBetweenYears($yearStart, $yearEnd);

      // 3. Days spent in second year = Total number of days - passed days.
      $numberDaysLastYear = $this->getDaysPriorToMonth($monthEnd - 1, $this->isLeapYear($yearEnd)) + $dayEnd;

      // 4. Lastly, sum the results.
      $numberDays = $numberDays + $numberDaysFirstYear + $numberDaysLastYear;
    }

    return intval($numberDays);
  }

  public function getDaysRemainingMonth($month, $currentDay, $isLeapYear) {
    return $this->getDaysPriorToMonth($month - 1, $isLeapYear) + $currentDay;
  }

  /**
   * Get number of days between two given years.
   *
   * @param $yearStart
   *   Year from.
   * @param $yearEnd
   *   Year to.
   *
   * @return int
   *   Number of days or 0 if yearend < yearstart.
   */
  public function getDaysBetweenYears($yearStart, $yearEnd) {
    $numberDays = 0;

    // 2. years in the middle.
    // for year from $yearStart + 1 to $yearEnd -1
    $yearIndex = $yearStart + 1;
    while ($yearIndex < $yearEnd) {
      // Number of days in a year.
      $numberDays = $numberDays + $this->getDaysPriorToMonth(12, $this->isLeapYear($yearIndex));
      $yearIndex = $yearIndex + 1;
    }
    return $numberDays;
  }

  /**
   * Get number of days preceding a month.
   *
   * @param $month
   *   Month to calculate.
   * @param $isLeap
   *   Check for a leap year.
   *
   * @return int
   *   Number of days before $month.
   */
  public function getDaysPriorToMonth($month, $isLeap = FALSE) {
    $number_days = 0;
    // 0 to n - 1 array format vs 1 to n human readable format.
    $currentMonth = $month - 1;

    if ($isLeap) {
      $days = $this->daysInLeapYear;
    }
    else {
      $days = $this->daysInYear;
    }

    // Month - 1 as we want to know previous month to the current one.
    if ($currentMonth >= 0) {
      // Passed days previous to January will be 0.
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

    if ($year % 4 == 0) {
      if ($year % 100  == 0) {
        if ($year % 400 == 0) {
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
