<?php
if(!defined('ROOT')) die();

$action = (isset($urlParams[0]) && !is_numeric($urlParams[0])) ? $urlParams[0] : '';

switch($action){
	case '':
	case 'archives':
		// Mode d'affichage
		$mode = 'list';
		// Détermination de la page courante
		if($urlParams[0] == '') $currentPage = 1;
		elseif($urlParams[0] == 'archives' && !isset($urlParams[2])) $currentPage = 1;
		elseif($urlParams[0] == 'archives' && isset($urlParams[2])) $currentPage = $urlParams[2];
		else $currentPage = $urlParams[0];
		// Contruction de la pagination
		$nbNews = count($newsManager->getItems()); 
		$newsByPage = $runPlugin->getConfigVal('itemsByPage');
		$nbPages = ceil($nbNews/$newsByPage);
		$start = $currentPage*$nbPages-1;
		$end = $start+$newsByPage-1;
		for($i=0;$i!=$nbPages;$i++){
			if($urlParams[0] == 'archives'){
				if($i != 0) $pagination[$i]['url'] = rewriteUrl('news', array('action' => 'archives', 'year' => $urlParams[1], 'page' => $i+1));
				else $pagination[$i]['url'] = rewriteUrl('news', array('action' => 'archives', 'year' => $urlParams[1]));
			}
			else{
				if($i != 0) $pagination[$i]['url'] = rewriteUrl('news', array('page' => $i+1));
				else $pagination[$i]['url'] = rewriteUrl('news');
			}
			$pagination[$i]['num'] = $i+1;
		}
		// Récupération des news
		$news = array();
		$i = 1;
		foreach($newsManager->getItems() as $k=>$v){
			$date = $v->getDate();
			if((isset($_GET['year']) && $_GET['year'] == substr($date, 0, 4)) || !isset($_GET['year'])){
				if($i >= $start && $i <= $end){
					$news[$k]['name'] = $v->getName();
					$news[$k]['date'] = utilFormatDate($date, 'en', 'fr');
					$news[$k]['id'] = $v->getId();
					$news[$k]['content'] = $v->getContent();
					$news[$k]['url'] = rewriteUrl('news', array('action' => 'read', 'name' => utilStrToUrl($v->getName()), 'id' => $v->getId()));
				}
				$i++;
			}
		}
		// Traitements divers : métas, fil d'ariane...
		if($urlParams[0] != 'archives' && $currentPage < 1) $runPlugin->initBreadcrumb();
		elseif($urlParams[0] != 'archives' && $currentPage > 1) $runPlugin->addToBreadcrumb('Page '.$currentPage, rewriteUrl('news', array('page' => $currentPage)));
		$runPlugin->setMainTitle($pluginsManager->getPlugin('news')->getConfigVal('label'));
		if(isset($urlParams[0]) && $urlParams[0] == 'archives'){
			$runPlugin->addToBreadcrumb($urlParams[1], rewriteUrl('news', array('action' => 'archives', 'year' => $urlParams[1])));
			$runPlugin->setTitleTag($pluginsManager->getPlugin('news')->getConfigVal('label').' : archives '.$urlParams[1].', page '.$currentPage);
			$runPlugin->setMainTitle('Archives '.$urlParams[1]);
			if($currentPage > 1) $runPlugin->addToBreadcrumb('Page '.$currentPage, rewriteUrl('news', array('action' => 'archives', 'year' => $urlParams[1], 'page' => $currentPage)));
		}
		else $runPlugin->setTitleTag($pluginsManager->getPlugin('news')->getConfigVal('label').' : page '.$currentPage);
		break;
	case 'read':
		// Mode d'affichage
		$mode = 'read';
		// Récupération de la news
		$item = $newsManager->create($urlParams[2]);
		$news['name'] = $item->getName();
		$news['date'] = utilFormatDate($item->getDate(), 'en', 'fr');
		$news['id'] = $item->getId();
		$news['content'] = $item->getContent();
		// Traitements divers : métas, fil d'ariane...
		$runPlugin->setMainTitle($item->getName());
		$runPlugin->addToBreadcrumb($item->getName(), rewriteUrl('news', array('action' => 'read', 'name' => utilStrToUrl($item->getName()), 'id' => $item->getId())));
		$runPlugin->setTitleTag($pluginsManager->getPlugin('news')->getConfigVal('label').' : '.$item->getName());
		break;
}
?>