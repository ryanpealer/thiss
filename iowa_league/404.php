<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since 1.0.0
 */

get_header();
?>


<div class="error-404 not-found default-max-width">
    <div class="container page-content">
        <br>
        <br>
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e( 'Nothing here', 'twentytwentyone' ); ?></h1>
            </header><!-- .page-header -->
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentytwentyone' ); ?></p>
			<div style="max-width:480px;">
                <?php get_search_form(); ?>
            </div>
            <br>
        <br><br>
        <br>
		</div><!-- .page-content -->
	</div><!-- .error-404 -->

<?php
get_footer();
