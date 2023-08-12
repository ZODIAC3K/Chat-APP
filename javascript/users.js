const searchBar = document.querySelector(".users .search input");
const searchBtn = document.querySelector(".users .search button");
const userList = document.querySelector(".users .users-list");

// Toggle search bar and button active classes when the search button is clicked
searchBtn.onclick = () => {
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
};

// Function to update user list based on the search term
const updateUserList = (searchTerm) => {
    fetch("search.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ searchTerm: searchTerm }),
    })
    .then(response => response.text())
    .then(data => {
        userList.innerHTML = data;
    })
    .catch(error => {
        console.log(error);
    });
};

// Attach event listener to the search bar for keyup events
searchBar.onkeyup = () => {
    let searchTerm = searchBar.value.trim(); // Trim the search term
    if (searchTerm === "") {
        updateUserList(""); // Update user list with empty search term
    } else {
        updateUserList(searchTerm); // Update user list with the entered search term
    }
};

// Function to update user list periodically
const updatePeriodically = () => {
    fetch("users_list.php", {
        method: "GET",
    })
    .then(response => response.text())
    .then(data => {
        if (!searchBar.classList.contains("active")) {
            userList.innerHTML = data;
        }
    })
    .catch(error => {
        console.log(error);
    });
};

// Call the updatePeriodically function in intervals
setInterval(updatePeriodically, 500);
