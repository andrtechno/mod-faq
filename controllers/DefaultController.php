<?php

namespace panix\mod\faq\controllers;

use panix\engine\data\ActiveDataProvider;
use panix\mod\faq\models\FaqCategory;
use Yii;
use panix\engine\controllers\WebController;
use panix\mod\faq\models\Faq;
use panix\mod\faq\models\FaqSearch;
use yii\helpers\ArrayHelper;

class DefaultController extends WebController
{

    public function actionIndex()
    {
        $this->pageName = Yii::t($this->module->id . '/default', 'MODULE_NAME');
        $this->view->params['breadcrumbs'][] = $this->pageName;


        $query = Faq::find()->published();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }




}
