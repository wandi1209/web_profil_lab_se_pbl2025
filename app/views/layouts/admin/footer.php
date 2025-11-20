</main>

</div> 

<footer class="text-center py-3 mt-auto">
    <p>&copy; <?= date('Y') ?> Web Profil Lab SE</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= $_ENV['APP_URL'] ?>/assets/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const subLinks = document.querySelectorAll('.sub-link');

    subLinks.forEach(link => {
        link.addEventListener('click', function() {
            subLinks.forEach(sub => sub.classList.remove('active-sub-link'));
            this.classList.add('active-sub-link');

            document.querySelectorAll('.nav-link.dropdown-toggle')
                .forEach(item => item.classList.remove('active'));

            const parentLink = this.closest('.collapse').previousElementSibling;
            if (parentLink) parentLink.classList.add('active');
        });
    });
});
</script>

</body>
</html>
