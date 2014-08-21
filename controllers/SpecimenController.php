<?php

namespace app\controllers;

use app\models\ReverseGeocodeForm;
use Yii;
use app\models\Specimen;
use app\models\SpecimenSearch;
use app\models\Location;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

//use yii\rest\ActiveController;

/**
 * SpecimenController implements the CRUD actions for Specimen model.
 */
//class SpecimenController extends ActiveController // Controller
class SpecimenController extends Controller
{
    public $modelClass = 'app\models\Specimen';


    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Specimen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SpecimenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Specimen model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a calendar with specimens as events.
     * @return string
     */
    public function actionCalendar()
    {
        return $this->render('calendar');
    }

    /**
     * Returns an json array with all specimens as events in the requested data range
     *
     * @param null $start   start of date range
     * @param null $end     end of date range
     * @return     string   json array with specimens down stripped as event objects
     */
    public function actionEvents($start = null, $end = null)
    {
        $model = new Specimen();

        $models = $model->findManyAsFullcalendarEvents($start, $end);

        echo json_encode($models);
        exit;
    }


    /**
     * Creates a new Specimen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        error_log('actionCreate');
        $model = new Specimen();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            error_log('redirect zur view in actionCreate');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            error_log("render create with model: " . print_r($model->attributes, true));
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Specimen model from another one specified by id.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateFromId($id)
    {
        $model = new Specimen();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            // use original model and reset
            // the primary key to null
            $model = $this->findModel($id);
            $model->id = null;

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Specimen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Specimen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionReverseGeocoding()
    {
        // use reverseGeolocate scenario that activates inputFormat and geoCodeLanguage
        // for service retrieval.
        $model = new Specimen(['scenario' => 'reverseGeolocate']);

        $model->load(Yii::$app->request->get());

        return $this->render('reversegeocode', [
            'model' => $model,
        ]);
    }


    public function actionCreateFromReverseGeocoding()
    {
        $model = new Specimen();

        if ($model->load(Yii::$app->request->post()) && $model->reverseGeolocate()) {

            // dirty hack: After getting data from reverse geolocation service
            // we want to pass it to normal Specimen creation process.
            // But therefor we have to rewrite the payload :-(
            $_POST['Specimen'] = $model->attributes;
            Yii::$app->request->setBodyParams($_POST);
            return $this->run('create');
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**
     * Finds the Specimen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Specimen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Specimen::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
