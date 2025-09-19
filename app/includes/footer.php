</main>

<!-- Footer -->
<footer class="footer bg text-light py-3 mt-auto">
    <div class="container text-center">
        <p class="mb-0">&copy; <?= date('Y'); ?> Bazar de Usados. Todos os direitos reservados.</p>
    </div>
</footer>

<!-- JS do Bootstrap -->
<script src="/assets/js/bootstrap.bundle.min.js"></script>


<!-- JS customizado -->
<script>
    // Caso queira usar toggle em menus customizados
    const menuToggle = document.getElementById('menu-toggle');
    const navbarNav = document.getElementById('navbar-nav');

    if(menuToggle && navbarNav) {
        menuToggle.addEventListener('click', () => {
            navbarNav.classList.toggle('active');
            menuToggle.classList.toggle('active');
        });
    }
</script>

</body>
</html>
