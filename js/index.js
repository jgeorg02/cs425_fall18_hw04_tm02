// Get the modal
var index = document.getElementById('login_modal');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == index) {
        index.style.display = "none";
    }
};

var tried = 0;

function checkCredentials() {
    tried++;

    $(document).ready(function () {
        $.ajax({
            type: "POST",
            url: "login.php",
            data: {
                username: document.getElementById('uname').value,
                password: document.getElementById('pass').value
            },
            success: function(response) {
                if (response == 'success')
                    window.location.replace("map.html");
                else {
                    if (tried <= 3){
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'You gave wrong username or password' + response
                        });
                    }
                    else window.location.replace("bye.html");
                }
            }

        });
    });

}
