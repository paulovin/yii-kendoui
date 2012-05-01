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
							'content' => '<div class="pane-content"><h3>Inner splitter / left pane</h3><p>Resizable and collapsible.</p></div>',
							'collapsible' => true, 
							'size' => '220px',
							'htmlOptions' => array('id' => 'left-pane'),
						),
						array(
							'content' => '<div class="pane-content"><h3>Inner splitter / center pane</h3><p>Resizable only.</p></div>',
							'collapsible' => false,
							'htmlOptions' => array('id' => 'center-pane'),
						),
						array(
							'content' => '<div class="pane-content"><h3>Inner splitter / right pane</h3><p>Resizable and collapsible.</p></div>',
							'collapsible' => true,
							'size' => '220px',
							'htmlOptions' => array('id' => 'right-pane'),
						),
						'orientation' => 'horizontal',
					),
					'htmlOptions' => array('id' => 'horizontal'),
				),
				true
			),
			'htmlOptions' => array('id' => 'top-pane'),
		),
		array(
			'content' => '<div class="pane-content"><h3>Outer splitter / middle pane</h3><p>Resizable only.</p></div>',
			'collapsible' => false,
			'size' => '100px',
			'htmlOptions' => array('id' => 'middle-pane'),
		),
		array(
			'content' => '<div class="pane-content"><h3>Outer splitter / bottom pane</h3><p>Non-resizable and non-collapsible.</p></div>',
			'collapsible' => false,
			'resizable' => false,
			'size' => '100px',
			'htmlOptions' => array('id' => 'bottom-pane'),
		),
		'orientation' => 'vertical',
	),
	'htmlOptions' => array('id' => 'vertical'),
));

$cs = Yii::app()->clientScript;
$style = <<<EOD
#vertical {height: 380px;width: 700px;margin: 0 auto;}
#middle-pane {background-color: rgba(60, 70, 80, 0.10);}
#bottom-pane {background-color: rgba(60, 70, 80, 0.15);}
#left-pane {background-color: rgba(60, 70, 80, 0.05);}
#center-pane {background-color: rgba(60, 70, 80, 0.05);}
#right-pane {background-color: rgba(60, 70, 80, 0.05);}
.pane-content {padding: 0 10px;}
EOD;
$cs->registerCss('aff', $style);

$script = <<<EOT
var onTopResize = function(e) {
	//$('#horizontal').data('kendoSplitter').size('#top-pane', 200 + 'px').trigger('resize');
	// $("#horizontal").height(170).trigger("resize");
};
$("#vertical").data('kendoSplitter').bind('resize', onTopResize);
//$("#horizontal").height(170).trigger("resize");
EOT;
$cs->registerScript('aff', $script, CClientScript::POS_LOAD)
?>

<p>You can see the original <a href="http://demos.kendoui.com/web/splitter/index.html" target="_blank">here</a></p>

<h3>The code:</h3>

<?php
$phpLighter = new CTextHighlighter();
$phpLighter->language = 'PHP';
 
echo $phpLighter->highlight("<?php
\$this->widget('kendoui.widgets.KSplitter', array(
	'panes' => array(
		array(
			'collapsible' => false,
			'content' => \$this->widget('kendoui.widgets.KSplitter', 
				array(
					'panes' => array(
						array(
							'content' => '<div class=\"pane-content\"><h3>Inner splitter / left pane</h3><p>Resizable and collapsible.</p></div>',
							'collapsible' => true, 
							'size' => '220px',
							'htmlOptions' => array('id' => 'left-pane'),
						),
						array(
							'content' => '<div class=\"pane-content\"><h3>Inner splitter / center pane</h3><p>Resizable only.</p></div>',
							'collapsible' => false,
							'htmlOptions' => array('id' => 'center-pane'),
						),
						array(
							'content' => '<div class=\"pane-content\"><h3>Inner splitter / right pane</h3><p>Resizable and collapsible.</p></div>',
							'collapsible' => true,
							'size' => '220px',
							'htmlOptions' => array('id' => 'right-pane'),
						),
						'orientation' => 'horizontal',
					),
					'htmlOptions' => array('id' => 'horizontal'),
				),
				true
			),
			'htmlOptions' => array('id' => 'top-pane'),
		),
		array(
			'content' => '<div class=\"pane-content\"><h3>Outer splitter / middle pane</h3><p>Resizable only.</p></div>',
			'collapsible' => false,
			'size' => '100px',
			'htmlOptions' => array('id' => 'middle-pane'),
		),
		array(
			'content' => '<div class=\"pane-content\"><h3>Outer splitter / bottom pane</h3><p>Non-resizable and non-collapsible.</p></div>',
			'collapsible' => false,
			'resizable' => false,
			'size' => '100px',
			'htmlOptions' => array('id' => 'bottom-pane'),
		),
		'orientation' => 'vertical',
	),
	'htmlOptions' => array('id' => 'vertical'),
));") 
?>