window.onload = function() {
    setTimeout(descargarPDF, 1000);
  };
  
  function descargarPDF() {
    const pdf = new jsPDF('landscape'); // Establecer la orientación como horizontal
  
    const contenido = document.documentElement.innerHTML;
  
    const scriptElement = document.getElementById('script-element');
  
    if (scriptElement) {
      scriptElement.style.display = 'none';
    }
  
    pdf.fromHTML(contenido, 15, 15, { 'width': 200 }, function() {
      if (scriptElement) {
        scriptElement.style.display = 'block';
      }
  
      pdf.save('mi_documento.pdf');
    });
  }
  