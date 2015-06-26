<?php get_header(); ?>

        	<div class="main-content-area">
				<?php
				op_mod('advertising')->display(array('advertising', 'pages', 'top'));
				if( have_posts() ): ?>
				<div class="op-page-header cf">
                	<?php
					$title = '';
					$text = '';
					if(is_tag()){
						$title = sprintf( __( 'Tag Archives: %s', OP_SN ), '<span>' . single_tag_title( '', false ) . '</span>' );
						$tag_description = tag_description();
						if ( ! empty( $tag_description ) )
							$text = apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
					} elseif(is_author()){
						the_post();
						$title = sprintf( __( 'Author Archives: %s', OP_SN ), '<span class="vcard">' . get_the_author() . '</span>' );
						rewind_posts();
					} elseif(is_category()){
						$title = sprintf( __( 'Category Archives: %s', OP_SN ), '<span>' . single_cat_title( '', false ) . '</span>' );
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							$text = apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
					} elseif(is_archive()){
						$dtstr = '';
						if(is_day()){
							$title = sprintf( __( 'Daily Archives: %s', OP_SN ), '<span>' . get_the_date() . '</span>' );
						} elseif(is_month()){
							$title = sprintf( __( 'Monthly Archives: %s', OP_SN ), '<span>' . get_the_date( 'F Y' ) . '</span>' );
						} elseif(is_year()){
							$title = sprintf( __( 'Yearly Archives: %s', OP_SN ), '<span>' . get_the_date( 'Y' ) . '</span>' );
						} else {
							$title = __('Blog Archives', OP_SN);
						}
					}
					echo '<h2>'.$title.'</h2>';
                    echo $text;
                    ?>
				</div>
				<?php op_theme_file('loop'); ?>
				<?php else: ?>
				<div class="op-page-header cf">
					<h2><?php _e( 'Nothing Found', OP_SN ); ?></h2>
				</div>
				<?php op_mod('advertising')->display(array('advertising', 'pages', 'top')) ?>
				<div class="entry-content">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', OP_SN ); ?></p>
					<?php get_search_form(); ?>
                </div>
                <?php endif ?>
				<?php op_mod('advertising')->display(array('advertising', 'pages', 'bottom')); ?>
			</div>
			<?php op_sidebar(); ?>
<?php get_footer(); ?>