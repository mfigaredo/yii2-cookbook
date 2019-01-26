<?php

namespace app\commands;

use Ramsey\Uuid\Uuid;
use yii\console\Controller;

class UuidController extends Controller 
{
  public function actionGenerate($n = 3)
  {
    for($k = 0; $k < $n; $k ++) {
      $this->stdout(Uuid::uuid4()->toString() . PHP_EOL);
    }
    /*
    $this->stdout(Uuid::uuid4()->toString() . PHP_EOL);
    $this->stdout(Uuid::uuid4()->toString() . PHP_EOL);
    $this->stdout(Uuid::uuid4()->toString() . PHP_EOL);
    $this->stdout(Uuid::uuid4()->toString() . PHP_EOL);
    */

    echo \yii\console\widgets\Table::widget([
        'headers' => ['Project', 'Status', 'Participant'],
        'rows' => [
            ['Yii', 'OK', '@samdark'],
            ['Yii', 'OK', '@cebe'],
        ],
    ]);
  }
}
