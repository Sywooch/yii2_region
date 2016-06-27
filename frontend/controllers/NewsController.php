<?php

namespace frontend\controllers;

use cinghie\articles\models\ItemsSearch;

class NewsController extends \cinghie\articles\controllers\ItemsController
{
    public function actionIndex()
    {
        // Check RBAC Permission
        if($this->userCanIndex())
        {
            $searchModel = new ItemsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Displays a single Items model.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionView($id)
    {
        // Check RBAC Permission
        if($this->userCanView($id))
        {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

}
