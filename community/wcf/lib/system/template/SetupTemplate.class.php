<?php
// wcf imports
if (!defined('NO_IMPORTS')) {
	require_once(WCF_DIR.'lib/system/template/Template.class.php');
	require_once(WCF_DIR.'lib/system/template/TemplateCompiler.class.php');
}

/**
 * SetupTemplate loads and displays template in the setup process.
 * 
 * @author 	Marcel Werk
 * @copyright	2001-2009 WoltLab GmbH
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package	com.woltlab.wcf
 * @subpackage	system.template
 * @category 	Community Framework
 */
class SetupTemplate extends Template {
	protected $templatePath = '';
	
	/**
	 * @see Template::setTemplatePaths()
	 */
	public function setTemplatePaths($templatePaths) {
		if (is_array($templatePaths)) $this->templatePath = array_shift($templatePaths);
		else $this->templatePath = $templatePaths;
	}
	
	/**
	 * @see Template::loadTemplateStructure()
	 */
	protected function loadTemplateStructure() {}
	
	/**
	 * @see Template::getSourceFilename()
	 */
	public function getSourceFilename($templateName, $packageID = 0) {
		return $this->templatePath.TMP_FILE_PREFIX.$templateName.'.tpl';
	}
	
	/**
	 * @see Template::getCompiledFilename()
	 */
	public function getCompiledFilename($templateName, $packageID = 0) {
		return $this->compileDir.TMP_FILE_PREFIX.$this->languageID.'_'.$templateName.'.php';
	}
	
	/**
	 * @see Template::getPluginFilename()
	 */
	public function getPluginFilename($type, $tag) {
		return $this->pluginDir.TMP_FILE_PREFIX.'TemplatePlugin'.StringUtil::firstCharToUpperCase(StringUtil::toLowerCase($type)).StringUtil::firstCharToUpperCase(StringUtil::toLowerCase($tag)).'.class.php';
	}
	
	/**
	 * @see Template::getCompiler()
	 */
	protected function getCompiler() {
		return new TemplateCompiler($this);
	}
}
?>