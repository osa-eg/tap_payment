<?php

namespace OsaEg\TapPayment\Traits;

trait RefundTrait
{

    public function refund($data = [])
    {
        $this->refundValidator($data);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.tap.company/v2/refunds",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"charge_id\":\"" . $this->REFUND_VARS['charge_id'] . "\",\"amount\":" . $this->REFUND_VARS['amount'] . ",\"currency\":\"" . $this->REFUND_VARS['currency'] . "\",\"description\":\"" . $this->REFUND_VARS['description'] . "\",\"reason\":\"" . $this->REFUND_VARS['reason'] . "\",
        \"reference\":{\"merchant\":\"" . $this->REFUND_VARS['reference']['merchant'] . "\"},\"metadata\":{\"udf1\":\"" . $this->REFUND_VARS['metadata']['udf1'] . "\",\"udf2\":\"" . $this->REFUND_VARS['metadata']['udf2'] . "\"},\"post\":{\"url\":\"" . $this->REFUND_VARS['post']['url'] . "\"}}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer " . $this->CONFIG_VARS['secret_api_Key'] . " ",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new \Exception("Exception  $err");
        } else {
            $json_response = json_decode($response);
            if (isset($json_response->errors) && is_array($json_response->errors) && count($json_response->errors) > 0) {
                throw new \Exception("Error : " . $response . " ");
            }
            if (isset($json_response->object) && $json_response->object == "refund") {
                return $json_response;
            } else {
                throw new \Exception("Error : " . $response . " ");
            }
        }

        return false;
    }

    public function getRefund($refund_id)
    {
        if ($refund_id == null) {
            throw new \InvalidArgumentException("InvalidArgumentException refund_id required");
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.tap.company/v2/refunds/$refund_id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer " . $this->CONFIG_VARS['secret_api_Key'] . " ",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new \Exception("Exception  $err");
        } else {
            $json_response = json_decode($response);
            if (isset($json_response->errors) && is_array($json_response->errors) && count($json_response->errors) > 0) {
                throw new \Exception("Error : " . $json_response->errors[0]->code . " ");
            }
            if (isset($json_response->object) && $json_response->object == "refund") {
                return $json_response;
            } else {
                throw new \Exception("Error : " . $response . " ");
            }
        }

        return false;
    }

    public function refundList($options = [])
    {
        $this->refundsListValidator($options);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.tap.company/v2/refunds/list",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"period\":{\"date\":{\"from\":" . $this->REFUNDS_FILTER['period']['date']['from'] . ",\"to\":" . $this->REFUNDS_FILTER['period']['date']['to'] . "}},\"starting_after\":\"\",\"limit\":" . $this->REFUNDS_FILTER['limit'] . "}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer " . $this->CONFIG_VARS['secret_api_Key'] . " ",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new \Exception("Exception  $err");
        } else {
            $json_response = json_decode($response);
            if (isset($json_response->errors) && is_array($json_response->errors) && count($json_response->errors) > 0) {
                throw new \Exception("Error : " . $json_response->errors[0]->code . " ");
            }
            if (isset($json_response->object) && $json_response->object == "list") {
                return $json_response;
            } else {
                throw new \Exception("Error : " . $response . " ");
            }
        }

        return false;
    }
}