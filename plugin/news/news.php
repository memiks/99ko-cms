<?php
if(!defined('ROOT')) die();

/*******************************************************************************************************
** Partie obligatoire
** Les fonctions ci-dessous sont obligatoires !
** Les fonctions ci-dessous doivent être nommées de cette façon : nomdupluginConfig, nomdupluginInfos...
*******************************************************************************************************/

/*
** Exécute du code lors de l'installation
** Le code présent dans cette fonction sera exécuté lors de l'installation
** Le contenu de cette fonction est facultatif
*/

function newsInstall(){
	$newsManager = new newsManager();
	if($newsManager->count() < 1){
		$news = new news();
		$news->setName('News 1');
		$news->setContent('<p>Atque, ut Tullius ait, ut etiam ferae fame monitae plerumque ad eum locum ubi aliquando pastae sunt revertuntur, ita homines instar turbinis degressi montibus impeditis et arduis loca petivere mari confinia, per quae viis latebrosis sese convallibusque occultantes cum appeterent noctes luna etiam tum cornuta ideoque nondum solido splendore fulgente nauticos observabant quos cum in somnum sentirent effusos per ancoralia, quadrupedo gradu repentes seseque suspensis passibus iniectantes in scaphas eisdem sensim nihil opinantibus adsistebant et incendente aviditate saevitiam ne cedentium quidem ulli parcendo obtruncatis omnibus merces opimas velut viles nullis repugnantibus avertebant. haecque non diu sunt perpetrata.</p>');
		$news->setDate(date('Y-m-d H:i:s'));
		$newsManager->saveNews($news);
	}
}

/********************************************************************************************************************
** Code relatif au plugin
** La partie ci-dessous est réservé au code du plugin 
** Elle peut contenir des classes, des fonctions, hooks... ou encore du code à exécutter lors du chargement du plugin
********************************************************************************************************************/

function newsGetSidebarContent(){
	global $newsManager;
	$output = '';
	foreach($newsManager->getNewsYears() as $k=>$v){
		if($k == 0) $output.= '<ul>';
		$year = substr($v, 0, 4);
		$output.= '<li><a href="'.rewriteUrl('news', array('action' => 'archives', 'year' => $year)).'">'.$year.'</a></li>';
	}
	if($output != '') $output.= '</ul>';
	return $output;
}

class newsManager{
	private $items;
	
	public function __construct(){
		$data = array();
		if(file_exists(ROOT.'data/plugin/news/news.json')){
			$temp = json_decode(@file_get_contents(ROOT.'data/plugin/news/news.json'), true);
			$temp = utilSort2DimArray($temp, 'date', 'desc');
			foreach($temp as $k=>$v){
				$data[] = new news($v);
			}
		}
		$this->items = $data;
	}
	
	public function getItems(){
		return $this->items;
	}
	
	public function create($id){
		foreach($this->items as $obj){
			if($obj->getId() == $id) return $obj;
		}
		return false;
	}
	
	public function saveNews($obj){
		$id = intval($obj->getId());
		if($id < 1){
			$obj->setId($this->makeId());
			$this->items[] = $obj;
		}
		else{
			foreach($this->items as $k=>$v){
				if($id == $v->getId()){
					$this->items[$k] = $obj;
				}
			}
		}
		return $this->save();
	}
	public function delNews($obj){
		foreach($this->items as $k=>$v){
			if($obj->getId() == $v->getId()){
				unset($this->items[$k]);
			}
		}
		return $this->save();
	}
	public function count(){
		return count($this->items);
	}
	
	public function getNewsYears(){
		$months = array();
		foreach($this->items as $k=>$v){
			$month = substr($v->getDate(), 0, 7);
			if(!in_array($month, $months)) $months[] = $month;
		}
		return $months;
	}
	
	private function makeId(){
		$ids = array(0);
		foreach($this->items as $obj){
			$ids[] = $obj->getId();
		}
		return max($ids)+1;
	}
	
	private function save(){
		$data = array();
		foreach($this->items as $k=>$v){
			$data[] = array(
				'id' => $v->getId(),
				'name' => $v->getName(),
				'content' => $v->getContent(),
				'date' => $v->getDate(),
			);
		}
		if(@file_put_contents(ROOT.'data/plugin/news/news.json', json_encode($data), 0666)){
			return true;
		}
		return false;
	}
}

class news{
	private $id;
	private $name;
	private $date;
	private $content;
	
	public function __construct($val = array()){
		if(count($val) > 0){
			$this->id = $val['id'];
			$this->name = $val['name'];
			$this->content = $val['content'];
			$this->date = $val['date'];
		}
	}
	
	public function setId($val){
		$this->id = intval($val);
	}
	public function setName($val){
		$val = trim($val);
		if($val == '') $val = "News sans nom";
		$this->name = $val;
	}
	public function setContent($val){
		$this->content = trim($val);
	}
	public function setDate($val){
		$val = trim($val);
		if($val == '') $val = date('Y-m-d H:i:s');
		$this->date = $val;
	}

	public function getId(){
		return $this->id;
	}
	public function getName(){
		return $this->name;
	}
	public function getContent(){
		return $this->content;
	}
	public function getDate(){
		return $this->date;
	}
}

$newsManager = new newsManager();
if($coreConf['defaultPlugin'] == 'news'){
	$pluginsManager->getPlugin('news')->addToNavigation($pluginsManager->getPlugin('news')->getConfigVal('label'), $coreConf['siteUrl']);
}
else $pluginsManager->getPlugin('news')->addToNavigation($pluginsManager->getPlugin('news')->getConfigVal('label'), rewriteUrl('news'));
?>