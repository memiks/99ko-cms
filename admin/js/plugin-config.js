function openPluginConfig() {
	$('#pluginConfig').show(200);
	$('#pluginConfigButton').unbind('click', openPluginConfig);
	$('#pluginConfigButton').click(closePluginConfig);
}
function closePluginConfig() {
	$('#pluginConfig').hide(200);
	$('#pluginConfigButton').unbind('click', closePluginConfig);
	$('#pluginConfigButton').click(openPluginConfig);
}
$(document).ready(function () {
	$('#pluginConfigButton').click(openPluginConfig);
});
function updateHtaccess(rewriteBase){
	var checked = $('#urlRewriting').attr('checked');
	if(!checked) $('#htaccess').attr('value', 'Options -Indexes');
	else{
		var content = "Options -Indexes\nOptions +FollowSymlinks\nRewriteEngine On\nRewriteBase "+rewriteBase+"\nRewriteRule ^admin/$  admin/ [L]\nRewriteRule ^([a-z]+)/([a-z-0-9,]+).html$  index.php?p=$1&param=$2 [L]\nRewriteRule ^([a-z]+)/$  index.php?p=$1 [L]";
		$('#htaccess').attr('value', content);
	}
}