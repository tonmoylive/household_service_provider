	const togglePassword = document.getElementById('togglePassword');
	const passwordInput = document.getElementById('rPassword');
	const toggleIcon = document.getElementById('toggleIcon');

	togglePassword.addEventListener('click', function () {
		const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);

    // Toggle the eye / eye-slash icon
    toggleIcon.classList.toggle('fa-eye');
    toggleIcon.classList.toggle('fa-eye-slash');
	});