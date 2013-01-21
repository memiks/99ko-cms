function addLink() {
	var position = parseInt($('#linksList tr:last').attr('id'));
	
	$('#linksList tr:last .down').html('<img src="../plugin/menu/img/down.png" alt="descendre" onclick="downLink(' + position + ')" />')
	
	position += 1;
	
	$('#linksList').append(
		'<tr id="' + position + '" class="added">'+
			'<input type="hidden" name="id' + position + '" value="-1" />'+
			'<input type="hidden" name="plugin' + position + '" value="menu" />'+
			'<td class="label">'+
				'<input type="text" name="label' + position + '" />'+
			'</td>'+
			'<td class="url">'+
				'<input type="text" name="url' + position + '" />'+
			'</td>'+
			'<td class="target">'+
				'<select name="target' + position + '">'+
					'<option value="_self">Fenêtre courante</option>' +
					'<option value="_blank">Nouvelle fenêtre</option>' +
				'</select>' +
			'</td>'+
			'<td class="up">'+
				'<img src="../plugin/menu/img/up.png" alt="monter" onclick="upLink(' + position + ')" />'+
			'</td>'+
			'<td class="down"></td>'+
			'<td class="delete">'+
				'<img src="../plugin/menu/img/delete.png" alt="supprimer" onclick="deleteLink(' + position + ')" />'+
			'</td>'+
		'</tr>'
	);
	
	$('input[name=number]').attr('value', position + 1);
}

function upLink(id) {
	var before = $('#'+id);
	var after = $('#'+(id-1));
	
	after.before(before);
	
	after.attr('id', id);
	before.attr('id', id-1);
	
	if (!$('#'+(id-1)+' .down img').length) {
		$('#'+(id-1)+' .down').append($('#'+id+' .down img').detach());
	}
	
	if (!$('#'+id+' .up img').length) {
		$('#'+id+' .up').append($('#'+(id-1)+' .up img').detach());
	}
	
	$('#'+id+' input[name=id'+(id-1)+']').attr('name', 'id'+id);
	$('#'+id+' input[name=plugin'+(id-1)+']').attr('name', 'plugin'+id);
	$('#'+id+' input[name=label'+(id-1)+']').attr('name', 'label'+id);
	$('#'+id+' input[name=url'+(id-1)+']').attr('name', 'url'+id);
	$('#'+id+' input[name=target'+(id-1)+']').attr('name', 'target'+id);
	$('#'+id+' img[alt=monter]').attr('onclick', 'upLink('+id+')');
	$('#'+id+' img[alt=descendre]').attr('onclick', 'downLink('+id+')');
	$('#'+id+' img[alt=supprimer]').attr('onclick', 'deleteLink('+id+')');
	
	$('#'+(id-1)+' input[name=id'+id+']').attr('name', 'id'+(id-1));
	$('#'+(id-1)+' input[name=plugin'+id+']').attr('name', 'plugin'+(id-1));
	$('#'+(id-1)+' input[name=label'+id+']').attr('name', 'label'+(id-1));
	$('#'+(id-1)+' input[name=url'+id+']').attr('name', 'url'+(id-1));
	$('#'+(id-1)+' input[name=target'+id+']').attr('name', 'target'+(id-1));
	$('#'+(id-1)+' img[alt=monter]').attr('onclick', 'upLink('+(id-1)+')');
	$('#'+(id-1)+' img[alt=descendre]').attr('onclick', 'downLink('+(id-1)+')');
	$('#'+(id-1)+' img[alt=supprimer]').attr('onclick', 'deleteLink('+(id-1)+')');
}

function downLink(id) {
	var before = $('#'+(id+1));
	var after = $('#'+id);
	
	before.after(after);
	
	after.attr('id', id+1);
	before.attr('id', id);
	
	if (!$('#'+id+' .down img').length) {
		$('#'+id+' .down').append($('#'+(id+1)+' .down img').detach());
	}
	
	if (!$('#'+(id+1)+' .up img').length) {
		$('#'+(id+1)+' .up').append($('#'+id+' .up img').detach());
	}

	$('#'+id+' input[name=id'+(id+1)+']').attr('name', 'id'+id);
	$('#'+id+' input[name=plugin'+(id+1)+']').attr('name', 'plugin'+id);
	$('#'+id+' input[name=label'+(id+1)+']').attr('name', 'label'+id);
	$('#'+id+' input[name=url'+(id+1)+']').attr('name', 'url'+id);
	$('#'+id+' input[name=target'+(id+1)+']').attr('name', 'target'+id);
	$('#'+id+' img[alt=monter]').attr('onclick', 'upLink('+id+')');
	$('#'+id+' img[alt=descendre]').attr('onclick', 'downLink('+id+')');
	$('#'+id+' img[alt=supprimer]').attr('onclick', 'deleteLink('+id+')');
	
	$('#'+(id+1)+' input[name=id'+id+']').attr('name', 'id'+(id+1));
	$('#'+(id+1)+' input[name=plugin'+id+']').attr('name', 'plugin'+(id+1));
	$('#'+(id+1)+' input[name=label'+id+']').attr('name', 'label'+(id+1));
	$('#'+(id+1)+' input[name=url'+id+']').attr('name', 'url'+(id+1));
	$('#'+(id+1)+' input[name=target'+id+']').attr('name', 'target'+(id+1));
	$('#'+(id+1)+' img[alt=monter]').attr('onclick', 'upLink('+(id+1)+')');
	$('#'+(id+1)+' img[alt=descendre]').attr('onclick', 'downLink('+(id+1)+')');
	$('#'+(id+1)+' img[alt=supprimer]').attr('onclick', 'deleteLink('+(id+1)+')');
}

function deleteLink(id) {
	$('#'+id).attr('class', 'deleted');
	$('#'+id).prepend('<input type="hidden" name="deleted'+id+'" value="true" />');
}
