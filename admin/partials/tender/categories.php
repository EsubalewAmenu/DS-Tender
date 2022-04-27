<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<link href="<?php echo ds_tender_PLAGIN_URL . 'hummingbird/hummingbird-treeview.css' ?>" rel="stylesheet" type="text/css" />
<style>
    body {
        background-color: #fafafa;
    }

    /* .container {
        margin: 150px auto;
        min-height: 100vh;
    } */

    .stylish-input-group .input-group-addon {
        background: white !important;
    }

    .stylish-input-group .form-control {
        border-right: 0;
        box-shadow: 0 0 0;
        border-color: #ccc;
    }

    .stylish-input-group button {
        border: 0;
        background: transparent;
    }

    .h-scroll {
        background-color: #fcfdfd;
        height: 260px;
        overflow-y: scroll;
    }
</style>


<!-- <div class="container"> -->
<div id="treeview_container" class="hummingbird-treeview" style="height: 230px; overflow-y: scroll">
    <ul id="treeview" class="hummingbird-base">
        <?php
        global $table_prefix, $wpdb;
        $wp_table = $table_prefix . "ds_tender_categories";
        $categories = $wpdb->get_results("SELECT id, category_name, main_category, sub_category FROM $wp_table where main_category!=0 order by category_name asc");

        foreach ($categories as $category) {

            $subCategories = $wpdb->get_results("SELECT id, category_name, main_category, sub_category FROM $wp_table where sub_category='" . $category->id . "' order by category_name asc");
            // print_r($subCategories);

            if ($subCategories) {
        ?>
                <li data-id="<?php echo $category->id ?>">
                    <i class="fa fa-plus"></i>
                    <label>
                        <input id="xnode-<?php echo $category->id ?>" data-id="custom-<?php echo $category->id ?>" type="checkbox" /> <?php echo $category->category_name ?>
                    </label>
                    <ul>
                        <?php foreach ($subCategories as $subCategory) { ?>
                            <li>
                                <label>
                                    <input class="hummingbird-end-node" id="xnode-<?php echo $category->id . '-' . $subCategory->id ?>" data-id="<?php echo $subCategory->id ?>" type="checkbox" />
                                    <?php echo $subCategory->category_name ?>
                                </label>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php
            } else { ?>
                <li>
                    <label>
                        <input class="hummingbird-end-node" id="xnode-<?php echo $category->id ?>" data-id="<?php echo $category->id ?>" type="checkbox" />
                        <?php echo $category->category_name ?>
                    </label>
                </li>
        <?php  }
        } ?>
    </ul>
</div>
<button class="btn btn-primary" id="checkAll">Check All</button>
<button class="btn btn-primary" id="uncheckAll">Uncheck All</button>
<button class="btn btn-danger" id="checkNode">Check Node 0-2-2</button>
<!-- </div> -->

<script src="<?php echo ds_tender_PLAGIN_URL . 'hummingbird/hummingbird-treeview.js' ?>"></script>
<script>
    jQuery("#treeview").hummingbird();
    jQuery("#checkAll").click(function() {
        jQuery("#treeview").hummingbird("checkAll");
    });
    jQuery("#uncheckAll").click(function() {
        jQuery("#treeview").hummingbird("uncheckAll");
    });
    jQuery("#collapseAll").click(function() {
        jQuery("#treeview").hummingbird("collapseAll");
    });
    jQuery("#checkNode").click(function() {
        jQuery("#treeview").hummingbird("checkNode", {
            attr: "id",
            name: "node-0-2-2",
            expandParents: false,
        });
    });
</script>