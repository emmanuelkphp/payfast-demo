<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<form action="https://sandbox.payfast.co.za/eng/process" method="post">
	   <input type="hidden" name="merchant_id" value="10031315">
	   <input type="hidden" name="merchant_key" value="sbijrnrrkonrs">
	   <input type="hidden" name="amount" value="100.00">
	   <input type="hidden" name="item_name" value="Test Product">
	   <input type="hidden" name="return_url" value="http://localhost/payfast-demo/public/success">
	   <input type="hidden" name="payment_method" value="cc">
	   <input type="submit">
	</form>
</body>
</html>