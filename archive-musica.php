<?php
if (!is_user_logged_in()):
   auth_redirect();
else:
get_header();?>
<?php get_template_part('parallaxheader'); ?>
<h3><?php add_breadcrumbs()?></h3>
<?php $post_per_page = mmc_array(array(3,2,get_option('posts_per_page')));
polivoz_search_box('musica',$post_per_page); ?>

<header class="container">
        <div class="section-title">
            <?php
            $args = array(
              'post_name' => get_option('polivoz_template_musica_name'),
              'type' => 'h1',
              'nota_musical' => get_option('polivoz_template_musica_nota_musical'),
              'post_link' => true
            );
            generate_title($args); ?><br>
        </div>
    <h1></h1>
</header>

<main id="polivoz-posts-container-id" class="polivoz-posts-container container">
    <?php
    $custom_args = array(
        'post_type' => 'musica',
        'post_status' => 'publish',
        'posts_per_page' => $post_per_page
    );
    $lastBlog = new WP_Query($custom_args); 
    $pagenum = $lastBlog->max_num_pages;
    $havePosts = $lastBlog->have_posts();?>
    <?php if ($havePosts) : $i=0; ?> 
        <div class="row container">
        <?php while ( $lastBlog->have_posts() ) : $lastBlog->the_post(); ?>
                <?php get_template_part('musica-single-post-list'); ?>
            <?php
         endwhile;?>
        </div>
    <?php else: 
        polivoz_error_404('Não há galerias nessa página:',
            array('O conteúdo dessa página foi removido;',
                  'O conteúdo mudou de lugar; ',
                  'Você digitou o endereço errado.'
        ));?>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
</main>
<?php if($havePosts){polivoz_pagination('musica',$pagenum,$post_per_page);}?>
<?php get_footer(); endif;