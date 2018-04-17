<?php

// php fly.php|tail -1|php test.php
// Message could not be sent. Mailer Error: SMTP Error: Could not authenticate.

$fp = fopen('php://stdin', 'r');
$input = '';
while (!feof($fp)) {
    $input .= fgets($fp);
}
fclose($fp);
echo $input;
