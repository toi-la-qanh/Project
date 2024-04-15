<!DOCTYPE html>
<html>

<head>
    <title>Live Search using AJAX</title>
    <!-- Including jQuery is required. -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Including our scripting file. -->
    <script type="text/javascript">
        $(document).ready(function () {
            //On pressing a key on "Search box" in "search.php" file. This function will be called.
            $("#search").keyup(function () {
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
                        data: {name: name},
                        //If result found, this funtion will be called.
                        success: function (data) {
                            //Assigning result to "display" div in "search.php" file.
                            $("#display").html(data);
                        }

                    });
                }
                else {
                    //Assigning empty value to "display" div in "search.php" file.
                    $("#display").html("");
                }
            });
        });
    </script>
    <!-- Including CSS file. -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <!-- Search box. -->
    <input type="text" id="search" placeholder="Search" />
    <!-- Suggestions will be displayed in below div. -->
    <div id="display"></div>
</body>

</html>