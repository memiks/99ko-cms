<?php if (isset($_GET['p'])) { ?>
</section>
<?php } ?>
	<!--</div>-->
<script type="text/javascript">
<?php if($data['openTab']){ ?>open<?php echo $data['openTab']; ?>();<?php } ?>
</script>
<?php eval(callHook('endAdminBody')); ?>
</body>
</html>
