<?php
class manager{
    
    private $articles;
    private $menuItems;
    private $configItems;
    private $plugins;
    private $langs;
    
    public function __construct(){
        // chargement des plugins
        $dir = utilScanDir('plugin/');
        foreach($dir['dir'] as $file){
            include_once('plugin/'.$file.'/'.$file.'.php');
            $plugin = new plugin();
            $plugin->set('id', $file);
			$plugin->install();
            $temp = $plugin->getConfigArray();
            $plugin->set('name', $temp['name']);
            $plugin->set('version', $temp['version']);
            $plugin->set('author', $temp['author']);
            $plugin->set('priority', $temp['priority']);
            $this->plugins[] = $plugin;
        }
        // chargement des articles
        $this->articles = array();
        $dir = utilScanDir('data/article/');
        foreach($dir['file'] as $file){
            $temp = utilReadJsonFile('data/article/'.$file);
            $article = new article();
            $article->set('id', $temp['id']);
            $article->set('name', $temp['name']);
            $article->set('content', $temp['content']);
            $article->set('date', $temp['date']);
            $article->set('type', $temp['type']);
            $article->set('homepage', $temp['homepage']);
            $this->articles[] = $article;
        }
        // chargement des items menu
        $this->menuItems = array();
        $dir = utilScanDir('data/menu/');
        foreach($dir['file'] as $file){
            $temp = utilReadJsonFile('data/menu/'.$file);
            $item = new menuItem();
            $item->set('id',$temp['id']);
            $item->set('name', $temp['name']);
            $item->set('idParent', $temp['idParent']);
            $item->set('url', $temp['url']);
            $item->set('position', $temp['position']);
            $this->menuItems[] = $item;
        }
        // chargement des items config
        $this->configItems = array();
        $temp = utilReadJsonFile('data/core.json');
        foreach($temp as $k=>$v){
            $item = new configItem();
            $item->set('key', $k);
            $item->set('val', $v);
            $this->configItems[] = $item;
        }
        // chargement des fichiers langue core
        // todo : gestion des langues a revoir ?
        $this->langs = array();
        $dir = utilScanDir('core/lang/');
        foreach($dir['file'] as $file){
            $temp = utilReadJsonFile('core/lang/'.$file);
            $k = substr($file, 0, 2);
            $this->langs[$k] = $temp;
        }
		// chargement des fichiers langue plugins
		foreach($this->plugins as $plugin){
			$dir = utilScanDir('plugin/'.$plugin->get('id').'/lang/');
			foreach($dir['file'] as $file){
				$temp = utilReadJsonFile('plugin/'.$plugin->get('id').'/lang/'.$file);
				$k = substr($file, 0, 2);
				// merge
				$this->langs[$k] = array_merge($this->langs[$k], $temp);
			}
		}
        $_SESSION['lang'] = $this->langs[$k];
        // hook
        eval(callHook('managerConstruct'));
    }
    
    // retourne la version du core
    public function getVersion(){
        return file_get_contents('core/version');
    }
    
    // liste les langues
    // todo : renommer en listLangsArray ?
    public function listLangs(){
        $langs = $this->langs;
        return $langs;
    }
    
    // retourne une valeur de configuration
    // todo renommer en getConfigValue ?
    public function getConfigItem($key){
        foreach($this->configItems as $item){
            if($key == $item->get('key')) break;
        }
        return $item->get('val');
    }
    
    // sauvegarde une valeur de configuration
    public function saveConfigItem($newItem){
        $data = array();
        foreach($this->configItems as $k=>$item){
            if($newItem->get('key') == $item->get('key')){
                $item = $newItem;
                // mise a jour du tableau d'items courant
                $this->configItems[$k] = $item;
            }
            $data[$item->get('key')] = $item->get('val');
        }
        utilWriteJsonFile('data/core.json', $data);
    }
    
    // liste les plugins
    public function listPlugins($activateOnly = false){
        foreach($this->plugins as $k=>$plugin){
            if($activateOnly && $plugin->get('activate') == 0) unset($this->plugins[$k]);
        }
        return $this->plugins;
    }
    
    // retourne un plugin
    public function getPlugin($id){
        foreach($this->listPlugins() as $plugin){
            if($plugin->get('id') == $id) break;
        }
        return $article;
    }
    
    // liste les articles
    public function listArticles($byType = false){
        foreach($this->articles as $k=>$article){
            if($byType && $byType != $article->get('type')) unset($this->articles[$k]);
        }
        return $this->articles;
    }
    
    // retourne un article
    public function getArticle($id){
        foreach($this->listArticles() as $article){
            if($article->get('id') == $id) break;
        }
        return $article;
    }
    
    // retourne l'article defini comme page d'accueil
    public function getArticleHomepage(){
        foreach($this->listArticles() as $article){
            if($article->get('homepage')) break;
        }
        return $article;
    }
    
    // liste les items menu
    public function listMenuItems(){
        $items = $this->menuItems;
        return $items;
    }
    
    // retourne un item menu
    public function getMenuItem($id){
        foreach($this->listMenuItems() as $item){
            if($item->get('id') == $id) break;
        }
        return $item;
    }
    
    // genere le menu HTML
    public function menuHtml(){
        $items = $this->listMenuItems();
        $data = "<ul>";
        foreach($items as $item){
            if($item->get('idParent') == 0) $data.= '<li><a href="'.$item->get('url').'">'.$item->get('name').'</a></li>';
            $i = 0;
            foreach($items as $k2=>$item2) if($item->get('idParent') == $item2->get('id')){
                if($i == 0) $data.= '<ul>';
                $data.= '<li><a href="'.$item->get('url').'">'.$item->get('name').'</a></li>';
                $i++;
            }
            if($i > 0) $data.= '</ul>';
        }
        $data.= "</ul>";
        return $data;
    }
    
    // cree les fichiers necessaires
    public function install(){
        mkdir('data/');
        mkdir('data/article/');
        mkdir('data/menu/');
		mkdir('data/plugin/');
        $config = array(
            'name' => 'Démo',
            'theme' => 'default',
            'url' => getSiteUrl(),
            'lang' => 'fr',
        );
        utilWriteJsonFile('data/core.json', $config);
        $time = time();
        $article = array(
            'id' => $time,
            'name' => 'article 1',
            'content' => '<p>Sed quid est quod in hac causa maxime homines admirentur et reprehendant meum consilium, cum ego idem antea multa decreverim, que magis ad hominis dignitatem quam ad rei publicae necessitatem pertinerent? Supplicationem quindecim dierum decrevi sententia mea. Rei publicae satis erat tot dierum quot C. Mario ; dis immortalibus non erat exigua eadem gratulatio quae ex maximis bellis. Ergo ille cumulus dierum hominis est dignitati tributus.</p>',
            'date' => date('Y-m-d H:i:s'),
            'type' => 'page',
            'homepage' => 1
        );
        utilWriteJsonFile('data/article/'.$time.'.json', $article);
        sleep(1);
        $time2 = time();
        $menu = array(
            'id' => $time2,
            'name' => 'lien 1',
            'url' => '?article='.$time,
            'position' => 1,
            'idParent' => 0
        );
        utilWriteJsonFile('data/menu/'.$time2.'.json', $menu);
        sleep(1);
        $time = time();
        $article = array(
            'id' => $time,
            'name' => 'article 2',
            'content' => '<p>Quare hoc quidem praeceptum, cuiuscumque est, ad tollendam amicitiam valet; illud potius praecipiendum fuit, ut eam diligentiam adhiberemus in amicitiis comparandis, ut ne quando amare inciperemus eum, quem aliquando odisse possemus. Quin etiam si minus felices in diligendo fuissemus, ferendum id Scipio potius quam inimicitiarum tempus cogitandum putabat.</p>',
            'date' => date('Y-m-d H:i:s'),
            'type' => 'page',
            'homepage' => 0
        );
        utilWriteJsonFile('data/article/'.$time.'.json', $article);
        sleep(1);
        $time2 = time();
        $menu = array(
            'id' => $time2,
            'name' => 'lien 2',
            'url' => 'javascript:',
            'position' => 2,
            'idParent' => 0
        );
        utilWriteJsonFile('data/menu/'.$time2.'.json', $menu);
        sleep(1);
        $time3 = time();
        $menu = array(
            'id' => $time3,
            'name' => 'lien 3',
            'url' => '?article='.$time,
            'position' => 1,
            'idParent' => $time2
        );
        utilWriteJsonFile('data/menu/'.$time3.'.json', $menu);
        sleep(1);
        $time = time();
        $menu = array(
            'id' => $time,
            'name' => 'lien 4',
            'url' => '?news',
            'idArticle' => '',
            'position' => 3,
            'idParent' => 0
        );
        utilWriteJsonFile('data/menu/'.$time.'.json', $menu);
        sleep(1);
        $time = time();
        $article = array(
            'id' => $time,
            'name' => 'article 3',
            'content' => '<p>Tu autem, Fanni, quod mihi tantum tribui dicis quantum ego nec adgnosco nec postulo, facis amice; sed, ut mihi videris, non recte iudicas de Catone; aut enim nemo, quod quidem magis credo, aut si quisquam, ille sapiens fuit. Quo modo, ut alia omittam, mortem filii tulit! memineram Paulum, videram Galum, sed hi in pueris, Cato in perfecto et spectato viro.</p>',
            'date' => date('Y-m-d H:i:s'),
            'type' => 'news',
            'homepage' => 0
        );
        utilWriteJsonFile('data/article/'.$time.'.json', $article);
        sleep(1);
        $time = time();
        $article = array(
            'id' => $time,
            'name' => 'article 4',
            'content' => '<p><p>Accedebant enim eius asperitati, ubi inminuta vel laesa amplitudo imperii dicebatur, et iracundae suspicionum quantitati proximorum cruentae blanditiae exaggerantium incidentia et dolere inpendio simulantium, si principis periclitetur vita, a cuius salute velut filo pendere statum orbis terrarum fictis vocibus exclamabant.</p>',
            'date' => date('Y-m-d H:i:s'),
            'type' => 'news',
            'homepage' => 0
        );
        utilWriteJsonFile('data/article/'.$time.'.json', $article);
    }
    
}
?>