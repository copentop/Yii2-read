<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use yii\helpers\Url;

use yii\helpers\VarDumper;

class SiteController extends Controller
{
    /**
     * @inheritdoc
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
     * @inheritdoc
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

    public function actionHello() {

        $arr = [
            'a' => [ '1', 'b'=> '2'],
            1,
            'c' => 1
        ];

        VarDumper::dump($arr, 10, true);
    }



    public function actionWeb1() {
        $cookies = Yii::$app->response->cookies;
    

        $cook = Yii::$app->request->cookies;
        $cc = $cook->get('HTTP_BIGO_TOKEN');
        
        if(!empty($cc)) {
           
            echo "has cookie {$cc} <br>";
        } else {
            $cookies->add(new \yii\web\Cookie([
                'name' => 'HTTP_BIGO_TOKEN',
                'value' => 'bigo',
                'path' => '/',
                'expire'=>time()+3600 * 2
            ]));

            echo "no cookie <br>";
        }

        


        echo "<a href='/site/web2/'> to Web2 </a>";
    }


    public function actionWeb2() {
        $cookies = Yii::$app->request->cookies;

        // var_dump($cookies);exit;
        $cc =  $cookies->get('HTTP_BIGO_TOKEN');
        $cc1 =  $cookies->get('HTTP_BIGO_TOKEN1_1');

        echo "<a href='/site/web3/'>Web1 cookie: {$cc}, {$cc1}, to Web 3</a>";
       
    }


    public function actionWeb3() {
        $cookies = Yii::$app->request->cookies;

        $cc =  $cookies->get('HTTP_BIGO_TOKEN');

        $cc1 =  $cookies->get('HTTP_BIGO_TOKEN1_1');

        echo "<a href='/site/web1/'>Web1 cookie: {$cc}, {$cc1}, to Web 1</a>";
    }


    public function actionTest() {
        
        echo Url::canonical();
        exit;
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
}
