<?php
$options = [
    'cost' => 12,
];
echo password_hash("prova1234", PASSWORD_BCRYPT, $options);
?>