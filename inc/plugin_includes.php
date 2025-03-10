<?php 
    require_once get_template_directory(). '/inc/class-tgm-plugin-activation.php';

    add_action('tgmpa_register', 'cswPluginIncludes_register_required_plugins');

    function cswPluginIncludes_register_required_plugins(){
        $plugins = array(
            array(
                'name' => 'Classic Editor',
                'slug' => 'classic-editor',
                'required' => true,
            )
        );
        tgmpa( $plugins );
    };