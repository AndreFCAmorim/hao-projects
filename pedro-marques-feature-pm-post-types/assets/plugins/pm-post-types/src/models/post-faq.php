<?php

return [
	'active'       => true,
	'type'         => 'cpt',
	'name'         => 'faq',
	'features'     => [
		'dragAndDrop'   => true,
		'duplicate'     => true,
		'single_export' => true,
		'admin_cols'    => [
			'title',
		],
		'admin_filters' => [],
	],
	'supports'     => [
		'title',
		'excerpt',
		'editor',
		'page-attributes',
	],
	'labels'       => [
		'has_one'        => __( 'FAQ', 'framework-demo' ),
		'has_many'       => __( 'FAQs', 'framework-demo' ),
		'featured_image' => __( 'FAQ Cover', 'framework-demo' ),
		'text_domain'    => 'framework-demo',

		// optional, but better for translation
		'overrides'      => [
			'labels'        => [
				'name'                  => __( 'FAQs', 'framework-demo' ),
				'singular_name'         => __( 'FAQ', 'framework-demo' ),
				'menu_name'             => __( 'FAQs', 'framework-demo' ),
				'name_admin_bar'        => __( 'FAQ', 'framework-demo' ),
				'add_new'               => __( 'Add New', 'framework-demo' ),
				'add_new_item'          => __( 'Add New FAQ', 'framework-demo' ),
				'edit_item'             => __( 'Edit FAQ', 'framework-demo' ),
				'new_item'              => __( 'New FAQ', 'framework-demo' ),
				'view_item'             => __( 'View FAQ', 'framework-demo' ),
				'view_items'            => __( 'View FAQs', 'framework-demo' ),
				'search_items'          => __( 'Search FAQs', 'framework-demo' ),
				'not_found'             => __( 'No FAQs found.', 'framework-demo' ),
				'not_found_in_trash'    => __( 'No FAQs found in Trash.', 'framework-demo' ),
				'parent_item-colon'     => __( 'Parent FAQs:', 'framework-demo' ),
				'all_items'             => __( 'All FAQs', 'framework-demo' ),
				'archives'              => __( 'FAQ Archives', 'framework-demo' ),
				'attributes'            => __( 'FAQ Attributes', 'framework-demo' ),
				'insert_into_item'      => __( 'Insert into faq', 'framework-demo' ),
				'uploaded_to_this_item' => __( 'Uploaded to this faq', 'framework-demo' ),
				'featured_image'        => __( 'Featured Image', 'framework-demo' ),
				'set_featured_image'    => __( 'Set featured image', 'framework-demo' ),
				'remove_featured_image' => __( 'Remove featured image', 'framework-demo' ),
				'use_featured_image'    => __( 'Use featured image', 'framework-demo' ),
				'filter_items_list'     => __( 'Filter FAQs list', 'framework-demo' ),
				'items_list_navigation' => __( 'FAQs list navigation', 'framework-demo' ),
				'items_list'            => __( 'FAQs list', 'framework-demo' ),
				'featured_image'        => __( 'FAQ Cover Image', 'framework-demo' ),
				'set_featured_image'    => __( 'Set FAQ Cover Image', 'framework-demo' ),
				'remove_featured_image' => __( 'Remove FAQ Cover', 'framework-demo' ),
				'use_featured_image'    => __( 'Use as FAQ Cover', 'framework-demo' ),
			],
			// you can use the placeholders {permalink}, {preview_url}, {date}
			'messages'      => [
				'post_updated'         => __( 'FAQ information updated. <a href="{permalink}" target="_blank">View FAQ</a>', 'framework-demo' ),
				'post_updated_short'   => __( 'FAQ info updated', 'framework-demo' ),
				'custom_field_updated' => __( 'Custom field updated', 'framework-demo' ),
				'custom_field_deleted' => __( 'Custom field deleted', 'framework-demo' ),
				'restored_to_revision' => __( 'FAQ content restored from revision', 'framework-demo' ),
				'post_published'       => __( 'FAQ Published', 'framework-demo' ),
				'post_saved'           => __( 'FAQ information saved.', 'framework-demo' ),
				'post_submitted'       => __( 'FAQ submitted. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
				'post_schedulled'      => __( 'FAQ scheduled for {date}. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
				'post_draft_updated'   => __( 'FAQ draft updated. <a href="{preview_url}" target="_blank">Preview</a>', 'framework-demo' ),
			],
			'bulk_messages' => [
				'updated_singular'   => __( 'FAQ updated. Yay!', 'framework-demo' ),
				// translators: %s is for number of FAQs updated
				'updated_plural'     => __( '%s FAQs updated. Yay!', 'framework-demo' ),
				'locked_singular'    => __( 'FAQ not updated, somebody is editing it', 'framework-demo' ),
				// translators: %s is for number of FAQs not updated
				'locked_plural'      => __( '%s FAQs not updated, somebody is editing them', 'framework-demo' ),
				'deleted_singular'   => __( 'FAQ permanetly deleted. Fahrenheit 451 team was here?', 'framework-demo' ),
				// translators: %s is for number of FAQs permanently deleted
				'deleted_plural'     => __( '%s FAQs permanently deleted. Why? :(', 'framework-demo' ),
				'trashed_singular'   => __( 'FAQ moved to the trash. I\'m sad :(', 'framework-demo' ),
				// translators: %s is for number of FAQs moved to the trash
				'trashed_plural'     => __( '%s FAQs moved to the trash. Why? :(', 'framework-demo' ),
				'untrashed_singular' => __( 'FAQ recovered from the trash. Well done!', 'framework-demo' ),
				// translators: %s is for number of FAQs saved from the trash
				'untrashed_plural'   => __( '%s FAQs saved from the trash!', 'framework-demo' ),
			],
			// overrides some of the available button labels and placeholders
			'ui'            => [
				'enter_title_here' => __( 'Enter faq name here', 'framework-demo' ),
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
		'menu_icon'          => 'dashicons-info',
		'rewrite'            => [
			'slug'       => 'faq',
			'with_front' => true,
			'feeds'      => true,
			'pages'      => true,
		],
	],
	'block_editor' => true,
];
