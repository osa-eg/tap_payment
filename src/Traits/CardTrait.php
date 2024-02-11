<?php

namespace OsaEg\TapPayment\Traits;

trait CardTrait
{
  public function card($data)
  {
    $this->cardValidator($data);
    $IP = \Request::ip();
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL            => "https://api.tap.company/v2/tokens",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING       => "",
      CURLOPT_MAXREDIRS      => 10,
      CURLOPT_TIMEOUT        => 30,
      CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST  => "POST",
      CURLOPT_POSTFIELDS     => "{\"card\":{\"number\": " . $this->CARD_VARS['number'] . " ,\"exp_month\":" . $this->CARD_VARS['exp_month'] . ",\"exp_year\":" . $this->CARD_VARS['exp_year'] . ",\"cvc\":" . $this->CARD_VARS['cvc'] . ",\"name\":\"" . $this->CARD_VARS['name'] . "\",\"address\":{\"country\":\" " . $this->CARD_VARS['country'] . " \",\"line1\":\" " . $this->CARD_VARS['line1'] . " \",\"city\":\"" . $this->CARD_VARS['city'] . "\",\"street\":\"" . $this->CARD_VARS['street'] . "\",\"avenue\":\"" . $this->CARD_VARS['avenue'] . "\"}},\"client_ip\":\"" . $IP . "\"}",
      CURLOPT_HTTPHEADER     => array(
        "authorization: Bearer " . $this->CONFIG_VARS['secret_api_Key'] . " ",
        "content-type: application/json"
      ),
    ));



    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      throw new \InvalidArgumentException("InvalidArgumentException  $err");
    } else {
      $json_response = json_decode($response);
      if (isset($json_response->errors) && is_array($json_response->errors) && count($json_response->errors) > 0) {
        throw new \InvalidArgumentException("Error : " . $json_response->errors[0]->code . " ");
      }

      if (isset($json_response->object) && $json_response->object == "token") {
        $this->CHARGE_VARS['source']['id'] = $json_response->id;
        $CARD_SET = true;
      }
    }
  }
}