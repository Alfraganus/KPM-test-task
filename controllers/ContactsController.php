<?php

namespace app\controllers;

use app\models\Favourites;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Contacts;
class ContactsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index', 'favourite-contacts'],
                'rules' => [
                    [
                        'actions' => ['logout','index', 'favourite-contacts'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $contacts = Contacts::find()->all();
        return $this->render('index',[
            'contacts'=>$contacts
        ]);
    }

    public function actionFavouriteContacts()
    {
        $favourites = Favourites::findAll(['user_id'=>Yii::$app->user->id]);
        return $this->render('favourite_contacts',[
            'favourites'=>$favourites
        ]);
    }

    public function attachContact($contact_id,$user_id)
    {
        $contact = Favourites::find()
            ->where([
               'user_id'=>$user_id,
               'contact_id'=>$contact_id
            ]);
        if($contact->exists()) {
            return false;
        } else {
            $model = new Favourites();
            $model->user_id = $user_id;
            $model->contact_id = $contact_id;
            if($model->save()) {
                return true;
            }
        }
    }

    public function actionContactFavourite($contact_id,$user_id)
    {
        $request = Yii::$app->request;
        $contact_id = $request->get('contact_id');
        $user_id = $request->get('user_id');

        if ($this->attachContact($contact_id, $user_id)) {
            Yii::$app->session->setFlash('success', "The contact has been saved!");
        } else {
            Yii::$app->session->setFlash('danger', "The contact has already been saved earlier!");
        }
        return $this->redirect(Yii::$app->request->referrer);
    }






}
