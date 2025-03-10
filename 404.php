<?php 
    $fields = get_fields();
    get_header();
?>

<section class="page-not-found dark-blue-bg">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 offset-lg-3">
                <div class="text-wrapper text-center">
                    <h1 style="color: #C3DFE0;">404</h1>
                    <?=get_field('404_support_text', 'option');?>
                    <div class="button-wrapper mt-5">
                        <a href="/" class="siteCTA" target="_self">Back to home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>