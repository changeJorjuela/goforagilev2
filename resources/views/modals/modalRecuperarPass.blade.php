<div class="modal fade bd-example-modal-xl" id="modal-recuperarPass" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title modal-title-primary">Recuperar Contraseña</h4>
            </div>
            {!! Form::open(['url' => 'recuperarAcceso', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off','id'=>'form-login_upd']) !!}
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Ingrese su usuario o correo electrónico para recuperar su contraseña de acceso</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6" id="logoPass" >
                            <picture>
                                <source srcset="{{asset("img/password.webp") }}" type="image/webp"/>
                                <source srcset="{{asset("img/password.png") }}" type="image/png"/>
                                <img src="{{asset("img/password.webp") }}" alt="Login" class="user-image"/>
                            </picture>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputEmail1">Usuario</label>
                                        {!! Form::text('username',null,['class'=>'form-control','id'=>'username','placeholder'=>'Usuario']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="exampleInputEmail1">Correo Electrónico</label>
                                        {!! Form::email('correo',null,['class'=>'form-control','id'=>'correo','placeholder'=>'Correo Electrónico']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Recuperar Contraseña</button>
            </div>
            {!!  Form::close() !!}
        </div>
    </div>
</div>
<div class="modal fade" id="loginExitoso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modalInicio">
            <div class="container" id="imageModal">
                <br><br>
                <center>
                    <picture>
                        <source srcset="{{asset("img/check.webp")}}" type="image/webp"/>
                        <source srcset="{{asset("img/check.png")}}" type="image/png"/>
                        <img src="{{asset("img/check.webp")}}" id="imgAlerts">
                    </picture>
                </center>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p id="exitoAlert"></p>
                    </div>
                </div>
                <br>
            </div>
            <div class="modal-footer" id="modalFooter">
                <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="solicitudError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modalInicio" style="background-color: #FFFFFF !important;border: none !important;margin-top: 100px !important;">
            <div class="container" id="imageModal">
                <br><br>
                <center>
                    <picture>
                        <source srcset="{{asset("img/uncheck.webp")}}" type="image/webp"/>
                        <source srcset="{{asset("img/uncheck.png")}}" type="image/png"/>
                        <img src="{{asset("img/uncheck.webp")}}" id="imgAlerts">
                    </picture>
                </center>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p id="errorAlert"></p>
                    </div>
                </div>
                <br>
            </div>
            <div class="modal-footer" id="modalFooter">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
