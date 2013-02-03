            </section>
            <section id="sidebar">
                <nav id="main">
                    <ul>
			<?php showMainNavigation(); ?>
                    </ul>
                </nav>
		<?php showSidebarItems('<div class="item" id="[id]"><h2 class="title">[title]</h2>[content]</div>'); ?>
            </section>
            <footer>
                <p><?php echo lang('Just using', 'theme') ?> <a target="_blank" title="<?php echo lang('NoDB CMS', 'theme') ?>" href="http://99ko.tuxfamily.org/">99ko</a> | <?php echo lang('Theme', 'theme') ?> <?php showTheme(); ?> | <a rel="nofollow" href="admin/">Administration</a> | <?php showExecTime(); ?>s</p>
            </footer>
        </div>
    <?php eval(callHook('endFrontBody')); ?>
    </body>
</html>