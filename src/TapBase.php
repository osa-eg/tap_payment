<?php

namespace OsaEg\TapPayment;

use OsaEg\TapPayment\Traits\VarsTrait;

class TapBase
{
    use VarsTrait;

    protected function cardValidator($data)
    {
        foreach ($this->REQUIRED_CARD_VARS as $parm => $req_status) {
            if (key_exists($parm, $data)) {
                $this->CARD_VARS[$parm] = $data[$parm];
            } else {
                if ($req_status) {
                    throw new \InvalidArgumentException("InvalidArgumentException $parm field");
                }
            }
        }
    }

    protected function chargeValidator($data)
    {
        foreach ($this->REQUIRED_CHARGE_VARS as $Firstkey => $req_status) {
            if (is_array($req_status)) {
                $SecondArray = $this->REQUIRED_CHARGE_VARS[$Firstkey];
                foreach ($SecondArray as $Secondkey => $req_status2) {
                    if (is_array($req_status2)) {
                        $ThirdArray = $this->REQUIRED_CHARGE_VARS[$Firstkey][$Secondkey];
                        foreach ($ThirdArray as $Thirdkey => $req_status3) {
                            if (isset($data[$Firstkey][$Secondkey]) &&  key_exists($Thirdkey, $data[$Firstkey][$Secondkey])) {
                                $this->CHARGE_VARS[$Firstkey][$Secondkey] = $data[$Firstkey][$Secondkey];
                            } else {
                                if ($req_status3) {
                                    // missing required parm
                                    throw new \InvalidArgumentException("InvalidArgumentException $Firstkey.$Secondkey.$Thirdkey required");
                                } else {
                                    if (in_array($Thirdkey, ['country_code', 'number']) && $this->CHARGE_VARS[$Firstkey][$Secondkey][$Thirdkey] == null) {
                                        if (!isset($this->CHARGE_VARS['customer']['email']) || isset($this->CHARGE_VARS['customer']['email']) && $this->CHARGE_VARS['customer']['email'] == null) {
                                            throw new \InvalidArgumentException("InvalidArgumentException $Firstkey.phone or $Firstkey.email is required");
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        if (isset($data[$Firstkey]) && key_exists($Secondkey, $data[$Firstkey])) {
                            $this->CHARGE_VARS[$Firstkey][$Secondkey] = $data[$Firstkey][$Secondkey];
                        } else {
                            if ($req_status2) {
                                // missing required parm
                                throw new \InvalidArgumentException("InvalidArgumentException $Firstkey.$Secondkey required");
                            }
                        }
                    }
                }
            } else {
                if (key_exists($Firstkey, $data)) {
                    $this->CHARGE_VARS[$Firstkey] = $data[$Firstkey];
                } else {
                    if ($req_status) {
                        // missing required parm
                        throw new \InvalidArgumentException("InvalidArgumentException $Firstkey field");
                    }
                }
            }
        }
    }


    protected function refundValidator($data)
    {
        foreach ($this->REQUIRED_REFUND_VARS as $Firstkey => $req_status) {
            if (is_array($req_status)) {
                $SecondArray = $this->REQUIRED_REFUND_VARS[$Firstkey];
                foreach ($SecondArray as $Secondkey => $req_status2) {
                    if (isset($data[$Firstkey]) && key_exists($Secondkey, $data[$Firstkey])) {
                        $this->REFUND_VARS[$Firstkey][$Secondkey] = $data[$Firstkey][$Secondkey];
                    } else {
                        if ($req_status2) {
                            // missing required parm
                            throw new \InvalidArgumentException("InvalidArgumentException $Firstkey.$Secondkey required");
                        }
                    }
                }
            } else {
                if (key_exists($Firstkey, $data)) {
                    $this->REFUND_VARS[$Firstkey] = $data[$Firstkey];
                } else {
                    if ($req_status) {
                        // missing required parm
                        throw new \InvalidArgumentException("InvalidArgumentException $Firstkey field");
                    }
                }
            }
        }
    }


    protected function chargesListValidator($options)
    {
        if (isset($options['period'])) {
            if (isset($options['period']['date']['from'])) {
                $strtotime = strtotime($options['period']['date']['from']);
                if ($strtotime != false && $strtotime > 0) {
                    $this->CHARGES_FILTER['period']['date']['from'] = $strtotime;
                } else {
                    throw new \Exception("Exception period from date not valid !");
                }
            }

            if (isset($options['period']['date']['to'])) {
                $strtotime = strtotime($options['period']['date']['to']);
                if ($strtotime != false && $strtotime > 0) {
                    $this->CHARGES_FILTER['period']['date']['to'] = $strtotime;
                } else {
                    throw new \Exception("Exception period to date not valid !");
                }
            }
        }

        if (isset($options['status'])) {
            if (in_array($options['status'], $this->CHARGE_STATUS_LIST)) {
                $this->CHARGES_FILTER['status'] = $options['status'];
            } else {
                throw new \Exception("Exception charge status not valid !");
            }
        }

        if (isset($options['limit'])) {
            if (is_numeric($options['limit']) && $options['limit'] > 0 && $options['limit'] < 51) {
                $this->CHARGES_FILTER['limit'] = $options['limit'];
            } else {
                throw new \Exception("Exception charges limit not valid !");
            }
        }
    }

    protected function refundsListValidator($options)
    {
        if (isset($options['period'])) {
            if (isset($options['period']['date']['from'])) {
                $strtotime = strtotime($options['period']['date']['from']);
                if ($strtotime != false && $strtotime > 0) {
                    $this->REFUNDS_FILTER['period']['date']['from'] = $strtotime;
                } else {
                    throw new \Exception("Exception period from date not valid !");
                }
            }

            if (isset($options['period']['date']['to'])) {
                $strtotime = strtotime($options['period']['date']['to']);
                if ($strtotime != false && $strtotime > 0) {
                    $this->REFUNDS_FILTER['period']['date']['to'] = $strtotime;
                } else {
                    throw new \Exception("Exception period to date not valid !");
                }
            }
        }




        if (isset($options['limit'])) {
            if (is_numeric($options['limit']) && $options['limit'] > 0 && $options['limit'] < 51) {
                $this->REFUNDS_FILTER['limit'] = $options['limit'];
            } else {
                throw new \Exception("Exception refunds limit not valid !");
            }
        }
    }
}