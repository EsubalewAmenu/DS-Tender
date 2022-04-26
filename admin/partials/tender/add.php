<?php


global $table_prefix, $wpdb;

$wp_ds_regions_table = $table_prefix . "ds_b_regions";

$regions = $wpdb->get_results("SELECT * FROM $wp_ds_regions_table where `deleted_at` IS NULL order by name asc", OBJECT);

$wp_ds_sources_table = $table_prefix . "ds_tender_sources";
$sources = $wpdb->get_results("SELECT * FROM $wp_ds_sources_table where `deleted_at` IS NULL order by source_name asc", OBJECT);


?>
<div id="div_tender_add" class="card-primary">
    <div class="card-header">
        <h4>New tender</h4>
    </div>

    <div class="card-body">
        <div class="row">

            <div class="row">
                <div class="form-group col-sm-5">
                    <label for="region">Region</label>
                    <select required class="form-control selectric" style="background-color: #FAA53F" id="region">
                        <option value="" selected>Select region</option>
                        <?php
                        for ($x = 0; $x < count($regions); $x++) {

                            echo '<option value="' . $regions[$x]->id . '" ';
                            echo ">" . $regions[$x]->name . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-sm-5">
                    <label for="source">source</label>
                    <select required class="form-control selectric" style="background-color: #FAA53F" id="source">
                        <option value="" selected>Select source</option>
                        <?php
                        for ($x = 0; $x < count($sources); $x++) {

                            echo '<option value="' . $sources[$x]->id . '" ';
                            echo ">" . $sources[$x]->source_name . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-sm-5">
                    <label for="two_merkato_id">2merkato tender id</label>
                    <input required id="two_merkato_id" type="text" class="form-control" id="two_merkato_id" value="<?php if (isset($tender->two_merkato_id)) echo $tender->two_merkato_id ?>">
                    <div id="ds_tender_check_if_added_ajax_response" class="form-group"></div>
                    <input type="hidden" id="is_tender_already_added" value="-1">
                </div>

                <div class="form-group col-sm-5">
                    <label for="company_2merkato_id">Company id</label>
                    <input required id="company_2merkato_id" type="text" class="form-control" id="company_2merkato_id" value="<?php if (isset($tender->company_2merkato_id)) echo $tender->company_2merkato_id ?>">
                    <input type="hidden" id="company_id" value="<?php if (isset($tender)) echo $tender->company_id ?>">
                    <div id="get_company_ajax_response" class="form-group"></div>
                </div>
                <div class="form-group col-sm-5">
                    <label for="opening_date">Opening date</label>
                    <input required id="opening_date" type="text" class="form-control" id="opening_date" value="<?php if (isset($tender->opening_date)) echo $tender->opening_date ?>">
                </div>

                <div class="form-group col-sm-5">
                    <label for="closing_date">closing date</label>
                    <input required id="closing_date" type="text" class="form-control" id="closing_date" value="<?php if (isset($tender->closing_date)) echo $tender->closing_date ?>">
                </div>

                <div class="form-group col-sm-5">
                    <label for="published_date">published date</label>
                    <input required id="published_date" type="text" class="form-control" id="published_date" value="<?php if (isset($tender->published_date)) echo $tender->published_date ?>">
                </div>

                <div class="form-group col-sm-5">
                    <label for="bid_doc_price">bid doc price</label>
                    <input required id="bid_doc_price" type="text" class="form-control" id="bid_doc_price" value="<?php if (isset($tender->bid_doc_price)) echo $tender->bid_doc_price ?>">
                </div>
                <div class="form-group col-sm-5">
                    <label for="bid_bond">bid bond</label>
                    <input required id="bid_bond" type="text" class="form-control" id="bid_bond" value="<?php if (isset($tender->bid_bond)) echo $tender->bid_bond ?>">
                </div>
            </div>

            <hr>


            <div class="form-group col-12">
                <label for="title">title</label>
                <?php
                // default settings - Kv_front_editor.php
                $content = '';
                $editor_id = 'title';
                $settings =   array(
                    'wpautop' => true, // use wpautop?
                    'media_buttons' => true, // show insert/upload button(s)
                    'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
                    'textarea_rows' => 2, //get_option('default_post_edit_rows', 5), // rows="..."
                    'tabindex' => '',
                    'editor_css' => '', //  extra styles for both visual and HTML editors buttons, 
                    'editor_class' => '', // add extra class(es) to the editor textarea
                    'teeny' => false, // output the minimal editor config used in Press This
                    'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
                    'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
                    'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
                );

                wp_editor($content, $editor_id, $settings = array());
                ?>
            </div>
            <hr>

            <div class="form-group col-12">
                <label for="content">Content</label>
                <?php
                // default settings - Kv_front_editor.php
                $content = '';
                $editor_id = 'content';
                $settings =   array(
                    'wpautop' => true, // use wpautop?
                    'media_buttons' => true, // show insert/upload button(s)
                    'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
                    'textarea_rows' => get_option('default_post_edit_rows', 5), // rows="..."
                    'tabindex' => '',
                    'editor_css' => '', //  extra styles for both visual and HTML editors buttons, 
                    'editor_class' => '', // add extra class(es) to the editor textarea
                    'teeny' => false, // output the minimal editor config used in Press This
                    'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
                    'tinymce'       => array(
                        'toolbar1'      => 'bold,italic,underline,separator,alignleft,aligncenter,alignright,separator,link,unlink,undo,redo',
                        'toolbar2'      => '',
                        'toolbar3'      => '',
                    ),
                    // 'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
                    'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
                );

                wp_editor($content, $editor_id, $settings = array());
                ?>
            </div>
            <hr>
        </div>
        <?php
        include_once ds_tender_PLAGIN_DIR . '/admin/partials/tender/categories.php';
        ?>
        <input type="hidden" id="edit_tender_id" value="<?php echo $tender->id ?>">

        <div class="form-group">

            <button value="1" type="button" id="save_tender" class="save_tender btn btn-primary">
                <i class="fa fa-plus"> </i> Save
            </button>
        </div>
        <div id="server_response" class="form-group"></div>

    </div>

</div>
<script type="text/javascript">
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    jQuery(document).ready(function() {

        jQuery("#two_merkato_id").focusout(function() {
            jQuery.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'ds_tender_check_if_added',
                    two_merkato_id: jQuery(this).val(),
                },
                success: async function(response) {
                    response = JSON.parse(response)
                    if (response) {
                        jQuery("#ds_tender_check_if_added_ajax_response").html("Tender already added");
                        jQuery("#is_tender_already_added").val("0");
                    } else {
                        jQuery("#ds_tender_check_if_added_ajax_response").html("")
                        jQuery("#is_tender_already_added").val("1");
                    }
                }
            });

        });
        jQuery("#company_2merkato_id").focusout(function() {
            jQuery.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'ds_tender_get_company_id',
                    company_2merkato_id: jQuery(this).val(),
                },
                success: async function(response) {
                    response = JSON.parse(response)
                    if (response) {
                        jQuery("#get_company_ajax_response").html(response.company_name);
                        jQuery("#company_id").val(response.id);
                    } else {
                        jQuery("#get_company_ajax_response").html("company not found! please add it")

                    }
                }
            });

        });

        jQuery("#save_tender").click(function() {

            if (isAllFiled()) {
                const save = document.querySelector('.save_tender')
                save.disabled = true;
                save.innerText = "Please wait..."


                // var feature_image = jQuery('.feature_image').prop('files')[0];
                var region = jQuery('#region').val();
                var source = jQuery('#source').val();
                var two_merkato_id = jQuery('#two_merkato_id').val();
                var company_2merkato_id = jQuery('#company_2merkato_id').val();
                var company_id = jQuery('#company_id').val();
                var opening_date = jQuery('#opening_date').val();
                var closing_date = jQuery('#closing_date').val();
                var published_date = jQuery('#published_date').val();
                var bid_doc_price = jQuery('#bid_doc_price').val();
                var bid_bond = jQuery('#bid_bond').val();
                var edit_tender_id = jQuery('#edit_tender_id').val();
                var title = tinyMCE.get("title").getContent({
                    format: 'raw'
                });
                var content = tinyMCE.get("content").getContent({
                    format: 'raw'
                });

                var form_data = new FormData();

                form_data.append('action', 'ds_tender_save_tender');
                // form_data.append('feature_image', feature_image);
                form_data.append('region', region);
                form_data.append('source', source);
                form_data.append('two_merkato_id', two_merkato_id);
                form_data.append('company_2merkato_id', company_2merkato_id);
                form_data.append('company_id', company_id);
                form_data.append('opening_date', opening_date);
                form_data.append('closing_date', closing_date);
                form_data.append('published_date', published_date);
                form_data.append('bid_doc_price', bid_doc_price);
                form_data.append('bid_bond', bid_bond);
                form_data.append('edit_tender_id', edit_tender_id);
                form_data.append('title', title);
                form_data.append('content', content);


                jQuery.ajax({
                    url: "<?php echo admin_url('admin-ajax.php'); ?>",
                    type: 'post',
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function(response) {
                        jQuery("#server_response").html(response);
                    }
                });
            }

        });

        function isAllFiled() {
            $filled = true;
            jQuery("#server_response").html("");

            if (!jQuery("#region").val()) {
                jQuery("#server_response").append('region filed is required</br>');
                $filled = false;
            }
            if (!jQuery("#company_id").val()) {
                jQuery("#server_response").append('company filed is required</br>');
                $filled = false;
            }
            if (!jQuery("#two_merkato_id").val()) {
                jQuery("#server_response").append('2merkato id filed is required</br>');
                $filled = false;
            }
            if (jQuery("#is_tender_already_added").val() === "0") {
                jQuery("#server_response").append('This tender is already added</br>');
                $filled = false;
            }
            if (!jQuery("#source").val()) {
                jQuery("#server_response").append('source is required</br>');
                $filled = false;
            }

            // alert(isFileUploaded + " data " )

            // if (isFileUploaded == "") {
            //     jQuery("#error_id_feature_image").html('Please choose feature image first');
            //     $filled = false;
            // } else jQuery("#error_id_feature_image").html('');

            // if (!jQuery(".topic").val()) {
            //     jQuery("#error_id_topicc").html('This filed is required');
            //     $filled = false;
            // } else jQuery("#error_id_topic").html('');
            // if (!jQuery("[name='content']").val()) {

            //     jQuery("#error_id_content").html('This filed is required');
            //     $filled = false;
            // } else jQuery("#error_id_content").html('');

            if (tinyMCE.get("title").getContent({
                    format: 'raw'
                }) === '<p><br data-mce-bogus=\"1\"></p>') {
                jQuery("#server_response").append('title is required</br>');
                $filled = false;
            }
            if (tinyMCE.get("content").getContent({
                    format: 'raw'
                }) === '<p><br data-mce-bogus=\"1\"></p>') {
                jQuery("#server_response").append('content is required</br>');
                $filled = false;
            }
            // if (!jQuery(".tag").val()) {

            //     jQuery("#error_id_tag").html('This filed is required');
            //     $filled = false;
            // } else jQuery("#error_id_tag").html('');

            return $filled;

        }
    });
</script>