<?php
/* ---------------------------------------------------------------------------
 * @Project: Alto CMS
 * @Plugin Name: Smiles
 * @Author: Klaus
 * @License: GNU GPL v2 & MIT
 *----------------------------------------------------------------------------
 */


class PluginSmiles_ModuleSmiles extends Module{

	public function Init() {
	
	}
	
	public function SmilesArray() {

		foreach (Config::Get('plugin.smiles.smiles_array') as $img => $texts) {
			if(!is_array($texts)) $texts = array($texts);
			$img_url = F::File_Dir2Url(Config::Get('plugin.smiles.smiles_dir').$img);
			$aSmiles[] = array(
				'src'	=> $img_url,
				'list'	=> $texts,
			);
		}
		
		return $aSmiles;
	}

	public function Replace($sText)	{

		foreach (Config::Get('plugin.smiles.smiles_array') as $img => $texts) {
		
			if(!is_array($texts)) $texts = array($texts);
			$img_url = F::File_Dir2Url(Config::Get('plugin.smiles.smiles_dir').$img);
			
			foreach($texts as $text){
				$smiles_preg[] = '#(?<=\s|^)(' . preg_quote($text, '/') .')(?=\s|$)#';
				$smiles_masked = htmlspecialchars(trim($text), ENT_QUOTES);
				$smiles_text[] = ' <img src="'. $img_url. '"  alt="'. $smiles_masked. '" title="'. $smiles_masked. '"/> ';
			}
		}

		$textarr = preg_split("/(<.*>)/U", $sText, -1, PREG_SPLIT_DELIM_CAPTURE);
		$sText = '';
		
		for ($i = 0; $i < count($textarr); $i++) {
			$content = $textarr[$i];
			if ((strlen($content) > 0) && ('<' != $content{0})) 
			{ 
				$content = preg_replace($smiles_preg, $smiles_text, $content);
			}
			$sText .= $content;
		}
		return $sText;
	}
}

?>