<?php

return [
	'active'       => true,
	'type'         => 'cpt',
	'name'         => 'slider',
	'features'     => [
		'dragAndDrop'   => true,
		'duplicate'     => true,
		'single_export' => true,
		'admin_cols'    => [
			'title',
			'date',
		],
	],
	'supports'     => [
		'title',
	],
	'labels'       => [
		'has_one'     => __( 'Slide', 'pm-cpt' ),
		'has_many'    => __( 'Slider', 'pm-cpt' ),
		'text_domain' => 'pm-cpt',

		// optional, but better for translation
		'overrides'   => [
			'labels'        => [
				'name'                  => __( 'Slider', 'pm-cpt' ),
				'singular_name'         => __( 'Slide', 'pm-cpt' ),
				'menu_name'             => __( 'Slider', 'pm-cpt' ),
				'name_admin_bar'        => __( 'Slide', 'pm-cpt' ),
				'add_new'               => __( 'Add New', 'pm-cpt' ),
				'add_new_item'          => __( 'Add New Image', 'pm-cpt' ),
				'edit_item'             => __( 'Edit Image', 'pm-cpt' ),
				'new_item'              => __( 'New Image', 'pm-cpt' ),
				'view_item'             => __( 'View Image', 'pm-cpt' ),
				'view_items'            => __( 'View Images', 'pm-cpt' ),
				'search_items'          => __( 'Search Images', 'pm-cpt' ),
				'not_found'             => __( 'No images found.', 'pm-cpt' ),
				'not_found_in_trash'    => __( 'No images found in Trash.', 'pm-cpt' ),
				'parent_item-colon'     => __( 'Parent Images:', 'pm-cpt' ),
				'all_items'             => __( 'All Images', 'pm-cpt' ),
				'archives'              => __( 'Image Archives', 'pm-cpt' ),
				'attributes'            => __( 'Image Attributes', 'pm-cpt' ),
				'insert_into_item'      => __( 'Insert into image', 'pm-cpt' ),
				'uploaded_to_this_item' => __( 'Uploaded to this image', 'pm-cpt' ),
				'featured_image'        => __( 'Featured Image', 'pm-cpt' ),
				'set_featured_image'    => __( 'Set featured image', 'pm-cpt' ),
				'remove_featured_image' => __( 'Remove featured image', 'pm-cpt' ),
				'use_featured_image'    => __( 'Use featured image', 'pm-cpt' ),
				'filter_items_list'     => __( 'Filter images list', 'pm-cpt' ),
				'items_list_navigation' => __( 'Images list navigation', 'pm-cpt' ),
				'items_list'            => __( 'Images list', 'pm-cpt' ),
				'featured_image'        => __( 'Image Cover Image', 'pm-cpt' ),
				'set_featured_image'    => __( 'Set Image Cover Image', 'pm-cpt' ),
				'remove_featured_image' => __( 'Remove Image Cover', 'pm-cpt' ),
				'use_featured_image'    => __( 'Use as Image Cover', 'pm-cpt' ),
			],
			// you can use the placeholders {permalink}, {preview_url}, {date}
			'messages'      => [
				'post_updated'         => __( 'Image information updated. <a href="{permalink}" target="_blank">View Image</a>', 'pm-cpt' ),
				'post_updated_short'   => __( 'Image info updated', 'pm-cpt' ),
				'custom_field_updated' => __( 'Custom field updated', 'pm-cpt' ),
				'custom_field_deleted' => __( 'Custom field deleted', 'pm-cpt' ),
				'restored_to_revision' => __( 'Image content restored from revision', 'pm-cpt' ),
				'post_published'       => __( 'Image Published', 'pm-cpt' ),
				'post_saved'           => __( 'Image information saved.', 'pm-cpt' ),
				'post_submitted'       => __( 'Image submitted. <a href="{preview_url}" target="_blank">Preview</a>', 'pm-cpt' ),
				'post_schedulled'      => __( 'Image scheduled for {date}. <a href="{preview_url}" target="_blank">Preview</a>', 'pm-cpt' ),
				'post_draft_updated'   => __( 'Image draft updated. <a href="{preview_url}" target="_blank">Preview</a>', 'pm-cpt' ),
			],
			'bulk_messages' => [
				'updated_singular'   => __( 'Image updated. Yay!', 'pm-cpt' ),
				// translators: %s is for number of topics updated
				'updated_plural'     => __( '%s Images updated. Yay!', 'pm-cpt' ),
				'locked_singular'    => __( 'Image not updated, somebody is editing it', 'pm-cpt' ),
				// translators: %s is for number of topics not updated
				'locked_plural'      => __( '%s Images not updated, somebody is editing them', 'pm-cpt' ),
				'deleted_singular'   => __( 'Image permanetly deleted. Fahrenheit 451 topic was here?', 'pm-cpt' ),
				// translators: %s is for number of topics permanently deleted
				'deleted_plural'     => __( '%s Images permanently deleted. Why? :(', 'pm-cpt' ),
				'trashed_singular'   => __( 'Image moved to the trash. I\'m sad :(', 'pm-cpt' ),
				// translators: %s is for number of topics moved to the trash
				'trashed_plural'     => __( '%s Images moved to the trash. Why? :(', 'pm-cpt' ),
				'untrashed_singular' => __( 'Image recovered from the trash. Well done!', 'pm-cpt' ),
				// translators: %s is for number of topics saved from the trash
				'untrashed_plural'   => __( '%s Images saved from the trash!', 'pm-cpt' ),
			],
			// overrides some of the available button labels and placeholders
			'ui'            => [
				'enter_title_here' => __( 'Enter image name here', 'pm-cpt' ),
			],
		],
	],
	'options'      => [
		'public'             => false,
		'publicly_queryable' => true,
		'show_in_rest'       => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'can_export'         => true,
		'capability_type'    => 'post',
		'menu_icon'          => 'dashicons-cover-image',
		'rewrite'            => [
			'slug'       => 'slider',
			'with_front' => true,
			'feeds'      => true,
			'pages'      => true,
		],
	],
	'block_editor' => true,
	'meta'         => [
		'slider_info' => [
			'id'       => 'information_metabox',
			'title'    => __( 'Information', 'pm-cpt' ),
			'sections' => [
				'information' => [
					'title'  => __( 'Image', 'pm-cpt' ),
					'desc'   => __( 'Information regarding the image', 'pm-cpt' ),
					'icon'   => 'fa fa-file-text-o',
					'fields' => [
						'slider-image' => [
							'title'   => __( 'Image', 'pm-cpt' ),
							'type'    => 'media',
							'library' => 'image',
							'desc'    => __( 'The image for this slider. Recommended resolution: 1920x1020.', 'pm-cpt' ),
						],
					],
				],
			],
		],
	],
];
