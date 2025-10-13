<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lyceum of Alabang - Excellence in Education</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary-blue: #1a4b8c;
            --secondary-blue: #2d6ec4;
            --light-blue: #e6f0ff;
            --accent-blue: #3498db;
            --dark-blue: #0a2a53;
            --text-dark: #333;
            --text-light: #fff;
            --gray-bg: #f8f9fa;
        }

        body {
            color: var(--text-dark);
            line-height: 1.6;
            background-color: #fff;
        }

        /* Navigation */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 5%;
            background-color: var(--primary-blue);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo h1 {
            color: var(--text-light);
            font-size: 1.8rem;
            margin-left: 10px;
        }

        .logo-icon {
            color: var(--text-light);
            font-size: 2rem;
        }

        .nav-links {
            display: flex;
            list-style: none;
        }

        .nav-links li {
            margin: 0 15px;
        }

        .nav-links a {
            color: var(--text-light);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            font-size: 19px;
        }

        .nav-links a:hover {
            color: var(--light-blue);
        }

        .auth-buttons {
            display: flex;
            align-items: center;
        }

        .btn {
            padding: 8px 20px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            margin-left: 15px;
        }

        .btn-signin {
            color: var(--text-light);
            border: 2px solid var(--text-light);
        }

        .btn-signin:hover {
            background-color: var(--text-light);
            color: var(--primary-blue);
        }

        .btn-signup {
            background-color: var(--accent-blue);
            color: var(--text-light);
        }

        .btn-signup:hover {
            background-color: var(--secondary-blue);
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            padding: 120px 5% 80px;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: var(--text-light);
            text-align: center;
        }

        .hero-content {
            max-width: 900px;
            margin: 0 auto;
        }

        .hero h2 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-hero {
            background-color: var(--text-light);
            color: var(--primary-blue);
            padding: 12px 30px;
            font-size: 1.1rem;
            display: inline-block;
            margin-top: 20px;
        }

        .btn-hero:hover {
            background-color: var(--light-blue);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Courses Section */
        .courses {
            padding: 80px 5%;
            background-color: var(--gray-bg);
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
            color: var(--primary-blue);
            font-size: 2.2rem;
        }

        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .course-card {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .course-img {
            height: 180px;
            background-color: var(--secondary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .course-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .course-card:hover .course-img img {
            transform: scale(1.05);
        }

        .course-content {
            padding: 20px;
        }

        .course-content h3 {
            color: var(--primary-blue);
            margin-bottom: 10px;
        }

        .course-content p {
            color: #666;
            margin-bottom: 15px;
        }

        .course-link {
            color: var(--accent-blue);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }

        .course-link i {
            margin-left: 5px;
            transition: transform 0.3s;
        }

        .course-link:hover i {
            transform: translateX(5px);
        }

        /* Features Section */
        .features {
            padding: 80px 5%;
            background: linear-gradient(to bottom, var(--light-blue) 0%, #fff 100%);
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .feature-card {
            text-align: center;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-blue);
            margin-bottom: 20px;
        }

        .feature-card h3 {
            margin-bottom: 15px;
            color: var(--dark-blue);
        }

        /* Testimonials */
        .testimonials {
            padding: 80px 5%;
            background-color: var(--primary-blue);
            color: var(--text-light);
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .testimonial-card {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 10px;
            backdrop-filter: blur(5px);
        }

        .testimonial-text {
            font-style: italic;
            margin-bottom: 20px;
        }

        .testimonial-author {
            font-weight: 600;
        }

        /* Footer */
        footer {
            background-color: var(--dark-blue);
            color: var(--text-light);
            padding: 60px 5% 30px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-column h3 {
            margin-bottom: 20px;
            font-size: 1.3rem;
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column ul li {
            margin-bottom: 10px;
        }

        .footer-column a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-column a:hover {
            color: var(--text-light);
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--text-light);
            transition: all 0.3s;
        }

        .social-links a:hover {
            background-color: var(--accent-blue);
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #ccc;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hero h2 {
                font-size: 2.2rem;
            }

            .hero p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="logo">
            <i class="fas fa-graduation-cap logo-icon"></i>
            <h1>Lyceum of Alabang</h1>
        </div>
        
        <ul class="nav-links">
            <li><a href="">Home</a></li>
            <li><a href="">Courses</a></li>
            <li><a href="">About Us</a></li>
            <li><a href="">Contact</a></li>
        </ul>
        
        <div class="auth-buttons">
            <a href="login.php" class="btn btn-signin">Sign In</a>
            <a href="signup.php" class="btn btn-signup">Sign Up</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h2>Excellence in Education Since 2003</h2>
            <p>Lyceum of Alabang offers quality education with modern facilities and experienced faculty to shape the future leaders of tomorrow.</p>
            <a href="#" class="btn btn-hero">Explore Our Courses <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>

    <!-- Courses Section -->
    <section class="courses">
        <h2 class="section-title">Our Courses</h2>
        <div class="course-grid">
            <div class="course-card">
                <div class="course-img">
                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Computer Science">
                </div>
                <div class="course-content">
                    <h3>Information Technology</h3>
                    <p>Learn programming, software development, and cutting-edge technologies from industry experts.</p>
                    <a href="#" class="course-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            
            <div class="course-card">
                <div class="course-img">
                    <img src="https://images.unsplash.com/photo-1491438590914-bc09fcaaf77a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Business Administration">
                </div>
                <div class="course-content">
                    <h3>Business Administration</h3>
                    <p>Develop strategic thinking and leadership skills for the global business environment for various professional role.</p>
                    <a href="#" class="course-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            
            <div class="course-card">
                <div class="course-img">
                    <img src="https://images.unsplash.com/photo-1584697964358-3e14ca57658b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Nursing">
                </div>
                <div class="course-content">
                    <h3>Accountant</h3>
                    <p>Students study balance of general education business,and professional courses recording,analyzing.</p>
                    <a href="#" class="course-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            
            <div class="course-card">
                <div class="course-img">
                    <img src="https://th.bing.com/th/id/OIP.omPOtM_iAnG47o4i0iDorQHaEo?w=259&h=180&c=7&r=0&o=7&pid=1.7&rm=3" alt="Engineering">
                </div>
                <div class="course-content">
                    <h3>Psychology</h3>
                    <p>an educational progran focused on the scientific study of the mind and behaviour invistigates how social factors influence.</p>
                    <a href="#" class="course-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            
            <div class="course-card">
                <div class="course-img">
                    <img src="https://th.bing.com/th/id/OIP.J22LUrNgtPeTEnyW--MhWAHaEK?w=325&h=182&c=7&r=0&o=7&pid=1.7&rm=3" alt="Maritime Studies">
                </div>
                <div class="course-content">
                    <h3>Criminology</h3>
                    <p>the interdiciplinary social and behavioural science that studies crime as a social phenomenon</p>
                    <a href="#" class="course-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            
            <div class="course-card">
                <div class="course-img">
                    <img src="https://th.bing.com/th/id/OIP.yMPuTSR6OtOIk6Zu23TU3QHaE8?w=249&h=180&c=7&r=0&o=7&pid=1.7&rm=3" alt="Hospitality Management">
                </div>
                <div class="course-content">
                    <h3>Hospitality Management</h3>
                    <p>Learn the art of hospitality management with international standards and practices train students for careers.</p>
                    <a href="#" class="course-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            
            <div class="course-card">
                <div class="course-img">
                    <img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Education">
                </div>
                <div class="course-content">
                    <h3>ACT</h3>
                    <p>provides skills in computing,programming,database management,computer networking.</p>
                    <a href="#" class="course-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
            
            <div class="course-card">
                <div class="course-img">
                    <img src="https://images.unsplash.com/photo-1559028012-481c04fa702d?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Architecture">
                </div>
                <div class="course-content">
                    <h3>Architecture</h3>
                    <p>Design the future with our architecture program blending creativity and technical skills.</p>
                    <a href="#" class="course-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        

        <div class="course-card">
                <div class="course-img">
                    <img src="https://th.bing.com/th/id/OIP.BquqRO6WiIZVHOmXc_10-wHaE8?w=263&h=180&c=7&r=0&o=7&pid=1.7&rm=3" alt="Architecture">
                </div>
                <div class="course-content">
                    <h3>Tourism</h3>
                    <p>A tourism course is an educational program design to provide individuals with comprehensive understating of the tourism industry</p>
                    <a href="#" class="course-link">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <h2 class="section-title">Why Choose Lyceum of Alabang</h2>
        <div class="feature-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h3>Experienced Faculty</h3>
                <p>Our teachers are experts in their fields with years of teaching experience.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-microscope"></i>
                </div>
                <h3>Modern Facilities</h3>
                <p>State-of-the-art laboratories and learning environments.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-globe"></i>
                </div>
                <h3>Global Curriculum</h3>
                <p>Internationally recognized programs that prepare you for global opportunities.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <h3>Industry Connections</h3>
                <p>Strong ties with industry leaders for internships and job placements.</p>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials">
        <h2 class="section-title" style="color: white;">What Our Students Say</h2>
        <div class="testimonial-grid">
            <div class="testimonial-card">
                <p class="testimonial-text">"Sobrang daming activity pinapagawa ni maam milky walang awa hehe."</p>
                <p class="testimonial-author">- Abella, Rey Vergel</p>
            </div>
            
            <div class="testimonial-card">
                <p class="testimonial-text">"Ang bait ni maam milky mataas mag bigay ng grade programmer of the year nga."</p>
                <p class="testimonial-author">-Mc Organo</p>
            </div>
            
            <div class="testimonial-card">
                <p class="testimonial-text">"Kay maam milky lang akong subject maraming missing kelan kaya magtuturo si maam ng walang activity."</p>
                <p class="testimonial-author">-Mike Hapin</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>Lyceum of Alabang</h3>
                <p>Excellence in Education Since 2003</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    
                </div>
            </div>
            
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Courses</a></li>
                    <li><a href="#">Admissions</a></li>
                    <li><a href="#">Scholarships</a></li>
                    <li><a href="#">Campus Tour</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h3>Contact Us</h3>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> Pacita Complex</li>
                    <li><i class="fas fa-phone"></i> 123-456-789</li>
                    <li><i class="fas fa-envelope"></i> lyceumalabang@lyceum.edu.ph</li>
                </ul>
            </div>
        </div>
        
        <div class="copyright">
            <p>&copy; 2025 Lyceum of Alabang. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>