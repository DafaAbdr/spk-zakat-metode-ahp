  </main>
</div>
</div>

<script>
  const btnSidebar = document.getElementById('btnSidebar');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlaySidebar');
  if (btnSidebar) {
    btnSidebar.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
      overlay.classList.toggle('hidden');
    });
    overlay.addEventListener('click', () => {
      sidebar.classList.add('-translate-x-full');
      overlay.classList.add('hidden');
    });
  }

  // Tombol hide/tampilkan menu (khusus tampilan desktop)
  const btnCollapse = document.getElementById('btnCollapse');
  if (btnCollapse) {
    btnCollapse.addEventListener('click', () => {
      const kolaps = sidebar.classList.toggle('collapsed');
      localStorage.setItem('sidebarCollapsed', kolaps ? '1' : '0');
    });
  }

  // Auto hilangkan alert flash setelah 5 detik
  setTimeout(() => {
    document.querySelectorAll('[role="alert"]').forEach(el => {
      el.style.transition = 'opacity .5s';
      el.style.opacity = '0';
      setTimeout(() => el.remove(), 500);
    });
  }, 5000);
</script>
</body>
</html>
