<?php
# Include the Sendinblue library\
include_once dirname(__DIR__, 2)."/vendor/autoload.php";
include_once dirname(__DIR__).'/mail/mail_config.php';

class SendMail{
    // Instantiate the client
    private $credentials;
    private $apiInstance;

    function  __construct(){
        $this->credentials = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', API_KEY);
        $this->apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(new GuzzleHttp\Client(),$this->credentials);
    }
    function send_otp($fname, $lname, $email, $otp){
        $full_name = $fname . " " . $lname;
        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail([
            'subject' => 'Verify your Email address!',
            'sender' => ['name' => SENDER_NAME, 'email' => SENDER_EMAIL],
//            'replyTo' => ['name' => REPLY_TO_NAME, 'email' => REPLY_TO_EMAIL],    // Reply to email is not necessary
            'to' => [[ 'name' => $full_name , 'email' => $email]],
            'htmlContent' => '
                <html lang="en">
                    <body>
                        <h2>Hello '. $full_name .'</h2>
                        <div>
                            <p>Thank you for registering with Pixihire. Your OTP is '. $otp .'.</p>
                            <p>Regards,</p>
                            <p>Pixihire Support</p>
                        </div>
                    </body>
                </html>'
        ]);

        try {
            $result = $this->apiInstance->sendTransacEmail($sendSmtpEmail);
            echo "OTP sent successfully!";
        } catch (Exception $e) {
            echo "OTP sending failed!";
        }
    }

}
?>