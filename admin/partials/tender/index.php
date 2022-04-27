<div id="body_active_job_index">
    <div class="panel panel-default">
        <div class="panel-heading">Tenders list</div>
    </div>

    <table class="dt_active_job_new display" style="width:100%">
        <thead>
            <tr>
                <th>Title</th>
                <th>closing_date</th>
                <th>source</th>
                <th>two_merkato_id</th>
                <th>Posted by</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $count = 1;
            foreach ($tenders as $tender) {
                echo "<tr>" .
                    "<td>" . $tender->title . "</td>" .
                    "<td>" . $tender->closing_date . "</td>" .
                    "<td>" . $tender->source_id . "</td>" .
                    "<td>" . $tender->two_merkato_id . "</td>" .
                    "<td>" . $tender->user_id . "</td>" .
                    '<td>';
                echo '<button item_id="' . $tender->id . '" class="btn btn-primary" id="edit_tender" type="button">Edit Tender</button>';

                echo "</td" . "</tr>";
            }
            ?>

        </tbody>

    </table>