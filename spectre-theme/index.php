<?php get_header(); ?>

<main class="site-main container mx-auto px-4 py-8">
    <?php if (have_posts()) : ?>
        <div class="posts-grid grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', array('class' => 'w-full h-48 object-cover')); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="p-6">
                        <h2 class="text-2xl font-bold mb-2">
                            <a href="<?php the_permalink(); ?>" class="text-gray-800 hover:text-blue-600">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <div class="post-meta text-sm text-gray-600 mb-4">
                            <time datetime="<?php echo get_the_date('c'); ?>">
                                <?php echo get_the_date(); ?>
                            </time>
                            <span class="mx-2">•</span>
                            <span><?php the_author(); ?></span>
                        </div>

                        <div class="post-excerpt text-gray-700">
                            <?php the_excerpt(); ?>
                        </div>

                        <a href="<?php the_permalink(); ?>" class="inline-block mt-4 text-blue-600 hover:text-blue-800 font-semibold">
                            Read More →
                        </a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <div class="pagination mt-12">
            <?php
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('← Previous', 'spectre-wordpress-themes'),
                'next_text' => __('Next →', 'spectre-wordpress-themes'),
            ));
            ?>
        </div>
    <?php else : ?>
        <div class="no-posts text-center py-12">
            <h2 class="text-3xl font-bold mb-4"><?php _e('No posts found', 'spectre-wordpress-themes'); ?></h2>
            <p class="text-gray-600"><?php _e('Sorry, no posts were found.', 'spectre-wordpress-themes'); ?></p>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
