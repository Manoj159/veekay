<?php
    //LIVE
    $action = "https://secure.payu.in/_payment";
    $key = "bcLRRh";
    $salt = "lL4ctjdmp9kEJXoIjyfzIfln9d37Z2rT";

    //TEST
    /*$action = "https://test.payu.in/_payment";
    $key = "oZ7oo9";
    $salt = "UkojH5TS";*/
?>
<html>
<body>
<form action="<?= $action; ?>" method='post' id="pay_form">

<input type="hidden" name="key" value="<?= $key; ?>" />
<input type="hidden" name="txnid" value="<?= $unique_order_id; ?>" />
<input type="hidden" name="productinfo" value="<?= $productinfo; ?>" />
<input type="hidden" name="amount" value="<?= $amount; ?>" />
<input type="hidden" name="email" value="<?= $email; ?>" />
<input type="hidden" name="firstname" value="<?= $firstname; ?>" />
<input type="hidden" name="lastname" value="" />
<input type="hidden" name="surl" value="<?= $surl; ?>" />
<input type="hidden" name="furl" value="<?= $furl; ?>" />
<input type="hidden" name="phone" value="<?= $phone; ?>" />
<?php
    $hash = "$key|$unique_order_id|$amount|$productinfo|$firstname|$email|||||||||||$salt";
    $hashed = hash("sha512", $hash);
?>
<input type="hidden" name="hash" value="<?= $hashed; ?>" />
<!--<input type="submit" value="submit"/>-->
</form>
<script>
    document.getElementById("pay_form").submit();
</script>
</body>
</html>