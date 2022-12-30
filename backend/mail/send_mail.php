<?php
# Include the Sendinblue library\
require_once("../../vendor/autoload.php");
include_once 'mail_config.php';

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
            'subject' => 'from the PHP SDK!',
            'sender' => ['name' => SENDER_NAME, 'email' => SENDER_EMAIL],
//            'replyTo' => ['name' => REPLY_TO_NAME, 'email' => REPLY_TO_EMAIL],    // Reply to email is not necessary
            'to' => [[ 'name' => $full_name , 'email' => $email]],
            'params' => ['fname' => $fname,'name' => $full_name, 'otp' => $otp],
            'htmlContent' => '
                <html lang="en">
                    <body>
                        <h2>Hello {{param.fname}}</h2>
                        <div>
                            <p>Thank you for registering with Pixihire. Your OTP is {{param.otp}}.</p>
                            <p>Regards,</p>
                            <p>Pixihire Support</p>
                        </div>
                    </body>
                </html>'
        ]);

        try {
            $result = $this->apiInstance->sendTransacEmail($sendSmtpEmail);
            print_r($result);
        } catch (Exception $e) {
            echo $e->getMessage(),PHP_EOL;
        }
    }

}
?>