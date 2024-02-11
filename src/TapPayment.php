<?php

namespace OsaEg\TapPayment;

use OsaEg\TapPayment\Traits\CardTrait;
use OsaEg\TapPayment\Traits\ChargeTrait;
use OsaEg\TapPayment\Traits\RefundTrait;

class TapPayment extends TapBase implements TapInterface
{
  use CardTrait, ChargeTrait, RefundTrait;

  protected $CARD_SET = false;

  public function __construct($config = [])
  {
    foreach ($this->REQUIRED_CONFIG_VARS as $parm => $req_status) {
      if (key_exists($parm, $config)) {
        $this->CONFIG_VARS[$parm] = $config[$parm];
      } else {
        if ($req_status) {
          throw new \InvalidArgumentException("InvalidArgumentException $parm field");
        }
      }
    }
  }
}