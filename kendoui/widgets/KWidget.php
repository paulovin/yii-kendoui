<?php
/**
 * Classe básica com os dados emétodos mais elementares usados pelo KendoUI.
 */
class KWidget extends CWidget {

	/**
	 * Diretório com estilos CSS.
	 */
	const CSS_DIR = 'css';
	/**
	 * Diretório com imagens.
	 */
	const IMAGES_DIR = 'images';
	/**
	 * Diretório com scripts JS.
	 */
	const JS_DIR = 'js';
	/**
	 * Opções HTML para a renderização do widget.
	 */
	public $htmlOptions;
	/**
	 * Widget height (may not apply to all cases).
	 */
	public $height;
	/**
	 * Widget width.
	 */
	public $width;
	/**
	 * Diretório dos 'assets' dos widgets.
	 */
	protected $assetsDir;
	/**
	 * URL onde os assets do módulo são publicados.
	 */
	private $_assetsUrl;
	
	/**
	 * Sobrecarga do construtor para inicializar o diretório de assets.
	 */
	public function __construct($owner = null) {
		parent::__construct($owner);
		$this->assetsDir = dirname(__FILE__) . '/../assets/';
		$htmlOptions = array();
	}
	
	/**
	 * Retorna a URL de publicação dos assets do módulo.
	 */
	public function getAssetsUrl() {
		if ($this->_assetsUrl === null){
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish($this->assetsDir);
		}
        return $this->_assetsUrl;
	}
	
	/**
	 * Carrega os 'assets' essenciais para o uso dos widgets do KendoUI.
	 */
	protected function loadBaseAssets()
	{
		// Estilos CSS:
		$this->loadCss('kendo.default.min.css');
		$this->loadCss('kendo.common.min.css');
		// Scripts JS:
		$cs = Yii::app()->getClientScript();
		$cs->registerCoreScript('jquery');
		$this->loadJs('kendo.web.min.js');
	}

	/**
	 * Registra um arquivo CSS para uso pelo widget.
	 */
	protected function loadCss($name) {
		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile($this->getAssetsUrl() . '/' . self::CSS_DIR . '/' . $name);
	}
	
	/**
	 * Publica um arquivo de imagem para uso pelo widget.
	 */
	protected function loadImage($name) {
		Yii::app()->assetManager->publish($this->assetsDir . self::IMAGES_DIR . '/' . $name);
	}
	
	/**
	 * Registra um arquivo .js para uso pelo widget.
	 */
	protected function loadJs($name) {
		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile($this->getAssetsUrl() . '/' . self::JS_DIR . '/' . $name);
	}
	
	/**
	 * Adds an option to a configuration array.
	 * 
	 * @param $config array bening populated (must pass by value)
	 * @param $name the key used in the configuration
	 * @param $value value being put into the array
	 */
	protected function addOption($config, $name, $value) {
		$ok = $value != null || ($value != null && is_array($value) && count($value) > 0);
		
		if ($ok) {
			$config[$name] = $value;
		}
	}
	
	/**
	 * Adds the basic config options to the widget's configuration array.
	 * 
	 * @param $config array bening populated (must pass by value)
	 */
	protected function addBasicOptions($config) {
		$this->addOption(&$config, 'height', $this->height);
		$this->addOption(&$config, 'width', $this->width);
	}
	
}
