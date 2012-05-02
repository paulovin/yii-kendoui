<?php
$this->pageTitle=Yii::app()->name . ' - Grid';
$this->breadcrumbs=array(
	'Grid',
);
?>
<h1>Grid</h1>

<p>This example reproduces the basic usage example based on data created locally through a JavaScript function:</p>

<?php
$cs = Yii::app()->clientScript;

$cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/people.js');

/*
$cs->registerCssFile(Yii::app()->request->baseUrl . '/assets/1c88ea21/css/kendo.common.min.css');
$cs->registerCssFile(Yii::app()->request->baseUrl . '/assets/1c88ea21/css/kendo.default.min.css');
// $cs->registerScriptFile(Yii::app()->request->baseUrl . '/assets/1c88ea21/js/jquery.min.js');
$cs->registerScriptFile(Yii::app()->request->baseUrl . '/assets/1c88ea21/js/kendo.web.min.js');
*/

?>

<div id="clientsDb">
<?php
$this->widget('kendoui.widgets.KGrid', array(
		'dataSource' => array(
	        'data' => 'js:createRandomData(50)', // the prepended 'js:' is necessary due to JavaScript encoding used by Yii
			'pageSize' => 10,
		),
	    'height' => 360,
	    'groupable' => true,
	    'scrollable' => true,
	    'sortable' => true,
	    'pageable' => true,
	    'columns' => array(
	    	array(
	            'field' => 'FirstName',
	            'width' => 90,
	            'title' => 'First Name',
	        ),
	    	array(
	            'field' => 'LastName',
	            'width' => 90,
	            'title' => 'Last Name',
	        ),
	    	array(
	            'width' => 100,
	            'field' => 'City',
	        ),
	    	array(
	            'field' => 'Title',
	        ),
	    	array(
	            'field' => 'BirthDate',
	            'title' => 'Birth Date',
	            'template' => "#= kendo.toString(BirthDate,'dd MMMM yyyy') #",
	        ),
	    	array(
	            'width' => 50,
	            'field' => 'Age',
	        ),
	    ),
		'htmlOptions' => array('id' => 'grid'),
	)
);
?>
</div>


<style scoped>
	#clientsDb {
	    width: 692px;
	    height: 393px;
	    margin: 30px auto;
	    padding: 51px 4px 0 4px;
	    background: url('<?php echo Yii::app()->request->baseUrl?>/images/grid/clientsDb.png') no-repeat 0 0;
	}
</style>


<p>You can see the original <a href="http://demos.kendoui.com/web/grid/index.html" target="_blank">here</a></p>

<h3>The code:</h3>

<?php
$phpLighter = new CTextHighlighter();
$phpLighter->language = 'PHP';
 
echo $phpLighter->highlight("
\$this->widget('kendoui.widgets.KGrid', array(
		'dataSource' => array(
	        'data' => 'js:createRandomData(50)', // the prepended 'js:' is necessary due to JavaScript encoding used by Yii
			'pageSize' => 10,
		),
	    'height' => 360,
	    'groupable' => true,
	    'scrollable' => true,
	    'sortable' => true,
	    'pageable' => true,
	    'columns' => array(
	    	array(
	            'field' => 'FirstName',
	            'width' => 90,
	            'title' => 'First Name',
	        ),
	    	array(
	            'field' => 'LastName',
	            'width' => 90,
	            'title' => 'Last Name',
	        ),
	    	array(
	            'width' => 100,
	            'field' => 'City',
	        ),
	    	array(
	            'field' => 'Title',
	        ),
	    	array(
	            'field' => 'BirthDate',
	            'title' => 'Birth Date',
	            'template' => \"#= kendo.toString(BirthDate,'dd MMMM yyyy') #\",
	        ),
	    	array(
	            'width' => 50,
	            'field' => 'Age',
	        ),
	    ),
		'htmlOptions' => array('id' => 'grid'),
	)
);
");
?>