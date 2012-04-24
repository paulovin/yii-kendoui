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
			$htmlOptions;
			
			if (isset($pane->htmlOptions['id'])) {
				$htmlOptions = $pane->htmlOptions;
				$paneId = $htmlOptions['id'];
			} else {
				$htmlOptions['id'] = $paneId;
			}
			echo CHtml::openTag('div', $htmlOptions) . "\n";
			
			// Inclui um conteúdo estático:
			if (isset($pane['content'])) {
				$content = $pane['content'];
				// renderiza o conteúdo passado diretamente para o widget
				if (!is_array($content)) {
					echo $content;
				}
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
			// carrega dinamicamente o conteúdo via AJAX
			else if (isset($content['ajax'])) {
				// TODO: implementar
				//$tabsOut .= strtr($this->headerTemplate, array('{title}'=>$title, '{url}'=>CHtml::normalizeUrl($content['ajax']), '{id}'=>'#' . $tabId))."\n";
				echo '<h3>Suporte a Ajax ainda não implementado</h3>';
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
