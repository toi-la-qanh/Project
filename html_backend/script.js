const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

function fill(Value) {

    $('#search').val(Value);

    $('#display').hide();
 }
 $(document).ready(function() {

    $("#search").keyup(function() {

        var name = $('#search').val();

        if (name == "") {

            $("#display").html("");
        }
        else {
            $.ajax({
                type: "POST",
                url: "product.php",
                data: {
                    search: name
                },
                success: function(html) {
                    $("#display").html(html).show();
                }
            });
        }
    });
 });