<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Unifield
 */
?>
<div id="footer-wrapper">
	<div class="container">
		<?php if ( ! dynamic_sidebar( 'footer-1' ) ) : ?>
		<?php endif; // end footer widget area ?>

		<?php if ( ! dynamic_sidebar( 'footer-2' ) ) : ?>
		<?php endif; // end footer widget area ?>

		<?php if ( ! dynamic_sidebar( 'footer-3' ) ) : ?>
		<?php endif; // end footer widget area ?>

		<?php if ( ! dynamic_sidebar( 'footer-4' ) ) : ?>
		<?php endif; // end footer widget area ?>


		<div class="clear"></div>
	</div><!--end .container-->

	<div class="copyright-wrapper">
		<div class="container">
			<div class="copyright-txt">
				© Don't Be Afraid <?php echo date( 'Y' ); ?> / Email: <a href="mailto:info@dontbeafraidrecordings.co.uk" target="_blank" style="color:#000; font-style:normal; font-weight:normal;">info@dontbeafraidrecordings.co.uk</a>
				<br><br><br>
			</div>
			<div class="design-by">
				<a target="_blank" rel="nofollow" href="https://zahidaramai.com/"><?php printf( __( 'Proudly designed by %s', 'unifield' ), 'Zahid Aramai' ); ?></a>
			</div>

		</div>
	</div>
</div>
</div><!--#end pageholder-->
<?php wp_footer(); ?>

</body>
</html>
