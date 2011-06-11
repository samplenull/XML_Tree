<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title>XML TREE</title>

	<link rel="stylesheet" href="jquery.treeview.css" />
	<link rel="stylesheet" href="screen.css" />

	<script src="lib/jquery.js" type="text/javascript"></script>
	<script src="lib/jquery.cookie.js" type="text/javascript"></script>
	<script src="jquery.treeview.js" type="text/javascript"></script>

	<script type="text/javascript">
	$(document).ready(function(){
		$("#browser").treeview({
            control: "#treecontrol",
            collapsed: true,
			toggle: function() {
				console.log("%s was toggled.", $(this).find(">span").text());
			}
		});
       
	});
	</script>
	</head>
	<body>










	
	
	
	


 