<?php
$this->pageTitle=Yii::app()->name . ' - Splitter';
$this->breadcrumbs=array(
	'About',
);
?>
<h1>Grid</h1>

<p>Description here...</p>

<?php
$this->widget('kendoui.widgets.KGrid', array(
		'columns' => array(
			array(
				'field' => 'OrderID',
				'filterable' => false
			),
			'Freight',
			array(
				'field' => "OrderDate",
				'title' => "Order Date",
				'width' => 100,
				'format' => "{0:MM/dd/yyyy}"
			),
			array(
				'field' => "ShipName",
				'title' => "Ship Name",
				'width' => 200
			),
			array (
				'field' => "ShipCity",
				'title' => "Ship City"
			)
		),
		
		'dataSource' => array(
			'type' => "odata",
			'transport' => array(
				'read' => "http://demos.kendoui.com/service/Northwind.svc/Orders"
			),
			'schema' => array(
				'model' => array(
					'fields' => array(
						'OrderID' => array( 'type' => "number" ),
						'Freight' => array( 'type' => "number" ),
						'ShipName' => array( 'type' => "string" ),
						'OrderDate' => array( 'type' => "date" ),
						'ShipCity' => array( 'type' => "string" ),
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
);
?>