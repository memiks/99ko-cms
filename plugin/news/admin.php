<?php
if(!defined('ROOT')) die();

switch(ACTION){
	case 'saveconf':
		$runPlugin->setConfigVal('label', trim($_REQUEST['label']));
		$runPlugin->setConfigVal('sidebarTitle', trim($_REQUEST['sidebarTitle']));
		$runPlugin->setConfigVal('itemsByPage', trim(intval($_REQUEST['itemsByPage'])));
		$pluginsManager->savePluginConfig($runPlugin);
		header('location:index.php?p=news');
		die();
		break;
	case 'save':
		$news = ($_REQUEST['id']) ?  $newsManager->create($_REQUEST['id']) : new news();
		$news->setName($_REQUEST['name']);
		$news->setContent($_REQUEST['content']);
		$news->setDate($news->getDate());
		$newsManager->saveNews($news);
		header('location:index.php?p=news');
		die();
		break;
	case 'edit':
		$mode = 'edit';
		$news = (isset($_REQUEST['id'])) ?  $newsManager->create($_GET['id']) : new news();
		$news = array(
			'id' => $news->getId(),
			'name' => $news->getName(),
			'content' => $news->getContent(),
		);
		break;
	case 'del':
		$news = $newsManager->create($_REQUEST['id']);
		$newsManager->delNews($news);
		header('location:index.php?p=news');
		die();
		break;
	default:
		$mode = 'list';
		foreach($newsManager->getItems() as $k=>$v){
			$news[$k]['name'] = $v->getName();
			$news[$k]['date'] = $v->getDate();
			$news[$k]['action'] = '<a class="edit-btn" href="index.php?p=news&action=edit&id='.$v->getId().'">éditer</a> <a class="del-btn" href="index.php?p=news&action=del&id='.$v->getId().'&token='.$_SESSION['token'].'" onclick = "if(!confirm(\'Supprimer cet élément ?\')) return false;">supprimer</a>';
		}
		$cols = 'titre,date,action';
		$table = utilHtmlTable($cols, $news, 'class="table table-striped table-condensed"');
}

$label = $runPlugin->getConfigVal('label');
$sidebarTitle = $runPlugin->getConfigVal('sidebarTitle');
$itemsByPage = $runPlugin->getConfigVal('itemsByPage');
?>