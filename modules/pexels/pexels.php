<?php

/**
 * This is Pexels module
 * @class FLPexelsModule
 */
class FLPexelsModule extends FLBuilderModule {
 
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Pexels Photo', 'fl-builder'),
            'description'   => __('Pexels Photo Picker.', 'fl-builder'),
            'category'		=> __('Media', 'fl-builder'),
            'dir'           => FL_MODULE_PEXELS_DIR . 'modules/pexels/',
            'url'           => FL_MODULE_PEXELS_URL . 'modules/pexels/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
        ));
    }
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLPexelsModule', array(
    'general'       => array( // Tab
        'title'         => __('General', 'fl-builder'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => __('Pexels Photo Fields', 'fl-builder'), // Section Title
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
                        'type'          => 'pexel-picker',
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