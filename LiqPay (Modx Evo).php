<?php
// лучше проверить какую оплату выбрали
// if ($_POST['payment'] != liqpay) die();

$public_key = 'i8104348****';
$private_key = 'gBb4T3A6sfSvxjCEHsXdVbFFwAt1KuWOmid****';

$amount = $_SESSION['shk_order_price'];
$order_id = $_SESSION['shk_order_id'];
$description = 'Оплата в магазине www';

$data = base64_encode(
          json_encode(
            array('version'     => 3,
                  'public_key'  => $public_key,
                  'private_key' => $private_key,
                  'amount'      => $amount,
                  'currency'    => 'UAH',
                  'description' => $description,
                  'order_id'    => $order_id,
                  'sandbox'     => 0 )
          )
        );
$sig = base64_encode( sha1( $private_key . $data . $private_key, 1) );

echo '
   <form method="POST" action="https://www.liqpay.com/api/checkout"
   accept-charset="utf-8">
     <input type="hidden" name="data" value="'.$data.'" />
     <input type="hidden" name="signature" value="'.$sig.'" />
     <input type="image" src="//static.liqpay.com/buttons/p1ru.radius.png" />
   </form>';
   
// отладка
// echo $_POST['payment'];
?>