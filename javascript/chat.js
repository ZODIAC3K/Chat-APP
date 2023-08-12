const form = document.querySelector(".typing-area");
const inputField = form.querySelector(".input-field");
const sendBtn = form.querySelector("button");
const outgoing_id = document.querySelector(".outgoing_id").value;
const incoming_id = document.querySelector(".incoming_id").value;
const chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) => {
    e.preventDefault(); // Preventing the form from submitting.
};

sendBtn.onclick = () => {
    const message = inputField.value;

    const data = {
        outgoing_id: outgoing_id,
        incoming_id: incoming_id,
        message: message,
    };

    fetch("insert_chat.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
    .then((response) => response.json()) // Parse the JSON response here
    .then((data) => {
        if (data.success) {
            inputField.value = "";
        }
    })
    .catch(error => {
        console.log("Fetch error: " + error);
    });
}


chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
}
chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
}


const updateChatBox = (data) => {
    if(!chatBox.classList.contains("active")){
        chatBox.innerHTML = data;
        chatBox.scrollTop = chatBox.scrollHeight;
    }
    
};

const updatePeriodically = () => {
    const data = {
        outgoing_id: incoming_id,
        incoming_id: outgoing_id,
    };
    fetch("get_chat.php", {
        method: "POST",
        body: JSON.stringify(data)
    })
    .then(response => response.text())
    .then(data => {
        updateChatBox(data);
    })
    .catch(error => {
        console.log(error);
    });
};

setInterval(updatePeriodically, 300);