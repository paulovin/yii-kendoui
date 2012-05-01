<?php
Yii::import('kendoui.widgets.KWidget');

/**
 * Widget para a exibição de diversos conteúdos separados por divisórias (splitters), usando como
 * base as bibliotecas do KendoUI.
 * 
 * Uso:
 * <pre>
 * $this->widget('kendoui.components.KSplitter', array(
 *     'content'=>array(
 *     ),
 *     'options'=>array(
 *     ),
 * ));
 * </pre>
 */
class KSplitter extends KWidget {
	
	/**
	 * Denota a orientação vertical dos 'panes' do widget.
	 */
	const HORIZONTAL = 'horizontal';
	
	/**
	 * Array com o conteúdo a ser separado pelas divisórias.
	 */
	public $panes = array();
	/**
	 * Indica se as divisões devem ser 
	 */
	public $orientation = self::HORIZONTAL;
	
	/**
	 * Applies a fix to nested splitters dimensions. It must be called only after the creation of
	 * the said splitters AND its parent.
	 * 
	 * @param $splitter string The splitter being fixed
	 * @param $parent string The parent splitter
	 * @param height string The nested splitter desired height (default: 100%)
	 * @param width string The nested splitter desired height (default: 100%)
	 * 	 */
	public static function applyNestedSplitterFix($splitter, $parent, $height = '100%', $width = '100%') {
		$cs = Yii::app()->clientScript;
		
		$script = "var onResize = function(e){setTimeout(function() {\$('#$splitter').data('kendoSplitter').trigger('resize');}, 1);};\n";
		$script .= "\$('#$splitter').css({height:'$height', width:'$width'});\n";
		$script .= "\$('#vertical').data('kendoSplitter').bind('resize', onResize);\n";
		$script .= "\$('#$splitter').data('kendoSplitter').trigger('resize');\n";

		$cs->registerScript($splitter . '_splitter-fix', $script, CClientScript::POS_LOAD);
	}
	
	/**
	 * Inicializa o widget
	 */
	public function init() {
	}
	
	/**
	 * Executa o widget.
	 */
	public function run() {
		$id = $this->getId();
		$scriptOptions = array ();
		
		if (isset($this->panes['orientation'])) {
			$this->orientation = $this->panes['orientation'];
			unset($this->panes['orientation']);
		}

		$paneCount = count($this->panes);

		if (isset($this->htmlOptions['id'])) {
			$id = $this->htmlOptions['id'];
		} else {
			$this->htmlOptions['id']=$id;
		}
        echo CHtml::openTag('div', $this->htmlOptions) . "\n";
		
		// Renderização dos panes
		for ($i = 0; $i < $paneCount; $i++) {
			$paneId = $id . '_pane-' . $i;
			$pane = $this->panes[$i];
			$htmlOptions = array();
			
			if (isset($pane['htmlOptions'])) {
				$htmlOptions = $pane['htmlOptions'];
				$paneId = $htmlOptions['id'];
				unset($this->panes[$i]['htmlOptions']);
			}
			$htmlOptions['id'] = $paneId;
			echo CHtml::openTag('div', $htmlOptions) . "\n";
			
			// Inclui um conteúdo estático:
			if (isset($pane['content'])) {
				$content = $pane['content'];
				// renderiza o conteúdo passado diretamente para o widget
				echo $content;
				unset($this->panes[$i]['content']);
			}
            // Carrega o conteúdo de uma view do sistema:
			else if (isset($pane['view'])) {
				$view = $pane['view'];
				$data = null;
				
				if (is_array($view)) {
					if (isset($view['data'])) {
						$data = $view['data'];
					}
					$view = $view['path']; 
				}
				$this->getController()->renderPartial($view, $data);
				unset($this->panes[$i]['view']);
			}
			// unset($this->panes[$i]['content']);
			if (count($this->panes[$i]) == 0) {
				unset($this->panes[$i]);
			}
			echo CHtml::closeTag('div')  . "\n";
		}
		// fim da renderização dos panes
		
		$this->registerClientScript();
		echo CHtml::closeTag('div')  . "\n";
		$this->addBasicOptions(&$scriptOptions);
		if (count($this->panes) > 0) {
			$scriptOptions['panes'] = $this->panes;
		}
		$scriptOptions['orientation'] = $this->orientation;
		$cs = Yii::app()->getClientScript();
		$cs->registerScript('KendoUI.KWidget#' . $id, "jQuery(\"#{$id}\").kendoSplitter(" . CJavaScript::encode($scriptOptions) . ")", CClientScript::POS_LOAD);
	}
	
	/**
	 * Registra os scripts necessários para o módulo.
	 */
	protected function registerClientScript() {
		$this->loadBaseAssets();
		$this->loadJs('kendo.splitter.min.js');
	}

}
