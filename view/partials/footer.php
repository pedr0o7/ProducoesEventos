</div> <!-- Fecha container-fluid -->
        </div> <!-- Fecha #content -->
    </div> <!-- Fecha wrapper -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script para alternar a sidebar
        document.getElementById('sidebarCollapse').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });

        // Fechar submenus ao abrir outros
        document.querySelectorAll('#sidebar .dropdown-toggle').forEach(function(element) {
            element.addEventListener('click', function() {
                document.querySelectorAll('#sidebar .collapse').forEach(function(collapse) {
                    if (collapse !== document.getElementById(element.getAttribute('href').substring(1)) {
                        collapse.classList.remove('show');
                    }
                });
            });
        });
    </script>
</body>
</html>