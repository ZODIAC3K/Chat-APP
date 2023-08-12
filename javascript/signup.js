// signup.js
const form = document.querySelector(".signup form");
const continueBtn = form.querySelector(".button input");

form.onsubmit = (e) => {
    e.preventDefault(); // Preventing the form from submitting.
};

continueBtn.onclick = (e) => {
    e.preventDefault(); // Prevent the default form submission behavior
    const fname = document.getElementById("fname").value;
    const lname = document.getElementById("lname").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const image = document.getElementById("image").files[0];
    const errorTextElement = document.querySelector('.error-text');

    if (fname == "") {
        errorTextElement.style.display = 'block';
        errorTextElement.innerHTML = "First name is empty.";
    } else if (lname == "") {
        errorTextElement.style.display = 'block';
        errorTextElement.innerHTML = "Last name is empty.";
    } else if (email == "") {
        errorTextElement.style.display = 'block';
        errorTextElement.innerHTML = "Email is empty.";
    } else if (password == "") {
        errorTextElement.style.display = 'block';
        errorTextElement.innerHTML = "Password is empty.";
    } else if (image == undefined) {
        errorTextElement.style.display = 'block';
        errorTextElement.innerHTML = "Upload Image.";
    } else {
        const allowedExtensions = ["png", "jpg", "jpeg"];
        const fileExtension = image.name.split('.').pop().toLowerCase();

        if (!allowedExtensions.includes(fileExtension)) {
            errorTextElement.style.display = 'block';
            errorTextElement.innerHTML = "Invalid image format. Allowed formats are PNG, JPG, and JPEG.";
        } else {
            // Convert the image to Base64
            const reader = new FileReader();
            reader.onloadend = function () {
                const base64Image = reader.result.split(',')[1]; // Extracting the Base64 string from the Data URL
                const data = {
                    fname,
                    lname,
                    email,
                    password,
                    image: base64Image, // Include the Base64 string in the JSON object
                };

                fetch("signup_validate.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(data), // Convert the JSON object to a string before sending
                })
                    .then((response) => response.json())
                    .then((data) => {
                        // console.log(data);
                        if (data.error) {
                            errorTextElement.style.display = 'block';
                            errorTextElement.innerHTML = data.error;
                        } else {
                            errorTextElement.style.display = 'block';
                            errorTextElement.innerHTML = data.success;
                            errorTextElement.style.background = "#DFF2BF";
                            errorTextElement.style.color = "#270";
                            errorTextElement.style.border = "1px solid #d5e7b5";
                            setTimeout(function () {
                                window.location.assign('http://localhost/test/users');
                            }, 1000); // 2000 milliseconds = 2 seconds
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                        errorTextElement.style.display = 'block';
                        errorTextElement.innerHTML = "An error occurred. Please try again later.";
                    });
            };

            reader.readAsDataURL(image); // Read the image file and trigger the onloadend event
        }
    }
};
