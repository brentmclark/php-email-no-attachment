<?php
	class Simple_Email {
	   
		private $_to;
		private $_from;
		private $_reply_to;
		private $_subject;
		private $_message;
		private $_headers;
		private $_success;
	   
		//Constructors like this make me wish PHP supported polymorphism...
		function __construct($to, $from, $subject, $message, $reply_to = null, $headers = '') {
			$this->_to = $to;
			$this->_from = $from;
			$this->_reply_to = $reply_to !== null ? $reply_to : $this->_from; //Just because I'm a nice guy I'll set this for you
			$this->_subject = $subject;
			$this->_message = $message;
			$this->_headers = $headers;
			$this->_send();
		}
	   
		private function _send() {
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'To: ' . $this->_to . "\r\n";
			$headers .= 'From: ' . $this->_from . "\r\n";
			$headers .= 'Reply-To: ' . $this->_reply_to . "\r\n";
			$headers .= $this->_headers;
		   
			$this->_success = mail($this->_to, $this->_subject, $this->_message, $headers);
			return $this->_success;
		}
	   
		public function getSuccess() {
			return $this->_success;
		}
	}
?>