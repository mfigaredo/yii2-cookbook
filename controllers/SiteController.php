<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionTestEvents()
    {
        $article = new \app\models\Article();
        $article->name = 'Valentine\'s Day coming? Aw crap! I forgot to get a girlfriend again!';
        $article->description = 'Bender is angry at Fry for dating a robot. Stay away from our women. You\'ve got metal fever, boy. Metal fever';

        // $event is an object of yii\base\Event or a child class
        $article->on(\yii\db\ActiveRecord::EVENT_AFTER_INSERT,

            function($event) {

                $followers = [
                                'john2@teleworm.us',
                                'shivawhite@cuvox.de', 
                                // 'kate@dayrep.com',
                                // 'm5ibx_n6@fakemailgenerator.net',
                            ];

                foreach($followers as $follower) {
                    Yii::$app->mailer->compose()
                        ->setFrom('techblog@teleworm.us')
                        ->setTo($follower)
                        ->setSubject($event->sender->name)
                        ->setTextBody($event->sender->description)
                        ->send();   
                    sleep(1);
                }
                echo 'Emails have been sent';
            });
        
        if (!$article->save()) {
            echo \yii\helpers\VarDumper::dumpAsString($article->getErrors());
        };
    }

    public function actionBlocks()
    {
        $this->layout = 'blocks';
        $this->view->blocks['footer'] = \yii\helpers\Html::tag('h3','New Footer Block from Controller');
        return $this->render('blocks');
    }

    public function actionDecorator()
    {
        
        return $this->render('decorator');
    }
}
