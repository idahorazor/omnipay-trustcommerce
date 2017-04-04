<?php
namespace Omnipay\TrustCommerce\Message;

/**
 * TrustCommerce Refund Request
 */
class RefundRequest extends AbstractRequest {
	public function getData() {
		$data = $this->getBaseData();
		$data['amount'] = $this->getAmountInteger();
		$data['name'] = $this->getCard()->getFirstName() . " " . $this->getCard()->getLastName();
		if($this->getTransactionReference() != "") {
			$data['action'] = 'credit';
			$data['transid'] = $this->getTransactionReference();
		} else {
			$data['action'] = 'credit2';
			$data['cc'] = $this->getCard()->getNumber();
			$data['exp'] = $this->getCard()->getExpiryDate('my');
		}

		return $data;
	}
}
?>
