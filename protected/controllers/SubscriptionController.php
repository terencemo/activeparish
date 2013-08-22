<?php

class SubscriptionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($fid)
	{
		$family = Families::model()->findByPk($fid);

		$model=new Subscription;

		$sub = Subscription::model()->findByAttributes(array(
							'family_id' => $family->id
						), array(
							'order' => 'year DESC, month DESC'
						));

		if ($sub) {
			$dt = new DateTime(sprintf("%d-%02d-%d", $sub->year, $sub->month, 15));
		} else {
			$dt = new DateTime($family->reg_date);
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Subscription']))
		{
			$till = $_POST['Subscription']['till'];

			for ($i = 1; $i <= $till; ++$i) {
				$model=new Subscription;

				$model->family_id = $family->id;
				$dt->add(new DateInterval('P1M'));				
				$model->month = date_format($dt, 'n');
				$model->year = date_format($dt, 'Y');
				$trans = new Transaction;
				$trans->type = 'credit';
				$trans->amount = $_POST['Subscription']['amount'];
				$trans->created = date_format(new DateTime(), 'Y-m-d H:i:s');
				$trans->creator = Yii::app()->user->id;
				$trans->descr = "Subscription for family #" . $family->id;
				if ($trans->save()) {
					$model->trans_id = $trans->id;
					if ($model->save()) {
						$trans->descr = "Family #" . $family->id . ' subscription for ' . date_format($dt, 'M Y');
						$trans->save(false);
					}
				}
			}
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'family' => $family,
			'model'=>$model,
			'start_dt'=>$dt
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Subscription']))
		{
			$model->attributes=$_POST['Subscription'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($fid)
	{
		$family = Families::model()->findByPk($fid);

		$subscriptions = Subscription::model()->findAllByAttributes(array(
								'family_id' => $family->id
							), array(
								'order' => 'year DESC, month ASC'								
							));

		$this->render('index',array(
			'family' => $family,
			'subscriptions' => $subscriptions
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($fid)
	{
		$family = Families::model()->findByPk($fid);

		$model=new Subscription('search');
		$model->unsetAttributes();  // clear any default values
		$model->family_id = $family->id;

		if(isset($_GET['Subscription']))
			$model->attributes=$_GET['Subscription'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Subscription the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Subscription::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Subscription $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='subscription-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
