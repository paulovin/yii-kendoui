<?php
$this->pageTitle=Yii::app()->name . ' - Grid';
$this->breadcrumbs=array(
	'Grid',
);
?>
<h1>Grid</h1>

<p>Description here...</p>

<?php
$cs = Yii::app()->clientScript;

$cs->registerScriptFile(Yii::app()->request->baseUrl . '/js/people.js');

$this->widget('kendoui.widgets.KGrid', array(
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
                'template' => '#= kendo.toString(BirthDate,"dd MMMM yyyy") #'
            ),
			array(
                'width' => 50,
                'field' => 'Age',
            ),
		),
		
		'dataSource' => array(
			'data' => 'createRandomData(50)',
			'pageSize' => 10,
		),

		'height' => 360,
		'groupable' => true,
		'scrollable' => true,
		'sortable' => true,
		'pageable' => true,
		'htmlOptions' => array('id' => 'grid'),
	)
);

$bgImage = Yii::app()->request->baseUrl;
$style = <<<EOD
#clientsDb {
    width: 692px;
    height: 393px;
    margin: 30px auto;
    padding: 51px 4px 0 4px;
    background: url('{$bgImage}/images/grid/clientsDb.png') no-repeat 0 0;
}
EOD;
$cs->registerCss('aff', $style);

?>
<p></p>
<h3>The code:</h3>

<?php
$phpLighter = new CTextHighlighter();
$phpLighter->language = 'PHP';
 
echo $phpLighter->highlight("$ this->widget('kendoui.widgets.KGrid', array(
		'columns' => array(
			array(
				'field' => 'OrderID',
				'filterable' => false
			),
			'Freight',
			array(
				'field' => 'OrderDate',
				'title' => 'Order Date',
				'width' => 100,
				'format' => '{0:MM/dd/yyyy}'
			),
			array(
				'field' => 'ShipName',
				'title' => 'Ship Name',
				'width' => 200
			),
			array (
				'field' => 'ShipCity',
				'title' => 'Ship City'
			)
		),
		
		'dataSource' => array(
			'type' => 'odata',
			'transport' => array(
				'read' => 'http://demos.kendoui.com/service/Northwind.svc/Orders'
			),
			'schema' => array(
				'model' => array(
					'fields' => array(
						'OrderID' => array( 'type' => 'number' ),
						'Freight' => array( 'type' => 'number' ),
						'ShipName' => array( 'type' => 'string' ),
						'OrderDate' => array( 'type' => 'date' ),
						'ShipCity' => array( 'type' => 'string' ),
					)
				)
			),
			'pageSize' => 10,
		),

		'height' => 251,
		'groupable' => true,
		'scrollable' => true,
		'sortable' => true,
		'pageable' => true,
	)
);");
?>