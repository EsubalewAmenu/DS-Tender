<div id="" class="main_container" style="display: flex;">
    <div id="div_company_add" class="card-primary">
        <div class="card-header">
            <h4>New company</h4>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="row">

                    <div class="form-group col-sm-5">
                        <label for="two_merkato_id">2merkato id</label>
                        <input required id="two_merkato_id" type="text" class="form-control" id="two_merkato_id" value="<?php if (isset($company->two_merkato_id)) echo $company->two_merkato_id ?>">
                    </div>
                    <div class="form-group col-sm-5">
                        <label for="company_name">company name</label>
                        <input required id="company_name" type="text" class="form-control" id="company_name" value="<?php if (isset($company->company_name)) echo $company->company_name ?>">
                    </div>

                    <div class="form-group col-sm-5">
                        <label for="phone">phone</label>
                        <input required id="phone" type="text" class="form-control" id="phone" value="<?php if (isset($company->phone)) echo $company->phone ?>">
                    </div>
                    <div class="form-group col-sm-5">
                        <label for="website">website</label>
                        <input required id="website" type="text" class="form-control" id="website" value="<?php if (isset($company->website)) echo $company->website ?>">
                    </div>

                    <div class="form-group col-sm-5">
                        <label for="email">email</label>
                        <input required id="email" type="text" class="form-control" id="email" value="<?php if (isset($company->email)) echo $company->email ?>">
                    </div>

                    <div class="form-group col-sm-5">
                        <label for="fax">fax</label>
                        <input required id="fax" type="text" class="form-control" id="fax" value="<?php if (isset($company->fax)) echo $company->fax ?>">
                    </div>

                </div>

                <hr>


                <div class="form-group col-12">
                    <label for="address">address</label>
                    <?php
                    // default settings - Kv_front_editor.php
                    $content = '';
                    $editor_id = 'address';
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
            </div>

            <input type="hidden" id="edit_company_id" value="<?php echo $company->id ?>">

            <div class="form-group">

                <button value="1" type="button" id="save_company" class="save_company btn btn-primary">
                    <i class="fa fa-plus"> </i> Save
                </button>
            </div>
            <div id="server_response" class="form-group">
            </div>

        </div>


    </div>

    <?php
    include_once ds_tender_PLAGIN_DIR . '/admin/partials/company/index.php';
    ?>

</div>
<script type="text/javascript">
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    jQuery(document).ready(function() {

        jQuery("#save_company").click(function() {

            if (isAllFiled()) {

                const save = document.querySelector('.save_company')
                save.disabled = true;
                save.innerText = "Please wait..."


                // var feature_image = jQuery('.feature_image').prop('files')[0];
                var company_name = jQuery('#company_name').val();
                var phone = jQuery('#phone').val();
                var website = jQuery('#website').val();
                var email = jQuery('#email').val();
                var fax = jQuery('#fax').val();
                var edit_company_id = jQuery('#edit_company_id').val();
                var two_merkato_id = jQuery('#two_merkato_id').val();
                var address = tinyMCE.get("address").getContent({
                    format: 'raw'
                });

                var form_data = new FormData();

                form_data.append('action', 'ds_tender_save_company');
                // form_data.append('feature_image', feature_image);
                form_data.append('company_name', company_name);
                form_data.append('phone', phone);
                form_data.append('website', website);
                form_data.append('email', email);
                form_data.append('fax', fax);
                form_data.append('edit_company_id', edit_company_id);
                form_data.append('two_merkato_id', two_merkato_id);
                form_data.append('address', address);


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

            // alert(isFileUploaded + " data " )

            // if (isFileUploaded == "") {
            //     jQuery("#error_id_feature_image").html('Please choose feature image first');
            //     $filled = false;
            // } else jQuery("#error_id_feature_image").html('');

            if (!jQuery("#company_name").val()) {
                jQuery("#error_id_company_name").html('This filed is required');
                $filled = false;
            } else jQuery("#error_id_company_name").html('');
            // if (!jQuery("#phone").val()) {
            //     jQuery("#error_id_phone").html('This filed is required');
            //     $filled = false;
            // } else jQuery("#error_id_phone").html('');
            // if (!jQuery("#website").val()) {
            //     jQuery("#error_id_website").html('This filed is required');
            //     $filled = false;
            // } else jQuery("#error_id_website").html('');
            // if (!jQuery("#email").val()) {
            //     jQuery("#error_id_email").html('This filed is required');
            //     $filled = false;
            // } else jQuery("#error_id_email").html('');
            // if (!jQuery("#fax").val()) {
            //     jQuery("#error_id_fax").html('This filed is required');
            //     $filled = false;
            // } else jQuery("#error_id_fax").html('');
            // if (!jQuery("[name='content']").val()) {

            //     jQuery("#error_id_content").html('This filed is required');
            //     $filled = false;
            // } else jQuery("#error_id_content").html('');




            // if (tinyMCE.activeEditor.getContent({
            //         format: 'raw'
            //     }) === '<p><br data-mce-bogus="1"></p>') {
            //     jQuery("#error_id_content").html('This filed is required');
            //     $filled = false;
            // } else jQuery("#error_id_content").html('');



            // if (!jQuery(".category").val()) {

            //     jQuery("#error_id_category").html('This filed is required');
            //     $filled = false;
            // } else jQuery("#error_id_category").html('');
            // if (!jQuery(".tag").val()) {

            //     jQuery("#error_id_tag").html('This filed is required');
            //     $filled = false;
            // } else jQuery("#error_id_tag").html('');

            return $filled;

        }
    });
</script>