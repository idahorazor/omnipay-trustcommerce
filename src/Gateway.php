<?php
namespace Omnipay\TrustCommerce;

use Omnipay\Common\AbstractGateway;
/**
* TrustCommerce Class
*/
class Gateway extends AbstractGateway {
	public function getName() {
		return 'TrustCommerce';
	}

	public function getDefaultParameters() {
		return array(
			'custid' => '',
			'password' => '',
			'avs' => 'n',
			'demo' => 'n'
		);
	}

	public function setDemo($value) {
		return $this->setParameter('demo', $value);
	}

	public function getDemo() {
		return $this->getParameter('demo');
	}

	public function setAvs($value) {
		return $this->setParameter('avs', $value);
	}

	public function getAvs() {
		return $this->getParameter('avs');
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

	public function getPassword($value) {
		return $this->getParameter('password');
	}

	public function authorize(array $parameters = array()) {
		return $this->createRequest('\Omnipay\TrustCommerce\Message\AuthorizeRequest', $parameters);
	}

	public function purchase(array $parameters = array()) {
		return $this->createRequest('\Omnipay\TrustCommerce\Message\PurchaseRequest', $parameters);
	}

	public function capture(array $parameters = array())  {
		return $this->createRequest('\Omnipay\TrustCommerce\Message\CaptureRequest', $parameters);
	}

	public function refund(array $parameters = array()) {
		return $this->createRequest('\Omnipay\TrustCommerce\Message\RefundRequest', $parameters);
	}
}
?>
