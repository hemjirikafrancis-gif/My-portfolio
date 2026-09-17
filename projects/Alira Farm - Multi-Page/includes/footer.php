<?php
if (!isset($is_home)) { $is_home = false; }
$home = $is_home ? '' : 'index.php';
?>
    <!-- ============ FOOTER ============ -->
    <footer class="site-footer">
        <div class="footer-inner">
            <a href="<?php echo $home !== '' ? $home : '#top'; ?>" class="brand brand-footer">
                <span class="brand-mark small"><img src="images/alira-logo.jpeg" alt="ALIRA Farm logo"></span>
                <span class="brand-name">ALIRA <em>Farm</em></span>
            </a>
            <nav class="footer-nav">
                <a href="<?php echo $home; ?>#about">About</a>
                <a href="<?php echo $home; ?>#vision">Vision</a>
                <a href="<?php echo $home; ?>#goals">Goals</a>
                <a href="<?php echo $home; ?>#products">Products</a>
                <a href="<?php echo $home; ?>#structure">Structure</a>
                <a href="<?php echo $home; ?>#contact">Contact</a>
            </nav>
            <p class="footer-copy">&copy; <?php echo date("Y"); ?> ALIRA Farm. Nigeria's integrated poultry
                agribusiness.</p>
        </div>
    </footer>

    <button class="to-top" id="toTop" aria-label="Back to top">↑</button>

    <script src="script.js"></script>
</body>

</html>
