<footer class="footer reveal-element">
    <div class="container">
        <div class="footer-bottom">© 2025 YPP Darunnadwah Al-Majidiyah. All rights reserved.</div>
    </div>
</footer>

<?php if (isset($customJs)): ?>
    <script src="<?php echo $customJs; ?>"></script>
<?php else: ?>
    <script src="script.js"></script>
<?php endif; ?>

<?php if (isset($extraJs)) echo $extraJs; ?>

</body>

</html>