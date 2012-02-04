<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

//get_header(); ?>



<!--
	This is a layout (or template) with a top nav, large banner,
	small left sub-menu a content area, and a footer. 
	Each of these sections are spaced 20 px apart and the widths of each section are hard coded.
	
	This html page has 2 css files associated with it: templace.css and theme.css.
	template.css contains style rules that control the layout and structure of page.
	You should avoid editing this file unless you want to change the size of sections or the spacing between them.
	If you add a section place the css to control it's width, heght, etc. in template.css.
	
	Finally, if you want to make the page printer friendly, add a print.css file.	
-->
<?php
	$pageData = get_page(the_id());
?>
<html>
	<head>
		<title><?php
			/*
			 * Print the <title> tag based on what is being viewed.
			 */
			global $page, $paged;

			wp_title( '|', true, 'right' );

			// Add the blog name.
			bloginfo( 'name' );

			// Add the blog description for the home/front page.
			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description && ( is_home() || is_front_page() ) )
				echo " | $site_description";

			// Add a page number if necessary:
			if ( $paged >= 2 || $page >= 2 )
				echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

			?>
		</title>
	
		<?php
			$themeDir = get_bloginfo('stylesheet_directory');
		?>
		
		<link rel="stylesheet" type="text/css" href="<?php echo $themeDir; ?>/template.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $themeDir; ?>/style.css" />
		
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width" />
		
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
		
<!--			<div id="title_box">
				<h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>
			</div> -->
			
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
		
			<div id= "scroll_area" class="content_box">
				<div>scroll area</div>
			</div>
		
			<div id= "sub_menu" class="content_box">
				<div>
					<?php //get_sidebar(); ?>
				</div>
			</div>
		
			<div id= "content" class="content_box">
				<div>
				<?php
					echo $pageData->post_content;
				?>
				
				<?php
				//	while ( have_posts() ) : the_post();
				//		get_template_part( 'content', get_post_format() );
				//	endwhile; 
				?>
				
				</div>
			</div>
			
			<div id= "footer">
				<?php get_footer(); ?>
			</div>
		</div>	<!-- End page <div -->
	</body>
</html>
