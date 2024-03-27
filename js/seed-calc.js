//confirm that DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
  //confirm if id seed-calc exists
  if (document.getElementById('seed-calc')) {
    //listeners for seed-calc
    document.getElementById('seed-calc-btn').addEventListener('click', function(e) {
      //prevent default action
      e.preventDefault();
      //get values from form
      const cantidadHectareas = document.getElementById("area").value;
      const pesoSemillasPor1000 = document.getElementById("peso").value;
      const plantasPorMetroLineal = document.getElementById("nro").value;
      const espaciamientoHilerasMetros = document.getElementById("esp").value;
      const porcentajeEmergencia = document.getElementById("porc").value;
      //calculate
      const semillasPorMetroLineal = plantasPorMetroLineal / (porcentajeEmergencia / 100); // Converting to decimal
      const semillasPorMetroCuadrado = semillasPorMetroLineal / (espaciamientoHilerasMetros / 100); // Converting to meters
      const semillasPorHectarea = semillasPorMetroCuadrado * 10000;
      const pesoSemillasPorHectareaKg = (semillasPorHectarea * pesoSemillasPor1000) / 1000;
      const cantidadTotalSemillas = semillasPorHectarea * cantidadHectareas;
      const pesoTotalSemillasKg = (pesoSemillasPorHectareaKg * cantidadHectareas) / 100; // Corrected calculation
      //format numbers
      const semillasPorMetroLineal_format = semillasPorMetroLineal.toLocaleString('es-AR', { maximumFractionDigits: 2 });
      const semillasPorMetroCuadrado_format = semillasPorMetroCuadrado.toLocaleString('es-AR', { maximumFractionDigits: 2 });
      const semillasPorHectarea_format = semillasPorHectarea.toLocaleString('es-AR', { maximumFractionDigits: 2 });
      const pesoSemillasPorHectareaKg_format = pesoSemillasPorHectareaKg.toLocaleString('es-AR', { maximumFractionDigits: 2 });
      const cantidadTotalSemillas_format = cantidadTotalSemillas.toLocaleString('es-AR', { maximumFractionDigits: 2 });
      const pesoTotalSemillasKg_format = pesoTotalSemillasKg.toLocaleString('es-AR', { maximumFractionDigits: 2 });
      //mostrar calculos 
      document.getElementById("sxml").value = semillasPorMetroLineal_format;
      document.getElementById("sdc").value = semillasPorHectarea_format;
      document.getElementById("pesoTsemi").value = pesoSemillasPorHectareaKg_format;
      document.getElementById("kxh").value = cantidadTotalSemillas_format;
      document.getElementById("sxh").value = pesoTotalSemillasKg_format;
      //show results
      document.getElementById('seed-calc-result').classList.remove('hide');
      document.getElementById('seed-calc-result').classList.add('show');
      //hide form
      document.getElementById('seed-calc-form').classList.remove('show');
      document.getElementById('seed-calc-form').classList.add('hide');
    });
    document.getElementById('return-btn').addEventListener('click', function(e) {
      //prevent default action
      e.preventDefault();
      //hide results
      document.getElementById('seed-calc-result').classList.remove('show');
      document.getElementById('seed-calc-result').classList.add('hide');
      //show form
      document.getElementById('seed-calc-form').classList.remove('hide');
      document.getElementById('seed-calc-form').classList.add('show');
    }
    );
  }
  
});