
// PASSWORD SHOW / HIDE
document.addEventListener("DOMContentLoaded", function () {

    const passwordInputs =
        document.querySelectorAll(
            'input[type="password"]'
        );


    passwordInputs.forEach(function (input) {

        const wrapper =
            input.parentElement;


        if (
            wrapper.querySelector(
                ".password-toggle"
            )
        ) {
            return;
        }


        const button =
            document.createElement("button");


        button.type = "button";

        button.innerText = "Show";

        button.className =
            "password-toggle";


        button.style.marginTop = "7px";

        button.style.padding = "5px 10px";

        button.style.cursor = "pointer";


        button.addEventListener(
            "click",
            function () {

                if (
                    input.type === "password"
                ) {

                    input.type = "text";

                    button.innerText =
                        "Hide";

                } else {

                    input.type = "password";

                    button.innerText =
                        "Show";
                }
            }
        );


        wrapper.appendChild(button);

    });

});


// CONFIRM DELETE
function confirmDelete() {

    return confirm(
        "Are you sure you want to delete this request?"
    );

}

// AUTO HIDE ALERT
document.addEventListener(
    "DOMContentLoaded",
    function () {

        const alerts =
            document.querySelectorAll(
                ".alert"
            );


        alerts.forEach(function (alert) {

            setTimeout(
                function () {

                    alert.style.transition =
                        "opacity 0.5s";

                    alert.style.opacity = "0";


                    setTimeout(
                        function () {

                            alert.remove();

                        },
                        500
                    );

                },
                5000
            );

        });

    }
);