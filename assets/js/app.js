
        // Page navigation
        function showPage(pageName) {
            // Hide all pages
            document.querySelectorAll('.page').forEach(page => {
                page.classList.add('hidden');
            });
            
            // Show selected page
            const targetPage = document.getElementById(pageName);
            if (targetPage) {
                targetPage.classList.remove('hidden');
            }
            
            // Update navigation active state
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('text-orange-600');
                link.classList.add('text-gray-700');
            });
            
            // Scroll to top when changing pages
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Smooth scroll to top
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

     

        // Fade in animation on scroll
        window.addEventListener('scroll', function() {
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;
                
                if (elementTop < window.innerHeight - elementVisible) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        });

        // Add hover effects for category cards
        document.querySelectorAll('.cursor-pointer').forEach(card => {
            card.addEventListener('click', function() {
                const category = this.querySelector('h3')?.textContent || 'Category';
                alert(`🎭 Exploring ${category} festivals! Loading events...`);
                showPage('festivals');
            });
        });

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            showPage('home');
        });