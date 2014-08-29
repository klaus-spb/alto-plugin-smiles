<?php
/* ---------------------------------------------------------------------------
 * @Project: Alto CMS
 * @Plugin Name: Smiles
 * @Author: Klaus
 * @License: GNU GPL v2 & MIT
 *----------------------------------------------------------------------------
 */

class PluginSmiles_HookSmiles extends Hook {

	public function RegisterHook() {

		$this->AddHook('template_form_add_comment_end','DisableSmiles');
		$this->AddHook('template_form_add_topic_end','DisableSmiles');
		$this->AddHook('template_form_add_talk_end','DisableSmiles');
		
	}
	
	public function DisableSmiles() {
		$oViewer = $this->Viewer_GetLocalViewer();
		return $oViewer->Fetch(	Plugin::GetTemplateDir(__CLASS__).'tpls/disable_smiles.tpl');
	}
	
}
?>