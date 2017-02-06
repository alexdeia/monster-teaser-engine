<?php
/*
=============================================================
=============================================================
MTE - Monster Teaser Engine
Author: unknown
Refactoring: Alexey Klykov
Contacts: http://chronodev.ru
E-mail: alexk.deia@gmail.com
=============================================================
=============================================================
*/

class WMI {	public $wmsign_dir = "/home/inf.loc/wmsign/";
	public $addr = array(
		1 =>'https://w3s.webmoney.ru/asp/XMLInvoice.asp',
		2 => 'https://w3s.webmoney.ru/asp/XMLTrans.asp',
		3 => 'https://w3s.webmoney.ru/asp/XMLOperations.asp',
		4 => 'https://w3s.webmoney.ru/asp/XMLOutInvoices.asp',
		5 => 'https://w3s.webmoney.ru/asp/XMLFinishProtect.asp',
		6 => 'https://w3s.webmoney.ru/asp/XMLSendMsg.asp',
		7 => 'https://w3s.webmoney.ru/asp/XMLClassicAuth.asp',
		8 => 'https://w3s.webmoney.ru/asp/XMLFindWMPurse.asp',
		9 => 'https://w3s.webmoney.ru/asp/XMLPurses.asp',
		10 => 'https://w3s.webmoney.ru/asp/XMLInInvoices.asp',
		11 => 'https://passport.webmoney.ru/asp/XMLGetWMPassport.asp',
	);

	public function __construct() {		global $sys;
		$this->sys = $sys;
	}

	public function get_sign($inStr) {
		chdir($this->wmsign_dir);
		$descriptorspec = array( 0 => array("pipe", "r"), 1 => array("pipe", "w"), 2 => array("pipe", "r") );
		$process = proc_open($this->wmsign_dir.'wmsigner', $descriptorspec, $pipes);
		fwrite($pipes[0], "$inStr\004\r\n");
		fclose($pipes[0]);
		$s = fgets($pipes[1], 133);
		fclose($pipes[1]);
		$return_value = proc_close($process);
		return $s;
	}

	public function x2 ($reqn,$tranid,$purse,$rpurse,$amount,$period,$pcode,$desc,$wminvid) {
		$desc = trim($desc);
		$pcode = trim($pcode);
		$amount = floatval($amount);
		$rsign = $this->get_sign($reqn.$tranid.$purse.$rpurse.$amount.$period.$pcode.$desc.$wminvid);
		$pcode = htmlspecialchars($pcode, ENT_QUOTES);
		$desc = htmlspecialchars($desc, ENT_QUOTES);
		$pcode = iconv("CP1251", "UTF-8", $pcode);
		$desc = iconv("CP1251", "UTF-8", $desc);
		$xml = " <w3s.request>
			<reqn>$reqn</reqn>
			<wmid>".$this->sys['wmid']."</wmid>
			<sign>$rsign</sign>
			<trans>
				<tranid>$tranid</tranid>
				<pursesrc>".$this->sys['wmz']."</pursesrc>
				<pursedest>".$this->sys['wmz']."</pursedest>
				<amount>$amount</amount>
				<period>$period</period>
				<pcode>$pcode</pcode>
				<desc>$desc</desc>
				<wminvid>$wminvid</wminvid>
			</trans>
		</w3s.request>";
		$resxml=$this->send($this->addr[2], $xml);
		// echo $resxml;
		$xmlres = simplexml_load_string($resxml);
		if(!$xmlres) {
			$result['retval']=1000;
			$result['retdesc']="Не получен XML-ответ";
			return $result;
		}
		$result['retval']=strval($xmlres->retval);
		$result['retdesc']=iconv("UTF-8", "CP1251", strval($xmlres->retdesc));
		$result['date']=strval($xmlres->operation->datecrt);
		return $result;
	}

	public function send($address, $xml) {
		$ch = curl_init($address);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		curl_setopt($ch, CURLOPT_CAINFO, $this->wmsign_dir.'WebMoneyCA.crt');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
		$result=curl_exec($ch);
		return $result;
	}
}
require_once(CONFIG_PATH . 'config.php');
$wm = new WMI();
$tranid="1";
$purse="кошелек_отправитель";
$rpurse="кошелек_получатель";
$amount="0.01";
$period="0";
$pcode="";
$desc="тестовый товар & тестовая услуга";
$wminvid="0";
$r = $wm->x2(2,$tranid,$purse,$rpurse,$amount,$period,$pcode,$desc,$wminvid);
echo "Результат (0 - успешно) - ".$r['retval']."<br>";
echo "Расшифровка - ".$r['retdesc']."<br>";
echo "Дата и время - ".$r['date']."<br>";
