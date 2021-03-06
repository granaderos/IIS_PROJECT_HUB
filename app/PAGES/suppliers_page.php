<!DOCTYPE html>
<html>
    <head>
        <title>Admin | Suppliers</title>
        <link rel = "stylesheet" href = "../CSS/includes_all_css_files.css" />
    </head>
    <body>
        <div id = "suppliers_main_container_div" class = "container">
            <h1>Suppliers</h1>
            <span id = 'show_transaction_span' class = 'pull-right label label-info'>show admin's transaction</span><br />
            <div id = "display_suppliers_div">
                <div id = "suppliers_action_div">
                        <span id = "item_limit_content" class = "pull-right">
                            <span id = "item_limit_span" class = "label label-info">Item Limit:</span>
                            <input type = "number" id = "item_limit_input" class = "input-mini" />
                        </span>
                        <input type = "hidden" id = "current_page" value = "0" />

                </div><!-- ======== suppliers action div ends ============ -->
                <br/>
                <table id = "suppliers_table" class = "table table-bordered">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Supplied Product(s)</th>
                            <th>Address</th>
                            <th>Contact NUmber</th>
                        </tr>
                    </thead>
                    <tbody id = "display_suppliers_tbody"></tbody>
                </table><!-- ======= display suppliers table ends ======== -->
                <div id = "pagination_content_div" class = "pagination">

                    <button class = "btn btn-primary" id = "previous_page_button"><<</button>
                    <ul id = "suppliers_pagination_ul"></ul>
                    <button class = "btn btn-primary" id = "next_page_button">>></button>
                </div><!-- =========== pagination content div ends =============-->
            </div><!-- ======= display suppliers div ends ============ -->
            <div id = "display_admins_transaction_div">
                <table id = "admins_transaction_table" class = "table table-bordered">
                    <thead>
                    <tr>
                        <th rowspan = "2">DATE</th>
                        <th colspan = "3">PURCHASE INFO</th>
                    </tr>
                    <tr>
                        <th>Purchased Product</th>
                        <th>Items Bought</th>
                        <th>Supplier</th>
                    </tr>
                    </thead>
                    <tbody id = "display_admins_transaction_table"></tbody>
                </table><!-- ======= admins transaction table ends ===== -->
            </div><!-- ====== display admins transaction div ends ======= -->
        </div><!-- main container div ends -->
        <script src = "../JS/jquery-1.9.1.min.js"></script>
        <script src = "../JS/jquery-ui-1.10.2.min.js"></script>
        <script src = "../JS/suppliers.js"></script>
    </body>
</html>