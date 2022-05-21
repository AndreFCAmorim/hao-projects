<?php

return [
	'active'       => true,
	'type'         => 'cpt',
	'name'         => 'external-link',
	'features'     => [
		'dragAndDrop'   => true,
		'duplicate'     => true,
		'single_export' => true,
		'admin_cols'    => [
			'title',
			'external-link-categories' => [
				'taxonomy' => 'external-link-category',
			],
			'featured_image'           => [
				'title'          => __( 'Image', 'framework-demo' ),
				'featured_image' => '',
				'width'          => 50,
				'height'         => 50,
			],
		],
		'admin_filters' => [
			'external-link-categories' => [
				'taxonomy' => 'external-link-category',
			],
		],
		'admin_filters' => [],
	],
	'supports'     => [
		'title',
		'page-attributes',
		'thumbnail',
	],
	'labels'       => [
		'has_one'        => __( 'External link', 'framework-demo' ),
		'has_many'       => __( 'External links', 'framework-demo' ),
		'featured_image' => __( 'External link Cover', 'framework-demo' ),
		'text_domain'    => 'framework-demo',

		// optional, but better for translation
		'overrides'      => [
			'labels'        => [
				'name'                  => __( 'External links', 'framework-demo' ),
				'singular_name'         => __( 'External link', 'framework-demo' ),
				'menu_name'             => __( 'External links', 'framework-demo' ),
				'name_admin_bar'        => __( 'External link', 'framework-demo' ),
				'add_new'               => __( 'Add New', 'framework-demo' ),
				'add_new_item'          => __( 'Add New External link', 'framework-demo' ),
				'edit_item'             => __( 'Edit External link', 'framework-demo' ),
				'new_item'              => __( 'New External link', 'framework-demo' ),
				'view_item'             => __( 'View External link', 'framework-demo' ),
				'view_items'            => __( 'View External links', 'framework-demo' ),
				'search_items'          => __( 'Search External links', 'framework-demo' ),
				'not_found'             => __( 'No external links found.', 'framework-demo' ),
				'not_found_in_trash'    => __( 'No external links found in Trash.', 'framework-demo' ),
				'parent_item-colon'     => __( 'Parent External links:', 'framework-demo' ),
				'all_items'             => __( 'All External links', 'framework-demo' ),
				'archives'              => __( 'External link Archives', 'framework-demo' ),
				'attributes'            => __( 'External link Attributes', 'framework-demo' ),
				'insert_into_item'      => __( 'Insert into external link', 'framework-demo' ),
				'uploaded_to_this_item' => __( 'Uploaded to this external link', 'framework-demo' ),
				'featured_image'        => __( 'Featured Image', 'framework-demo' ),
				'set_featured_image'    => __( 'Set featured image', 'framework-demo' ),
				'remove_featured_image' => __( 'Remove featured image', 'framework-demo' ),
				'use_featured_image'    => __( 'Use featured image', 'framework-demo' ),
				'filter_items_list'     => __( 'Filter external links list', 'framework-demo' ),
				'items_list_navigation' => __( 'External links list navigation', 'framework-demo' ),
				'items_list'            => __( 'External links list', 'framework-demo' ),
				'featured_image'        => __( 'External link Cover Image', 'framework-demo' ),
				'set_featured_image'    => __( 'Set External link Cover Image', 'framework-demo' ),
				'remove_featured_image' => __( 'Remove External link Cover', 'framework-demo' ),
				'use_featured_image'    => __( 'Use as External link Cover', 'framework-demo' ),
			],
			// you can use the placeholders {permalink}, {preview_url}, {date}
			'messages'      => [
				'post_updated'         => __( 'External link information updated. <a href="{permalink}" target="_blank">View External link</a>', 'framework-demo' ),
				'post_updated_short'   => __( 'External link info updated', 'framework-demo' ),
				'custom_field_updated' => __( 'Custom field updated', 'framework-demo' ),
				'custom_field_deleted' => __( 'Custom field deleted', 'framework-demo' ),
				'restored_to_revision' => __( 'External link content restored from revision', 'framework-demo' ),
				'post_published'       => __( 'External link Published', 'framework-demo' ),
				'post_saved'           => __( 'External link information saved.', 'framework-demo' ),
				'post_submitted'       => __( 'External link submitted. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
				'post_schedulled'      => __( 'External link scheduled for {date}. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
				'post_draft_updated'   => __( 'External link draft updated. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
			],
			'bulk_messages' => [
				'updated_singular'   => __( 'External link updated. Yay!', 'framework-demo' ),
				// translators: %s is for number of external links updated
				'updated_plural'     => __( '%s External links updated. Yay!', 'framework-demo' ),
				'locked_singular'    => __( 'External link not updated, somebody is editing it', 'framework-demo' ),
				// translators: %s is for number of external links not updated
				'locked_plural'      => __( '%s External links not updated, somebody is editing them', 'framework-demo' ),
				'deleted_singular'   => __( 'External link permanetly deleted. Fahrenheit 451 team was here?', 'framework-demo' ),
				// translators: %s is for number of external links permanently deleted
				'deleted_plural'     => __( '%s External links permanently deleted. Why? :(', 'framework-demo' ),
				'trashed_singular'   => __( 'External link moved to the trash. I\'m sad :(', 'framework-demo' ),
				// translators: %s is for number of external links moved to the trash
				'trashed_plural'     => __( '%s External links moved to the trash. Why? :(', 'framework-demo' ),
				'untrashed_singular' => __( 'External link recovered from the trash. Well done!', 'framework-demo' ),
				// translators: %s is for number of external links saved from the trash
				'untrashed_plural'   => __( '%s External links saved from the trash!', 'framework-demo' ),
			],
			// overrides some of the available button labels and placeholders
			'ui'            => [
				'enter_title_here' => __( 'Enter external link name here', 'framework-demo' ),
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
		'menu_icon'          => 'dashicons-external',
		'rewrite'            => [
			'slug'       => 'external-link',
			'with_front' => true,
			'feeds'      => true,
			'pages'      => true,
		],
	],
	'block_editor' => true,
	'meta'         => [
		'external-link_info' => [
			'id'       => 'information_metabox',
			'title'    => __( 'Information', 'framework-demo' ),
			'sections' => [
				'information' => [
					'title'  => __( 'External link', 'framework-demo' ),
					'desc'   => __( 'Information regarding the external link', 'framework-demo' ),
					'icon'   => 'fa fa-file-text-o',
					'fields' => [
						'external-link-url' => [
							'title' => __( 'Local', 'framework-demo' ),
							'type'  => 'text',
							'desc'  => __( 'The local for this external link.', 'framework-demo' ),
						],
					],
				],
			],
		],
	],
];
