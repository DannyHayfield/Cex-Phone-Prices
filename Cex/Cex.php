<?php
class Cex {
	public function __construct() {
		$this->operators = array('unlocked','tmobile','vodafone','orange','3','o2','tesco','virgin','ee');
		$this->grades = array('A'=>'Mint','B'=>'Good','C'=>'Poor');
	}
	public function getPrice($url='') {
		if(!empty($url)) {
			if(strpos($url, 'webuy.com') !== false && strpos($url, 'mastersku=') !== false) {
				$this->pageSource = file_get_contents(urldecode($url));
				$this->productData = array();
				$this->productData['name'] = $this->getBetween($this->pageSource, '<h2>','</h2>');
				foreach($this->operators as $operator) {
					foreach($this->grades as $key => $value) {
						$this->productData['buy'][''.$operator.''][''.$value.''] = $this->getBetween($this->pageSource, 'grade'.$key.'_values["grade'.$key.'_'.$operator.'_cash"] = ',';');
						$this->productData['sell'][''.$operator.''][''.$value.''] = $this->getBetween($this->pageSource, 'grade'.$key.'_values["grade'.$key.'_'.$operator.'_sell"] = ',';');
					}
				}
			} else {
				$this->productData['error'] = "Invalid URL";
			}
			return $this->productData;
		}
		return false;
	}
	public function showForm() {
		echo "<div class=\"form-group\">
			<form method=\"get\" action=\"\">
				<div class=\"row\">
					<div class=\"col\">
						<input type=\"text\" name=\"url\" value=\"".urldecode($_REQUEST['url'])."\" placeholder=\"Enter CEX Phone URL\" class=\"form-control\" />
					</div>
					<div class=\"col\">
						<input type=\"submit\" value=\"Go\" class=\"btn btn-primary\" />
					</div>
				</div>
			</form>
		</div>";
		return true;
	}
	private function getBetween($string, $start, $end) {
		$string = ' ' . $string;
		$ini = strpos($string, $start);
		if ($ini == 0) return '';
		$ini += strlen($start);
		$len = strpos($string, $end, $ini) - $ini;
		return substr($string, $ini, $len);
	}
}
?>