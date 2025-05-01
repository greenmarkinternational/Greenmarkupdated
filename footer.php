<footer>
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <a href="#" class="footer-logo">
                    </a>
                    <img src="assets/images/logo without text.svg" alt="" width="100px" style="margin-bottom: 10px;">
                    <h3 class="text-lg font-semibold mb-4"><span style="color:#34723a ;">GreenMark </span>International</h3>
                    <p class="footer-about text-gray-400">Pioneering AI-driven carbon solutions for a sustainable future.</p>
                </div>
                
                <div class="col-6 col-lg-2">
                    <div class="footer-links">
                        <h5>Services</h5>
                        <ul>
                            <li><a href="#">Carbon Credits</a></li>
                            <li><a href="#">MRV Systems</a></li>
                            <li><a href="#">CBAM Solutions</a></li>
                            <li><a href="#">Waste Management</a></li>
                            <li><a href="#">AI Analytics</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-6 col-lg-2">
                    <div class="footer-links">
                        <h5>Company</h5>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Press</a></li>
                            <li><a href="#">Partners</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-6 col-lg-2">
                    <div class="footer-links">
                        <h5>Legal</h5>
                        <ul>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms of Service</a></li>
                            <li><a href="#">Cookie Policy</a></li>
                            <li><a href="#">GDPR</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-6 col-lg-2">
                    <div class="footer-links">
                        <h5>Resources</h5>
                        <ul>
                            <li><a href="#">Help Center</a></li>
                            <li><a href="#">Case Studies</a></li>
                            <li><a href="#">Webinars</a></li>
                            <li><a href="#">Sustainability Guides</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-md-0">© 2023 GreenMark International. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-0">Sustainable technology for a greener tomorrow.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                    
                    // Close mobile menu if open
                    const navbarCollapse = document.querySelector('.navbar-collapse');
                    if (navbarCollapse.classList.contains('show')) {
                        navbarCollapse.classList.remove('show');
                    }
                }
            });
        });
        
        // Initialize Bootstrap scrollspy
        const scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '.navbar',
            offset: 100
        });
    </script>
</body>
</html>