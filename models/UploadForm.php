<?php 
namespace app\models;

use yii\base\Model;
//use yii\web\UploadedFile;

class UploadForm extends Model
{
	/**
	 * @var UploadedFile
	 */
	public $file;
	public function rules()
	{
		return [
			['file', 'file', 'skipOnEmpty' => false, 'extensions' => ['zip','jpeg']],
		];
	}
	

	public function upload()
	{
		if($this->validate()) {
			$t = ""; $i = 0; 
			$base = $this->file->baseName;
			while(file_exists('uploads/' . $base . $t . '.' . $this->file->extension)) {
				$i++; $t = "_" . $i;
			}
			$this->file->name = $base . $t . '.' . $this->file->extension;
			$this->file->saveAs('uploads/' . $this->file->name);
			// return ['status' => 'success', 'filename' => $this->file->name];
			return true;
		} else {
			// return ['status' => 'error'];
			return false;
		}
	}
}
?>