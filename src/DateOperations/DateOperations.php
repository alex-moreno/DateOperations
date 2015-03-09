<?php

namespace AvantiDates;

use AvantiDates\Interfaces\DateInterface;

/**
 * Created by PhpStorm.
 * User: alexmoreno
 * Date: 17/02/2015
 * Time: 19:57
 */
class DateOperations {

  protected $dateObject;

  /**
   * Constructor.
   *
   * @param DateInterface $dateObject
   */
  public function __construct (DateInterface $dateObject) {
    $this->dateObject = $dateObject;
  }

  /**
   * {@inheritdoc}
   */
  public function diff($start, $end) {
    return $this->dateObject->diff($start, $end);
  }
}
