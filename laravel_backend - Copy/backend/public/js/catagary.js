function showCategory(category) {
            // Hide all sections
            document.querySelectorAll('.category-section').forEach(section => {
                section.classList.remove('active');
            });
            
            // Remove active from all buttons
            document.querySelectorAll('.nav-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Show selected section
            document.getElementById(category).classList.add('active');
            
            // Add active to clicked button
            event.target.classList.add('active');
        }

        // Add some interactive functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Add to cart functionality
            document.querySelectorAll('.btn-primary').forEach(button => {
                button.addEventListener('click', function() {
                    const productName = this.closest('.product-card').querySelector('.product-name').textContent;
                    this.textContent = 'Added!';
                    this.style.background = '#2ecc71';
                    
                    setTimeout(() => {
                        this.textContent = 'Add to Cart';
                        this.style.background = '';
                    }, 2000);
                    
                    // You could add actual cart functionality here
                    console.log(`Added ${productName} to cart`);
                });
            });

            // Search functionality
            document.querySelectorAll('.search-input').forEach(input => {
                input.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const currentSection = document.querySelector('.category-section.active');
                    const products = currentSection.querySelectorAll('.product-card');
                    
                    products.forEach(product => {
                        const productName = product.querySelector('.product-name').textContent.toLowerCase();
                        const productDesc = product.querySelector('.product-description').textContent.toLowerCase();
                        
                        if (productName.includes(searchTerm) || productDesc.includes(searchTerm)) {
                            product.style.display = 'block';
                        } else {
                            product.style.display = 'none';
                        }
                    });
                });
            });
        });
 
