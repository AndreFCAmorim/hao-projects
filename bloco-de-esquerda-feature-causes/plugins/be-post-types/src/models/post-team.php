<?php

return [
	'active'       => true,
	'type'         => 'cpt',
	'name'         => 'member',
	'features'     => [
		'dragAndDrop'   => true,
		'duplicate'     => true,
		'single_export' => true,
		'admin_cols'    => [
			'title',
			'member-email'   => [
				'title'    => __( 'Email', 'framework-demo' ),
				'meta_key' => 'member-email',
			],
			'member-job'     => [
				'title'    => __( 'Job', 'framework-demo' ),
				'meta_key' => 'member-job',
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
		'has_one'        => __( 'Member', 'framework-demo' ),
		'has_many'       => __( 'Members', 'framework-demo' ),
		'featured_image' => __( 'Member Cover', 'framework-demo' ),
		'text_domain'    => 'framework-demo',

		// optional, but better for translation
		'overrides'      => [
			'labels'        => [
				'name'                  => __( 'Members', 'framework-demo' ),
				'singular_name'         => __( 'Member', 'framework-demo' ),
				'menu_name'             => __( 'Team', 'framework-demo' ),
				'name_admin_bar'        => __( 'Member', 'framework-demo' ),
				'add_new'               => __( 'Add New', 'framework-demo' ),
				'add_new_item'          => __( 'Add New Member', 'framework-demo' ),
				'edit_item'             => __( 'Edit Member', 'framework-demo' ),
				'new_item'              => __( 'New Member', 'framework-demo' ),
				'view_item'             => __( 'View Member', 'framework-demo' ),
				'view_items'            => __( 'View Members', 'framework-demo' ),
				'search_items'          => __( 'Search Members', 'framework-demo' ),
				'not_found'             => __( 'No members found.', 'framework-demo' ),
				'not_found_in_trash'    => __( 'No members found in Trash.', 'framework-demo' ),
				'parent_item-colon'     => __( 'Parent Members:', 'framework-demo' ),
				'all_items'             => __( 'All Members', 'framework-demo' ),
				'archives'              => __( 'Member Archives', 'framework-demo' ),
				'attributes'            => __( 'Member Attributes', 'framework-demo' ),
				'insert_into_item'      => __( 'Insert into member', 'framework-demo' ),
				'uploaded_to_this_item' => __( 'Uploaded to this member', 'framework-demo' ),
				'featured_image'        => __( 'Featured Image', 'framework-demo' ),
				'set_featured_image'    => __( 'Set featured image', 'framework-demo' ),
				'remove_featured_image' => __( 'Remove featured image', 'framework-demo' ),
				'use_featured_image'    => __( 'Use featured image', 'framework-demo' ),
				'filter_items_list'     => __( 'Filter members list', 'framework-demo' ),
				'items_list_navigation' => __( 'Members list navigation', 'framework-demo' ),
				'items_list'            => __( 'Members list', 'framework-demo' ),
				'featured_image'        => __( 'Member Cover Image', 'framework-demo' ),
				'set_featured_image'    => __( 'Set Member Cover Image', 'framework-demo' ),
				'remove_featured_image' => __( 'Remove Member Cover', 'framework-demo' ),
				'use_featured_image'    => __( 'Use as Member Cover', 'framework-demo' ),
			],
			// you can use the placeholders {permalink}, {preview_url}, {date}
			'messages'      => [
				'post_updated'         => __( 'Member information updated. <a href="{permalink}" target="_blank">View Member</a>', 'framework-demo' ),
				'post_updated_short'   => __( 'Member info updated', 'framework-demo' ),
				'custom_field_updated' => __( 'Custom field updated', 'framework-demo' ),
				'custom_field_deleted' => __( 'Custom field deleted', 'framework-demo' ),
				'restored_to_revision' => __( 'Member content restored from revision', 'framework-demo' ),
				'post_published'       => __( 'Member Published', 'framework-demo' ),
				'post_saved'           => __( 'Member information saved.', 'framework-demo' ),
				'post_submitted'       => __( 'Member submitted. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
				'post_schedulled'      => __( 'Member scheduled for {date}. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
				'post_draft_updated'   => __( 'Member draft updated. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
			],
			'bulk_messages' => [
				'updated_singular'   => __( 'Member updated. Yay!', 'framework-demo' ),
				// translators: %s is for number of members updated
				'updated_plural'     => __( '%s Members updated. Yay!', 'framework-demo' ),
				'locked_singular'    => __( 'Member not updated, somebody is editing it', 'framework-demo' ),
				// translators: %s is for number of members not updated
				'locked_plural'      => __( '%s Members not updated, somebody is editing them', 'framework-demo' ),
				'deleted_singular'   => __( 'Member permanetly deleted. Fahrenheit 451 member was here?', 'framework-demo' ),
				// translators: %s is for number of members permanently deleted
				'deleted_plural'     => __( '%s Members permanently deleted. Why? :(', 'framework-demo' ),
				'trashed_singular'   => __( 'Member moved to the trash. I\'m sad :(', 'framework-demo' ),
				// translators: %s is for number of members moved to the trash
				'trashed_plural'     => __( '%s Members moved to the trash. Why? :(', 'framework-demo' ),
				'untrashed_singular' => __( 'Member recovered from the trash. Well done!', 'framework-demo' ),
				// translators: %s is for number of members saved from the trash
				'untrashed_plural'   => __( '%s Members saved from the trash!', 'framework-demo' ),
			],
			// overrides some of the available button labels and placeholders
			'ui'            => [
				'enter_title_here' => __( 'Enter member name here', 'framework-demo' ),
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
		'menu_icon'          => 'dashicons-groups',
		'rewrite'            => [
			'slug'       => __( 'member', 'framework-demo' ),
			'with_front' => true,
			'feeds'      => true,
			'pages'      => true,
		],
	],
	'block_editor' => true,
	'meta'         => [
		'team_info' => [
			'id'       => 'information_metabox',
			'title'    => __( 'Information', 'framework-demo' ),
			'sections' => [
				'information' => [
					'title'  => __( 'Member', 'framework-demo' ),
					'desc'   => __( 'Information regarding the member', 'framework-demo' ),
					'icon'   => 'fa fa-file-text-o',
					'fields' => [
						'member-quote'        => [
							'title' => __( 'Quote', 'framework-demo' ),
							'type'  => 'text',
							'desc'  => __( 'The quote of this member.', 'framework-demo' ),
						],
						'member-video'        => [
							'title' => __( 'Video', 'framework-demo' ),
							'type'  => 'text',
							'desc'  => __( 'The video for this member.', 'framework-demo' ),
						],
						'member-social-networks' => [
							'title' => __( 'Social Networks', 'framework-demo' ),
							'type'  => 'textarea',
							'desc'  => __( 'The social network URL for this member. One per line.', 'framework-demo' ),
						],
						'member-email'        => [
							'title' => __( 'Email', 'framework-demo' ),
							'type'  => 'text',
							'desc'  => __( 'The email address for this member.', 'framework-demo' ),
						],
						'member-job'          => [
							'title' => __( 'Job', 'framework-demo' ),
							'type'  => 'text',
							'desc'  => __( 'The job of this member.', 'framework-demo' ),
						],
					],
				],
			],
		],
	],
];
