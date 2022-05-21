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
				'title'          => __( 'Image', 'pm-cpt' ),
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
		'has_one'        => __( 'External link', 'pm-cpt' ),
		'has_many'       => __( 'External links', 'pm-cpt' ),
		'featured_image' => __( 'External link Cover', 'pm-cpt' ),
		'text_domain'    => 'pm-cpt',

		// optional, but better for translation
		'overrides'      => [
			'labels'        => [
				'name'                  => __( 'External links', 'pm-cpt' ),
				'singular_name'         => __( 'External link', 'pm-cpt' ),
				'menu_name'             => __( 'External links', 'pm-cpt' ),
				'name_admin_bar'        => __( 'External link', 'pm-cpt' ),
				'add_new'               => __( 'Add New', 'pm-cpt' ),
				'add_new_item'          => __( 'Add New External link', 'pm-cpt' ),
				'edit_item'             => __( 'Edit External link', 'pm-cpt' ),
				'new_item'              => __( 'New External link', 'pm-cpt' ),
				'view_item'             => __( 'View External link', 'pm-cpt' ),
				'view_items'            => __( 'View External links', 'pm-cpt' ),
				'search_items'          => __( 'Search External links', 'pm-cpt' ),
				'not_found'             => __( 'No external links found.', 'pm-cpt' ),
				'not_found_in_trash'    => __( 'No external links found in Trash.', 'pm-cpt' ),
				'parent_item-colon'     => __( 'Parent External links:', 'pm-cpt' ),
				'all_items'             => __( 'All External links', 'pm-cpt' ),
				'archives'              => __( 'External link Archives', 'pm-cpt' ),
				'attributes'            => __( 'External link Attributes', 'pm-cpt' ),
				'insert_into_item'      => __( 'Insert into external link', 'pm-cpt' ),
				'uploaded_to_this_item' => __( 'Uploaded to this external link', 'pm-cpt' ),
				'featured_image'        => __( 'Featured Image', 'pm-cpt' ),
				'set_featured_image'    => __( 'Set featured image', 'pm-cpt' ),
				'remove_featured_image' => __( 'Remove featured image', 'pm-cpt' ),
				'use_featured_image'    => __( 'Use featured image', 'pm-cpt' ),
				'filter_items_list'     => __( 'Filter external links list', 'pm-cpt' ),
				'items_list_navigation' => __( 'External links list navigation', 'pm-cpt' ),
				'items_list'            => __( 'External links list', 'pm-cpt' ),
				'featured_image'        => __( 'External link Cover Image', 'pm-cpt' ),
				'set_featured_image'    => __( 'Set External link Cover Image', 'pm-cpt' ),
				'remove_featured_image' => __( 'Remove External link Cover', 'pm-cpt' ),
				'use_featured_image'    => __( 'Use as External link Cover', 'pm-cpt' ),
			],
			// you can use the placeholders {permalink}, {preview_url}, {date}
			'messages'      => [
				'post_updated'         => __( 'External link information updated. <a href="{permalink}" target="_blank">View External link</a>', 'pm-cpt' ),
				'post_updated_short'   => __( 'External link info updated', 'pm-cpt' ),
				'custom_field_updated' => __( 'Custom field updated', 'pm-cpt' ),
				'custom_field_deleted' => __( 'Custom field deleted', 'pm-cpt' ),
				'restored_to_revision' => __( 'External link content restored from revision', 'pm-cpt' ),
				'post_published'       => __( 'External link Published', 'pm-cpt' ),
				'post_saved'           => __( 'External link information saved.', 'pm-cpt' ),
				'post_submitted'       => __( 'External link submitted. <a href="{preview_url}" target="_blank">Preview</a>', 'pm-cpt' ),
				'post_schedulled'      => __( 'External link scheduled for {date}. <a href="{preview_url}" target="_blank">Preview</a>', 'pm-cpt' ),
				'post_draft_updated'   => __( 'External link draft updated. <a href="{preview_url}" target="_blank">Preview</a>', 'pm-cpt' ),
			],
			'bulk_messages' => [
				'updated_singular'   => __( 'External link updated. Yay!', 'pm-cpt' ),
				// translators: %s is for number of external links updated
				'updated_plural'     => __( '%s External links updated. Yay!', 'pm-cpt' ),
				'locked_singular'    => __( 'External link not updated, somebody is editing it', 'pm-cpt' ),
				// translators: %s is for number of external links not updated
				'locked_plural'      => __( '%s External links not updated, somebody is editing them', 'pm-cpt' ),
				'deleted_singular'   => __( 'External link permanetly deleted. Fahrenheit 451 team was here?', 'pm-cpt' ),
				// translators: %s is for number of external links permanently deleted
				'deleted_plural'     => __( '%s External links permanently deleted. Why? :(', 'pm-cpt' ),
				'trashed_singular'   => __( 'External link moved to the trash. I\'m sad :(', 'pm-cpt' ),
				// translators: %s is for number of external links moved to the trash
				'trashed_plural'     => __( '%s External links moved to the trash. Why? :(', 'pm-cpt' ),
				'untrashed_singular' => __( 'External link recovered from the trash. Well done!', 'pm-cpt' ),
				// translators: %s is for number of external links saved from the trash
				'untrashed_plural'   => __( '%s External links saved from the trash!', 'pm-cpt' ),
			],
			// overrides some of the available button labels and placeholders
			'ui'            => [
				'enter_title_here' => __( 'Enter external link name here', 'pm-cpt' ),
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
			'title'    => __( 'Information', 'pm-cpt' ),
			'sections' => [
				'information' => [
					'title'  => __( 'External link', 'pm-cpt' ),
					'desc'   => __( 'Information regarding the external link', 'pm-cpt' ),
					'icon'   => 'fa fa-file-text-o',
					'fields' => [
						'external-link-url' => [
							'title' => __( 'Local', 'pm-cpt' ),
							'type'  => 'text',
							'desc'  => __( 'The local for this external link.', 'pm-cpt' ),
						],
					],
				],
			],
		],
	],
];
