<?php
/*
=============================================================
=============================================================
MTE - Monster Teaser Engine
Author: unknown
Refactoring: Alexey Klykov
Contacts: http://e-dev.ru
E-mail: alexk.deia@gmail.com
=============================================================
=============================================================
*/

class Template {

	public $letters = array('a','b','c','d','e','f','g','h','i','j','k','l','n','o','p','q','r','s','t','u','v','w','x','y','z');
	public $symbols = array('!','@','#','$','%','^','&','*','(',')','_','-','=','+');
  public $monthes = array("заменить", "Января","Февраля","Марта","Апреля","Мая","Июня","Июля","Августа","Сентября","Октября","Ноября","Декабря");
	public $monthes2 = array("Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь");
	public $week_days = array('заменить','Понедельник','Вторник','Среда','Четверг','Пятница','Суббота','Воскресенье');

	public function __construct() {		global $sys,$user,$session;
		$this->user = $user;
		$this->session = $session;
		$this->sys = &$sys;
	}
    function get_html_entites($var) {
    	$text = $this->getVariable($var);
		return html_entity_decode($text,ENT_QUOTES,'cp1251');
    }

    function parse_simple_BBC($txt) {
		$txt = str_ireplace("[b]","<b>",$txt);
		$txt = str_ireplace("[/b]","</b>",$txt);
		$txt = str_ireplace("[i]","<i>",$txt);
		$txt = str_ireplace("[/i]","</i>",$txt);
		$txt = str_ireplace("[u]","<u>",$txt);
		$txt = str_ireplace("[/u]","</u>",$txt);
		$txt = str_ireplace("[center]","<center>",$txt);
		$txt = str_ireplace("[/center]","</center>",$txt);
		$txt = str_ireplace("\n","<br>",$txt);
		return $txt;
    }
	function out($name,$noparse=FALSE) {
		$file = 'templates/'.$this->sys['template'].'/'.$name.'.tpl';
		if (!file_exists($file)) {
			trigger_error('Шаблон <b>'.$file.'</b> не найден',E_USER_NOTICE);
			return FALSE;
		}
		$fp = fopen($file,RO);
		$content = fread($fp,filesize($file)+1);
		fclose($fp);
		if ($noparse) {
			$tpl = $content;
		}else{
			$tpl = $this->parse($content);
		}
		return $tpl;
	}

	function parse($tpl) {
		preg_match_all("|<INC>(.*)</INC>|Uims", $tpl, $regs);
		$vars = $regs[1];
		foreach($vars as $key => $value) {
			$replace = $this->out($value);
			$search = '<INC>'.$value.'</INC>';
			$tpl = str_replace($search,$replace,$tpl);
			if (!$replace) {
				$tpl = str_replace($search,'',$tpl);
			}
		}

		preg_match_all("|<OVAR>(.*)</OVAR>|Uims", $tpl, $regs);
		$vars = $regs[1];
		foreach($vars as $key => $value) {
			$search = '<OVAR>'.$value.'</OVAR>';
			if ($this->getVariable($value)) {
				$replace = $this->getVariable($value);
			}else{
				$replace = '';
			}
			$tpl = str_replace($search,$replace,$tpl);
		}

		preg_match_all("|<CVAR>(.*)</CVAR>|Uims", $tpl, $regs);
		$vars = $regs[1];
		foreach($vars as $key => $value) {
			$search = '<CVAR>'.$value.'</CVAR>';
			if (isset($this->$value)) {
				$replace = $this->$value;
			}else{
				$replace = '';
			}
			$tpl = str_replace($search,$replace,$tpl);
		}

		preg_match_all("|<TVAR>(.*)</TVAR>|Uims", $tpl, $regs);
		$vars = $regs[1];
		foreach($vars as $key => $value) {
			$search = '<TVAR>'.$value.'</TVAR>';
			if (isset($this->vars[$value])) {
				$replace = $this->vars[$value];
			}else{
				$replace = '';
			}
			$tpl = str_replace($search,$replace,$tpl);
		}

		preg_match_all("|<SYS>(.*)</SYS>|Uims", $tpl, $regs);
		$vars = $regs[1];
		foreach($vars as $key => $value) {
			$search = '<SYS>'.$value.'</SYS>';
			if (isset($this->sys[$value])) {
				$replace = $this->sys[$value];
			}else{
				$replace = '';
			}
			$tpl = str_replace($search,$replace,$tpl);
		}

		preg_match_all("|<REQ>(.*)</REQ>|Uims", $tpl, $regs);
		$vars = $regs[1];
		foreach($vars as $key => $value) {
			$search = '<REQ>'.$value.'</REQ>';
			if (isset($_REQUEST[$value])) {
				$replace = $_REQUEST[$value];
		          }else{
		          	$replace = '';
			}
			$tpl = str_replace($search,$replace,$tpl);
		}

		preg_match_all("|<FUNC>(.*)</FUNC>|Uims", $tpl, $regs);
		$vars = $regs[1];
		foreach($vars as $key => $value) {
			$search = '<FUNC>'.$value.'</FUNC>';
			preg_match("|<FUNC>(.*)\{|",$search,$func);
			$value = str_replace("\n","",$value);
			$value = str_replace("\r","",$value);
			preg_match("|{(.*)}|",$value,$args);
			$eval_str = '$replace = call_user_func(array($this, $func[1])';
			if (strlen($args[1]) > 0) {
				$a = explode(",",$args[1]);
				foreach($a as $key => $val) {
			       	$eval_str .= ',$a['.$key.']';
				}
			}
			$eval_str .= ');';
			eval($eval_str);
			$tpl = str_replace($search,$replace,$tpl);
		}

		preg_match_all("|<CFUNC>(.*)</CFUNC>|Uims",$tpl,$regs);
		$vars = $regs[1];
		foreach($vars as $key => $value) {
			$search = "<CFUNC>".$value."</CFUNC>";
			preg_match("|<CFUNC>(.*)::|",$search,$class);
			$value = str_replace("\n","",$value);
			$value = str_replace("\r","",$value);
			preg_match("|::(.*)\{|",$search,$func);
			preg_match("|{(.*)}|",$search,$args);
			$c = trim($class[1]);
			if (get_class($this->$c)) {
				$eval_str = '$replace = call_user_func(array($this->'.$c.',$func[1])';
				$a = explode(",",$args[1]);
				foreach($a as $key => $val) {
		 		         	$eval_str .= ',$a['.$key.']';
				}
				$eval_str .= ');';
				echo $eval;
				eval($eval_str);
			}else{
				$replace = '';
			}
			$tpl = str_replace($search,$replace,$tpl);
		}

		preg_match_all("|(<IF(.*)>(.*)</IF>)|Uims", $tpl, $regs);
		$construction = $regs[1];
		$expression = $regs[2];
		$results = $regs[3];
		$i = 0;
		foreach($regs[1] as $key => $val) {
			$exp = $expression[$i];
			$res = $results[$i];
			$con = $construction[$i];
			if (stristr($res,'<ELSE>')) {
				list($if,$else) = explode('<ELSE>',$res);
			}else{
				$if = $res;
			}
			$e = "if (".$exp.") {
				\$out = '".$if."';
			";
			if ($else) {
				$e .= "}else{
					\$out = '".$else."';";
			}
			$e .= "}";
			$i++;
			eval($e);
			$tpl = str_ireplace($con,$out,$tpl);
		}
		return $tpl;
	}

	function get_left_time($t) {
		$minutes = ceil($t/60);
		$hours = floor($minutes/60);
		$seconds = $t;
		if ($hours > 0) {
			$str = $hours.' ч.';
			if (($hours*60) < $minutes) {
				$str .= '&nbsp;'.($minutes-($hours*60)).'мин.';
			}
		}else{
			$str = $minutes.' мин.';
		}
		return $str;
	}

	function get_select_form($name,$data,$select=NULL,$id=NULL) {
		$str = FALSE;
		if (count($data) > 0) {
			$str = '<select name="'.$name.'"';
			if ($id) {
				$str .= ' id="'.$id.'"';
			}
			$str .= '>';
			foreach($data as $key => $val) {
				$str .= '<option value="'.$key.'"';
				if ($select == $key) {
					$str .= ' selected';
				}
				$str .= '>'.$val.'</option>';
			}
			$str .= '</select>';
		}
		return $str;
	}

	public function set($name,$value) {
		$this->vars[$name] = $value;
	}

	public function get_years_opts($s=0,$from=2008,$to=0) {		if (!$to) {			$to = date('Y')+1;
		}		for($i=$from;$i<$to;$i++) {			$str .= '<option value="'.$i.'"';
			if ($s == $i) {				$str .= ' selected';
			}
			$str .= '>'.$i.'</option>';
		}
		return $str;
	}

	public function get_monthes_opts($s=0) {		foreach($this->monthes2 as $key => $val) {			$str .= '<option value="'.($key+1).'"';
			if ($s == ($key+1)) {
				$str .= ' selected';
			}
			$str .= '>'.$val.'</option>';
		}
		return $str;
	}

	public function get_days_opts($s=0) {
		for($i=1;$i<32;$i++) {
			$str .= '<option value="'.$i.'"';
			if ($s == $i) {
				$str .= ' selected';
			}
			$str .= '>'.$i.'</option>';
		}
		return $str;
	}
}
?>
