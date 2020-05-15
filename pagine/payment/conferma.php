<?php 
    //valori login da cambiare
    $my_username='mp';
    $loggedin=true;
    $email="emacapecchi@gmail.com";
    $order_num=23;?>
<?php
$to_email = $email;
$subject = "Order Confirmation #".$order_num;
$body = "Hi ".$my_username.",
Your order #".$order_num." has been placed.
Did you know that you may check all your orders by visiting your profile page?
Thank you for shopping with us,
The Entertainment Factory Inc. Team.
";
$headers = "From: katewosk@gmail.com";
 
if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}?>