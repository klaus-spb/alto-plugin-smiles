<?php
/* ---------------------------------------------------------------------------
 * @Project: Alto CMS
 * @Plugin Name: Smiles
 * @Author: Klaus
 * @License: GNU GPL v2 & MIT
 *----------------------------------------------------------------------------
 */
 
class PluginSmiles_ActionAjax extends PluginSmiles_Inherits_ActionAjax {	
	
	
	public function Init() {
		parent::Init();
	}
	
	protected function RegisterEvent() {
		parent::RegisterEvent();
		$this->AddEventPreg('/^get$/i','/^smiles$/','EventGetSmiles');
	}
	
	protected function EventGetSmiles() {
	
		$aSmiles = $this->PluginSmiles_Smiles_SmilesArray();		
		$this->Viewer_AssignAjax('aSmiles',	$aSmiles);
		
	}

}
?>