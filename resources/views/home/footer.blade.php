<div style="position: relative;" class="container-fluid padding bg-white">
<footer id="footer" class="container-fluid text-light bg-dark">

    <div class="row justify-content-end">
        <div class="p-2">
            <div>Ultima actualización: {{\Carbon\Carbon::parse($footer->actualizacion)->format('d/m/Y')}}</div>
            <div>Cantidad de visitas: {{$footer->visitas}}</div>
        </div>
        <div class="col-md-12 text-center">
            <a href="{{route('home.survey')}}" class="text-white text-uppercase">encuestas</a> /
            <a href="{{route('home.questions')}}" class="text-white text-uppercase">preguntas frecuentes</a> /
            <a href="{{route('home.contact')}}" class="text-white text-uppercase">contáctenos</a>
        </div>
        <div class="col-md-12 text-center pr-5 pl-5">
            <div class=" border-light border-top pt-2">@2019 BPA. Todos los derechos reservados.Desarrollado por DESOFT</div>
        </div>
    </div>
</footer>
</div>