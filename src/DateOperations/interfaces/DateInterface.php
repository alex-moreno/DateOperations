<?php

namespace DateOperations\Interfaces;

/**
 * Interface DateInterface
 */
interface DateInterface {

  /**
   * Return and object with the difference between two dates.
   *
   * @param $start
   *   From date.
   * @param $end
   *   To date.
   *
   * @return object
   *   Object with the difference between $start and $end.
   */
  public function diff($start, $end);

}
