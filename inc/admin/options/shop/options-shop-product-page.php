<?php

Flatsome_Option::add_section( 'product-page', array(
	'title' => __( 'Product Page', 'flatsome-admin' ),
	'panel' => 'woocommerce',
) );

function flatsome_customizer_shop_product_page_options() {
	Flatsome_Option::add_field( '', array(
		'type'     => 'custom',
		'settings' => 'custom_title_product_layout',
		'label'    => __( '', 'flatsome-admin' ),
		'section'  => 'product-page',
		'default'  => '<div class="options-title-divider">Layout</div>',
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'     => 'radio-image',
		'settings' => 'product_layout',
		'label'    => __( 'Product Layout', 'flatsome-admin' ),
		'section'  => 'product-page',
		'default'  => flatsome_product_layout(),
		'choices'  => array(
			'no-sidebar'          => flatsome_customizer_images_uri() . '/layout-no-sidebar.svg',
			'left-sidebar'        => flatsome_customizer_images_uri() . '/layout-left.svg',
			'left-sidebar-full'   => flatsome_customizer_images_uri() . '/layout-left-full.svg',
			'left-sidebar-small'  => flatsome_customizer_images_uri() . '/layout-left-small.svg',
			'right-sidebar'       => flatsome_customizer_images_uri() . '/layout-right.svg',
			'right-sidebar-small' => flatsome_customizer_images_uri() . '/layout-right-small.svg',
			'right-sidebar-full'  => flatsome_customizer_images_uri() . '/layout-right-full.svg',
			'gallery-wide'        => flatsome_customizer_images_uri() . '/layout-wide-gallery.svg',
			'stacked-right'       => flatsome_customizer_images_uri() . '/product-stacked.svg',
			'custom'              => flatsome_customizer_images_uri() . '/layout-custom.svg',
		),
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'select',
		'settings'        => 'product_custom_layout',
		'label'           => __( 'Custom product layout', 'flatsome' ),
		'description'     => __( 'Create a custom product layout by using the UX Builder. You need to select a Block and then open it in the UX Builder from a product page in the front-end.', 'flatsome-admin' ),
		'section'         => 'product-page',
		'active_callback' => array(
			array(
				'setting'  => 'product_layout',
				'operator' => '==',
				'value'    => 'custom',
			),
		),
		'default'         => false,
		'choices'         => flatsome_customizer_blocks(),
	) );

	$hide_on_gallery_wide   = array(
		'setting'  => 'product_layout',
		'operator' => '!==',
		'value'    => 'gallery-wide',
	);
	$hide_on_custom_product = array(
		'setting'  => 'product_layout',
		'operator' => '!==',
		'value'    => 'custom',
	);

	Flatsome_Option::add_field( 'option', array(
		'type'     => 'checkbox',
		'settings' => 'product_offcanvas_sidebar',
		'label'    => __( 'Off-canvas Sidebar for Mobile', 'flatsome-admin' ),
		'section'  => 'product-page',
		'default'  => 0,
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'radio-image',
		'settings'        => 'product_header',
		'label'           => __( 'Product Header', 'flatsome-admin' ),
		'section'         => 'product-page',
		'default'         => '',
		'active_callback' => array(
			$hide_on_gallery_wide,
			$hide_on_custom_product,
		),
		'choices'         => array(
			''                => flatsome_customizer_images_uri() . '/product-title.svg',
			'top'             => flatsome_customizer_images_uri() . '/product-title-top.svg',
			'featured'        => flatsome_customizer_images_uri() . '/product-title-featured.svg',
			'featured-center' => flatsome_customizer_images_uri() . '/product-title-featured-center.svg',
		),
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'     => 'checkbox',
		'settings' => 'product_header_transparent',
		'label'    => __( 'Transparent Header', 'flatsome-admin' ),
		'section'  => 'product-page',
		'default'  => 0,
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'checkbox',
		'settings'        => 'product_next_prev_nav',
		'active_callback' => array(
			$hide_on_gallery_wide,
			$hide_on_custom_product,
		),
		'label'           => __( 'Next / Prev Navigation', 'flatsome-admin' ),
		'section'         => 'product-page',
		'default'         => 1,
	) );

	Flatsome_Option::add_field( '', array(
		'type'     => 'custom',
		'settings' => 'custom_title_product_gallery',
		'label'    => __( '', 'flatsome-admin' ),
		'section'  => 'product-page',
		'default'  => '<div class="options-title-divider">Gallery</div>',
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'select',
		'settings'        => 'product_image_width',
		'label'           => __( 'Product Image Width', 'flatsome-admin' ),
		'section'         => 'product-page',
		'active_callback' => function () {
			return ! get_theme_mod( 'product_gallery_woocommerce' )
						&& get_theme_mod( 'product_layout' ) !== 'gallery-wide'
						&& get_theme_mod( 'product_layout' ) !== 'custom';
		},
		'transport'       => flatsome_customizer_transport(),
		'default'         => '6',
		'choices'         => array(
			'8' => __( '8/12', 'flatsome-admin' ),
			'7' => __( '7/12', 'flatsome-admin' ),
			'6' => __( '6/12 (50%)', 'flatsome-admin' ),
			'5' => __( '5/12', 'flatsome-admin' ),
			'4' => __( '4/12', 'flatsome-admin' ),
			'3' => __( '3/12', 'flatsome-admin' ),
			'2' => __( '2/12', 'flatsome-admin' ),
		),
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'radio-image',
		'settings'        => 'product_image_style',
		'label'           => __( 'Product Image Style', 'flatsome-admin' ),
		'section'         => 'product-page',
		'active_callback' => function () {
			return ! get_theme_mod( 'product_gallery_woocommerce' )
						&& get_theme_mod( 'product_layout' ) !== 'gallery-wide'
						&& get_theme_mod( 'product_layout' ) !== 'custom'
						&& get_theme_mod( 'product_layout' ) !== 'stacked-right';
		},
		'default'         => 'normal',
		'choices'         => array(
			'normal'   => flatsome_customizer_images_uri() . '/product-gallery.svg',
			'vertical' => flatsome_customizer_images_uri() . '/product-gallery-vertical.svg',
		),
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'radio-image',
		'settings'        => 'product_gallery_grid_layout',
		'label'           => __( 'Grid layout', 'flatsome-admin' ),
		'section'         => 'product-page',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'product_layout',
				'operator' => '===',
				'value'    => 'stacked-right',
			),
		),
		'choices'         => array(
			''      => flatsome_customizer_images_uri() . '/product-gallery-grid-1.svg',
			'1-2'   => flatsome_customizer_images_uri() . '/product-gallery-grid-1-2.svg',
			'2'     => flatsome_customizer_images_uri() . '/product-gallery-grid-2.svg',
			'3-1-2' => flatsome_customizer_images_uri() . '/product-gallery-grid-3-1-2.svg',
		),
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'radio-buttonset',
		'settings'        => 'product_gallery_slider_type',
		'active_callback' => function () {
			return ! get_theme_mod( 'product_gallery_woocommerce' )
			       && get_theme_mod( 'product_layout' ) !== 'gallery-wide';
		},
		'label'           => esc_html__( 'Type', 'flatsome-admin' ),
		'section'         => 'product-page',
		'default'         => '',
		'choices'         => array(
			''     => esc_html__( 'Slide', 'flatsome-admin' ),
			'fade' => esc_html__( 'Fade', 'flatsome-admin' ),
		),
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'select',
		'settings'        => 'product_lightbox',
		'active_callback' => function() {
			return ! get_theme_mod( 'product_gallery_woocommerce' );
		},
		'label'           => __( 'Product Image Lightbox', 'flatsome-admin' ),
		'description'     => __( 'Show images in a lightbox when clicking on image in gallery. You might need to save and close Customizer for this to work properly.', 'flatsome-admin' ),
		'section'         => 'product-page',
		'default'         => 'default',
		'choices'         => array(
			'default'     => __( 'New WooCommerce 3.0 Lightbox', 'flatsome-admin' ),
			'flatsome'    => __( 'Flatsome Lightbox', 'flatsome-admin' ),
			'woocommerce' => __( 'Old WooCommerce Lightbox', 'flatsome-admin' ),
			'disabled'    => __( 'Disable Lightbox', 'flatsome-admin' ),
		),
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'checkbox',
		'settings'        => 'product_zoom',
		'active_callback' => function () {
			return ! get_theme_mod( 'product_gallery_woocommerce' )
						&& get_theme_mod( 'product_layout' ) !== 'gallery-wide';
		},
		'label'           => __( 'Product Image Hover Zoom', 'flatsome-admin' ),
		'description'     => __( 'Show a zoomed version of image when hovering gallery', 'flatsome-admin' ),
		'section'         => 'product-page',
		'default'         => 0,
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'checkbox',
		'settings'        => 'product_sticky_gallery',
		'active_callback' => function () {
			$product_layout = get_theme_mod( 'product_layout' );

			return $product_layout !== 'gallery-wide'
					&& $product_layout !== 'custom';
		},
		'label'           => esc_html__( 'Sticky gallery', 'flatsome-admin' ),
		'section'         => 'product-page',
		'default'         => 0,
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'select',
		'settings'        => 'product_sticky_gallery_mode',
		'label'           => esc_html__( 'Sticky mode', 'flatsome-admin' ),
		'section'         => 'product-page',
		'default'         => '',
		'choices'         => array(
			''           => esc_html__( 'CSS (native)', 'flatsome-admin' ),
			'javascript' => esc_html__( 'JavaScript (enhanced)', 'flatsome-admin' ),
		),
		'active_callback' => array(
			$hide_on_gallery_wide,
			$hide_on_custom_product,
			array(
				'setting'  => 'product_sticky_gallery',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Flatsome_Option::add_field( '', array(
		'type'     => 'custom',
		'settings' => 'custom_html_woocommerce_image_shortcut_product',
		'label'    => __( '', 'flatsome-admin' ),
		'section'  => 'product-page',
		'default'  => '<button style="margin-top: 15px; margin-bottom:15px" class="button button-primary" data-to-section="woocommerce_product_images">WooCommerce Image Settings →</button>',
	) );

	Flatsome_Option::add_field( '', array(
		'type'            => 'custom',
		'settings'        => 'custom_section_gallery_message',
		'label'           => __( '', 'flatsome-admin' ),
		'active_callback' => function () {
			return get_theme_mod( 'product_gallery_woocommerce' ) ? true : false;
		},
		'section'         => 'product-page',
		'default'         => '<span style="margin-top: -10px" class="description customize-control-description">The default WooCommerce gallery has been activated in section Advanced → WooCommerce. Multiple Flatsome gallery options are disabled.</span>',
	) );

	Flatsome_Option::add_field( '', array(
		'type'            => 'custom',
		'settings'        => 'custom_title_product_info',
		'label'           => __( '', 'flatsome-admin' ),
		'section'         => 'product-page',
		'default'         => '<div class="options-title-divider">Product Summary</div>',
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'radio-buttonset',
		'settings'        => 'product_info_align',
		'label'           => __( 'Text Align', 'flatsome-admin' ),
		'section'         => 'product-page',
		'active_callback' => array(
			$hide_on_gallery_wide,
			$hide_on_custom_product,
		),
		'default'         => 'left',
		'choices'         => array(
			'left'   => __( 'Left', 'flatsome-admin' ),
			'center' => __( 'Center', 'flatsome-admin' ),
			'right'  => __( 'Right', 'flatsome-admin' ),
		),
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'radio-buttonset',
		'settings'        => 'product_info_form',
		'active_callback' => array(
			$hide_on_custom_product,
		),
		'label'           => __( 'Form Style', 'flatsome-admin' ),
		'section'         => 'product-page',
		'default'         => '',
		'choices'         => array(
			''     => __( 'Default', 'flatsome-admin' ),
			'flat' => __( 'Flat', 'flatsome-admin' ),
			'minimal' => __( 'Minimal', 'flatsome-admin' ),
		),
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'checkbox',
		'settings'        => 'product_title_divider',
		'label'           => __( 'Product Title divider', 'flatsome-admin' ),
		'active_callback' => array(
			$hide_on_custom_product,
		),
		'section'         => 'product-page',
		'default'         => 1,
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'checkbox',
		'settings'        => 'product_brands',
		'label'           => __( 'Show brand image', 'flatsome-admin' ),
		'active_callback' => array(
			$hide_on_custom_product,
		),
		'section'         => 'product-page',
		'default'         => 0,
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'checkbox',
		'settings'        => 'product_info_review_count',
		'active_callback' => array(
			$hide_on_custom_product,
		),
		'label'           => __( 'Show Review Count', 'flatsome-admin' ),
		'section'         => 'product-page',
		'default'         => false,
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'select',
		'settings'        => 'product_info_review_count_style',
		'label'           => __( 'Review Count Style', 'flatsome-admin' ),
		'section'         => 'product-page',
		'active_callback' => array(
			$hide_on_custom_product,
			array(
				'setting'  => 'product_info_review_count',
				'operator' => '==',
				'value'    => true,
			),
		),
		'default'         => 'inline',
		'choices'         => array(
			'tooltip' => __( 'Tooltip', 'flatsome-admin' ),
			'stacked' => __( 'Stacked', 'flatsome-admin' ),
			'inline'  => __( 'Inline', 'flatsome-admin' ),
		),
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'     => 'checkbox',
		'settings' => 'product_sticky_cart',
		'label'    => esc_html__( 'Sticky add to cart', 'flatsome-admin' ),
		'section'  => 'product-page',
		'default'  => 0,
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'     => 'checkbox',
		'settings' => 'product_buy_now',
		'label'    => esc_html__( 'Buy now button', 'flatsome-admin' ),
		'section'  => 'product-page',
		'default'  => 0,
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'select',
		'settings'        => 'product_buy_now_redirect',
		'label'           => esc_html__( 'Buy now redirect', 'flatsome-admin' ),
		'section'         => 'product-page',
		'active_callback' => array(
			array(
				'setting'  => 'product_buy_now',
				'operator' => '==',
				'value'    => true,
			),
		),
		'default'         => 'checkout',
		'choices'         => array(
			'checkout' => esc_html__( 'Checkout page', 'flatsome-admin' ),
			'cart'     => esc_html__( 'Cart page', 'flatsome-admin' ),
		),
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'checkbox',
		'settings'        => 'product_info_meta',
		'active_callback' => array(
			$hide_on_gallery_wide,
			$hide_on_custom_product,
		),
		'label'           => __( 'Show Meta / Categories / Brands', 'flatsome-admin' ),
		'section'         => 'product-page',
		'default'         => 1,
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'checkbox',
		'settings'        => 'product_info_share',
		'active_callback' => array(
			$hide_on_custom_product,
		),
		'label'           => __( 'Show Share Icons', 'flatsome-admin' ),
		'section'         => 'product-page',
		'default'         => 1,
	) );

	if ( get_theme_mod( 'swatches' ) ) :
		Flatsome_Option::add_field( '', array(
			'type'     => 'custom',
			'settings' => 'custom_title_swatches',
			'label'    => '',
			'section'  => 'product-page',
			'default'  => '<div class="options-title-divider">Swatches</div>',
		) );

		Flatsome_Option::add_field( 'option', array(
			'type'     => 'radio-image',
			'settings' => 'swatches_layout',
			'label'    => __( 'Layout', 'flatsome' ),
			'section'  => 'product-page',
			'default'  => '',
			'choices'  => array(
				''        => flatsome_customizer_images_uri() . '/product-swatches.svg',
				'stacked' => flatsome_customizer_images_uri() . '/product-swatches-stacked.svg',
			),
		) );

		Flatsome_Option::add_field( 'option', array(
			'type'        => 'checkbox',
			'settings'    => 'swatches_tooltip',
			'label'       => __( 'Tooltip', 'flatsome' ),
			'description' => __( 'Show a tooltip with the term or term description.', 'flatsome' ),
			'section'     => 'product-page',
			'default'     => 1,
		) );

		Flatsome_Option::add_field( 'option', array(
			'type'        => 'checkbox',
			'settings'    => 'swatches_out_of_stock_inactive',
			'label'       => __( 'Inactive out of stock', 'flatsome' ),
			'description' => __( 'Show out of stock items as inactive.', 'flatsome' ),
			'section'     => 'product-page',
			'default'     => 0,
		) );

		Flatsome_Option::add_field( 'option', array(
			'type'     => 'checkbox',
			'settings' => 'swatches_disable_deselect',
			'label'    => __( 'Disable deselection', 'flatsome' ),
			'section'  => 'product-page',
			'default'  => 0,
		) );

		Flatsome_Option::add_field( 'option', array(
			'type'        => 'color',
			'settings'    => 'swatches_color_selected',
			'transport'   => flatsome_customizer_transport(),
			'label'       => __( 'Color :selected', 'flatsome' ),
			'description' => __( 'Default is Secondary color', 'flatsome-admin' ),
			'section'     => 'product-page',
			'default'     => '',
		) );
	endif;

	Flatsome_Option::add_field( '', array(
		'type'     => 'custom',
		'settings' => 'custom_title_product_tabs',
		'label'    => __( '', 'flatsome-admin' ),
		'section'  => 'product-page',
		'default'  => '<div class="options-title-divider">Tabs</div>',
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'select',
		'settings'        => 'product_display',
		'label'           => __( 'Product Tabs Style', 'flatsome-admin' ),
		'section'         => 'product-page',
		'active_callback' => array(
			$hide_on_custom_product,
		),
		'default'         => 'tabs',
		'choices'         => array(
			'tabs'                => __( 'Line Tabs', 'flatsome-admin' ),
			'tabs_normal'         => __( 'Tabs Normal', 'flatsome-admin' ),
			'line-grow'           => __( 'Line Tabs - Grow', 'flatsome-admin' ),
			'tabs_vertical'       => __( 'Tabs vertical', 'flatsome-admin' ),
			'tabs_pills'          => __( 'Pills', 'flatsome-admin' ),
			'tabs_outline'        => __( 'Outline', 'flatsome-admin' ),
			'sections'            => __( 'Sections', 'flatsome-admin' ),
			'accordian'           => __( 'Accordion', 'flatsome-admin' ),
			'accordian-collapsed' => __( 'Accordion - Collapsed', 'flatsome-admin' ),
		),
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'radio-buttonset',
		'settings'        => 'product_tabs_align',
		'label'           => __( 'Product Tabs Align', 'flatsome-admin' ),
		'section'         => 'product-page',
		'active_callback' => array(
			$hide_on_custom_product,
		),
		'default'         => 'left',
		'choices'         => array(
			'left'   => __( 'Left', 'flatsome-admin' ),
			'center' => __( 'Center', 'flatsome-admin' ),
			'right'  => __( 'Right', 'flatsome-admin' ),
		),
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'              => 'text',
		'settings'          => 'tab_title',
		'label'             => __( 'Global custom tab title', 'flatsome-admin' ),
		'section'           => 'product-page',
		'sanitize_callback' => 'flatsome_custom_sanitize',
		'default'           => '',
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'              => 'textarea',
		'settings'          => 'tab_content',
		'label'             => __( 'Global custom tab content', 'flatsome-admin' ),
		'section'           => 'product-page',
		'sanitize_callback' => 'flatsome_custom_sanitize',
		'default'           => '',
	) );


	Flatsome_Option::add_field( '', array(
		'type'     => 'custom',
		'settings' => 'custom_title_product_related',
		'label'    => __( '', 'flatsome-admin' ),
		'section'  => 'product-page',
		'default'  => '<div class="options-title-divider">Related / Upsell</div>',
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'select',
		'settings'        => 'product_upsell',
		'label'           => __( 'Product Upsell', 'flatsome-admin' ),
		'section'         => 'product-page',
		'active_callback' => array(
			$hide_on_gallery_wide,
			$hide_on_custom_product,
		),
		'default'         => 'sidebar',
		'choices'         => array(
			'sidebar'  => __( 'In Sidebar', 'flatsome-admin' ),
			'bottom'   => __( 'Below Description', 'flatsome-admin' ),
			'disabled' => __( 'Disabled', 'flatsome-admin' ),
		),
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'            => 'select',
		'settings'        => 'related_products',
		'label'           => __( 'Related Products Style', 'flatsome-admin' ),
		'section'         => 'product-page',
		'active_callback' => array(
			$hide_on_custom_product,
		),
		'default'         => 'slider',
		'choices'         => array(
			'slider' => __( 'Slider', 'flatsome-admin' ),
			'grid'   => __( 'Grid', 'flatsome-admin' ),
			'hidden' => __( 'Disabled', 'flatsome-admin' ),
		),
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'     => 'slider',
		'settings' => 'related_products_pr_row',
		'label'    => __( 'Products per row - Desktop', 'flatsome-admin' ),
		'section'  => 'product-page',
		'default'  => 4,
		'choices'  => array(
			'min'  => 1,
			'max'  => 6,
			'step' => 1,
		),
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'     => 'slider',
		'settings' => 'related_products_pr_row_tablet',
		'label'    => __( 'Products per row - Tablet', 'flatsome-admin' ),
		'section'  => 'product-page',
		'default'  => 3,
		'choices'  => array(
			'min'  => 1,
			'max'  => 4,
			'step' => 1,
		),
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'     => 'slider',
		'settings' => 'related_products_pr_row_mobile',
		'label'    => __( 'Products per row - Mobile', 'flatsome-admin' ),
		'section'  => 'product-page',
		'default'  => 2,
		'choices'  => array(
			'min'  => 1,
			'max'  => 3,
			'step' => 1,
		),
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'     => 'text',
		'settings' => 'max_related_products',
		'label'    => __( 'Max number of Related Products', 'flatsome-admin' ),
		'section'  => 'product-page',
		'default'  => 8,
	) );

	Flatsome_Option::add_field( '', array(
		'type'     => 'custom',
		'settings' => 'custom_title_product_html',
		'label'    => __( '', 'flatsome-admin' ),
		'section'  => 'product-page',
		'default'  => '<div class="options-title-divider">Custom HTML</div>',
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'              => 'textarea',
		'settings'          => 'html_before_add_to_cart',
		'label'             => __( 'HTML before Add To Cart button', 'flatsome-admin' ),
		'section'           => 'product-page',
		'sanitize_callback' => 'flatsome_custom_sanitize',
		'default'           => '',
	) );

	Flatsome_Option::add_field( 'option', array(
		'type'              => 'textarea',
		'settings'          => 'html_after_add_to_cart',
		'label'             => __( 'HTML after Add To Cart button', 'flatsome-admin' ),
		'section'           => 'product-page',
		'sanitize_callback' => 'flatsome_custom_sanitize',
		'default'           => '',
	) );
}
add_action( 'init', 'flatsome_customizer_shop_product_page_options' );
