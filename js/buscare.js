function redirectToPhp(event) {
    if (event.key === "Enter") {
      const searchValue = document.getElementById("mySearchField").value;
      window.location.href = `cargar_imagenes/buscador.php?parametro=${encodeURIComponent(searchValue)}`;
    }
  }

  document.getElementById("mySearchField").addEventListener("keydown", redirectToPhp);