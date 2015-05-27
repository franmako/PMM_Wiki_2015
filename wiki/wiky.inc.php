<?php
/* Wiky.php - A tiny PHP "library" to convert Wiki Markup language to HTML
 * Author: Toni Lähdekorpi <toni@lygon.net>
 *
 * Code usage under any of these licenses:
 * Apache License 2.0, http://www.apache.org/licenses/LICENSE-2.0
 * Mozilla Public License 1.1, http://www.mozilla.org/MPL/1.1/
 * GNU Lesser General Public License 3.0, http://www.gnu.org/licenses/lgpl-3.0.html
 * GNU General Public License 2.0, http://www.gnu.org/licenses/gpl-2.0.html
 * Creative Commons Attribution 3.0 Unported License, http://creativecommons.org/licenses/by/3.0/
 */
class wiky {
	private $patterns, $replacements;
	public function __construct($analyze=false) {
		$this->patterns=array(
			
			// Headings
			"/\[1\|(.*?)\]/",						// Subsubheading
			"/\[2\|(.*?)\]/",						// Subheading
			"/\[3\|(.*?)\]/",						// Heading
	
			// Formatting
			"/\[b\|(.*?)\]/",						// Bold
			"/\[i\|(.*?)\]/",						// Italic
	
			// Special
			"/\[img\|(.*?)\|(.*?)\]/",	// (File|img):(http|https|ftp) aka image
			"/\[a\|(.*?)\|(.*?)\]/",		// Other urls with text
			"/\[a\|(.*?)\|(.*?)\]/",			// Other urls without text
		);
		$this->replacements=array(
			
			// Headings
			"<h1>$1</h1>",
			"<h2>$1</h2>",
			"<h3>$1</h3>",
	
			//Formatting
			"<strong>$1</strong>",
			"<em>$1</em>",
	
			// Special
			"<img src=\"$2\" alt=\"$6\"/>",
			"<a href=\"$1\">$7</a>",
			"<a href=\"$1\">$1</a>",
	
		);
		if($analyze) {
			foreach($this->patterns as $k=>$v) {
				$this->patterns[$k].="S";
			}
		}
	}
	public function parse($input) {
		if(!empty($input))
			$output=preg_replace($this->patterns,$this->replacements,$input);
		else
			$output=false;
		return $output;
	}
}