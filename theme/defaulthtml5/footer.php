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
                <p><?php echo lang('Just using') ?> <a target="_blank" title="<?php echo lang('NoDB CMS') ?>" href="http://99ko.tuxfamily.org/">99ko</a> | <?php echo lang('Theme') ?> <?php showTheme(); ?> | <a rel="nofollow" href="admin/"><?php echo lang('Administration') ?></a> | <?php showExecTime(); ?>s</p>
            </footer>
        </div>
    <?php eval(callHook('endFrontBody')); ?>
    </body>
</html>