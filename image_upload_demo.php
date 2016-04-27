<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Image upload and generate thumbnail using ajax in PHP</title>
  <link rel="shortcut icon" href="favicon2.ico" type="image/x-icon" />
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/mycss/mystyle.css">
  <link rel="stylesheet" href="css/mycss/tabstyle.css">
  <link rel="stylesheet" href="css/header/menu.css">
  <link rel="stylesheet" href="css/Mytable.css">
  <link rel="stylesheet" href="css/mycss/mystyle2.css">
  <link rel="stylesheet" href="css/footer/footer-basic-centered.css">
  <link rel="stylesheet" href="css/frame/frame.css">
  <link rel="stylesheet" href="css/animate.css">
  <link href="css/upload/style.css" rel="stylesheet">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery.form.js"></script>
  <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
  <script type="text/javascript" src="js/moment-2.13.0.min.js"></script>
  <script type="text/javascript" src="js/livestamp.js"></script>
<script>
$(document).on('change', '#image_upload_file', function () {
var progressBar = $('.progressBar'), bar = $('.progressBar .bar'), percent = $('.progressBar .percent');

$('#image_upload_form').ajaxForm({
    beforeSend: function() {
		progressBar.fadeIn();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    success: function(html, statusText, xhr, $form) {		
		obj = $.parseJSON(html);	
		if(obj.status){		
			var percentVal = '100%';
			bar.width(percentVal)
			percent.html(percentVal);
			$("#imgArea>img").prop('src',obj.image_medium);			
		}else{
			alert(obj.error);
		}
    },
	complete: function(xhr) {
		progressBar.fadeOut();			
	}	
}).submit();		

});
</script>
</head>

<body>



<br>


<div id="imgContainer">
  <form enctype="multipart/form-data" action="image_upload_demo_submit.php" method="post" name="image_upload_form" id="image_upload_form">
    
    <div id="imgArea"><img src="img/default.jpg">
      <div class="progressBar">
        <div class="bar"></div>
        <div class="percent">0%</div>
      </div>
      <div id="imgChange"><span>Change Photo</span>
        <input type="file" accept="image/*" name="image_upload_file" id="image_upload_file">
      </div>
    </div>
  </form>
</div>
</body>
</html>
