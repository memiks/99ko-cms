$(document).ready(function(){
    $('#advancedConfigurationButton').click(function(){
        if($('#advancedConfiguration').css('display') == 'none') $('#advancedConfiguration').show();
        else $('#advancedConfiguration').hide();
    });
    $('.aboutTheme').click(function(){
        var content = $(this).next('span').html();
        TINY.box.show({html:content});
    });
});
function updateHtaccess(rewriteBase){
	//var checked = $('#urlRewriting').attr('checked');
        var checked = $('#urlRewriting')[0].checked;
        //alert(checked);
	//if(!checked) $('#htaccess').attr('value', 'Options -Indexes');
        if(!checked) $('#htaccess').html('Options -Indexes');
	else{
		var content = "Options -Indexes\nOptions +FollowSymlinks\nRewriteEngine On\nRewriteBase "+rewriteBase+"\nRewriteRule ^admin/$  admin/ [L]\nRewriteRule ^([a-z]+)/([a-z-0-9,]+).html$  index.php?p=$1&param=$2 [L]\nRewriteRule ^([a-z]+)/$  index.php?p=$1 [L]";
                //$('#htaccess').attr('value', content);
                $('#htaccess').html(content);
	}
}