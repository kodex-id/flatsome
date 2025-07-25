<?php

Flatsome_Option::add_section( 'blog-layout', array(
	'title'       => __( 'Blog Layout', 'flatsome-admin' ),
	'panel' => 'blog',
) );


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'textarea',
	'settings'     => 'blog_header',
	'label'       => __( 'Blog Homepage Header', 'flatsome-admin' ),
	'description' => __( 'Enter HTML for blog header here. Will be placed above content and sidebar. Shortcodes are allowed. F.ex [block id="blog-header"]', 'flatsome-admin' ),
	'section'     => 'blog-layout',
	'sanitize_callback' => 'flatsome_custom_sanitize',
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'blog_archive_transparent',
	'label'       => __( 'Transparent Header', 'flatsome-admin' ),
	'section'     => 'blog-layout',
	'default'     => 0,
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-image',
	'settings'     => 'blog_layout',
	'label'       => __( 'Blog Sidebar', 'flatsome-admin' ),
	'section'     => 'blog-layout',
	'default'     => 'right-sidebar',
	'transport'	  => flatsome_customizer_transport(),
	'choices'     => array(
		'right-sidebar' => $image_url . 'layout-right.svg',
		'left-sidebar' => $image_url . 'layout-left.svg',
		'no-sidebar' => $image_url . 'layout-no-sidebar.svg',
	),
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'blog_layout_divider',
	'label'       => __( 'Enable Sidebar Divider', 'flatsome-admin' ),
	'section'     => 'blog-layout',
	'transport'	  => flatsome_customizer_transport(),
	'default'     => 1,
));

Flatsome_Option::add_field( 'option', array(
	'type'     => 'checkbox',
	'settings' => 'blog_sticky_sidebar',
	'label'    => __( 'Sticky sidebar', 'flatsome-admin' ),
	'section'  => 'blog-layout',
	'default'  => 0,
) );

Flatsome_Option::add_field( 'option', array(
	'type'            => 'select',
	'settings'        => 'blog_sticky_sidebar_mode',
	'label'           => __( 'Sticky mode', 'flatsome-admin' ),
	'section'         => 'blog-layout',
	'default'         => '',
	'choices'         => array(
		''           => __( 'CSS (native)', 'flatsome-admin' ),
		'javascript' => __( 'JavaScript (enhanced)', 'flatsome-admin' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'blog_sticky_sidebar',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-image',
	'settings'     => 'blog_style',
	'label'       => __( 'Posts Layout', 'flatsome-admin' ),
	'section'     => 'blog-layout',
	'default'     => 'normal',
	'choices'     => array(
		'normal' => $image_url . 'blog-normal.svg',
		'inline' => $image_url . 'blog-inline.svg',
		'2-col' => $image_url . 'blog-two-col.svg',
		'3-col' =>$image_url . 'blog-three-col.svg',
		'list' => $image_url . 'blog-list.svg',
	),
));

Flatsome_Option::add_field( 'option', array(
	'type'            => 'radio-buttonset',
	'settings'        => 'blog_style_type',
	'label'           => __( 'Posts Layout Type', 'flatsome-admin' ),
	'section'         => 'blog-layout',
	'default'         => 'masonry',
	'choices'         => array(
		'row'     => __( 'Row', 'flatsome-admin' ),
		'masonry' => __( 'Masonry', 'flatsome-admin' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'blog_style',
			'operator' => 'contains',
			'value'    => array( '2-col', '3-col' ),
		),
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'blog_show_excerpt',
	'transport'	  => flatsome_customizer_transport(),
	'label'       => __( 'Show Excerpts Only', 'flatsome-admin' ),
	'help'        => __( 'Show Excerpts only of the Blog posts. You can manually add a Read More link by adding a More Tag to the Post Content.', 'flatsome-admin' ),
	'section'     => 'blog-layout',
	'default'     => 1,
));

Flatsome_Option::add_field( 'option',  array(
'type'        => 'color-alpha',
'settings'     => 'blog_bg_color',
'label'       => __( 'Blog Background Color', 'flatsome-admin' ),
'section'     => 'blog-layout',
'default'     => '',
'transport' => flatsome_customizer_transport(),
'js_vars'   => array(
	array(
		'element'  => '.blog-wrapper',
		'function' => 'css',
		'property' => 'background-color'
	),
)
));


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'slider',
	'settings'     => 'blog_posts_depth',
	'label'       => __( 'Depth', 'flatsome-admin' ),
	'section'     => 'blog-layout',
	'default'     => 0,
	'choices'     => array(
		'min'  => 0,
		'max'  => 5,
		'step' => 1
	),
	'transport' => flatsome_customizer_transport()
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'slider',
	'settings'     => 'blog_posts_depth_hover',
	'label'       => __( 'Depth :hover', 'flatsome-admin' ),
	'section'     => 'blog-layout',
	'default'     => 0,
	'choices'     => array(
		'min'  => 0,
		'max'  => 5,
		'step' => 1
	),
	'transport' => flatsome_customizer_transport()
));


Flatsome_Option::add_field( '', array(
    'type'        => 'custom',
    'settings' => 'custom_title_post_layout',
    'label'       => __( '', 'flatsome-admin' ),
	'section'     => 'blog-layout',
    'default'     => '<div class="options-title-divider">Post layout</div>',
) );


Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-image',
	'settings'     => 'blog_posts_header_style',
	'label'       => __( 'Posts Title Style', 'flatsome-admin' ),
	'section'     => 'blog-layout',
	'active_callback'    => array(
		array(
			'setting'  => 'blog_style',
			'operator' => '===',
			'value'    => 'normal',
		),
	),
	'default'     => 'normal',
	'choices'     => array(
		'normal' => $image_url . 'text-top.svg',
		'bottom' => $image_url . 'text-bottom.svg',
	),
));

Flatsome_Option::add_field( 'option',  array(
	'type'        => 'radio-image',
	'settings'     => 'blog_posts_title_align',
	'label'       => __( 'Posts Title Align', 'flatsome-admin' ),
	'section'     => 'blog-layout',
	'default'     => 'center',
	'choices'     => array(
		'left' =>	$image_url . 'align-left.svg',
		'center' => $image_url . 'align-center.svg',
		'right' => 	$image_url . 'align-right.svg',
	),
));
