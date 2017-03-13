<?php
/**
 * TrustCommerce Abstract Request
 */
namespace Omnipay\TrustCommerce\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest {

	protected function getBaseData(){
		$data = array();
		$data['custid'] = $this->getCustid();
		$data['password'] = $this->getPassword();
		$data['demo'] = $this->getDemo();
		$data['avs'] = $this->getAvs();

		return $data;
	}

	protected function curl_tc_send($fields_to_send) {
                $post_string = '';
                $use_amp = 0;
                foreach ($fields_to_send as $key => $value)
                {
                        if ($use_amp) $post_string .= '&';
                        $post_string .= "$key=$value";
                        $use_amp = 1;
                }
                $curl_object = curl_init('https://vault.trustcommerce.com/trans/');
                curl_setopt($curl_object, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl_object, CURLOPT_POST, 1);
                curl_setopt($curl_object, CURLOPT_POSTFIELDS, $post_string);

                $unformatted_results = curl_exec($curl_object);
                curl_close($curl_object);
                $result_array = explode("\n", $unformatted_results);
                $tclink_results = array();
                foreach ($result_array as $key => $value)
                {
                        $key_pair = explode('=', $value);
                        if (count($key_pair) == 2)
                        {
                                $tclink_results[$key_pair[0]] = $key_pair[1];
                        }
                }
                return $tclink_results;
        }

	public function setDemo($value) {
		return $this->setParameter('demo', $value);
	}

	public function getDemo() {
		return $this->getParameter('demo');
	}

	public function setCustid($value) {
		return $this->setParameter('custid',$value);
	}

	public function getCustid() {
		return $this->getParameter('custid');
	}

	public function setPassword($value) {
		return $this->setParameter('password',$value);
	}

	public function getPassword() {
		return $this->getParameter('password');
	}

	public function setAvs($data) {
		return $this->setParameter('avs',$data);
	}

	public function getAvs() {
		return $this->getParameter('avs');
	}

	public function sendData($data) {
		$result = $this->curl_tc_send($data);
		return $this->createResponse($result);
	}

	protected function createResponse($data){
		return $this->response = new Response($this, $data);
	}
}
?>
