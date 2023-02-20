const enlaceLogout = document.getElementById('logoutLink');

enlaceLogout.addEventListener('click', function (event) {
    event.preventDefault();
    
    const formLogout = document.getElementById('logoutForm');
    formLogout.submit();
});