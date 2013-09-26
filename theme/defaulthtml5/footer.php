            </section>
            <section id="sidebar">
                <nav id="main">
                    <ul>
			<?php showMainNavigation(); ?>
                    </ul>
                </nav>
		<?php showSidebarItems('<div class="item" id="[id]"><h2 class="title">[title]</h2>[content]</div>'); ?>
            </section>
            <footer id="main">
                <p>Just using <a target="_blank" title="CMS sans base de données" href="http://99ko.tuxfamily.org/">99ko</a> | Thème <?php showTheme(); ?> | <a rel="nofollow" href="admin/">Administration</a> | <?php showExecTime(); ?>s</p>
            </footer>
        </div>
    <?php eval(callHook('endFrontBody')); ?>
    </body>
</html>