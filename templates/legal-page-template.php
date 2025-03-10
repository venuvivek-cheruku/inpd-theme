<?php 
    /* Template Name: Legal Pages Template */
    get_header();
?>

    <section class="legal-main">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="title">
                        <h1><?=the_title();?></h1>
                    </div>
                </div>
                <div class="col-12 col-lg-10">
                    <div class="content">
                        <?=the_content();?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php get_footer();?>