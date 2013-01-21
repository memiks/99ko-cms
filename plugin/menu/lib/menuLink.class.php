<?php

class menuLink {
	private $id;
	private $label;
	private $url;
	private $target;
	private $plugin;
	
	public function __construct($id = -1) {
		$this->id = $id;

		if ($this->id == -1) {
			$this->label = '';
			$this->url = '';
			$this->target = '_self';
			$this->plugin = '';
		} else {
			$link = utilReadJsonFile(MENU_LINKS.$id.'.json');

			$this->label = $link['label'];
			$this->url = $link['url'];
			$this->target = $link['target'];
			$this->plugin = $link['plugin'];
		}
	}
	
	public function getId() {
		return $this->id;
	}

	public function getLabel() {
		return $this->label;
	}

	public function getUrl() {
		return $this->url;
	}

	public function getTarget() {
		return $this->target;
	}

	public function getPlugin() {
		return $this->plugin;
	}
	
	public function setLabel($label) {
		$this->label = trim($label);
	}

	public function setUrl($url) {
		$this->url = trim($url);
	}

	public function setTarget($target) {
		$this->target = trim($target);
	}

	public function setPlugin($plugin) {
		$this->plugin = trim($plugin);
	}
	
	public function save() {
		$link = array(
			'label' => $this->label,
			'url' => $this->url,
			'target' => $this->target,
			'plugin' => $this->plugin
		);
		
		if ($this->id == -1) {
			$index = utilReadJsonFile(MENU_LINKS.'index.json');
			$this->id = $index['current'];
			$index['current'] += 1;
			utilWriteJsonFile(MENU_LINKS.'index.json', $index);
		}
		
		return utilWriteJsonFile(MENU_LINKS.$this->id.'.json', $link);
	}
}

?>
