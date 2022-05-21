<?php

return [
	'active'       => true,
	'type'         => 'cpt',
	'name'         => 'dossier',
	'features'     => [
		'dragAndDrop'   => true,
		'duplicate'     => true,
		'single_export' => true,
		'admin_cols'    => [
			'title',
			'topics' => [
				'taxonomy' => 'topics',
			],
			'dossier-credit'   => [
				'title'    => __( 'Credit', 'pm-cpt' ),
				'meta_key' => 'dossier-credit',
			],
			'dossier-date'     => [
				'title'    => __( 'Date', 'pm-cpt' ),
				'meta_key' => 'dossier-date',
			],
			'dossier-local'    => [
				'title'    => __( 'Local', 'pm-cpt' ),
				'meta_key' => 'dossier-local',
			],
			'featured_image'   => [
				'title'          => __( 'Image', 'pm-cpt' ),
				'featured_image' => '',
				'width'          => 50,
				'height'         => 50,
			],
		],
		'admin_filters' => [
			'topics' => [
				'taxonomy' => 'topics',
			],
		],
	],
	'supports'     => [
		'title',
		'excerpt',
		'editor',
		'page-attributes',
		'thumbnail',
	],
	'labels'       => [
		'has_one'        => __( 'Dossier', 'pm-cpt' ),
		'has_many'       => __( 'Dossiers', 'pm-cpt' ),
		'featured_image' => __( 'Dossier Cover', 'pm-cpt' ),
		'text_domain'    => 'pm-cpt',

		// optional, but better for translation
		'overrides'      => [
			'labels'        => [
				'name'                  => __( 'Dossiers', 'pm-cpt' ),
				'singular_name'         => __( 'Dossier', 'pm-cpt' ),
				'menu_name'             => __( 'Dossiers', 'pm-cpt' ),
				'name_admin_bar'        => __( 'Dossier', 'pm-cpt' ),
				'add_new'               => __( 'Add New', 'pm-cpt' ),
				'add_new_item'          => __( 'Add New Dossier', 'pm-cpt' ),
				'edit_item'             => __( 'Edit Dossier', 'pm-cpt' ),
				'new_item'              => __( 'New Dossier', 'pm-cpt' ),
				'view_item'             => __( 'View Dossier', 'pm-cpt' ),
				'view_items'            => __( 'View Dossiers', 'pm-cpt' ),
				'search_items'          => __( 'Search Dossiers', 'pm-cpt' ),
				'not_found'             => __( 'No dossiers found.', 'pm-cpt' ),
				'not_found_in_trash'    => __( 'No dossiers found in Trash.', 'pm-cpt' ),
				'parent_item-colon'     => __( 'Parent Dossiers:', 'pm-cpt' ),
				'all_items'             => __( 'All Dossiers', 'pm-cpt' ),
				'archives'              => __( 'Dossier Archives', 'pm-cpt' ),
				'attributes'            => __( 'Dossier Attributes', 'pm-cpt' ),
				'insert_into_item'      => __( 'Insert into dossier', 'pm-cpt' ),
				'uploaded_to_this_item' => __( 'Uploaded to this dossier', 'pm-cpt' ),
				'featured_image'        => __( 'Featured Image', 'pm-cpt' ),
				'set_featured_image'    => __( 'Set featured image', 'pm-cpt' ),
				'remove_featured_image' => __( 'Remove featured image', 'pm-cpt' ),
				'use_featured_image'    => __( 'Use featured image', 'pm-cpt' ),
				'filter_items_list'     => __( 'Filter dossiers list', 'pm-cpt' ),
				'items_list_navigation' => __( 'Dossiers list navigation', 'pm-cpt' ),
				'items_list'            => __( 'Dossiers list', 'pm-cpt' ),
				'featured_image'        => __( 'Dossier Cover Image', 'pm-cpt' ),
				'set_featured_image'    => __( 'Set Dossier Cover Image', 'pm-cpt' ),
				'remove_featured_image' => __( 'Remove Dossier Cover', 'pm-cpt' ),
				'use_featured_image'    => __( 'Use as Dossier Cover', 'pm-cpt' ),
			],
			// you can use the placeholders {permalink}, {preview_url}, {date}
			'messages'      => [
				'post_updated'         => __( 'Dossier information updated. <a href="{permalink}" target="_blank">View Dossier</a>', 'pm-cpt' ),
				'post_updated_short'   => __( 'Dossier info updated', 'pm-cpt' ),
				'custom_field_updated' => __( 'Custom field updated', 'pm-cpt' ),
				'custom_field_deleted' => __( 'Custom field deleted', 'pm-cpt' ),
				'restored_to_revision' => __( 'Dossier content restored from revision', 'pm-cpt' ),
				'post_published'       => __( 'Dossier Published', 'pm-cpt' ),
				'post_saved'           => __( 'Dossier information saved.', 'pm-cpt' ),
				'post_submitted'       => __( 'Dossier submitted. <a href="{preview_url}" target="_blank">Preview</a>', 'pm-cpt' ),
				'post_schedulled'      => __( 'Dossier scheduled for {date}. <a href="{preview_url}" target="_blank">Preview</a>', 'pm-cpt' ),
				'post_draft_updated'   => __( 'Dossier draft updated. <a href="{preview_url}" target="_blank">Preview</a>', 'pm-cpt' ),
			],
			'bulk_messages' => [
				'updated_singular'   => __( 'Dossier updated. Yay!', 'pm-cpt' ),
				// translators: %s is for number of dossiers updated
				'updated_plural'     => __( '%s Dossiers updated. Yay!', 'pm-cpt' ),
				'locked_singular'    => __( 'Dossier not updated, somebody is editing it', 'pm-cpt' ),
				// translators: %s is for number of dossiers not updated
				'locked_plural'      => __( '%s Dossiers not updated, somebody is editing them', 'pm-cpt' ),
				'deleted_singular'   => __( 'Dossier permanetly deleted. Fahrenheit 451 team was here?', 'pm-cpt' ),
				// translators: %s is for number of dossiers permanently deleted
				'deleted_plural'     => __( '%s Dossiers permanently deleted. Why? :(', 'pm-cpt' ),
				'trashed_singular'   => __( 'Dossier moved to the trash. I\'m sad :(', 'pm-cpt' ),
				// translators: %s is for number of dossiers moved to the trash
				'trashed_plural'     => __( '%s Dossiers moved to the trash. Why? :(', 'pm-cpt' ),
				'untrashed_singular' => __( 'Dossier recovered from the trash. Well done!', 'pm-cpt' ),
				// translators: %s is for number of dossiers saved from the trash
				'untrashed_plural'   => __( '%s Dossiers saved from the trash!', 'pm-cpt' ),
			],
			// overrides some of the available button labels and placeholders
			'ui'            => [
				'enter_title_here' => __( 'Enter dossier name here', 'pm-cpt' ),
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
		'hierarchical'       => true,
		'menu_position'      => null,
		'can_export'         => true,
		'capability_type'    => 'post',
		'menu_icon'          => 'dashicons-book-alt',
		'rewrite'            => [
			'slug'       => 'dossier',
			'with_front' => true,
			'feeds'      => true,
			'pages'      => true,
		],
	],
	'block_editor' => true,
	'meta'         => [
		'dossier_info' => [
			'id'       => 'information_metabox',
			'title'    => __( 'Information', 'pm-cpt' ),
			'sections' => [
				'information' => [
					'title'  => __( 'Dossier', 'pm-cpt' ),
					'desc'   => __( 'Information regarding the dossier', 'pm-cpt' ),
					'icon'   => 'fa fa-file-text-o',
					'fields' => [
						'dossier-credit' => [
							'title' => __( 'Credit', 'pm-cpt' ),
							'type'  => 'text',
							'desc'  => __( 'The author of this dossier.', 'pm-cpt' ),
						],
						'dossier-date'   => [
							'title'    => __( 'Date', 'pm-cpt' ),
							'type'     => 'date',
							'settings' => [
								'dateFormat' => 'dd/mm/yy',
							],
							'desc'     => __( 'The date of this dossier.', 'pm-cpt' ),
						],
						'dossier-local'  => [
							'title' => __( 'Local', 'pm-cpt' ),
							'type'  => 'text',
							'desc'  => __( 'The local of this dossier.', 'pm-cpt' ),
						],
						'dossier-file'   => [
							'title' => __( 'File', 'pm-cpt' ),
							'type'  => 'media',
							'desc'  => __( 'The file for this dossier.', 'pm-cpt' ),
						],
						'is_featured'        => [
							'title'   => __( 'Is Featured', 'pm-cpt' ),
							'type'    => 'switcher',
							'label'   => __( 'Is Featured?', 'pm-cpt' ),
							'default' => false,
						],
					],
				],
			],
		],
	],
];
