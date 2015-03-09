<?php

namespace DateOperations;

use DateOperations\Interfaces\DateInterface;
use DateTime;

/**
 * Class phpDate.
 */
class phpDate implements DateInterface {

  /**
   * {@inheritdoc}
   */
  public function diff($start, $end) {
    date_default_timezone_set('Europe/London');

    $start = DateTime::createFromFormat('Y/m/d', $start);
    $end = DateTime::createFromFormat('Y/m/d', $end);

    // Sample object:
    return $start->diff($end);
  }

}
