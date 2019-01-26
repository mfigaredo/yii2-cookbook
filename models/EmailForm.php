<?php 
namespace app\models;

use yii\base\Model;
use yii\captcha\Captcha;

class EmailForm extends Model 
{
	public $email;
	public $verifyCode;
	public $math;

	public function rules()
	{
		return [
			['email', 'email'],
			['email', 'required'],
			['verifyCode', 'captcha', 
				'skipOnEmpty' => !Captcha::checkRequirements(), 
				'captchaAction' => $this->math ? 'email/mathcaptcha' : 'email/captcha',
			],
		];
	}


    public function attributeLabels()
    {
        return [
        	'email' => 'Email Address',
            'verifyCode' => 'Verification Code',
        ];
    }
}

?>
