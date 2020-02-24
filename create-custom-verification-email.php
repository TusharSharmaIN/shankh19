<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/user/user.php';

$ses = new SesApi();

$name = 'template-email-verification-prod-0';
$sender = 'no-reply@shankhnaad.org';
$html = '<table
class="heading"
width="100%"
style="border:none;border-spacing:0;"
>
<tr>
    <td style="background:#fff;padding:0px;text-align:center;">
        <img
            src="https://shankhnaad-cdn.s3.ap-south-1.amazonaws.com/shankhnaad.png"
            alt="Shankhnaad\'20"
            height="200px"
        />
    </td>
</tr>
</table>

<table
class="content"
width="100%"
style="border:none;border-spacing:0;letter-spacing:1px;"
>
<tr>
    <td
        style="padding:50px 10px 5px 10px;font-family:sans-serif;font-size:16px"
    >
        This verification email is valid for 24 hours. To resend the
        verification email, after 24 hours, login again on the
        website.
    </td>
</tr>
<tr>
    <td
        style="padding:10px 10px 5px 10px;font-family:sans-serif;font-size:16px"
    >
        Click on the link below to verify your email address:
    </td>
</tr>
</table>';
$subject = 'Verify your email';
$successURL = 'https://shankhnaad.org/login';
$failureURL = 'https://shankhnaad.org/login';

echo $ses->createCustomVerificationEmailTemplate($name, $sender, $subject, $html, $successURL, $failureURL);
