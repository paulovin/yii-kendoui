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
	 * Fonte de dados do grid
	 */
	public $dataSource;
	/**
	 * Template usado para renderizar as linhas de detalhe no grid.
	 */
	public $detailTemplate;
	
	public $height;

	public $groupable;
	
	public $sortable;
	
	public $pageable;
	
	public $scrollable;
	
	
	/**
	 * Inicializa o widget
	 */
	public function init() {
	}
	
	/**
	 * Executa o widget.
	 */
	public function run() {
		echo 'hello, widget<br>';
		// TODO: renderizar
		$this->registerClientScript();
		// TODO: criar script de inicialização
		echo 'bye, widget<br>';
	}
	
	/**
	 * Registra os scripts necessários para o módulo.
	 */
	protected function registerClientScript() {
		$this->loadBaseAssets();
		$this->loadJs('kendo.grid.min.js');
	}

}