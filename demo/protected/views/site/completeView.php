<?php $this->pageTitle=Yii::app()->name . ' - Partial View'; ?>

<h1>Hello! I am a complete View!</h1>

<p>The contents of this page will always be fully rendered in normal circumstances, but
	partially rendered when answering to an AJAX request.</p>

<p>My path is ""<?php echo __FILE__; ?>" and my URL is "
	<?php
	$url = $this->createAbsoluteUrl('site/completeView'); 
	echo CHtml::link($url, $url); 
	?>"</p>