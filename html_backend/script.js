 $(document).ready(function() {
    //On pressing a key on "Search box" in "search.php" file. This function will be called.
    $("#search").keyup(function() {
        //Assigning search box value to javascript variable named as "name".
        var name = $(this).val();
        //Validating, if "name" is empty.
        if (name != "") {
            //AJAX is called.
            $.ajax({
                //Data will be sent to "ajax.php".
                url: "ajax.php",
                method: "POST",
                //Data, that will be sent to "ajax.php".
                data: {
                    //Assigning value of "name" into "search" variable.
                    name: name
                },
                //If result found, this funtion will be called.
                success: function(html) {
                    //Assigning result to "display" div in "search.php" file.
                    $("#display").html(html);
                }

            });
        }
        else {
            //Assigning empty value to "display" div in "search.php" file.
            $("#display").html("");
        }
    });
 });