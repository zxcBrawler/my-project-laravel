document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    if (togglePassword && password) {
        togglePassword.onclick = function () {
            if (password.type === 'password') {
                password.type = 'text';
                this.classList.remove('bi-eye-slash');
                this.classList.add('bi-eye');
            } else {
                password.type = 'password';
                this.classList.remove('bi-eye');
                this.classList.add('bi-eye-slash');
            }
        };
    }

    const toggleConfirm = document.getElementById('toggleConfirmPassword');
    const confirmPassword = document.getElementById('password_confirmation');

    if (toggleConfirm && confirmPassword) {
        toggleConfirm.onclick = function () {
            if (confirmPassword.type === 'password') {
                confirmPassword.type = 'text';
                this.classList.remove('bi-eye-slash');
                this.classList.add('bi-eye');
            } else {
                confirmPassword.type = 'password';
                this.classList.remove('bi-eye');
                this.classList.add('bi-eye-slash');
            }
        };
    }
});