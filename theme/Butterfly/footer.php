        </article><!-- /post -->   
    </div><!-- /main -->
       
    <aside role="complimentary">
        <h2><a href="http://twitter.com" title="follow">Suivez moi sur Twitter</a></h2>
        <div id="jstwitter">
        </div>
        <?php showSidebarItems('<div class="item" id="[id]"><h2 class="title">[title]</h2><p>[content]</p></div>'); ?>      
    </aside>
  
</div><!-- /wrap -->
</div>
	<!-- Start Footer -->
	<footer>
		<p>Just using <a target="_blank" title="CMS sans base de données" href="http://99ko.tuxfamily.org/">99ko</a>  ◷  <?php showExecTime(); ?>s</p>
	</footer>
	<!-- End Footer -->
    <?php eval(callHook('endFrontBody')); ?>
</body>
</html>