document.getElementById("loginForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the default form submission and page reload

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    // console.log(username, password); // showing current username,password.

    // Perform client-side validation (if needed)

    // Make API call to the PHP server
    if( !username == "" && !password == ""){ // this makes sure input fields are not empty!
        fetch("login.php", {
            method: "POST",
            body: JSON.stringify({ username: username, password: password }),
        })
            .then((response) => response.json()) // Parse the response as JSON
            .then((data) => {
                if (data.error) {
                    document.getElementById("errorText").textContent = data.error;
                    document.getElementById("loginContainer").style.display = "block";
                    document.getElementById("dashboardContainer").style.display = "none";
                } else {
                    // Show the dashboard content
                    document.getElementById("userFullName").textContent = data.full_name;
                    document.getElementById("loginContainer").style.display = "none";
                    document.getElementById("dashboardContainer").style.display = "block";
                }
            })
            .catch((error) => {
                document.getElementById("errorText").textContent = "An error occurred. Please try again later.";
            });
    }else{
        console.log("ALL Fields are required");
    }
});
