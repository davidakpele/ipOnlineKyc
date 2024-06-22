import services from './services'

$(document).ready(function () {
    $("#clearPasswordText").click(function () {
        const password = document.querySelector('.userPassword');
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // toggle the eye slash icon
        if (type === 'password') {
            this.classList.remove('fa-eye');
            this.classList.add('fa-eye-slash');
        } else {
            this.classList.remove('fa-eye-slash');
            this.classList.add('fa-eye');
        }
    });

    // $('.auth-form').submit(function (e) {
    //     e.preventDefault()
    //     // Username validation
    //     const usernameInput = document.querySelector('.username');
    //     const usernameError = document.querySelector('.username-error');
    //     const username = usernameInput.value.trim();
    //     const usernameRegex = /^[a-zA-Z0-9]{3,20}$/;

    //     if (username === '') {
    //         usernameInput.classList.add('is-invalid');
    //         usernameError.textContent = 'Username requires*';
    //         usernameError.style.display = 'block';
    //     } else if (!usernameRegex.test(username)) {
    //         usernameInput.classList.add('is-invalid');
    //         usernameError.textContent = 'Username must be alphanumeric and between 3-20 characters.';
    //         usernameError.style.display = 'block';
    //     } else {
    //         usernameInput.classList.remove('is-invalid');
    //         usernameError.textContent = '';
    //         usernameError.style.display = 'none';
    //     }

    //     // Email validation
    //     const emailInput = document.querySelector('.email');
    //     const emailError = document.querySelector('.email-error');
    //     const email = emailInput.value.trim();
    //     const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    //     if (email === '') {
    //         emailInput.classList.add('is-invalid');
    //         emailError.textContent = 'Email address requires*.';
    //         emailError.style.display = 'block';

    //     } else if (!emailRegex.test(email)) {
    //         emailInput.classList.add('is-invalid');
    //         emailError.textContent = 'Invalid email address.';
    //         emailError.style.display = 'block';
    //     } else {
    //         emailInput.classList.remove('is-invalid');
    //         emailError.textContent = '';
    //         emailError.style.display = 'none';
    //     }

    //     // Password validation
    //     const passwordInput = document.querySelector('.userPassword');
    //     const passwordError = document.querySelector('.password-error');
    //     const password = passwordInput.value.trim();
    //     const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;

    //     if (password == '') {
    //         passwordInput.classList.add('is-invalid');
    //         passwordError.textContent = 'Password requires*.';
    //         passwordError.style.display = 'block';
    //     } else if (!passwordRegex.test(password)) {
    //         passwordInput.classList.add('is-invalid');
    //         passwordError.textContent = 'Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one number.';
    //         passwordError.style.display = 'block';
    //     } else {
    //         passwordInput.classList.remove('is-invalid');
    //         passwordError.textContent = '';
    //         passwordError.style.display = 'none';
    //     }

    //     // Check if form is valid before submitting
    //     if (!usernameInput.classList.contains('is-invalid') && 
    //         !emailInput.classList.contains('is-invalid') && 
    //         !passwordInput.classList.contains('is-invalid')) {
    //         // Form is valid, you can submit it
    //         $('.loader').show()
    //         $(".text").text("Processing...");
    //         if ((username, email, password)) {
    //             const auth = new services();
    //             auth.register({
    //                 username:username,
    //                 email: email,
    //                 password: password,
    //             })
    //         }
    //     }
    // });
});