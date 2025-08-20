
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

        // Form submission handlers
        document.addEventListener('DOMContentLoaded', function() {
            // Contact form
            const contactForm = document.querySelector('#contact form');
            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    alert('🙏 Thank you for your message! We will get back to you soon.');
                    this.reset();
                });
            }

            // Login form
            const loginForm = document.querySelector('#login form');
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    alert('🎉 Login successful! Welcome to Bharat Events.');
                    showPage('home');
                });
            }

            // Signup form
            const signupForm = document.querySelector('#signup form');
            if (signupForm) {
                signupForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    alert('🎊 Account created successfully! Welcome to Bharat Events family.');
                    showPage('home');
                });
            }

            // Admin form
            const adminForm = document.querySelector('#admin form');
            if (adminForm) {
                adminForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    alert('👑 Admin access granted! Welcome to the admin portal.');
                    showPage('home');
                });
            }

            // Search form
            const searchForm = document.querySelector('#home form');
            if (searchForm) {
                searchForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    alert('🔍 Searching for festivals! Results will be displayed here.');
                    showPage('festivals');
                });
            }
        });

        // Add click handlers for booking buttons
        document.addEventListener('click', function(e) {
            if (e.target.textContent && e.target.textContent.includes('Book')) {
                const festivalName = e.target.closest('.festival-card')?.querySelector('h3')?.textContent || 'Festival';
                alert(`🎫 Booking tickets for ${festivalName}! Redirecting to payment page...`);
            }
        });

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

(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9720c11cc2593c2e',t:'MTc1NTY4MDk5My4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();