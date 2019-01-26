<?php 
namespace app\controllers;

use yii\web\Controller;
use app\models\EmailForm;
use Yii;

class EmailController extends Controller
{
	public function actions()
	{
		return [
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				//'fontFile' => '@webroot/fonts/GIGI.ttf',
				// 'fixedVerifyCode' => 'Test',
				'foreColor' => 0xCC3388,
			],
			'mathcaptcha' => [
				'class' => 'app\components\MathCaptchaAction',
				//'fontFile' => '@webroot/fonts/GIGI.ttf',
				// 'fixedVerifyCode' => '5',
				// 'foreColor' => 0xCC3388,
			],
		];
	}

	public function actionIndex($math = false)
	{
		$success = false;
		$model = new EmailForm();
		$model->math = $math;
		if( $model->load(Yii::$app->request->post()) && $model->validate()) {
			Yii::$app->session->setFlash('success','Success!');
		}
		return $this->render('index',[
			'model' => $model,
			'success' => $success,
		]);
	}
}

 ?>