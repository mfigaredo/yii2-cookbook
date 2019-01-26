<?php
namespace app\controllers;
use app\cart\ShoppingCart;
use app\models\CartAddForm;
use Yii;
use yii\data\ArrayDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;

class CartController extends Controller
{
	private $cart;
	public function __construct($id, $module, ShoppingCart $cart, $config = [])
	{
		$this->cart = $cart;
		parent::__construct($id, $module, $config);
	}

	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
					'clear' => ['post'],
				],
			],
		];
	}

	public function actionIndex()
	{
		$dataProvider = new ArrayDataProvider([
			'allModels' => $this->cart->getItems(),
			// 'allModels' => [],
		]);
		
	

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'items' => $this->cart->getItems(),
		]);
	}

	public function actionAdd()
	{
		$form = new CartAddForm();

		if( $form->load(Yii::$app->request->post()) && $form->validate() ) {
			$this->cart->add($form->productId, $form->amount);
			return $this->redirect(['index']);
		}

		return $this->render('add', [
			'model' => $form,
		]);
	}

	public function actionDelete($id)
	{
		$this->cart->remove($id);
		return $this->redirect(['index']);
	}


	public function actionPostear($param1 = null)
	{
		echo \yii\helpers\VarDumper::dump($param1);
	}

	public function actionClear()
	{
		$this->cart->clear();
		Yii::$app->session->setFlash('cartCleared');
		return $this->redirect(['index']);
	}
}
