<?php

/**
 * This is an example module with only the basic
 * setup necessary to get it working.
 *
 * @class FLBasicExampleModule
 */
class FLBasicExampleModule extends FLBuilderModule {

    /** 
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */  
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Basic Example', 'fl-builder'),
            'description'   => __('An basic example for coding new modules.', 'fl-builder'),
            'category'		=> __('Example Modules', 'fl-builder'),
            'dir'           => FL_MODULE_EXAMPLES_DIR . 'modules/basic-example/',
            'url'           => FL_MODULE_EXAMPLES_URL . 'modules/basic-example/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
        ));
    }
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLBasicExampleModule', array(
    'general'       => array( // Tab
        'title'         => __('General', 'fl-builder'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => __('Section Title', 'fl-builder'), // Section Title
                'fields'        => array( // Section Fields
                    'pexels_width'     => array(
                        'type'          => 'text',
                        'label'         => __('Width', 'fl-builder'),
                        'default'       => '',
                        'maxlength'     => '4',
                        'size'          => '4',
                        'class'         => 'my-css-class',
                        'description'   => 'px',
                        'preview'         => array(
                            'type'             => 'css',
                            'selector'         => '.fl-pexels img',
                            'property'         => 'width',
                            'unit'             => 'px'
                        )
                    ),
                    'pexels_height'     => array(
                        'type'          => 'text',
                        'label'         => __('Height', 'fl-builder'),
                        'default'       => '',
                        'maxlength'     => '4',
                        'size'          => '4',
                        'class'         => 'my-css-class',
                        'description'   => 'px',
                        'preview'         => array(
                            'type'             => 'css',
                            'selector'         => '.fl-pexels img',
                            'property'         => 'height',
                            'unit'             => 'px'
                        )
                    ),
                    'pexels_alt'     => array(
                        'type'          => 'text',
                        'label'         => __('Alt', 'fl-builder'),
                        'default'       => '',
                        'class'         => 'my-css-class',
                        'preview'         => array(
                            'type'             => 'attribute',
                            'attribute'        => 'alt',
                            'selector'         => '.fl-pexels img',
                        )
                    ),
                    'pexels_src' => array(
                        'type'          => 'my-custom-field',
                        'label'         => __('Pexels', 'fl-builder'),
                        'default'       => '',
                        'preview'         => array(
                            'type'             => 'attribute',
                            'attribute'        => 'src',
                            'selector'         => '.fl-pexels img'
                        )
                    ),
                )
            )
        )
    )
));