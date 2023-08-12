// login.js
document.addEventListener("DOMContentLoaded", function () 
{
    const form = document.querySelector(".signup form");
    const continueBtn = form.querySelector('.button');
    const errorTextElement = document.querySelector('.error-text');

    form.onsubmit = (e) => {
        e.preventDefault(); // Preventing the form from submitting.
    };

    continueBtn.onclick = () => {
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        if (email == "") 
        {
            errorTextElement.style.display = 'block';
            errorTextElement.innerHTML = "Email is empty.";
        } else if (password == "") 
        {
            errorTextElement.style.display = 'block';
            errorTextElement.innerHTML = "Password is empty.";
        } else 
        {
            fetch("login_validate.php", {
                method: "POST",
                headers: 
                {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ email: email, password: password}), // Convert the JSON object to a string before sending
            })
            .then((response) =>response.json())
            .then((data) => {
                if (data.error) 
                {
                    errorTextElement.style.display = 'block';
                    errorTextElement.innerHTML = data.error;
                } 
                else 
                {
                    errorTextElement.style.display = 'block';
                    errorTextElement.innerHTML = data.success; // accessing success attribute of json in data which we recieve when fetch our API.
                    errorTextElement.style.background = "#DFF2BF";
                    errorTextElement.style.color = "#270";
                    errorTextElement.style.border = "1px solid #d5e7b5";
                    setTimeout(function() {
                        window.location.assign('http://localhost/test/users');
                    }, 1000); // 1000 milliseconds = 1 second
                }
            })
            .catch((error) => {
                console.log(error);
                errorTextElement.style.display = 'block';
                errorTextElement.innerHTML = "An error occurred. Please try again later.";
            });
        }
    };
});
