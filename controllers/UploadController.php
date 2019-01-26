<?php 
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\helpers\Html;

class UploadController extends Controller
{
	public function actionIndex()
	{
		return $this->redirect(['upload']);
	}

	public function actionUpload()
	{
		// $this->view->title = 'File Upload Example';  // it is better to assign in view file
		$model = new UploadForm();
		if(Yii::$app->request->isPost) {
			$model->file = UploadedFile::getInstance($model, 'file');
			// if(($upload = $model->upload()) && $upload['status']=='success' )  {
			if( $model->upload() )  {
				// return $this->renderContent(Html::tag('p',"File {$upload['filename']} is uploaded successfully.") . Html::a('Upload another file',Url::to('upload')));
				return $this->renderContent(Html::tag('p',"File {$model->file->name} is uploaded successfully.") . Html::a('Upload another file',Url::to('upload')));				
			} else {
				// return $this->renderContent("Error: estatus = {$upload['status']}");
				return $this->renderContent("Error: could not upload your file...");
			}
		}
		return $this->render('index',compact('model'));
	}
}
?>