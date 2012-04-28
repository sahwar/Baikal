<?php

$sDir = realpath(dirname(__FILE__)) . "/";
require_once($sDir . "TabulatorColumn.php");
require_once($sDir . "Tabulator.php");

class TabulatorColumnHtml extends TabulatorColumn {
	
	protected function wrap($sString) {
		return $this->htmlWrap($sString, "td");
	}
	
	protected function wrapHeader($sString) {
		return $this->htmlWrap($sString, "th");
	}
	
	protected function htmlWrap($sString, $sTag) {
		if(in_array($this->getType(), array("numeric", "duration"))) {
			$sAlign = "right";
		} else {
			$sAlign = "left";
		}
		
		return "<" . $sTag . " class=\"col-" . $this->getName() . " align-" . $sAlign . "\">" . $sString . "</" . $sTag . ">";
	}
	
	public function renderUnderline() {
		return $this->wrap(str_repeat("-", $this->iLen));
	}
}

class TabulatorHtml extends Tabulator {
	
	private $sCssClass = FALSE;
	
	public function __construct($sCssClass = FALSE) {
		$this->sCssClass = $sCssClass;
	}
	
	public function getSep() {
		return "";
	}
		
	protected function wrapHeaders($sHeaders) {
		return "<tr class=\"headers\">" . $sHeaders . "</tr>";
	}
	
	protected function wrapValues($sValues, $iRowNum) {
		$sClass = (($iRowNum % 2) === 0) ? "even" : "odd"; 
		return "<tr class=\"values " . $sClass . "\">" . $sValues . "</tr>";
	}
	
	function renderOpen() {
		$sClass = "tabulator";
		
		if($this->sCssClass !== FALSE) {
			$sClass .= " " . trim($this->sCssClass);
		}
		
		return "<table class=\"{$sClass}\">";
	}
	
	function renderClose() {
		return "</table>";
	}
	
	public function repeatHeadersEvery() {
		return 30;
	}
}
