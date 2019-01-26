<?php 
namespace app\controllers;
use yii\web\Controller;
use app\models\Car;
use app\models\FamilyCar;
use app\models\SportCar;
use Yii;
use yii\helpers\Html;
use yii\helpers\VarDumper;

class TableInheritanceController extends Controller
{

	protected static function showCar(Car $car)
	{
		echo Html::tag('p', '[' . get_class($car) . ']: <strong>' . $car->name . '</strong> of type <strong>' . $car->type . '</strong>');
	}

	public function actionIndex()
	{
		echo Html::tag('h2','All Cars');
		$cars = Car::find()->all();
		// echo Html::tag('pre',VarDumper::dumpAsString($cars,10,1));

		foreach( $cars as $car ) {
			// Each car can be of class Car, SportCar or FamilyCar
			// echo get_class($car) . ' ' . $car->name . '<br/>';
			$this::showCar($car);
		}

		echo Html::tag('h2','Family Cars');
		$familyCars = FamilyCar::find()->all();
		foreach( $familyCars as $car ) {
			// Each car should be FamilyCar
			// echo get_class($car) . ' ' . $car->name . '<br/>';
			self::showCar($car);	
		}

		echo Html::tag('h2','Sport Cars');
		$sportCars = SportCar::find()->all();
		foreach( $sportCars as $car ) {
			// Each car should be SportCar
			// echo get_class($car) . ' ' . $car->name . '<br/>';
			self::showCar($car);
		}

	}
}

?>
