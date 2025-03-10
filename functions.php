<?php 
    require get_template_directory().'/inc/themeSetup.php';
    require get_template_directory().'/inc/custom-posttypes.php';
    require get_template_directory().'/inc/enqueueScriptsStyles.php';
    require get_template_directory().'/inc/widget_areas.php';
    require get_template_directory().'/inc/createRequiredPages.php';
    require get_template_directory().'/inc/customAcfOptionsPages.php';
    require get_template_directory().'/inc/customAcfRequiredFields.php';
    require get_template_directory().'/inc/customizer.php';
    require get_template_directory().'/inc/class-wp-bootstrap-navwalker.php';
    require get_template_directory().'/inc/plugin_includes.php';
    require get_template_directory().'/inc/addSvgSupport.php';

    // Add Administrate Specific Functions
    require get_template_directory().'/inc/bly_customAdministrateAuth.php';
    require get_template_directory().'/inc/addCustomRestEndpoint.php';
    require get_template_directory().'/inc/bly_getAdministrateProductSessionsByCode.php';
    require get_template_directory().'/inc/refreshProduct.php';
  //  require get_template_directory().'/inc/bly_updateHubSpot.php';
    require get_template_directory().'/inc/bly_updateAdministrate.php';
    //test
    // Automatic Upload Test

