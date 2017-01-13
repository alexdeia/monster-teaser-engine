<html>
<body>
<form id="pay" name="pay" method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp">
<input type="hidden" name="LMI_PAYMENT_DESC" value="Пополнение баланса">
<input type="hidden" name="LMI_PAYMENT_AMOUNT" value="<TVAR>wm_order_sum</TVAR>">
<input type="hidden" name="LMI_PAYMENT_NO" value="<TVAR>wm_order_id</TVAR>">
<input type="hidden" name="LMI_PAYEE_PURSE" value="<SYS>wmz</SYS>">
<input type="hidden" name="LMI_MODE" value="1">
<input type="hidden" name="LMI_RESULT_URL" value="<SYS>url</SYS>wm.result.php">
<input type="hidden" name="LMI_SUCCESS_URL" value="<SYS>url</SYS>account/funds/sucessfull.html">
<input type="hidden" name="LMI_SUCCESS_METHOD" value="2">
<input type="hidden" name="LMI_FAIL_URL" value="<SYS>url</SYS>account/funds/failed.html">
<input type="hidden" name="LMI_FAIL_METHOD" value="2">
Вы подтверждаете оплату <strong><TVAR>wm_order_sum</TVAR> WMZ</strong> через систему WebMoney?
	<input type="submit" value="Да" class="button">
	<input type="button" value="Нет" onClick="document.location.href='/account/funds/index.html'" class="button">
</form>
</body>
</html>