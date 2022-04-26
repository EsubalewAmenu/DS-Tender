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
        <li data-id="0">
            <i class="fa fa-plus"></i>
            <label>
                <input id="xnode-0" data-id="custom-0" type="checkbox" /> node-0
            </label>
            <ul>
                <li data-id="1">
                    <i class="fa fa-plus"></i>
                    <label>
                        <input id="xnode-0-1" data-id="custom-0-1" type="checkbox" />
                        node-0-1
                    </label>
                    <ul>
                        <li>
                            <label>
                                <input class="hummingbird-end-node" id="xnode-0-1-1" data-id="custom-0-1-1" type="checkbox" />
                                node-0-1-1
                            </label>
                        </li>
                        <li>
                            <label>
                                <input class="hummingbird-end-node" id="xnode-0-1-2" data-id="custom-0-1-2" type="checkbox" />
                                node-0-1-2
                            </label>
                        </li>
                    </ul>
                </li>
                <li data-id="1">
                    <i class="fa fa-plus"></i>
                    <label>
                        <input id="xnode-0-2" data-id="custom-0-2" type="checkbox" />
                        node-0-2
                    </label>
                    <ul>
                        <li>
                            <label>
                                <input class="hummingbird-end-node" id="xnode-0-2-1" data-id="custom-0-2-1" type="checkbox" />
                                node-0-2-1
                            </label>
                        </li>
                        <li>
                            <label>
                                <input class="hummingbird-end-node" id="xnode-0-2-2" data-id="custom-0-2-2" type="checkbox" />
                                node-0-2-2
                            </label>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
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