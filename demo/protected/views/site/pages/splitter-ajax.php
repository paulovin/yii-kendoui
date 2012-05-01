<?php
Yii::import('kendoui.widgets.KSplitter');

$this->pageTitle=Yii::app()->name . ' - Splitter';
$this->breadcrumbs=array(
	'Splitter'=>array('site/page', 'view'=>'splitter'),
	'AJAX',
);
?>
<h1>Splitter</h1>

<p>In this example, we load the content of the widgets dynamically through AJAX.</p>

<?php
$this->widget('kendoui.widgets.KSplitter', array(
	'panes' => array(
		array(
			'contentUrl' => $this->createUrl('site/partialView'),
		),
		array(
			'contentUrl' => $this->createUrl('site/completeView'),
		),
	),
	'htmlOptions' => array('id' => 'splitter'),
));

$cs = Yii::app()->clientScript;
$style = <<<EOD
#splitter {height: 380px;width: 700px;margin: 0 auto;}
EOD;
$cs->registerCss('aff', $style);
?>

<p>You can see the original <a href="http://demos.kendoui.com/web/splitter/ajax.html" target="_blank">here</a></p>

<h3>The code:</h3>

<?php
$phpLighter = new CTextHighlighter();
$phpLighter->language = 'PHP';
 
echo $phpLighter->highlight("<?php
\$this->widget('kendoui.widgets.KSplitter', array(
	'panes' => array(
		array(
			'contentUrl' => \$this->createUrl('site/partialView'),
		),
		array(
			'contentUrl' => \$this->createUrl('site/completeView'),
		),
	),
	'htmlOptions' => array('id' => 'splitter'),
));
?>");
?>
