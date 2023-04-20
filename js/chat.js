const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const user = urlParams.get('user');
const form = document.getElementById('messageForm');
const messageInput = document.getElementById('sendMessage');
const sendButton = document.getElementById('sendButton');

function getUsers(){
    fetch(`http://localhost/apichat/controllers/chatHeaderController.php?user=${user}`)
    .then(response => response.text())
    .then(data => {
        document.querySelector('.chat-header').innerHTML = data;
    })
    .catch(error => console.error(error));
}

form.addEventListener('submit', function(e){
    e.preventDefault();
    message = messageInput.value.trim();
    const formData = new FormData();
    formData.append('sentedMessage', message);
    fetch(`http://localhost/apichat/controllers/sendMessagesController.php?user=${user}`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .catch(error => console.error(error));

    messageInput.value = '';
});

function getMessages(){
    fetch(`http://localhost/apichat/controllers/chatMessagesController.php?user=${user}`)
    .then(response => response.text())
    .then(data => {
        document.querySelector('.chat-messages').innerHTML = data;
    })
    .catch(error => console.error(error));
}

document.addEventListener('DOMContentLoaded', function() {
    getUsers();
    getMessages();
    setInterval(getUsers, 3000);
    setInterval(getMessages, 1000);
});

