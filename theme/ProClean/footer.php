				</div>	
				<aside>
				
				    <!-- Menu -->
				    <div class="section">
						<h3>Navigation</h3>
						<ul>
					       <?php showMainNavigation(); ?>	
					    <ul>
					    <div class="clearer"></div>	
					</div>
					
					<!-- Block -->			
					<?php showSidebarItems('<div class="section" id="[id]">
						<h3>[title]</h3>
					    [content]
						<div class="clearer"></div>	
					</div>'); ?>					

					<div class="section">
						<h3>Recherche</h3>
						<form id="search" action="" method="post">
							<input type="text" name="search_keywords" id="search_keywords" value="" />
							<button type="submit" class="small pill">rechercher</button>
						</form>
					</div>
					
				</aside><!-- /Sidebar -->
				
				<div class="clearer"></div>
			</div>
			
		</section>
		
		<footer>
			Just using <a target="_blank" title="CMS sans base de données" href="http://99ko.tuxfamily.org/">99ko</a> | Thème <?php showTheme(); ?> | <a rel="nofollow" href="admin/">Administration</a> | <?php showExecTime(); ?>s
		</footer>
    <?php eval(callHook('endFrontBody')); ?>
    </body>
</html>