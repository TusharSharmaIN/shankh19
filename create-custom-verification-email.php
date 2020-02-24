<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/user/user.php';

$ses = new SesApi();

$name = 'template-email-verification-prod-0';
$sender = 'no-reply@shankhnaad.org';
$html = '<table class="heading" width="100%" cellpadding="0" border="0" cellspacing="0" style="border-spacing:0;"><tr><td align="center" style="background:#fff;color:#fff;padding:0px;text-transform:uppercase;font-family:"Poppins",sans-serif;letter-spacing:10px;font-weight:100;"><a href="https://shankhnaad.org" target="_blank"><img src="https://shankhnaad-cdn.s3.ap-south-1.amazonaws.com/shankhnaad.png" alt="Shankhnaad\'20" height="200px"/></a></td></tr></table>
         <table class="content" width="100%" cellpadding="0" border="0" cellspacing="0" style="border-spacing:0;letter-spacing:1px;"><tr><td align="left" style="padding:50px 10px 5px 10px;font-family:sans-serif;font-size:16px">This verification email is valid for 24 hours. To resend the verification email after 24 hours login <a href="https://shankhnaad.org/login" target="_blank">here</a>.</td></tr><tr><td align="left" style="padding:10px 10px 5px 10px;font-family:sans-serif;font-size:16px">Click on the link below to verify your email address:</td></tr></table>';
$subject = 'Verify your email';
$successURL = 'https://shankhnaad.org/login';
$failureURL = 'https://shankhnaad.org/login';

echo $ses->createCustomVerificationEmailTemplate($name, $sender, $subject, $html, $successURL, $failureURL);
