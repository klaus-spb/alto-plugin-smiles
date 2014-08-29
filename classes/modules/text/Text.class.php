<?php
/* ---------------------------------------------------------------------------
 * @Project: Alto CMS
 * @Plugin Name: Smiles
 * @Author: Klaus
 * @License: GNU GPL v2 & MIT
 *----------------------------------------------------------------------------
 */


class PluginSmiles_ModuleText extends PluginSmiles_Inherits_ModuleText {
    
	public function Parser($sText) {
        $sText = parent::Parser($sText);
		
		if(getRequest('disable_smiles', false, 'post')){
			return $sText;
		}
		
		$sText = $this->PluginSmiles_Smiles_Replace($sText);
        return $sText;
    }
	
}
?>