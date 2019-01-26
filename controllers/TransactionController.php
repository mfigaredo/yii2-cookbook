<?php 
namespace app\controllers;

use app\models\Account;
use Yii;
use yii\db\Exception;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\web\Controller;

class TransactionController extends Controller
{
	public function actionSuccess()
	{
		$transaction = Yii::$app->db->beginTransaction();

		try {
			$recipient = Account::findOne(1);
			$sender = Account::findOne(2);
			$transferAmount = 177;
			$recipient->balance += $transferAmount;
			$sender->balance -= $transferAmount;

			if($sender->save() && $recipient->save()) {
				$transaction->commit();
				return $this->renderContent(Html::tag('h1','Money Transfer was successfully.'));
			} else {
				$transaction->rollBack();
				throw new Exception('Money Transfer failed: ' . VarDumper::dumpAsString($sender->getErrors()) . VarDumper::dumpAsString($recipient->getErrors()));
			}
		} catch( Exception $e ) {
			$transaction->rollBack();
			throw $e;
		}
	}

	public function actionError()
	{
		$transaction = Yii::$app->db->beginTransaction();

		try {

			$recipient = Account::findOne(1);
			$sender = Account::findOne(3);

			$transferAmount = 1000;
			$recipient->balance += $transferAmount;
			$sender->balance -= $transferAmount;

			if($sender->save() && $recipient->save()) {
				$transaction->commit();
				return $this->renderContent(Html::tag('h1','Money Transfer was successfully.'));
			} else {
				$transaction->rollBack();
				throw new Exception('Money Transfer failed: ' . VarDumper::dumpAsString($sender->getErrors()) . VarDumper::dumpAsString($recipient->getErrors()));
			}
		} catch( Exception $e ) {
			$transaction->rollBack();
			throw $e;
		}
	}
}

 ?>