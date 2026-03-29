(function () {
    const toggleBtn = document.getElementById('togglePassword');
    const passInput = document.getElementById('password');

    if (toggleBtn && passInput) {
        toggleBtn.onclick = function (e) {
            e.preventDefault();
            if (passInput.type === 'password') {
                passInput.type = 'text';
                this.innerHTML = '<i class="bi bi-eye"></i>';
            } else {
                passInput.type = 'password';
                this.innerHTML = '<i class="bi bi-eye-slash"></i>';
            }
        };
    }

    const toggleConfirmBtn = document.getElementById('toggleConfirmPassword');
    const confirmInput = document.getElementById('password_confirmation');

    if (toggleConfirmBtn && confirmInput) {
        toggleConfirmBtn.onclick = function (e) {
            e.preventDefault();
            if (confirmInput.type === 'password') {
                confirmInput.type = 'text';
                this.innerHTML = '<i class="bi bi-eye"></i>';
            } else {
                confirmInput.type = 'password';
                this.innerHTML = '<i class="bi bi-eye-slash"></i>';
            }
        };
    }
})();