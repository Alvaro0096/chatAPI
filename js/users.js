const filterName = document.getElementById('usersInput');

filterName.addEventListener('keyup', function(){
    const searchTerm = filterName.value.trim();
    if(searchTerm === '') {
        getUsers();
        startInterval();
    } else {
        clearInterval(intervalValue);
        getUsers(searchTerm);
    }
});

function getUsers(searchTerm = ''){
    fetch(`http://localhost/apichat/controllers/usersController.php?searchTerm=${searchTerm}`)
    .then(response => response.text())
    .then(data => {
        document.querySelector('.users-available').innerHTML = data;
    })
    .catch(error => console.error(error));
}

let intervalValue = null;
function startInterval() {
  intervalValue = setInterval(getUsers, 3000);
}

document.addEventListener('DOMContentLoaded', function() {
    getUsers();
    startInterval();
});