<div id="body_active_job_index">
    <div class="panel panel-default">
        <div class="panel-heading">companies list</div>
    </div>

    <table class="dt_active_job_new display" style="width:100%">
        <thead>
            <tr>
                <th>Company</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Website</th>
                <th>Added by</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            global $table_prefix, $wpdb;
            $wp_table = $table_prefix . "ds_tender_companies";
            $companies = $wpdb->get_results("SELECT id, company_name, phone, email, website, user_id FROM $wp_table order by id desc");


            foreach ($companies as $company) {
                echo "<tr>" .
                    "<td>" . $company->company_name . "</td>" .
                    "<td>" . $company->phone . "</td>" .
                    "<td>" . $company->email . "</td>" .
                    "<td>" . $company->website . "</td>" .
                    "<td>" . $company->user_id . "</td>" .
                    '<td>';
                echo '<button item_id="' . $company->id . '" class="btn btn-primary" id="edit_company" type="button">Edit company</button>';

                echo "</td" . "</tr>";
            }
            ?>

        </tbody>

    </table>