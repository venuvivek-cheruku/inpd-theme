<?php 
    /* Template Name: Single Archive Template */
    get_header();
     // Get all product categories
    $product_categories = get_terms(array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => true,
    ));
?>

<style>
.course-overview-section #product-content {
    margin-top: 3rem;
}

.course-overview-category-selection .course-overview-nav-tabs {
    display: flex;
    gap: 1rem;
    align-items: center;
    list-style: none;
    padding-left: 0;
}

.course-overview-nav-tabs-nav-link .nav-link {
    padding: 0.2rem 0.8rem;
    border-radius: 10px;
    color: #102e43;
    background-color: var(--bs-white);
}

.course-overview-nav-tabs-nav-link .nav-link.active {
    background-color: #102e43;
    color: var(--bs-white);
}

.home-courses.course-overview-section {
    padding-top: 50px;
}

.co-load-more-btn {
    padding: 10px 25px;
    text-decoration: none;
    outline: unset !important;
    border-radius: 20px;
    border: 1px solid #fff;
    position: relative;
    background-color: #102e43;
    color: var(--bs-white);
    transition: all 333ms ease;
}


.co-load-more-btn:hover {
    background-color: var(--bs-white);
    color: #102e43;
    border: 1px solid #102e43;
    transition: all 333ms ease;
}

.course-overview-section .course-class a {
    text-decoration: none;
    color: var(--bs-heading-color);
}
</style>

<section class="boxed-top-row"
    style="background: url('/wp-content/uploads/2024/07/inhousetrain.webp') no-repeat center center / cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7">
                <div class="text-wrapper blue-box">
                    <h1>Course Categories for Your Professional Development</h1>
                    <p>We are dedicated to providing a comprehensive range of course categories that cover every aspect
                        of corporate training. Our wide selection of course categories is thoughtfully designed to meet
                        the unique requirements of businesses spanning across diverse sectors. </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-courses course-overview-section">
    <div class="container">
        <!-- Category Selection: Tabs for Desktop, Dropdown for Mobile -->
        <div class="course-overview-category-selection">
            <ul class="course-overview-nav-tabs mb-4 d-none d-md-flex" id="courseTabs" role="tablist">
                <li>Filter by:</li>
                <li class="course-overview-nav-tabs-nav-link" role="presentation">
                    <button class="nav-link active" id="all-tab" data-category="all" type="button"
                        role="tab">All</button>
                </li>
                <li class="course-overview-nav-tabs-nav-link" role="presentation">
                    <button class="nav-link" id="director-training-tab" data-category="director-training" type="button" role="tab">Director Courses</button>
                </li>
                <li class="course-overview-nav-tabs-nav-link" role="presentation">
                    <button class="nav-link" id="director-training-tab" data-category="sales-leadership" type="button" role="tab">Sales</button>
                </li>
                <li class="course-overview-nav-tabs-nav-link" role="presentation">
                    <button class="nav-link" id="director-training-tab" data-category="strategy" type="button" role="tab">Strategy</button>
                </li>
                <li class="course-overview-nav-tabs-nav-link" role="presentation">
                    <button class="nav-link" id="management-tab" data-category="management" type="button" role="tab">Management</button>
                </li>
                <li class="course-overview-nav-tabs-nav-link" role="presentation">
                    <button class="nav-link" id="leadership-tab" data-category="leadership" type="button" role="tab">Leadership</button>
                </li>
                <li class="course-overview-nav-tabs-nav-link" role="presentation">
                    <button class="nav-link" id="director-training-tab" data-category="director-training" type="button" role="tab">Marketing</button>
                </li>
                <li class="course-overview-nav-tabs-nav-link" role="presentation">
                    <button class="nav-link" id="digital-transformation-tab" data-category="digital-transformation" type="button" role="tab">Digital Transformation</button>
                </li>
            </ul>

            <!-- Mobile Dropdown -->
            <select class="form-select d-md-none category-dropdown" id="mobileCategorySelect">
                <option value="all">All</option>
                <option value="director-training"> Director Courses </option>
                <option value="sales-leadership"> Sales </option>
                <option value="strategy"> Strategy Courses </option>
                <option value="management">Management Courses</option>
                <option value="leadership"> Leadership Courses </option>
                <option value="marketing"> Marketing Courses </option>
                <option value="digital-transformation">Digital Transformation Courses</option>
            </select>

        </div>

        <!-- Product Listing with AJAX -->
        <div id="product-content" class="tab-content">
            <div class="row">
                <div class="course-wrapper">
                    <!-- Products will be loaded here via AJAX -->
                </div>
            </div>
            <div class="pagination-wrapper text-center mt-4">
                <button class="co-load-more-btn no-arrow" data-page="1">Load More</button>
            </div>
        </div>
    </div>

    <script>
    jQuery(document).ready(function($) {
        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

        function loadProducts(category, page) {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'load_products_ajax',
                    category: category,
                    page: page
                },
                beforeSend: function() {
                    $('.co-load-more-btn').text('Loading...');
                },
                success: function(response) {
                    if (page == 1) {
                        $('.course-wrapper').html(response.html);
                    } else {
                        $('.course-wrapper').append(response.html);
                    }

                    if (response.has_more) {
                        $('.co-load-more-btn').show().text('Load More').attr('data-page', parseInt(
                            page) + 1);
                    } else {
                        $('.co-load-more-btn').hide();
                    }
                }
            });
        }

        $('.nav-link').click(function() {
            var category = $(this).attr('data-category');
            $('.nav-link').removeClass('active');
            $(this).addClass('active');
            loadProducts(category, 1);
        });

        $('#mobileCategorySelect').change(function() {
            var category = $(this).val();
            loadProducts(category, 1);
        });

        $('.co-load-more-btn').click(function() {
            var category = $('.nav-link.active').attr('data-category') || $('#mobileCategorySelect')
                .val();
            var page = $(this).attr('data-page');
            loadProducts(category, page);
        });

        loadProducts('all', 1);
    });
    </script>
</section>

<section class="c-arch video-with-bc grey-bg">
    <div class="container">
        <div class="row">
            <div class="float-vid">
                <div class="video-img" data-aos="fade-right">
                    <img src="/wp-content/uploads/2024/07/placeholder.jpg" alt=""
                        class="img-fluid">
                    <div class="vid-btn">
                        <a data-bs-toggle="modal" data-bs-target=".vid-modal">
                            <img src="/wp-content/uploads/2024/07/play-btn-1.svg" alt="Play Button" class="img-fluid">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-7 offset-lg-5">
                <div class="text-wrapper">
                    <h2>Find out more about our professional training courses</h2>
                    <p>Whether you’re seeking to enhance your skills, explore new interests, or advance your career, our
                        diverse range of courses are designed to meet your learning goals.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade vid-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="row">
                    <div class="col-12 video-wrapper">
                        <div class="close" data-bs-dismiss="modal">✕</div>
                        <iframe src="https://www.youtube.com/embed/NpEaa2P7qZI?si=DaEx7BmFRlX0Rhgr" frameborder="0"
                            allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="course-lower-content grey-bg">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
                <div class="text-wrapper text-center mt-5">
                    <p>Our expert tutors are dedicated to delivering engaging and interactive learning experiences. By
                        blending theoretical knowledge with practical applications, we ensure that you gain the
                        necessary expertise to thrive in your chosen area.</p>
                    <div class="button-wrapper mt-4">
                        <a href="#" class="siteCTA blue">Find out more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>