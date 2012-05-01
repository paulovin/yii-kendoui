<?php
Yii::import('kendoui.widgets.KSplitter');

$this->pageTitle=Yii::app()->name . ' - Splitter';
$this->breadcrumbs=array(
	'Splitter'=>array('site/page', 'view'=>'splitter'),
	'Using Views',
);
?>
<h1>Splitter</h1>

<p>In this example, we render partially the content of other views inside the splitter (no AJAX
	calls used here).</p>

<?php
$this->widget('kendoui.widgets.KSplitter', array(
	'panes' => array(
		array(
			'view' => 'partialView',
		),
		array(
			'view' => 'index',
		),
		'orientation' => 'vertical',
	),
	'htmlOptions' => array('id' => 'splitter'),
));

$cs = Yii::app()->clientScript;
$style = <<<EOD
#splitter {height: 380px;width: 700px;margin: 0 auto;}
EOD;
$cs->registerCss('aff', $style);
?>

<h3>The code:</h3>

<?php
$phpLighter = new CTextHighlighter();
$phpLighter->language = 'PHP';
 
echo $phpLighter->highlight("<?php
\$this->widget('kendoui.widgets.KSplitter', array(
	'panes' => array(
		array(
			'view' => 'partialView',
		),
		array(
			'view' => 'index',
		),
		'orientation' => 'vertical',
	),
	'htmlOptions' => array('id' => 'splitter'),
));
?>");
?>
