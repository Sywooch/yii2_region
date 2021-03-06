<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace backend\controllers\base;

use common\models\BusReservation;
use backend\models\SearchBusReservation;
use yii\web\Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
use dmstr\bootstrap\Tabs;

/**
 * BusReservationController implements the CRUD actions for BusReservation model.
 */
class BusReservationController extends Controller
{
    /**
     * @var boolean whether to enable CSRF validation for the actions in this controller.
     * CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
     */
    public $enableCsrfValidation = false;


    /**
     * Lists all BusReservation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchBusReservation;
        $dataProvider = $searchModel->search($_GET);

        Tabs::clearLocalStorage();

        Url::remember();
        \Yii::$app->session['__crudReturnUrl'] = null;

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single BusReservation model.
     * @param integer $id
     * @param integer $bus_info_id
     * @param integer $bus_way_id
     * @param integer $kontragent_persons_id
     *
     * @return mixed
     */
    public function actionView($id, $bus_info_id, $bus_way_id, $kontragent_persons_id)
    {
        \Yii::$app->session['__crudReturnUrl'] = Url::previous();
        Url::remember();
        Tabs::rememberActiveState();

        return $this->render('view', [
            'model' => $this->findModel($id, $bus_info_id, $bus_way_id, $kontragent_persons_id),
        ]);
    }

    /**
     * Creates a new BusReservation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BusReservation;

        try {
            if ($model->load($_POST) && $model->save()) {
                return $this->redirect(Url::previous());
            } elseif (!\Yii::$app->request->isPost) {
                $model->load($_GET);
            }
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            $model->addError('_exception', $msg);
        }
        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing BusReservation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $bus_info_id
     * @param integer $bus_way_id
     * @param integer $kontragent_persons_id
     * @return mixed
     */
    public function actionUpdate($id, $bus_info_id, $bus_way_id, $kontragent_persons_id)
    {
        $model = $this->findModel($id, $bus_info_id, $bus_way_id, $kontragent_persons_id);

        if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BusReservation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $bus_info_id
     * @param integer $bus_way_id
     * @param integer $kontragent_persons_id
     * @return mixed
     */
    public function actionDelete($id, $bus_info_id, $bus_way_id, $kontragent_persons_id)
    {
        try {
            $this->findModel($id, $bus_info_id, $bus_way_id, $kontragent_persons_id)->delete();
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            \Yii::$app->getSession()->addFlash('error', $msg);
            return $this->redirect(Url::previous());
        }

// TODO: improve detection
        $isPivot = strstr('$id, $bus_info_id, $bus_way_id, $kontragent_persons_id', ',');
        if ($isPivot == true) {
            return $this->redirect(Url::previous());
        } elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/') {
            Url::remember(null);
            $url = \Yii::$app->session['__crudReturnUrl'];
            \Yii::$app->session['__crudReturnUrl'] = null;

            return $this->redirect($url);
        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the BusReservation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $bus_info_id
     * @param integer $bus_way_id
     * @param integer $kontragent_persons_id
     * @return BusReservation the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findModel($id, $bus_info_id, $bus_way_id, $kontragent_persons_id)
    {
        if (($model = BusReservation::findOne(['id' => $id, 'bus_info_id' => $bus_info_id, 'bus_way_id' => $bus_way_id, 'kontragent_persons_id' => $kontragent_persons_id])) !== null) {
            return $model;
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }
}
