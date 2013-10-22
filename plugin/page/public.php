<?php
if(!defined('ROOT')) die();
$id = (isset($urlParams[1])) ? $urlParams[1] : false;
if(!$id) $pageItem = $page->createHomepage();
elseif($pageItem = $page->create($id)){}
else error404();
if($runPlugin->getConfigVal('hideTitles')) $runPlugin->setMainTitle('');
else $runPlugin->setMainTitle(($pageItem->getMainTitle() != '') ? $pageItem->getMainTitle() : $pageItem->getName());
if($pageItem->getMetaDescriptionTag() != '') $runPlugin->setMetaDescriptionTag($pageItem->getMetaDescriptionTag());
elseif($pageItem->getMetaDescriptionTag() == '' && $pageItem->getIsHomepage() && $runPlugin->getIsDefaultPlugin()) $runPlugin->setMetaDescriptionTag($coreConf['siteDescription']);
$pageTitleTag = $pageItem->getName();
if($pageItem->getMainTitle() != '') $pageTitleTag.= ' | '.$pageItem->getMainTitle();
$runPlugin->setTitleTag($pageTitleTag);
$runPlugin->removeToBreadcrumb(0);
$runPlugin->addToBreadcrumb($pageItem->getName(), rewriteUrl('page', array('name' => $pageItem->getName(), 'id' => $pageItem->getId())));
if($runPlugin->getIsDefaultPlugin() && $pageItem->getIsHomepage()) $runPlugin->initBreadcrumb();
$data['pageId'] = $pageItem->getId();
$data['pageName'] = $pageItem->getName();
$data['pageContent'] = $pageItem->getContent();
$data['pageFile'] = ($pageItem->getFile()) ? ROOT.'theme/'.getCoreConf('theme').'/'.$pageItem->getFile() : false;
?>