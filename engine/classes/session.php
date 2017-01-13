<?php
class Session{

	public function __construct($sid=null) {
		session_start($sid);
	}

	public function set($id) {		session_name($id);
	}

	public function kill() {
		session_destroy();
	}

	public function id() {
		return	session_id();
	}

	function setVariable($variableName, $value) {
		$_SESSION[$variableName] = $value;
	}

	function getVariable($variableName) {
		if (isset($_SESSION[$variableName])) {
			return $_SESSION[$variableName];
		}
	}

	function removeVariable($variableName) {		if (isset($_SESSION[$variableName])) {
			unset($_SESSION[$variableName]);
			return TRUE;
		}
	}

	function set_notice($text,$type) {		$this->setVariable($type.'_notice',$this->getVariable($type.'_notice').'<li>'.$text.'</li>');
	}

	function get_notice() {		if ($this->getVariable(ERROR.'_notice')) { 			$notice = '<div class="err_notice">'.$this->getVariable(ERROR.'_notice').'</div>';
   			$this->setVariable(ERROR.'_notice','');
   		}
		if ($this->getVariable(OK.'_notice')) {
 			$notice .= '<div class="ok_notice">'.$this->getVariable(OK.'_notice').'</div>';
   			$this->setVariable(OK.'_notice','');
   		}
   		return $notice;
	}
}
?>