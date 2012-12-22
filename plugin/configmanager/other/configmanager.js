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