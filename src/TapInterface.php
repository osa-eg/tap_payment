<?php

namespace OsaEg\TapPayment;

interface TapInterface
{

  public function charge($data);

  public function getCharge($charge_id);

  public function chargesList($options);

  public function refund($data = []);

  public function getRefund($refund_id);

  public function refundList($options);
}