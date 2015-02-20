<?php

/**
 * Class MyDate
 */
class phpDate implements DateInterface {

  /**
   * @param $start
   * @param $end
   * @return object
   */
  public function diff($start, $end) {
    $start = DateTime::createFromFormat('Y/m/d', $start);
    $end = DateTime::createFromFormat('Y/m/d', $end);

    // Sample object:
    return $start->diff($end);
  }

}
