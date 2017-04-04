<?php
namespace Omnipay\TrustCommerce\Message;

/**
 * PayPal Pro Purchase Request
 */
class PurchaseRequest extends AuthorizeRequest {
	public function getData(){
		$data = parent::getData();
		$data['name'] = $this->getCard()->getFirstName() . " " . $this->getCard()->getLastName();
		$data['action'] = 'sale';

		return $data;
	}
}

?>
