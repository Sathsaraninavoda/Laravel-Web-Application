// Contact form submission
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();

    // Get form data
    const formData = new FormData(this);
    const data = {};
    formData.forEach((value, key) => {
        data[key] = value;
    });

    // Basic validation
    if (!data.firstName || !data.lastName || !data.email || !data.subject || !data.message) {
        alert('Please fill in all required fields.');
        return;
    }

    // Email validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(data.email)) {
        alert('Please enter a valid email address.');
        return;
    }

    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
    submitBtn.disabled = true;

    // Simulate form submission (replace with actual PHP submission)
    setTimeout(() => {
        // Show success message
        document.getElementById('success-alert').classList.remove('d-none');

        // Reset form
        this.reset();

        // Restore button
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;

        // Scroll to success message
        document.getElementById('success-alert').scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });

        // Hide success message after 5 seconds
        setTimeout(() => {
            document.getElementById('success-alert').classList.add('d-none');
        }, 5000);

    }, 2000);
});

// Form field focus effects
document.querySelectorAll('.form-control').forEach(field => {
    field.addEventListener('focus', function() {
        this.parentNode.classList.add('focused');
    });

    field.addEventListener('blur', function() {
        if (this.value === '') {
            this.parentNode.classList.remove('focused');
        }
    });
});