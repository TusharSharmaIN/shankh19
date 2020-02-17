<?php
    /**
     * Author: Shubham Singh
     * Email: shubhams.167@gmail.com
     */

    use Aws\Ses\SesClient;
    use Aws\Exception\AwsException;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '/usr/bin/vendor/autoload.php';
    
    class SesApi{
        private $client;

        //Constructor
        public function __construct(){
            require $_SERVER['DOCUMENT_ROOT'] . '/../config/sesconfig.php';
            $this->client = SesClient::factory(array(
                'version' => 'latest',
                'credentials' => [
                    'key'    => $accessKey,
                    'secret' => $secretKey,
                ],
                'region'  => 'us-east-1',
            ));
        }

        public function getClient(){
            return $this->client;
        }

        /**
         * Function to send a custom verification email to recipient with a link to verify the recipient's email id
         * @param $recipient (String): Email address of the recipient
         * @param $template (String): Name of custom verification email template (must be created earlier)
         */
        public function sendCustomVerificationEmail($recipient, $template){
            try {
                $result = $this->client->sendCustomVerificationEmail([
                    'EmailAddress' => $recipient,
                    'TemplateName' => $template,
                ]);
                return true;
            } catch (AwsException $e) {
                //Output error message if fails
                echo $e->getMessage() . "\n";
                return false;
            }
        }

        /**
         * Function to check whether provided email id is verified in SES or not
         * @param $recepient (String): Email address of the user whose email has to be checked for verification in SES
         */
        public function isEmailVerified($recipient){
            try {
                $verificationStatus = $this->client->getIdentityVerificationAttributes([
                    'Identities' => [$recipient],
                ]);
                if(isset($verificationStatus['VerificationAttributes'][$recipient]) && $verificationStatus['VerificationAttributes'][$recipient]['VerificationStatus'] == "Success")
                    return true;
                else
                    return false;
            } catch (AwsException $e) {
                //Output error message if fails
                echo $e->getMessage() . "\n";
                return false;
            }
        }

        /**
         * Function to create a custom verification email template in SES (Use only once to create a template)
         * @param $name (String): Name of the verification email template (for identification of template)
         * @param $sender (String): Email address of the sender of verification email
         * @param $subject (String): Subject of email
         * @param $content (String): Body of email (written in HTML)
         * @param $successURL (String): User will be redirected to this URL if email verification is successful
         * @param $failureURL (String): User will be redirected to this URL if email verification is failed
         */
        public function createCustomVerificationEmailTemplate($name, $sender, $subject, $content, $successURL, $failureURL){
            try {
                $this->client->createCustomVerificationEmailTemplate([
                    'FailureRedirectionURL' => $failureURL,
                    'FromEmailAddress' => $sender,
                    'SuccessRedirectionURL' => $successURL,
                    'TemplateContent' => $content,
                    'TemplateName' => $name,
                    'TemplateSubject' => $subject,
                ]);
                return true;
            } catch (AwsException $e) {
                //Output error message if fails
                echo $e->getMessage() . "\n";
                return false;
            }
        }

        /**
         * Function to send email using SES api
         * @param $sender (String): Email address of the sender of the email
         * @param $recipients (Array of strings): Array of email addresses of recipients
         * @param $subject (String): Subject of email
         * @param $htmlContent (String): Part of body of email written in HTML
         * @param $rawContent (String): Part of body of email written in text format
         */
        public function sendEmail($sender, $recipients, $subject, $htmlContent, $rawContent){
            try {
                $this->client->sendEmail([
                    'Destination' => [
                        'ToAddresses' => $recipients,
                    ],
                    'Message' => [
                        'Body' => [
                            'Html' => [
                                'Charset' => 'utf-8',
                                'Data' => $htmlContent,
                            ],
                            'Text' => [
                                'Charset' => 'utf-8',
                                'Data' => $rawContent,
                            ],
                        ],
                        'Subject' => [
                            'Charset' => 'utf-8',
                            'Data' => $subject,
                        ],
                    ],
                    'Source' => $sender,
                ]);
                return true;
            }
            catch (AwsException $e) {
                //Output error message if fails
                echo $e->getMessage() . "\n";
                return false;
            }
        }

        /**
         * Function to send email using PHPMailer
         * @param $senderEmail (String): Email address of the sender of the email
         * @param $senderName (String): Name of the sender of the email
         * @param $recipientEmail (Array of strings): Array of email addresses of recipients
         * @param $subject (String): Subject of email
         * @param $htmlContent (String): Part of body of email written in HTML
         * @param $rawContent (String): Part of body of email written in text format
         */
        public function sendEmailUsingPHPMailer($senderEmail, $senderName, $recipientEmail, $subject, $htmlContent, $rawContent){
            // Include dependency
            require $_SERVER['DOCUMENT_ROOT'] . '/../config/smtpconfig.php';

            $host = 'email-smtp.us-east-1.amazonaws.com';
            $port = 587;
            $mail = new PHPMailer(true);
            try {
                // Specify the SMTP settings.
                $mail->isSMTP();
                $mail->setFrom($senderEmail, $senderName);
                $mail->Username   = $username;// SMTP username from smtpconfig.php
                $mail->Password   = $password;// SMTP password from smtpconfig.php
                $mail->Host       = $host;
                $mail->Port       = $port;
                $mail->SMTPAuth   = true;
                $mail->SMTPSecure = 'tls';
                // Specify the message recipients.
                $mail->addAddress($recipientEmail);
                // Specify the content of the message.
                $mail->isHTML(true);
                $mail->Subject    = $subject;
                $mail->Body       = $htmlContent;
                $mail->AltBody    = $rawContent;
                $mail->Send();
                return true;
            } catch (phpmailerException $e) {
                echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
                return false;
            } catch (Exception $e) {
                echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
                return false;
            }
        }
    }
?>