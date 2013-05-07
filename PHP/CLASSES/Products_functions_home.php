<?php

    include_once "database_connection.php";
    class Products_functions_home extends Database_connection {

        function check_if_product_to_add_already_exist($product_name) {
            $this->open_connection();

            $select_statement = $this->db_holder->query("SELECT * FROM products;");

            while($products = $select_statement->fetch()) {
                if($products[1] == $product_name) {
                    echo "true";
                    break;
                }
            }

            $this->close_connection();
        }

        function add_product($product_name, $product_price, $number_of_stocks, $stock_unit, $update) {
            $this->open_connection();

            if($update == "yes") {
                $select_statement = $this->db_holder->prepare("SELECT number_of_stocks FROM products WHERE product_name = ?");
                $select_statement->execute(array($product_name));
                $product_number_of_stocks = $select_statement->fetch();
                $total_number_of_stocks = $product_number_of_stocks[0] + $number_of_stocks;
                $update_statement = $this->db_holder->prepare("UPDATE products SET number_of_stocks = ? WHERE product_name = ?");
                $update_statement->execute(array($total_number_of_stocks, $product_name));
            } else {
                $final_product_price = round($product_price, 2);
                $insert_statement = $this->db_holder->prepare("INSERT INTO products VALUES (null, ?, ?, ?, ?);");
                $insert_statement->execute(array($product_name, $final_product_price, $number_of_stocks, $stock_unit));
            }

            $this->close_connection();
        }

        function display_products() {
            $this->open_connection();

            $select_statement = $this->db_holder->query("SELECT product_id, LEFT(product_name, 30), product_price, number_of_stocks, stock_unit FROM products ORDER BY product_name;");

            $counter = 0;
            while($content = $select_statement->fetch()) {
               while($counter < 1) {
                    echo "<tr><th>NAME</th><th>PRICE</th><th>STOCKS</th><th>UNIT</th><th class = 'product_delete_action'><img src = '../CSS/images/trash_can.gif' id = 'delete_trash_icon' onclick = 'delete_products()' /><ul><li id = 'mark_all_delete_action' >Mark All</li><li id = 'unmark_all_delete_action'>UnMark All</li></ul></th></tr>";
                    $counter++;
                }
                $position = strpos($content[2], ".");
                if($position != "") {
                    // ========= With decimal prices greater than 0 ============
                    $whole_number = substr($content[2], 0, $position);
                    $formatted_whole_number = number_format($whole_number);
                    $decimal = substr($content[2], $position);
                    $formatted_price = $formatted_whole_number.$decimal;
                    echo "<tr id = '".$content[0]."'>";
                    echo    "<td ondblclick = 'edit_products_name(".$content[0].")'>".$content[1]."</td>";
                    echo    "<td ondblclick = 'edit_products_price(".$content[0].")'>&#8369;<span id = 'product_price_span'>".$formatted_price."</span></td>";
                    echo    "<td ondblclick = 'edit_products_number_of_stocks(".$content[0].")'>".$content[3]."</td>";
                    echo    "<td ondblclick = 'edit_products_stock_unit(".$content[0].")'>".$content[4]."</td>";
                    echo    "<td class = 'product_delete_action'><input type = 'checkbox' class = 'mark_this' id = 'product_check_box_".$content[0]."' /></td>";
                    echo "</tr>";
                } else {
                    echo "<tr id = '".$content[0]."'>";
                    echo    "<td ondblclick = 'edit_products_name(".$content[0].")'>".$content[1]."</td>";
                    echo    "<td ondblclick = 'edit_products_price(".$content[0].")'>&#8369;<span id = 'product_price_span'>".number_format($content[2]).".00</span></td>";
                    echo    "<td ondblclick = 'edit_products_number_of_stocks(".$content[0].")'>".$content[3]."</td>";
                    echo    "<td ondblclick = 'edit_products_stock_unit(".$content[0].")'>".$content[4]."</td>";
                    echo    "<td class = 'product_delete_action'><input type = 'checkbox' class = 'mark_this' id = 'product_check_box_".$content[0]."' /></td>";
                    echo "</tr>";
                }
            }

            $this->close_connection();
        }

        function display_products_by_select_letter($selected_letter) {
            $this->open_connection();

            $select_statement = $this->db_holder->prepare("SELECT product_id, LEFT(product_name, 30), product_price, number_of_stocks, stock_unit FROM products WHERE product_name LIKE ? ORDER BY product_name;");
            $select_statement->execute(array($selected_letter));
            $counter = 0;
            while($content = $select_statement->fetch()) {
                while($counter < 1) {
                    echo "<tr><th>NAME</th><th>PRICE</th><th>STOCKS</th><th>UNIT</th><th class = 'product_delete_action'><img src = '../CSS/images/trash_can.gif' id = 'delete_trash_icon' onclick = 'delete_products()' /><ul><li id = 'mark_all_delete_action' >Mark All</li><li id = 'unmark_all_delete_action'>UnMark All</li></ul></th></tr>";
                    $counter++;
                }
                $position = strpos($content[2], ".");
                if($position != "") {
                    // ========= With decimal prices greater than 0 ============
                    $whole_number = substr($content[2], 0, $position);
                    $formatted_whole_number = number_format($whole_number);
                    $decimal = substr($content[2], $position);
                    $formatted_price = $formatted_whole_number.$decimal;
                    echo "<tr id = '".$content[0]."'>";
                    echo    "<td ondblclick = 'edit_products_name(".$content[0].")'>".$content[1]."</td>";
                    echo    "<td ondblclick = 'edit_products_price(".$content[0].")'>&#8369;<span id = 'product_price_span'>".$formatted_price."</span></td>";
                    echo    "<td ondblclick = 'edit_products_number_of_stocks(".$content[0].")'>".$content[3]."</td>";
                    echo    "<td ondblclick = 'edit_products_stock_unit(".$content[0].")'>".$content[4]."</td>";
                    echo    "<td class = 'product_delete_action'><input type = 'checkbox' class = 'mark_this' id = 'product_check_box_".$content[0]."' /></td>";
                    echo "</tr>";
                } else {
                    echo "<tr id = '".$content[0]."'>";
                    echo    "<td ondblclick = 'edit_products_name(".$content[0].")'>".$content[1]."</td>";
                    echo    "<td ondblclick = 'edit_products_price(".$content[0].")'>&#8369;<span id = 'product_price_span'>".number_format($content[2]).".00</span></td>";
                    echo    "<td ondblclick = 'edit_products_number_of_stocks(".$content[0].")'>".$content[3]."</td>";
                    echo    "<td ondblclick = 'edit_products_stock_unit(".$content[0].")'>".$content[4]."</td>";
                    echo    "<td class = 'product_delete_action'><input type = 'checkbox' class = 'mark_this' id = 'product_check_box_".$content[0]."' /></td>";
                    echo "</tr>";
                }
            }

            $this->close_connection();
        }

        function retrieve_product_data($id, $data_to_retrieve) {
            $this->open_connection();

            $select_statement = $this->db_holder->prepare("SELECT ".$data_to_retrieve." FROM products WHERE product_id = ?;");
            $select_statement->execute(array($id));

            $product_data = $select_statement->fetch();

            echo $product_data[0];

            $this->close_connection();
        }

        function edit_products_data($id, $product_name, $product_price, $products_number_of_stocks, $stock_unit) {
            $this->open_connection();

            $product_price = round($product_price, 2);

            if($product_name != "") {
                $update_statement = $this->db_holder->prepare("UPDATE products SET product_name = ? WHERE product_id = ?;");
                $update_statement->execute(array($product_name, $id));
                echo $product_name;
            }

            if($product_price != "") {
                $update_statement = $this->db_holder->prepare("UPDATE products SET product_price = ? WHERE product_id = ?;");
                $update_statement->execute(array($product_price, $id));
                echo $product_price;
            }

            if($products_number_of_stocks != "") {
                $update_statement = $this->db_holder->prepare("UPDATE products SET number_of_stocks = ? WHERE product_id = ?;");
                $update_statement->execute(array($products_number_of_stocks, $id));
                echo $products_number_of_stocks;
            }

            if($stock_unit != "") {
                $update_statement = $this->db_holder->prepare("UPDATE products SET stock_unit = ? WHERE product_id = ?;");
                $update_statement->execute(array($stock_unit, $id));
                echo $stock_unit;
            }

            $this->close_connection();
        }

        function delete_product($id) {
            $this->open_connection();

            $delete_statement = $this->db_holder->prepare("DELETE FROM products WHERE product_id = ?;");
            $delete_statement->execute(array($id));

            $this->close_connection();
        }

        function search_product($product_name_to_search) {
            $this->open_connection();

            $select_statement = $this->db_holder->prepare("SELECT product_id, LEFT(product_name, 30), product_price, number_of_stocks, stock_unit FROM products WHERE product_name LIKE ? ORDER BY product_name;");
            $select_statement->execute(array($product_name_to_search));

            $counter = 0;
            while($content = $select_statement->fetch()) {
                while($counter < 1) {
                    echo "<tr><th>NAME</th><th>PRICE</th><th>STOCKS</th><th>UNIT</th><th class = 'product_delete_action'><img src = '../CSS/images/trash_can.gif' id = 'delete_trash_icon' onclick = 'delete_products()' /><ul><li id = 'mark_all_delete_action' >Mark All</li><li id = 'unmark_all_delete_action'>UnMark All</li></ul></th></tr>";
                    $counter++;
                }
                $position = strpos($content[2], ".");
                if($position != "") {
                    // ========= With decimal prices greater than 0 ============ //
                    $whole_number = substr($content[2], 0, $position);
                    $formatted_whole_number = number_format($whole_number);
                    $decimal = substr($content[2], $position);
                    $formatted_price = $formatted_whole_number.$decimal;
                    echo "<tr id = '".$content[0]."'>";
                    echo    "<td ondblclick = 'edit_products_name(".$content[0].")'>".$content[1]."</td>";
                    echo    "<td ondblclick = 'edit_products_price(".$content[0].")'>&#8369;<span id = 'product_price_span'>".$formatted_price."</span></td>";
                    echo    "<td ondblclick = 'edit_products_number_of_stocks(".$content[0].")'>".$content[3]."</td>";
                    echo    "<td ondblclick = 'edit_products_stock_unit(".$content[0].")'>".$content[4]."</td>";
                    echo    "<td class = 'product_delete_action'><input type = 'checkbox' class = 'mark_this' id = 'product_check_box_".$content[0]."' /></td>";
                    echo "</tr>";
                } else {
                    echo "<tr id = '".$content[0]."'>";
                    echo    "<td ondblclick = 'edit_products_name(".$content[0].")'>".$content[1]."</td>";
                    echo    "<td ondblclick = 'edit_products_price(".$content[0].")'>&#8369;<span id = 'product_price_span'>".number_format($content[2]).".00</span></td>";
                    echo    "<td ondblclick = 'edit_products_number_of_stocks(".$content[0].")'>".$content[3]."</td>";
                    echo    "<td ondblclick = 'edit_products_stock_unit(".$content[0].")'>".$content[4]."</td>";
                    echo    "<td class = 'product_delete_action'><input type = 'checkbox' class = 'mark_this' id = 'product_check_box_".$content[0]."' /></td>";
                    echo "</tr>";
                }
            }

            $this->close_connection();
        }

    }