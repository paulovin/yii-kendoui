<?php
Yii::import('kendoui.widgets.KWidget');

/**
 * Widget para a exibição de conteúdo dentro de um Grid do KendoUI.
 * 
 * Uso:
 * <pre>
 * TODO
 * </pre>
 */
class KGrid extends KWidget {

	/**
	 * Indica se os dados do grid são carregados automaticamente.
	 */
	public $autoBind;
	/**
	 * Coleção de colunas a serem exibidas pelo grid.
	 * Opções:
	 * <ul>
	 * <li>command: definição da coluna de comando</li>
	 * <li>editor (function): define um editor personalizado para o campo
	 *   <li>container: o container do editor</li>
	 *   <li>options: opções adicionais
	 *     <li>field: campo do editor</li>
	 *     <li>model: modelo do editor</li>
	 *   </li>
	 * </li>
	 * <li>encoded (padrão:true): indica se algum eventual conteúdo HTML da coluna deve ser escapado como texto normal</li>
	 * <li>field: o campo do datasource que será exibido pela coluna</li>
	 * <li>filterable (padrão:true): indica se o conteúdo da coluna é filtrável</li>
	 * <li>format: o formato a ser usado nas células da coluna</li>
	 * <li>template: o template a ser usado nas células da coluna</li>
	 * <li>title: título (cabeçalho) da coluna</li>
	 * <li>width: largura da coluna</li>
	 * </ul>
	 */
	public $columns;
	/**
	 * Instance of DataSource or Object with DataSource configuration.
	 */
	public $dataSource;
	/**
	 * Template to be used for rendering the detail rows in the grid. See KendoUI's "Detail Template" example.
	 */
	public $detailTemplate;
	/**
	 * Indicates whether editing is enabled/disabled.
	 * <ul>
	 * <li>confirmation: Defines the text that will be used in confirmation box when delete an item.</li>
	 * <li>destroy: Indicates whether item should be deleted when click on delete button.</li>
	 * <li>mode: Indicates which of the available edit modes(incell(default)/inline/popup) will be used</li>
	 * <li>template: Template which will be use during popup editing</li>
	 * <li>update: Indicates whether item should be switched to edit mode on click.</li>
	 * </ul>
	 */
	public $editable;
	/**
	 * Indicates whether grouping is enabled/disabled.
	 */	
	public $groupable;
	/**
	 * Indicates whether keyboard navigation is enabled/disabled.
	 */
	public $navigatable;
	/**
	 * Indicates whether paging is enabled/disabled.
	 */
	public $pageable;
	/**
	 * Template to be used for rendering the rows in the grid.
	 */
	public $rowTemplate;
	/**
	 * Enable/disable grid scrolling. Possible values:
	 * <ul>
	 * <li>true: Enables grid vertical scrolling</li>
	 * <li>false: Disables grid vertical scrolling</li>
	 * <li>'virtual' => 'false': Enables grid vertical scrolling without data virtualization. Same as first option.</li>
	 * <li>'virtual' => 'true': Enables grid vertical scrolling with data virtualization.</li>
	 * </ul>
	 */
	public $scrollable;
	/**
	 * Indicates whether selection is enabled/disabled. Possible values:
	 * <ul>
	 * <li>row: Single row selection</li>
	 * <li>cell: Single cell selection</li>
	 * <li>multiple, row: Multiple row selection</li>
	 * <li>multiple, cell: Multiple cell selection</li>
	 * </ul>
	 */
	public $selectable;
	/**
	 * Defines whether grid columns are sortable.
	 * <ul>
	 * <li>allowUnsort: Defines whether column can have unsorted state</li>
	 * <li>mode: Defines sorting mode. Possible values: </li>
	 *   <ul>
	 *   <li>single: Defines that only once column can be sorted at a time</li>
	 *   <li>multiple: Defines that multiple columns can be sorted at a time</li>
	 *   </ul>
	 * </ul>
	 */
	public $sortable;
	/**
	 * This is a list of commands for which the corresponding buttons will be rendered. The supported built-in commands are: "create", "cancel", "save", "destroy".
	 * <ul>
	 * <li>name: The name of the command. One of the predefined or a custom</li>
	 * <li>template: The template for the command button</li>
	 * <li>text: The text of the command that will be set on the button</li>
	 * </ul>
	 */
	public $toolbar;
	
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
			
		if (isset($this->htmlOptions['id'])) {
			$id = $this->htmlOptions['id'];
		} else {
			$this->htmlOptions['id']=$id;
		}
        echo CHtml::openTag('div', $this->htmlOptions) . "\n";
		echo CHtml::closeTag('div')  . "\n";
		$this->registerClientScript();
		
		// popula o array de configurações
		$this->addBasicOptions(&$scriptOptions);
		$this->addOption(&$scriptOptions, 'autoBind', $this->autoBind);
		$this->addOption(&$scriptOptions, 'columns', $this->columns);
		$this->addOption(&$scriptOptions, 'dataSource', $this->dataSource);
		$this->addOption(&$scriptOptions, 'detailTemplate', $this->detailTemplate);
		$this->addOption(&$scriptOptions, 'editable', $this->editable);
		$this->addOption(&$scriptOptions, 'groupable', $this->groupable);
		$this->addOption(&$scriptOptions, 'navigatable', $this->navigatable);
		$this->addOption(&$scriptOptions, 'pageable', $this->pageable);
		$this->addOption(&$scriptOptions, 'rowTemplate', $this->rowTemplate);
		$this->addOption(&$scriptOptions, 'scrollable', $this->scrollable);
		$this->addOption(&$scriptOptions, 'pageable', $this->pageable);
		$this->addOption(&$scriptOptions, 'rowTemplate', $this->rowTemplate);
		$this->addOption(&$scriptOptions, 'scrollable', $this->scrollable);
		$this->addOption(&$scriptOptions, 'selectable', $this->selectable);
		$this->addOption(&$scriptOptions, 'sortable', $this->sortable);
		$this->addOption(&$scriptOptions, 'toolbar', $this->toolbar);
		// cria o "hook" de inicialização do widget:
		$cs = Yii::app()->getClientScript();
		$cs->registerScript('KendoUI.KWidget#' . $id, "jQuery(\"#{$id}\").kendoGrid(" . CJavaScript::encode($scriptOptions) . ")", CClientScript::POS_LOAD);
	}
	
	/**
	 * Registra os scripts necessários para o módulo.
	 */
	protected function registerClientScript() {
		$this->loadBaseAssets();
		// $this->loadJs('kendo.grid.min.js');
	}
	
}