<?php

namespace AvantiDates;

/**
 * Class MyDate
 */
interface DateInterface {

  /**
   * @param $start
   * @param $end
   * @return object
   */
  public function diff($start, $end);

}
