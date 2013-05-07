$(document).ready(function() {

    // ================= HIDDEN ==============

    $("#log_in_div").hide();
    $("#overlay_div_container").hide();

    var width = $("#main_log_in_button").css("width");
    var margin = $("#main_log_in_button").css("margin");

    $("#log_in_option_ul").css({
        "width": width,
        "margin": margin
    });

    $("#close_log_in_options_span").click(function() {
        $("#log_in_option_ul").slideUp(300);
        $("#overlay_div_container").slideUp(300);
        $("#log_in_div").slideUp(300);
    });

    $("#log_in_as_cashier_li").click(function() {
        $("#log_in_as").val("cashier");
        $("#log_in_as_span").html("CASHIER LOG-IN")
        $("#overlay_div_container").show();
        $("#log_in_div").show();
    });

    $("#log_in_as_administrator_button").click(function() {
        $("#log_in_as").val("administrator");
        $("#log_in_as_span").html("ADMINISTRATOR LOG-IN");
        $("#overlay_div_container").show();
        $("#log_in_div").show();
    });

    // ========== LOG-IN PROCESS ==========

    $("#log_in_form").submit(function() {
        return false;
    })

    $("#log_in_submit").click(function() {
        if($("#username_entered").val() != "" && $("#password_entered").val() != "") {
            $.ajax({
                type: "POST",
                url: "../PHP/OBJECTS/log_in_validation.php",
                data: {"log_in_data": JSON.stringify($("#log_in_form").serializeArray())},
                success: function(data) {
                    if(data != "") {
                        $("#error_span").html(data);
                    } else {
                        if($("#log_in_as").val() == "cashier") {
                            window.location.assign("transaction.php");
                        }
                        if($("#log_in_as").val() == "administrator") {
                            window.location.assign("adminhome.php");
                        }
                    }
                },
                error: function(data) {
                    console.log("ERROR in processing log in = " + JSON.stringify(wew));
                }
            });
        } else {
            // username or password blank warning
        }
    });
});