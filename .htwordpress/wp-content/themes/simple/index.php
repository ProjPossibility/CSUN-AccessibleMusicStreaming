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
 *
 *	This is a layout (or template) with a top nav, large banner,
 *	small left sub-menu a content area, and a footer. 
 *	Each of these sections are spaced 20 px apart and the widths of each section are hard coded.
 *	
 *	This html page has 2 css files associated with it: templace.css and theme.css.
 *	template.css contains style rules that control the layout and structure of page.
 *	You should avoid editing this file unless you want to change the size of sections or the spacing between them.
 *	If you add a section place the css to control it's width, heght, etc. in template.css.
 *	
 *	Finally, if you want to make the page printer friendly, add a print.css file.	
 */
 
 $pageData = get_page(the_id());
?>

<?php get_header(); ?>

		
			<div id= "scroll_area" class="content_box">
				<div>
					scroll
				</div>
			</div>
		
			<div id= "sub_menu" class="content_box">
				<div>
					<ul>
						<li>item 1</li><hr />
						<li>item 2</li><hr />
						<li>item 3</li><hr />
					</ul>
				</div>
			</div>
		
			<div id= "content" class="content_box">
				<div>
					<h1>Primary Title</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					<h2>Secondary Title</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					<h3>Ternary Title</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					<a href= "#">A link</a>
					<a href= "http://www.google.com">visited</a>
				</div>
			</div>
			
			<div id= "footer">
				footer
			</div>
		</div>	<!-- End page <div -->
	</body>
</html>
