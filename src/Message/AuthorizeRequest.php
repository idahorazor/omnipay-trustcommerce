<?php
namespace Omnipay\TrustCommerce\Message;

/**
 * TrustCommerce Authorize Request
 */
class AuthorizeRequest extends AbstractRequest {

	public function getData() {
		$this->validate('amount', 'card');
		$this->getCard()->validate();

		$data = $this->getBaseData();
		$data['action'] = "preauth";
		$data['amount'] = $this->getAmountInteger();

		//add credit card details
		$data['cc'] = $this->getCard()->getNumber();
		$data['exp'] = $this->getCard()->getExpiryDate('my');
		$data['name'] = $this->getCard()->getFirstName() . " " . $this->getCard()->getLastName();
		$data['address1'] = $this->getCard()->getAddress1();
		$data['zip'] = $this->getCard()->getPostcode();
		$data['cvv'] = $this->getCard()->getCvv();

		return $data;
	}
}
?>
