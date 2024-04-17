

const tovarfsLink = document.getElementById('tovarfs-link');
const usersLink = document.getElementById('users-link');
const contenttovarfs = document.getElementById('content-tovarfs');
const contentUsers = document.getElementById('content-users');

tovarfsLink.addEventListener('click', function(event) {
    event.preventDefault();
    contenttovarfs.style.display = 'block';
    contentUsers.style.display = 'none';
});

usersLink.addEventListener('click', function(event) {
    event.preventDefault();
    contenttovarfs.style.display = 'none';
    contentUsers.style.display = 'block';
});