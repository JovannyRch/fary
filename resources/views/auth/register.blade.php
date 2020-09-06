@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">

                <div class="card-body form-register">
                    <div class="row">
                        <div class="col-8 col-md-5 offset-2 offset-md-0">
                            <img id="logo" class="w-100" src="/images/logo.jpg" alt="" srcset="">
                        </div>
                        <div class="col-12 col-md-7">
                            <div class="text-center mb-3">
                                <h3><b>Registro de usuario</b></h3>
                            </div>
                            <div class="alert alert-primary text-center">
                            ¿Tienes un negocio?<a href="{{route('register.cuenta')}}"> <b> Registra tu negocio aquí</b></a>
                            </div>
                            <form method="POST" id="register-form" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name"
                                        class="col-md-8 p-0 offset-md-2 col-form-label"><b>Nombre</b></label>

                                    <div class="col-md-8 p-0 offset-md-2">
                                        <input id="name" type="text" placeholder="Escribe tu nombre"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="col-md-8 p-0 offset-md-2 col-form-label"><b>Número
                                            telefónico</b></label>

                                    <div class="col-md-8 p-0 p-0 offset-md-2">
                                        <input id="phone" placeholder="Escribe tu número telefónico" type="text"
                                            class="form-control @error('phone') is-invalid @enderror" name="phone"
                                            value="{{ old('phone') }}" required autocomplete="phone">

                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="address"
                                        class="col-md-8 p-0 offset-md-2 col-form-label"><b>Dirección</b></label>

                                    <div class="col-md-8 p-0 offset-md-2">
                                        <input id="address" placeholder="Escribe tu direccíón" type="text"
                                            class="form-control @error('address') is-invalid @enderror" name="address"
                                            value="{{ old('address') }}" required autocomplete="address">

                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-md-8 p-0 offset-md-2 col-form-label"><b>Correo
                                            electrónico</b></label>

                                    <div class="col-md-8 p-0 offset-md-2">
                                        <input id="email" type="email" placeholder="Escribe tu correo electrónico"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password"
                                        class="col-md-8 p-0 offset-md-2 col-form-label"><b>Contraseña</b></label>

                                    <div class="col-md-8 p-0 offset-md-2">
                                        <input id="password" type="password" placeholder="Escribe tu contraseña"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm"
                                        class="col-md-8 p-0 offset-md-2 col-form-label"><b>Confirmación de
                                            contraseña</b></label>

                                    <div class="col-md-8 p-0 offset-md-2">
                                        <input id="password-confirm" placeholder="Repite tu contraseña" type="password"
                                            class="form-control" name="password_confirmation" required
                                            autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="col-md-8 p-9 offset-md-2 text-center" style="color: grey">
                                    Al hacer clic en "Registrarme" aceptas nuestros <a href="/docs/contrato.pdf" target="_blank" style="color: rgb(105, 140, 150);" >terminos, condiciones</a> y la
                                    <a href="#" style="color: rgb(105, 140, 150);" data-toggle="modal"
                                        data-target="#user-register">política de privacidad</a>.
                                </div>

                                <div class="form-group row mb-0  text-center">
                                    <div class="col-md-8 p-0 offset-md-2">
                                        <button type="submit" class="btn btn-success text-white">
                                            Registrarme
                                        </button>
                                    </div>
                                </div>


                                <div class="text-center text-success">
                                    ¿Ya tienes cuenta? <br>
                                    <b><a class="text-success" href="{{ route('login') }}">
                                            <u>Inicia sesión aquí</u></a></b>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Aviso de Privacidad -->
    <div class="modal fade" id="user-register" tabindex="-1" role="dialog" aria-labelledby="title-register"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><b>Aviso de Privacidad</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-justify">
                    <p>
                        Con fundamento en el artículo 17 de la Ley Federal de Protección de
                        Datos Personales en Posesión de los Particulares se da a conocer el
                        aviso de privacidad relativo a la forma y términos en que serán
                        tratados los datos personales recabados, consultable en la siguiente
                        liga: <i><a href="http://www.faryreddeautopartes.com">
                                www.faryreddeautopartes.com</a></i> .
                    </p>

                    <p>De conformidad con lo establecido en la Ley Federal de Protección de
                        Datos Personales en Posesión de los Particulares, y demás normas
                        relativas y aplicables se extiende el presente aviso de privacidad,
                        con el fin de ser utilizados para la administración, control
                        interno, contacto con el propietario de éstos y demás acciones que
                        sean necesarias para la publicación de negocios, marcas, giros
                        comerciales y/o establecimientos integrados en el portal de internet
                        <a href="http://www.faryreddeautopartes.com">
                            www.faryreddeautopartes.com</a> , para que los usuarios de dicha
                        página puedan
                        obtener los servicios, productos y bienes que sean publicados; mismo
                        aviso que puede ser consultado en nuestra sección de (aviso de
                        privacidad),reiterando que solo se establecerá la comunicación entre
                        el encargado de la recolección de sus datos personales y del
                        propietario de los datos personales, y donde se establecen las bases
                        y procedimientos en caso de rectificación, cancelación u oposición
                        al uso de sus datos personales.</p>
                    <h5 class="text-center"><b>AVISO DE PRIVACIDAD.</b></h5>
                    <p>Políticas de Privacidad
                        El portal de Internet www.faryreddeautopartes.com, en su apartado de
                        aviso
                        de privacidad, es responsable del uso y protección de datos
                        personales, y al respecto le informamos lo siguiente:
                    </p>
                    <p>
                        <b> I.- ¿QUÉ DATOS PERSONALES UTILIZAREMOS PARA ESTOS FINES?</b>
                        Para llevar a cabo las finalidades descritas en el presente aviso de
                        privacidad, utilizaremos los siguientes datos personales:

                    </p>
                    <div class="container m-0 p-0 pl-4">
                        <ul>
                            <li>Nombre</li>
                            <li>Número telefónico de contacto</li>
                            <li>Nombre del establcimiento</li>
                            <li>Domicilio</li>
                            <li>Tipo de giro comercial</li>
                            <li>Correo electrónico</li>
                        </ul>
                    </div>
                    <p>
                        <b> II.- ¿PARA QUÉ UTILIZAREMOS SUS DATOS PERSONALES?</b>
                        Los datos personales que usted proporcione en este registro de
                        acceso son datos meramente identificativos necesarios para el
                        control de negocios, marcas, giros comerciales, bienes, servicios
                        y/o establecimientos publicados en el portal de internet
                        www.faryreddeautopartes.com en el que se promocionara los referidos.
                        Si usted
                        no desea proporcionarlos, nos reservamos el derecho de negarle el
                        servicio de publicación en el portal de internet. Los datos
                        mencionados se mantendrán bajo resguardo en el portal de internet
                        por el término de un año y solo podrán ser públicos si autoridad
                        competente lo requiere, y no existirá otro medio de publicación,
                        siempre teniendo el entendido de que los datos proporcionados solo
                        se conocerán al momento del registro; al término de la vigencia de
                        un año se procederá a la actualización de los datos requeridos y/o
                        en cualquier momento que sea solicitado por ser inexactos o
                        incompletos si así lo observare el titular de los datos personales,
                        mediante previa consulta y solicitud del dueño de negocios, marcas,
                        giros comerciales y/o establecimientos, así como de los datos
                        personales publicados en el portal de internet
                        www.faryreddeautopartes.com.
                    </p>
                    <p>
                        En caso de que no desee que sus datos personales sean tratados para
                        el registro y control de información de los negocios, marcas, giros
                        comerciales y/o establecimientos publicados en el portal de internet
                        <a href="http://www.faryreddeautopartes.com">
                            www.faryreddeautopartes.com</a> sobre alguna o todas las
                        finalidades adicionales,
                        desde este momento usted nos puede comunicar lo anterior al correo
                        <a href="http://www.faryreddeautopartes.com">
                            www.faryreddeautopartes.com</a> indicándonos en el cuerpo del
                        correo su
                        nombre completo, su causa, motivo, razón o circunstancia y el dato
                        que desea que sea tratado y para qué finalidad secundaria.
                    </p>
                    <p>
                        Los datos proporcionados serán utilizados para la administración,
                        control interno, contacto con el propietario de éstos y demás
                        acciones que sean necesarias, y solo se establecerá la comunicación
                        entre el encargado de la recolección de sus datos personales y del
                        propietario de dichos datos, siendo única y exclusivamente la
                        utilización de datos de registro, nombre y domicilio del negocio,
                        marca, giro comercial y/o establecimiento de cada propietario y que
                        solo estos datos serán publicados en el portal de internet
                        <a href="http://www.faryreddeautopartes.com">
                            www.faryreddeautopartes.com</a>
                    </p>
                    <p>
                        La negativa para el uso de sus datos personales para estas
                        finalidades no podrá ser un motivo para que le neguemos los
                        servicios y productos que solicita o contrata con nosotros.
                    </p>
                    <p>
                        En caso de sufrir vulneraciones de seguridad ocurridas en cualquier
                        fase del tratamiento, resguardo o cualquier momento que así lo
                        estime pertinente el encargado del aseguramiento de los datos
                        personales, que afecten de forma significativa los derechos
                        patrimoniales o morales de los titulares, serán informadas de forma
                        inmediata por el responsable al titular, a fin de que este último
                        pueda tomar las medidas correspondientes a la defensa de sus
                        derechos.
                    </p>
                    <p>
                        <b> III.- ¿CÓMO PUEDE ACCEDER, RECTIFICAR, CANCELAR U OPONERSE AL
                            USO DE
                            SUS DATOS PERSONALES?</b>

                        Usted tiene derecho a conocer qué datos personales tenemos de usted,
                        para qué los utilizamos y las condiciones del uso que les damos; así
                        como también es su derecho solicitar la corrección de su información
                        personal en caso de que esté desactualizada, sea inexacta o
                        incompleta, sufra alguna actualización por su parte y que tenga la
                        necesidad de ser actualizada.
                    </p>
                    <p>
                        También es su derecho que eliminemos de nuestros registros o bases
                        de datos los datos personales cuando considere que dicha información
                        no se está usando adecuadamente y por último, también puede oponerse
                        al uso de sus datos personales para fines específicos.
                    </p>
                    <p>
                        Para el ejercicio de cualquiera de los derechos contenidos en la Ley
                        Federal de Protección de Datos Personales en Posesión de los
                        Particulares usted deberá presentar la solicitud respectiva mediante
                        correo electrónico dirigido al correo <a href="http://www.faryreddeautopartes.com">
                            www.faryreddeautopartes.com</a>,
                        mismo que deberá contener la siguiente información:
                    </p>


                    <ul class="p-0 m-0 pl-4">
                        <li>Nombre del titular de los datos personales;</li>
                        <li>Identificación oficial con fotografía que lo acredite como el
                            titular
                            de los datos personales;</li>
                        <li>Correo electrónico al cual quiere recibir la respuesta;</li>
                        <li> Los datos personales sobre los que se pretende ejercer alguno
                            de
                            los
                            derechos contenidos en la Ley Federal de Protección de Datos
                            Personales
                            en Posesión de los Particulares;</li>
                        <li>Descripción del motivo por el que se pretenda realizar una
                            acción
                            respecto de sus datos personales.</li>
                        <li>En caso de ser necesario documento o documentos que facilite la
                            localización de los datos personales.</li>
                    </ul>
                    <p>
                        De conformidad con la legislación aplicable, la respuesta a la
                        solicitud no podrá ser superior a los 20 días hábiles contados a
                        partir del día hábil siguiente a aquel en que se haya recibido la
                        solicitud.
                    </p>
                    <p>
                        Los datos de contacto de la persona que está a cargo de dar trámite
                        a las solicitudes de derechos contenidos en la ley son los
                        siguientes:
                    </p>
                    <ul class="m-0 p-0 pl-4">
                        <li>
                            autofary@gmail.com
                        </li>
                    </ul>
                    <p>
                        <b>IV.- USTED PUEDE REVOCAR SU CONSENTIMIENTO PARA EL USO DE DATOS
                            PERSONALES.</b>
                        Usted puede revocar el consentimiento que, en su caso, nos haya
                        otorgado para el tratamiento de sus datos personales. Sin embargo,
                        es importante que tenga en cuenta que no en todos los casos podremos
                        atender su solicitud o concluir el uso de forma inmediata, ya que es
                        posible que por alguna obligación legal requiramos seguir tratando
                        sus datos personales. Asimismo, usted deberá considerar que para
                        ciertos fines, la revocación de su consentimiento implicará que no
                        le podamos seguir prestando el servicio de publicación que nos
                        solicitó, o la conclusión de su relación con nosotros.

                    </p>
                    <p>Para revocar su consentimiento deberá presentar una solicitud en los
                        mismos términos que en el apartado III del presente aviso de
                        privacidad (¿CÓMO PUEDE ACCEDER, RECTIFICAR, CANCELAR U OPONERSE AL
                        USO DE SUS DATOS PERSONALES?) de este aviso de privacidad.</p>
                    <p><b>V.- ¿CÓMO PUEDE LIMITAR EL USO O DIVULGACIÓN DE SU INFORMACIÓN
                            PERSONAL?</b>
                        Con el objeto de que usted pueda limitar el uso y divulgación de su
                        información personal, le ofrecemos el mecanismo señalado en el
                        apartado III del presente aviso de privacidad (¿CÓMO PUEDE ACCEDER,
                        RECTIFICAR, CANCELAR U OPONERSE AL USO DE SUS DATOS PERSONALES?) de
                        este aviso de privacidad.
                    </p>
                    <p>Asimismo, en caso de que usted no desee recibir publicidad de nuestra
                        parte, usted se podrá inscribir al Registro Público para Evitar
                        Publicidad. Para mayor información se puede consultar el portal
                        electrónico siguiente: <a href="http://repep.profeco.gob.mx/">http://repep.profeco.gob.mx/</a>
                    </p>
                    <p><b>VI.- EL USO DE TECNOLOGÍAS DE RASTREO EN NUESTRO PORTAL DE
                            INTERNET.</b>
                        Le informamos que en nuestra página de Internet utilizamos cookies,
                        web beacons u otras tecnologías, a través de las cuales es posible
                        monitorear su comportamiento como usuario de Internet, así como
                        brindarle un mejor servicio y experiencia al navegar nuestra página.
                        Los datos personales que recabamos a través de estas tecnologías son
                        los siguientes:
                    </p>
                    <ul class="p-0 m-0 pl-4">
                        <li>Información sobre la dirección IP/nombre de dominio del
                            visitante;</li>
                        <li>Sitios web que hagan referencia a su sitio;</li>
                        <li> Comportamiento y tiempo de estadía en el sitio web;</li>
                        <li>Páginas navegadas;</li>
                        <li>Herramientas utilizadas;</li>
                        <li>Código postal;</li>
                        <li>Tipo de navegador; y,</li>
                        <li>Sistema operativo.</li>

                    </ul>
                    <p>
                        Estas tecnologías se pueden deshabilitar en las opciones de
                        configuración del navegador que se use, normalmente en el botón de
                        ayuda que se encuentra en la barra de herramientas de la mayoría de
                        los navegadores. Adicionalmente, le sugerimos consultar las
                        instrucciones del navegador que esté usando.
                    </p>
                    <p>
                        <b>VII.- ¿CÓMO PUEDE CONOCER LOS CAMBIOS EN ESTE AVISO DE
                            PRIVACIDAD?</b>
                        El presente aviso de privacidad puede sufrir modificaciones, cambios
                        o actualizaciones derivados de nuevos requerimientos legales, de
                        nuestras propias necesidades, de cambios en nuestro modelo de
                        negocio o por cualquier otra causa.

                    </p>
                    <p>Nos comprometemos a mantenerlo informado sobre los cambios que pueda
                        sufrir el presente aviso de privacidad, a través del portal de
                        Internet <a href="http://www.faryreddeautopartes.com">
                            www.faryreddeautopartes.com</a>.</p>
                    <p>La última modificación de este aviso de privacidad es la de fecha
                        29 de Mayo del 2020.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection