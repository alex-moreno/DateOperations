<?php
/**
 * Created by PhpStorm.
 * User: alexmoreno
 * Date: 17/02/2015
 * Time: 19:57
 */
class DateOperations {

  protected $dateObject = NULL;

  /**
   * @param DateInterface $dateObject
   */
  public function __construct (DateInterface $dateObject) {
    $this->$dateObject = $dateObject;
  }

  /**
   * @param $start
   * @param $end
   */
  public function diff($start, $end) {
    $this->dateObject->diff($start, $end);
  }
}