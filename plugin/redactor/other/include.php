<link rel="stylesheet" href="../plugin/redactor/css/redactor.css" />
<script src="../plugin/redactor/redactor.min.js"></script>	
		<script type="text/javascript">
		$(document).ready(
			function()
			{
				$('textarea').redactor({ 
				lang:           'fr',
				toolbar:        'default',/* mini*/
				imageUpload:    '../plugin/redactor/upload.php/image',
				linkFileUpload: '../plugin/redactor/upload.php/link',
				fileUpload:     '../plugin/redactor/upload.php/file',
				imageGetJson:   '../plugin/redactor/images.json',
				overlay: false 
				});			
			}
		);
		</script>  
