<?php $this->pageTitle=Yii::app()->name . ' - Partial View'; ?>

<h1>Hello! I am a partial View!</h1>

<p>The contents of this page will always be partially rendered.</p>

<p>My path is ""<?php echo __FILE__; ?>" and my URL is "
	<?php
	$url = $this->createAbsoluteUrl('site/partialView'); 
	echo CHtml::link($url, $url); 
	?>"</p>