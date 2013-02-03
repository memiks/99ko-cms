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