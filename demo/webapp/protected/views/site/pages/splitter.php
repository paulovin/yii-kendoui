<?php
$this->pageTitle=Yii::app()->name . ' - Splitter';
$this->breadcrumbs=array(
	'About',
);
?>
<h1>Splitter</h1>

<p>This is a Splitter  widget example based on KendoUI's basic example. It enables you to create 
	the whole content of the splitter dynamically and load its content from a partial view or an
	AJAX request (in progress).</p>

<?php
$this->widget('kendoui.widgets.KSplitter', array(
	'panes' => array(
		array(
			'collapsible' => false,
			'content' => $this->widget('kendoui.widgets.KSplitter', 
				array(
					'panes' => array(
						array(
							'content' => '<h3>Inner splitter / left pane</h3><p>Resizable and collapsible.</p>',
							'collapsible' => true, 
							'size' => "220px"
						),
						array(
							'content' => '<h3>Inner splitter / center pane</h3><p>Resizable only.</p>',
							'collapsible' => false
						),
						array(
							'content' => '<h3>Inner splitter / right pane</h3><p>Resizable and collapsible.</p>',
							'collapsible' => true,
							'size' => "220px"
						),
						'orientation' => 'horizontal',
					)
				),
			true),
		),
		array(
			'content' => '<h3>Outer splitter / middle pane</h3><p>Resizable only.</p>',
			'collapsible' => false,
			'size' => "100px"
		),
		array(
			'content' => '<h3>Outer splitter / bottom pane</h3><p>Non-resizable and non-collapsible.</p>',
			'collapsible' => false,
			'resizable' => false,
			'size' => "100px",
			'htmlOptions' => array('id' => 'last_pane'),
		),
		'orientation' => 'vertical',
	),
	'htmlOptions' => array('id' => 'vertical'),
));
?>
<p></p>
<h3>The code:</h3>
<?php
$phpLighter = new CTextHighlighter();
$phpLighter->language = 'PHP';
 
echo $phpLighter->highlight("<?php $ this->widget('kendoui.widgets.KSplitter', array(
	'panes' => array(
		array(
			'collapsible' => false,
			'content' => $ this->widget('kendoui.widgets.KSplitter', 
				array(
					'panes' => array(
						array(
							'content' => '<h3>Inner splitter / left pane</h3><p>Resizable and collapsible.</p>',
							'collapsible' => true, 
							'size' => '220px'
						),
						array(
							'content' => '<h3>Inner splitter / center pane</h3><p>Resizable only.</p>',
							'collapsible' => false
						),
						array(
							'content' => '<h3>Inner splitter / right pane</h3><p>Resizable and collapsible.</p>',
							'collapsible' => true,
							'size' => '220px'
						),
						'orientation' => 'horizontal',
					)
				),
			true),
		),
		array(
			'content' => '<h3>Outer splitter / middle pane</h3><p>Resizable only.</p>',
			'collapsible' => false,
			'size' => '100px'
		),
		array(
			'content' => '<h3>Outer splitter / bottom pane</h3><p>Non-resizable and non-collapsible.</p>',
			'collapsible' => false,
			'resizable' => false,
			'size' => '100px' 
		),
		'orientation' => 'vertical',
	),
	'htmlOptions' => array('id' => 'vertical'),
));
?>") 
?>