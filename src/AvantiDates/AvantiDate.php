<?php

namespace AvantiDates;

use AvantiDates\DateInterface;


/**
 * Class MyDate
 */
class AvantiDate implements DateInterface {

  /**
   * @param $start
   * @param $end
   * @return object
   */
  public function diff($start, $end) {

    // Sample object:
    return (object)array(
      'years' => null,
      'months' => null,
      'days' => null,
      'total_days' => null,
      'invert' => null
    );

  }

}
