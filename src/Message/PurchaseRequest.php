<?php
namespace Omnipay\TrustCommerce\Message;

/**
 * PayPal Pro Purchase Request
 */
class PurchaseRequest extends AuthorizeRequest {
	public function getData(){
		$data = parent::getData();
		$data['action'] = 'sale';

		return $data;
	}
}

?>
