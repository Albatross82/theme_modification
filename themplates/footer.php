<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Monstroid2
 */

?>
<script>
jQuery(document).ready(function() {
    // Выбираем все ссылки из .menu-item имеющего во вложении .sub-menu
        jQuery('.widget .menu-item:has(.sub-menu)').children('a').toggle( 
            function() {
                    // Показываем вложенный пункт
                            jQuery(this).parent('.menu-item').children('.sub-menu').css('display', 'block');  
                                }, function() {
                                        // Скрываем вложенный пункт
                                                jQuery(this).parent('.menu-item').children('.sub-menu').css('display', 'none'); 
                                                    });
                                                        // Раскрываем родительский пункт меню если активна дочерняя страница
                                                            jQuery('.current-menu-item').parent('ul').css('display', 'block');
                                                            });
                                                            </script>

	</div><!-- #content -->

	<footer id="colophon" <?php monstroid2_footer_class() ?> role="contentinfo">
		<?php get_template_part( 'template-parts/footer/footer-area' ); ?>
		<?php get_template_part( apply_filters( 'monstroid2_footer_layout_template_slug', 'template-parts/footer/layout' ), get_theme_mod( 'footer_layout_type' ) ); ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
