<?php

class SiteController extends Controller
{
	
	private static $firstNames = null;
	private static $lastNames = null;
	private static $cities = null;
	private static $titles = null;
	private static $birthDates = null;
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	/**
	 * Renders the partial view page.
	 */
	public function actionPartialView() {
		$this->renderPartial('partialView');
	}
	
	/**
	 * Renders the partial view page.
	 */
	public function actionCompleteView() {
		$this->renderPartial('completeView');
	}
	
	public function actionRandomData($size) {
		// initializes the data arrays
		if (self::$firstNames == null) {
			self::$firstNames = array("Nancy", "Andrew", "Janet", "Margaret", "Steven", "Michael", "Robert", "Laura", "Anne", "Nige");
    		self::$lastNames = array("Davolio", "Fuller", "Leverling", "Peacock", "Buchanan", "Suyama", "King", "Callahan", "Dodsworth", "White");
    		self::$cities = array("Seattle", "Tacoma", "Kirkland", "Redmond", "London", "Philadelphia", "New York", "Seattle", "London", "Boston");
    		self::$titles = array("Accountant", "Vice President, Sales", "Sales Representative", "Technical Support", "Sales Manager", "Web Designer","Software Developer", "Inside Sales Coordinator", "Chief Techical Officer", "Chief Execute Officer");
    		self::$birthDates = array("1948/12/08", "1952/02/19", "1963/08/30", "1937/09/19", "1955/03/04", "1963/07/02", "1960/05/29", "1958/01/09", "1966/01/27", "1966/03/27");
		}
		$ret = array();
		
		for ($i = 0; $i < $size; $i++) {
			$ret[] = array(
				'Id' => $i,
				'FirstName' => self::$firstNames[rand(0, count(self::$firstNames) - 1)],
				'LastName' => self::$lastNames[rand(0, count(self::$lastNames) - 1)],
				'City' => self::$cities[rand(0, count(self::$cities) - 1)],
				'Title' => self::$titles[rand(0, count(self::$titles) - 1)],
				'BirthDate' => self::$birthDates[rand(0, count(self::$birthDates) - 1)],
				'Age' => rand(0, 100),
			);
		}
		echo CJSON::encode($ret);
		Yii::app()->end();
	}
	
}