<?php
namespace Omnipay\TrustCommerce\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
* TrustCommerce Response
*/
class Response extends AbstractResponse {
	
	private $defaultError = "Sorry, there was an error processing your payment. Please try again later.";

	public function isSuccessful() {
		return in_array($this->data['status'], array('approved', 'accepted'));
	}

	public function getMessage() {
		switch($this->data['status']) {
			case "decline":
				return $this->getDeclineMessage();
				break;
			case "baddata":
				return $this->getBaddataMessage();
				break;
			case "error":
				return $this->getErrorMessage();
				break;
			default:
				return $this->defaultError; 
		}
	}

	public function getDeclineMessage() {
		switch($this->getDeclineType()) {
			case "decline":
				return "Insufficient funds on the card";
				break;
			case "avs":
				return "The address verification process failed";
				break;
			case "expiredcard":
				return "The card has expired";
				break;
			case "carderror":
				return "Card number is invalid";
				break;
			default:
				return $this->defaultError;
		}
	}

	public function getBaddataMessage() {
		switch($this->geteError()) {
			case "missingfields": 
				return  $this->getOffenderMessage("missing");
			case "badformat": 
				return $this->getOffenderMessage("invaild format");
				break;
			default:
				return $this->defaultError;
		}
	}

	public function getOffenderMessage($message) {
		$returnMessage = "";
		foreach(explode(",",$this->getOffenders()) as $field) {
			switch($field) {
				case "cc":
					$returnMessage .= "Credit Card number, ";
					break;
				case "exp":
					$returnMessage .= "Expiration date, ";
					break;
				case "cvv":
					$returnMessage .= "CVV, ";
					break;
				case "address1":
					$returnMessage .= "Address Line 1, ";
					break;
				case "zip":
					$returnMessage .= "Zip ,";
					break;
				default: 
					$returnMessage .= "";
			}
		}
		if($returnMessage == "") {
			$returnMessage = $this->defaultError;
		} else {
			$returnMessage = substr(trim($returnMessage),0,-1) . " $message";
		}
		
		return $returnMessage; 
	}

	public function getErrorMessage() {
		return $this->defaultError;
	}

	public function getTransactionId() {
		return $this->data['transid'];
	}

	public function getCode() {
		return $this->data['authcode'];
	}

	public function geteError() {
		return $this->data['error'];
	}

	public function getDeclineType() {
		return $this->data['declinetype'];
	}

	public function getOffenders() {
		return $this->data['offenders'];
	}

	public function getErrorType() {
		return $this->data['errortype'];
	}
}
?>
