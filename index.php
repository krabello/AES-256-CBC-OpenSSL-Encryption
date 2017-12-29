<?php

include 'Encryption.php';

$key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';

$creditCardNumber = '7111111111111111';

$encrypted = Encryption::encrypt($creditCardNumber, $key);

$decrypted = Encryption::decrypt($encrypted, $key);


var_dump($encrypted);

echo 'credit Card Number: '. $creditCardNumber . PHP_EOL;
echo 'encrypted Card Number: ' . $encrypted . PHP_EOL;
echo 'decrypted Card Number: ' . $decrypted . PHP_EOL;


