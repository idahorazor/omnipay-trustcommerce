<?php
namespace Omnipay\TrustCommerce\Message;

/**
 * TrustCommerce Capture Request
 */
class CaptureRequest extends AbstractRequest {
	public function getData() {
		$data = $this->getBaseData();
		$data['action'] = 'postauth';
		$data['amount'] = $this->getAmountInteger();
		$data['transid'] = $this->getTransactionReference();

		return $data;
	}
}
?>
