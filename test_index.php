
    <?php
    $to = '"Sumit" <sumit@iitj.ac.in>';
    $subject = 'PHP mail tester';
    $message = 'This message was sent via PHP!' . PHP_EOL .
               'Some other message text.' . PHP_EOL . PHP_EOL .
               '-- signature' . PHP_EOL;
    $headers = 'From: "TxtConnect" <admin@txtconnect.in>' . PHP_EOL .
               'Reply-To: reply@txtconnect.in' . PHP_EOL .
               'Cc: "CC Name" <cc@txtconnect.in>' . PHP_EOL .
               'X-Mailer: PHP/' . phpversion();
              
    if (mail($to, $subject, $message, $headers)) {
      echo 'mail() Success!';
    }
    else {
      echo 'mail() Failed!';
    }
    ?>

