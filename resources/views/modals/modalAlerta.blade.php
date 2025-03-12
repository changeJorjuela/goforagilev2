<div class="modal fade" id="mensajeAlerta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modalInicio">
            <div class="modal-header">
                <h5 class="modal-title" id="headAlerta"></h5>
                                
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" style="text-align:center;">
                        <center>
                            <picture>
                                <source srcset="{{asset("img/uncheck.webp")}}" type="image/webp" />
                                <source srcset="{{asset("img/uncheck.png")}}" type="image/png" />
                                <img src="{{asset("img/uncheck.webp")}}" id="imgAlerts">
                            </picture>
                        </center>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <p id="exitoAlerta"></p>
                    </div>
                </div>
                <br>
            </div>
            <div class="modal-footer" id="modalFooter">
                <button class="btn btn-danger btn-rounded" id="aceptarAlerta">Aceptar</button>
            </div>
        </div>
    </div>
</div>