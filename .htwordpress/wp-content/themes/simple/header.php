<html>
	<head>
		<title><?php wp_title("", true, "right"); ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/template.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css" />
		
		<script type= "text/javascript">
			window.onload = function(){
				//Make page to the full window height
				var body = document.getElementsByTagName("body")[0];
				document.getElementById("page").style.height = body.scrollHeight;
			}
		</script>
	</head>
	
	<body>
		<div id= "page">
			
			<div id="title_box">
			</div>
			
			<div id= "menu_bar" class="content_box">
				<div>	<!-- Add margin to this instead of padding to parent div -->
					<ul>
						<li><a href= "/home">Home</a></li>
						<li><a href= "/school">School</a></li>
						<li><a href= "/repo">Repo</a></li>
						<li><a href= "/interests">Interests</a></li>
						<li><a href= "/ideas">Ideas</a></li>
						<li><a href= "/quotes">Quotes</a></li>
						<li><a href= "/blog">Blog</a></li>
					</ul>
				</div>
			</div>
