# Plugins

## "hao-sync-posts-source"
- This plugin will be installed in the site where the posts are manually created, updated or deleted.
- After the installation, you should check out the settings page for this plugin, located on: WP Dashboard > Settings > HaO Sync Posts Settings.
- In the settings page, pay attention to the "Verify SSL".
- The URL must end in a forward slash "/"

## "hao-sync-posts-destination
- This plugin will be installed in the site where the posts are automatically created, updated or deleted.
- There's no configuration required for this plugin.


Notes:
- The custom post type is hardcode defined in both plugin.
- The meta "local" is being sync as empty string because it's defined as required in ACF;
- It's necessary in the site where the posts are automatically crud, add the following metas in ACF:
    - field name: "remote_post_id";
    - field name: "remote_post_featured_image_url".
    - This meta should be hidden.
- ACF fields must have REST API Active;
