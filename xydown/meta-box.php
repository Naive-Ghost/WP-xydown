<?php
if (!defined('ABSPATH')) {
    exit;
}
add_action('admin_menu', 'xy_create_down_box');
add_action('save_post', 'xy_save_down_data');
function xy_create_down_box() {
    add_meta_box('ali-post-meta-boxes', '下载信息', 'xy_post_down_info', 'post', 'normal', 'high');
}
function xy_down_post_boxes() { //资源名称、资源大小、更新时间、适用版本、作者信息
    $meta_boxes = array(
        array(
            "name" => "xydown_start",
            "title" => "启用下载",
            "desc" => "启用下载",
            "type" => "checkbox",
            "capability" => "manage_options"
        ) ,
        array(
            "name" => "xydown_name",
            "title" => "资源名称",
            "desc" => "",
            "type" => "text",
            "capability" => "manage_options"
        ) ,
        array(
            "name" => "xydown_size",
            "title" => "资源大小",
            "desc" => "",
            "type" => "text",
            "capability" => "manage_options"
        ) ,
        array(
            "name" => "xydown_date",
            "title" => "更新时间",
            "desc" => "",
            "type" => "text",
            "capability" => "manage_options"
        ) ,
        /* array(
        "name"             => "xydown_version",
        "title"            => "适用版本",
        "desc"             => "",
        "type"             => "text",
        "capability"       => "manage_options"
        ), */
        array(
            "name" => "xydown_author",
            "title" => "作者信息",
            "desc" => "",
            "type" => "text",
            "capability" => "manage_options"
        ) ,
        //演示地址放弃这个功能了。
        //array(
        //		"name"             => "xydown_yanshi",
        //		"title"            => "演示地址（暂不完美）",
        //		"desc"             => "",
        //		"type"             => "text",
        //		"capability"       => "manage_options"
        //		),
        array(
            "name" => "xydown_downurl3",
            "title" => "普通下载",
            "desc" => "",
            "type" => "text",
            "capability" => "manage_options"
        ) ,
        array(
            "name" => "xydown_downurl1",
            "title" => "百度网盘",
            "desc" => "",
            "type" => "text",
            "capability" => "manage_options"
        ) ,
        array(
            "name" => "xydown_baidumima",
            "title" => "百度网盘密码",
            "desc" => "",
            "type" => "text",
            "capability" => "manage_options"
        ) ,
        array(
            "name" => "xydown_downurl4",
            "title" => "蓝奏云盘",
            "desc" => "",
            "type" => "text",
            "capability" => "manage_options"
        ) ,
        array(
            "name" => "xydown_360mima",
            "title" => "蓝奏云盘密码",
            "desc" => "",
            "type" => "text",
            "capability" => "manage_options"
        ) ,
        array(
            "name" => "xydown_downurl5",
            "title" => "腾讯微云",
            "desc" => "",
            "type" => "text",
            "capability" => "manage_options"
        ) ,
        array(
            "name" => "xydown_downurl6",
            "title" => "其他网盘",
            "desc" => "",
            "type" => "text",
            "capability" => "manage_options"
        ) ,
        array(
            "name" => "xydown_downurl7",
            "title" => "官方下载",
            "desc" => "",
            "type" => "text",
            "capability" => "manage_options"
        ) ,
        array(
            "name" => "xydown_downurl2",
            "title" => "推荐星级:1~5",
            "desc" => "",
            "type" => "text",
            "capability" => "manage_options"
        ) ,
    );
    return apply_filters('ali_post_boxes', $meta_boxes);
}
function xy_post_down_info() {
    global $post;
    $meta_boxes = xy_down_post_boxes();
?>
	<table class="form-table">
	<?php
    foreach ($meta_boxes as $meta):
        $value = get_post_meta($post->ID, $meta['name'], true);
        if ($meta['type'] == 'text') xy_show_text_input($meta, $value);
        elseif ($meta['type'] == 'textarea') xy_show_textarea($meta, $value);
        elseif ($meta['type'] == 'checkbox') xy_show_checkbox($meta, $value);
    endforeach; ?>
	</table>
<?php
}
function xy_show_text_input($args = array() , $value = false) {
    extract($args); ?>
	<tr>
		<th style="width:10%;">
			<label for="<?php
    echo $name; ?>"><?php
    echo $title; ?></label>
		</th>
		<td>
		<input type="text" name="<?php
    echo $name; ?>" id="<?php
    echo $name; ?>" value="<?php
    echo wp_specialchars($value, 1); ?>" size="30" tabindex="30" style="width: 97%;" />
			<input type="hidden" name="<?php
    echo $name; ?>_input_name" id="<?php
    echo $name; ?>_input_name" value="<?php
    echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />
		</td>
	</tr>
	<?php
}
function xy_show_textarea($args = array() , $value = false) {
    extract($args); ?>
	<tr>
		<th style="width:10%;">
			<label for="<?php
    echo $name; ?>"><?php
    echo $title; ?></label>
		</th>
		<td>
			<textarea name="<?php
    echo $name; ?>" id="<?php
    echo $name; ?>" cols="60" rows="4" tabindex="30" style="width: 97%;"><?php
    echo wp_specialchars($value, 1); ?></textarea>
			<input type="hidden" name="<?php
    echo $name; ?>_input_name" id="<?php
    echo $name; ?>_input_name" value="<?php
    echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />	</td>
	</tr>
	<?php
}
function xy_show_checkbox($args = array() , $value = false) {
    extract($args); ?>
<tr>
		<th style="width:10%;">
	<label for="<?php
    echo $name; ?>"><?php
    echo $title; ?></label>		</th>
		<td>
    <input type="checkbox" name="<?php
    echo $name; ?>" id="<?php
    echo $name; ?>" value="yes"
    <?php
    if (htmlentities($value, 1) == 'yes') echo ' checked="checked"'; ?>
    style="width: auto;" />
    <input type="hidden" name="<?php
    echo $name; ?>_input_name" id="<?php
    echo $name; ?>_input_name" value="<?php
    echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />
    </td>
	</tr>
	<?php
}
function xy_save_down_data($post_id) {
    $meta_boxes = array_merge(xy_down_post_boxes());
    foreach ($meta_boxes as $meta_box):
        if (!wp_verify_nonce($_POST[$meta_box['name'] . '_input_name'], plugin_basename(__FILE__))) return $post_id;
        if ('page' == $_POST['post_type'] && !current_user_can('edit_page', $post_id)) return $post_id;
        elseif ('post' == $_POST['post_type'] && !current_user_can('edit_post', $post_id)) return $post_id;
        $data = stripslashes($_POST[$meta_box['name']]);
        if (get_post_meta($post_id, $meta_box['name']) == '') add_post_meta($post_id, $meta_box['name'], $data, true);
        elseif ($data != get_post_meta($post_id, $meta_box['name'], true)) update_post_meta($post_id, $meta_box['name'], $data);
        elseif ($data == '') delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
    endforeach;
}
?>
