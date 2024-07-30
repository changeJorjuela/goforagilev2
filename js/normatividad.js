if (window.innerWidth >= 991) {
    document.write('<section class="ftco-section" id="idSectionNormatividad">' +
      '<div class="container" id="containerNormatividad">' +
      '<iframe src="../documentos/PLAN_ANTICORRUPCION.pdf#toolbar=0" type="application/pdf" width="100%" height="600px"></iframe>' +
      '</div>' +
      '</section>' +
      '<section class="ftco-section" id="idSectionNormatividad">' +
      '<div class="container" id="containerNormatividad">' +
      '<iframe src="../documentos/INFORMACION_TECNOLOGIA.pdf#toolbar=0" type="application/pdf" width="100%" height="600px"></iframe>' +
      '</div>' +
      '</section>');
  } else if (window.innerWidth <= 991) {
    document.write('<section class="ftco-section" id="idSectionNormatividad">' +
      '<div class="container" id="containerNormatividad">' +
      '<div class="row">' +
      '<div class="col-md-2">' +
        '<a href="../documentos/PLAN_ANTICORRUPCION.pdf" target="_blank"><img src="images/doc.png" alt=""></a>'+
      '</div>' +
      '<div class="col-md-10">' +
        '<p font-size: 15px;>PLAN ANTIRCORRUPCIÓN</p>'+
      '</div>' +
      '</div>' +
      '<br>'+
      '<div class="row">' +
        '<div class="col-md-2">' +
        '<a href="../documentos/INFORMACION_TECNOLOGIA.pdf" target="_blank"><img src="images/doc.png" alt=""></a>'+
      '</div>' +
      '<div class="col-md-10">' +
        '<p font-size: 15px;>INFORMACIÓN CONTRACTUAL</p>'+
      '</div>' +
      '</div>' +
      '</div>' +
      '</section>');
  }
