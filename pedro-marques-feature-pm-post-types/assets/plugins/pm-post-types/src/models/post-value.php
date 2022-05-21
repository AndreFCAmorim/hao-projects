<?php

return [
	'active'       => true,
	'type'         => 'cpt',
	'name'         => 'value',
	'features'     => [
		'dragAndDrop'   => true,
		'duplicate'     => true,
		'single_export' => true,
		'admin_cols'    => [
			'title',
			'value-quote'    => [
				'title'    => __( 'Quote', 'framework-demo' ),
				'meta_key' => 'value-quote',
			],
			'featured_image' => [
				'title'          => __( 'Image', 'framework-demo' ),
				'featured_image' => '',
				'width'          => 50,
				'height'         => 50,
			],
		],
		'admin_filters' => [],
	],
	'supports'     => [
		'title',
		'excerpt',
		'editor',
		'page-attributes',
		'thumbnail',
	],
	'labels'       => [
		'has_one'        => __( 'Case Study', 'framework-demo' ),
		'has_many'       => __( 'Values', 'framework-demo' ),
		'featured_image' => __( 'ValueCover', 'framework-demo' ),
		'text_domain'    => 'framework-demo',

		// optional, but better for translation
		'overrides'      => [
			'labels'        => [
				'name'                  => __( 'Values', 'framework-demo' ),
				'singular_name'         => __( 'Case Study', 'framework-demo' ),
				'menu_name'             => __( 'Values', 'framework-demo' ),
				'name_admin_bar'        => __( 'Case Study', 'framework-demo' ),
				'add_new'               => __( 'Add New', 'framework-demo' ),
				'add_new_item'          => __( 'Add New Case Study', 'framework-demo' ),
				'edit_item'             => __( 'Edit Case Study', 'framework-demo' ),
				'new_item'              => __( 'New Case Study', 'framework-demo' ),
				'view_item'             => __( 'View Case Study', 'framework-demo' ),
				'view_items'            => __( 'View Values', 'framework-demo' ),
				'search_items'          => __( 'Search Values', 'framework-demo' ),
				'not_found'             => __( 'No values found.', 'framework-demo' ),
				'not_found_in_trash'    => __( 'No values found in Trash.', 'framework-demo' ),
				'parent_item-colon'     => __( 'Parent Values:', 'framework-demo' ),
				'all_items'             => __( 'All Values', 'framework-demo' ),
				'archives'              => __( 'ValueArchives', 'framework-demo' ),
				'attributes'            => __( 'ValueAttributes', 'framework-demo' ),
				'insert_into_item'      => __( 'Insert into value', 'framework-demo' ),
				'uploaded_to_this_item' => __( 'Uploaded to this value', 'framework-demo' ),
				'featured_image'        => __( 'Featured Image', 'framework-demo' ),
				'set_featured_image'    => __( 'Set featured image', 'framework-demo' ),
				'remove_featured_image' => __( 'Remove featured image', 'framework-demo' ),
				'use_featured_image'    => __( 'Use featured image', 'framework-demo' ),
				'filter_items_list'     => __( 'Filter values list', 'framework-demo' ),
				'items_list_navigation' => __( 'Values list navigation', 'framework-demo' ),
				'items_list'            => __( 'Values list', 'framework-demo' ),
				'featured_image'        => __( 'ValueCover Image', 'framework-demo' ),
				'set_featured_image'    => __( 'Set ValueCover Image', 'framework-demo' ),
				'remove_featured_image' => __( 'Remove ValueCover', 'framework-demo' ),
				'use_featured_image'    => __( 'Use as ValueCover', 'framework-demo' ),
			],
			// you can use the placeholders {permalink}, {preview_url}, {date}
			'messages'      => [
				'post_updated'         => __( 'Valueinformation updated. <a href="{permalink}" target="_blank">View Case Study</a>', 'framework-demo' ),
				'post_updated_short'   => __( 'Valueinfo updated', 'framework-demo' ),
				'custom_field_updated' => __( 'Custom field updated', 'framework-demo' ),
				'custom_field_deleted' => __( 'Custom field deleted', 'framework-demo' ),
				'restored_to_revision' => __( 'Valuecontent restored from revision', 'framework-demo' ),
				'post_published'       => __( 'ValuePublished', 'framework-demo' ),
				'post_saved'           => __( 'Valueinformation saved.', 'framework-demo' ),
				'post_submitted'       => __( 'Valuesubmitted. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
				'post_schedulled'      => __( 'Valuescheduled for {date}. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
				'post_draft_updated'   => __( 'Valuedraft updated. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
			],
			'bulk_messages' => [
				'updated_singular'   => __( 'Valueupdated. Yay!', 'framework-demo' ),
				// translators: %s is for number of values updated
				'updated_plural'     => __( '%s Values updated. Yay!', 'framework-demo' ),
				'locked_singular'    => __( 'Valuenot updated, somebody is editing it', 'framework-demo' ),
				// translators: %s is for number of values not updated
				'locked_plural'      => __( '%s Values not updated, somebody is editing them', 'framework-demo' ),
				'deleted_singular'   => __( 'Valuepermanetly deleted. Fahrenheit 451 team was here?', 'framework-demo' ),
				// translators: %s is for number of values permanently deleted
				'deleted_plural'     => __( '%s Values permanently deleted. Why? :(', 'framework-demo' ),
				'trashed_singular'   => __( 'Valuemoved to the trash. I\'m sad :(', 'framework-demo' ),
				// translators: %s is for number of values moved to the trash
				'trashed_plural'     => __( '%s Values moved to the trash. Why? :(', 'framework-demo' ),
				'untrashed_singular' => __( 'Valuerecovered from the trash. Well done!', 'framework-demo' ),
				// translators: %s is for number of values saved from the trash
				'untrashed_plural'   => __( '%s Values saved from the trash!', 'framework-demo' ),
			],
			// overrides some of the available button labels and placeholders
			'ui'            => [
				'enter_title_here' => __( 'Enter value name here', 'framework-demo' ),
			],
		],
	],
	'options'      => [
		'public'             => true,
		'publicly_queryable' => true,
		'show_in_rest'       => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'can_export'         => true,
		'capability_type'    => 'post',
		'menu_icon'          => 'dashicons-universal-access',
		'rewrite'            => [
			'slug'       => 'value',
			'with_front' => true,
			'feeds'      => true,
			'pages'      => true,
		],
	],
	'block_editor' => true,
	'meta'         => [
		'value_info' => [
			'id'       => 'information_metabox',
			'title'    => __( 'Information', 'framework-demo' ),
			'sections' => [
				'information' => [
					'title'  => __( 'Value', 'framework-demo' ),
					'desc'   => __( 'Information regarding the value', 'framework-demo' ),
					'icon'   => 'fa fa-file-text-o',
					'fields' => [
						'value-quote' => [
							'title' => __( 'Quote', 'framework-demo' ),
							'type'  => 'text',
							'desc'  => __( 'The quote for this value.', 'framework-demo' ),
						],
					],
				],
			],
		],
	],
];
