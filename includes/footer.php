<?php
/**
 * Global footer + closing </body></html>
 * Included at the bottom of every page.
 */
$year = date('Y');
?>
<footer class="site-footer">
    <svg class="footer-wave" viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,32 C240,70 480,-10 720,20 C960,50 1200,10 1440,34 L1440,60 L0,60 Z"></path>
    </svg>

    <div class="footer-inner">
        <div class="container">
            <div class="footer-top">
                <div class="footer-brand">
                    <a href="index.php" class="logo">
                        <span class="bracket">&lt;</span>F.H<span class="bracket">/&gt;</span>
                    </a>
                    <p>Building the web, one debugged form at a time. HTML, CSS, JavaScript and PHP — front end to
                        database.</p>
                    <div class="social-row" style="margin-top:22px;">
                        <a href="#" aria-label="GitHub">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M9 19c-4.3 1.4-4.3-2.5-6-3m12 5v-3.5c0-1 .1-1.4-.5-2 2.8-.3 5.5-1.4 5.5-6a4.6 4.6 0 0 0-1.3-3.2 4.2 4.2 0 0 0-.1-3.2s-1.1-.3-3.5 1.3a12.3 12.3 0 0 0-6.2 0C6.5 2.8 5.4 3.1 5.4 3.1a4.2 4.2 0 0 0-.1 3.2A4.6 4.6 0 0 0 4 9.5c0 4.6 2.7 5.7 5.5 6-.6.6-.6 1.2-.5 2V21" />
                            </svg>
                        </a>
                        <a href="#" aria-label="LinkedIn">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M6 9H2v13h4V9zM4 6a2 2 0 1 0 0-4 2 2 0 0 0 0 4zM22 22v-7.5c0-3-1.6-4.5-4-4.5-1.8 0-2.8 1-3.3 2V10H10v12h4.7v-6.7c0-1.3.9-2.3 2.2-2.3 1.3 0 2.1 1 2.1 2.3V22H22z" />
                            </svg>
                        </a>
                        <a href="#" aria-label="Email">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1zM3.5 6.5l8.5 6 8.5-6" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Navigate</h4>
                    <ul>
                        <li><a href="index.php#home">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="index.php#skills">Skills</a></li>
                        <li><a href="projects.php">Work</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="index.php#services">Website development</a></li>
                        <li><a href="index.php#services">Backend &amp; database</a></li>
                        <li><a href="index.php#services">Debugging &amp; fixes</a></li>
                        <li><a href="index.php#services">Maintenance</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Contact</h4>
                    <ul>
                        <li><a href="mailto:hemjirikafrancis@gmail.com">hemjirikafrancis@gmail.com</a></li>
                        <li><a href="contact.php">Send a message</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <span>&copy; <?php echo $year; ?> Francis H. All rights reserved.</span>
                <span>Built with HTML, CSS, JS &amp; PHP.</span>
            </div>
        </div>
    </div>
</footer>

<script src="js/script.js"></script>
</body>

</html>