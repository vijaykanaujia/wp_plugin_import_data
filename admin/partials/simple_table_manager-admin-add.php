<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once WP_PLUGIN_DIR . '/simple_table_manager/simplexlsx-master/src/SimpleXLSX.php';
require_once WP_PLUGIN_DIR . '/simple_table_manager/admin/classes/node-class.php';
require_once WP_PLUGIN_DIR . '/simple_table_manager/admin/index.php';

if (isset($_POST['import_stm'])) {

    if (!file_exists(WP_PLUGIN_DIR . '/temp')) {
        mkdir(WP_PLUGIN_DIR . '/temp', 0777, true);
    }

    $target_dir = WP_PLUGIN_DIR . '/temp/';
    $target_file = $target_dir . basename($_FILES["stm_file"]["name"]);

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (move_uploaded_file($_FILES["stm_file"]["tmp_name"], $target_file)) {
        $xlsx = SimpleXLSX::parse($target_file);
        $sheets = $xlsx->sheetNames();

        foreach ($sheets as $sheet_key => $sheet_value) {
            $templist = [];
            foreach ($xlsx->rows($sheet_key) as $k => $r) {
                if (!($k == 0)) {
                    $templist[$k] = $r;
                }
            }

            //print_r(build_tree($templist));
            $rootNodes = build_tree($templist);

            foreach ($rootNodes as $node) {
                // show_tree($node);
                if (value_exists_in_table($node->getText(), make_tag_string($sheet_value))) {
                    echo "'" . $node->getText() . "' already exits <br/>";
                    continue;
                } else {
                    insert_data($node, make_tag_string($sheet_value));
                }
            }
        }
        echo "inserted";
        if (file_exists($target_file)) {
            unlink($target_file);
        }
    } else {
        echo "Something went wrong";
        die;
    }
}
?>
<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form id="upload_form" action="" enctype="multipart/form-data" method="post">
        <div class="welcome-panel">
            <p><input name="stm_file" type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" /></p>
            <p><input name="import_stm" id="btnSubmit" type="submit" value="Import" /></p>
        </div>
    </form>
</div>