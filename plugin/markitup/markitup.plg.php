<?php
/**
 * Plugin markItUp!
 *
 * @version 0.1
 * @date	04/01/2012
 * @author	Frédéric K.
/*
** Fichier Langue du plugin
*/
require 'plugin/' .$plugin. '/lang/' .$config['lang']. '.lng.php';
 // On pré-installe les paramètres par défauts.
if(!isValidEntry('plugin', $plugin))
{
      $data[$plugin.'state']      ='off';       
      saveEntry('plugin', $plugin, $data);
} 
// Admin
function markitup_config()
{   
       $plugin = 'markitup';
       $out ='';
       global $lang;
       if(check('submit'))
       {
               $data[$plugin.'state'] = clean($_POST['state']); 
               saveEntry('plugin', $plugin, $data);
               $out .= '<div class="alert alert-success"><h4 class="alert-heading">' .$lang['data_save']. '</h4><br />
               <p><a class="btn" href="config.php/plugin/'.$plugin.'">' .$lang['redirect']. '&nbsp;' .$plugin.'</a></p></div>';
       }
       else
       {
               if (isValidEntry('plugin', $plugin))
               $data = readEntry('plugin', $plugin);
               $out .= form('config.php/plugin/'.$plugin, 'well',
               select('state', array('on'=> $lang['state_on'], 'off'=> $lang['state_off']), $data[$plugin.'state']).
               submit());
       }
       return $out;
}

function markitup_head()
{
         $plugin = 'markitup';
         $out ='';
         global $lang;
         //load config
         $config = readEntry('config', 'config');
         # Lecture des données
         $data = readEntry('plugin', $plugin);
         if ($data[$plugin.'state']=='on') 
           { 
           $out .= '<!-- markItUp! -->
                    <script type="text/javascript" src="plugin/'.$plugin.'/jquery.markitup.js"></script>
                    <!-- markItUp! toolbar settings -->
                    <script type="text/javascript" src="plugin/'.$plugin.'/sets/bbcode/set.js"></script>
                    <!-- markItUp! skin -->
                    <link rel="stylesheet" type="text/css" href="plugin/'.$plugin.'/skins/simple/style.css" />
                    <!--  markItUp! toolbar skin -->
                    <link rel="stylesheet" type="text/css" href="plugin/'.$plugin.'/sets/bbcode/style.css" />
                    <script type="text/javascript">
                    $(document).ready(function()	{
                        $("textarea").markItUp(myBbcodeSettings);
                        $("#emoticons a").click(function() {
                            emoticon = $(this).attr("title");
                            $.markItUp( { replaceWith:emoticon } );
                        });
                    });
                    </script>';
           return $out;
         } 
         else 
         { 
        // return '<!-- markItUp! Disabled -->'; 
         }  
}

function markitup_bbcode($text) 
{ 
            $plugin = 'markitup';
            # Lecture des données
            $data = readEntry('plugin', $plugin);
            if ($data[$plugin.'state']=='on') 
            {             
            global $pattern, $replace;
			$pattern = array('#\[color=([a-zA-Z]*|\#?[0-9a-fA-F]{6})](.+)\[/color\]#Usi',
					         '/\[size\="?(.*?)"?\](.*?)\[\/size\]/ms',
					         '/\[list\=(.*?)\](.*?)\[\/list\]/ms',
					         '/\[list\](.*?)\[\/list\]/ms',
					         '/\[\*\]\s?(.*?)\n/ms',
							 '#\[email]([\w\.\-]+@[a-zA-Z0-9\-]+\.?[a-zA-Z0-9\-]*\.\w{1,4})\[/email]#Usi',
							 '#\[url](.+)\[/url]#Usi',
							 '#\[email=([\w\.\-]+@[a-zA-Z0-9\-]+\.?[a-zA-Z0-9\-]*\.\w{1,4})](.+)\[/email]#Usi',
							 '#\[url=(.+)](.+)\[/url\]#Usi',
							 '#\[urloff](.+)\[/urloff]#Usi',
							 '#\[urloff=(.+)\](.+)\[/urloff\]#Usi',
							 '#\[img](.+)\[/img]#Usi',
							 '#\[img=(.+)](.+)\[/img]#Usi',
							 '#\[code](\r\n)?(.+?)(\r\n)?\[/code]#si',
							 '#\[youtube]http://[a-z]{0,3}.youtube.com/watch\?v=([0-9a-zA-Z]{1,11})\[/youtube]#Usi',
							 '#\[youtube]([0-9a-zA-Z]{1,11})\[/youtube]#Usi',
							 '#\[dmmedium]([0-9a-zA-Z]{1,20})\[/dmmedium]#Usi',
							 '#\[dmsmall]([0-9a-zA-Z]{1,20})\[/dmsmall]#Usi',
							 '#\[vimeo]http://www.vimeo.com/([0-9]{1,10})\[/vimeo]#Usi',
							 '#\[vimeo]([0-9]{1,10})\[/vimeo]#Usi',
							 );

			$replace = array('<span style="color: $1">$2</span>',
			                 '<span style="font-size:\1%">\2</span>',
					         '<ol start="\1">\2</ol>',
					         '<ul>\1</ul>',
					         '<li>\1</li>',							 
							 '<a href="mailto: $1">$1</a>',
							 '<a href="$1">$1</a>',
							 '<a href="mailto: $1">$2</a>',
							 '<a href="$1">$2</a>',
							 '<a href="$1" target="_blank">$1</a>',
							 '<a href="$1" target="_blank">$2</a>',
							 '<img class="img" src="$1" alt="$1" />',
							 '<img class="img" src="$1" alt="$2" />',
							 '<div class="code">$2</div>',
							 '<object type="application/x-shockwave-flash" style="width: 450px; height: 366px;" data="http://www.youtube.com/v/$1"><param name="movie" value="http://www.youtube.com/v/$1" /><param name="wmode" value="transparent" /></object>',
							 '<object type="application/x-shockwave-flash" style="width: 450px; height: 366px;" data="http://www.youtube.com/v/$1"><param name="movie" value="http://www.youtube.com/v/$1" /><param name="wmode" value="transparent" /></object>',
							 '<object type="application/x-shockwave-flash" style="width: 420px; height: 365px;" data="http://dailymotion.alice.it/swf/$1"><param name="movie" value="http://dailymotion.alice.it/swf/$1" /><param name="allowScriptAccess" value="always" /></object>',
							 '<object type="application/x-shockwave-flash" style="width: 220px; height: 185px;" data="http://dailymotion.alice.it/swf/$1"><param name="movie" value="http://dailymotion.alice.it/swf/$1" /><param name="allowScriptAccess" value="always" /></object>',
							 '<object type="application/x-shockwave-flash" style="width: 400px; height: 327px;" data="http://vimeo.com/moogaloop.swf?clip_id=$1"><param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=$1" /><param name="allowScriptAccess" value="always" /></object>',
							 '<object type="application/x-shockwave-flash" style="width: 400px; height: 327px;" data="http://vimeo.com/moogaloop.swf?clip_id=$1"><param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=$1" /><param name="allowScriptAccess" value="always" /></object>',
							 );
            
            } 
 
}	

?>