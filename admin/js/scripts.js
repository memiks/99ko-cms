			// ONGLETS
			$(document).ready(function(){
				$('ul.tabs').each(function(){
					// Track l'onglet actif ainsi que sont contenu
					var $active, $content, $links = $(this).find('a');
					// Si le location.hash correspond à l'un des liens, l'utiliser comme onglet actif.
                    // Si aucune correspondance n'est trouvée, donner le premier lien de l'onglet en tant qu'actif initial.
					$active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
					$active.addClass('active');
					$content = $($active.attr('href'));
					// Cacher le contenu restant
					$links.not($active).each(function () {
						$($(this).attr('href')).hide();
					});
					// Associe une action au clique
					$(this).on('click', 'a', function(e){
						// Rend l'ancien onglet inactif.
						$active.removeClass('active');
						$content.hide();
						// Met à jour les variables avec le nouveau lien et le contenu
						$active = $(this);
						$content = $($(this).attr('href'));
						// Crée l'onglet actif.
						$active.addClass('active');
						$content.show();
						// Prevent the anchor's default click action
						e.preventDefault();
					});
				});
			});
