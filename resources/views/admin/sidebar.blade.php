<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="@if(Auth::user()->avatar)
                        {{asset('/storage/'.Auth::user()->avatar)}}
                        @else
                        {{asset('/files/defaultuser.png')}}
                        @endif
                        " class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="{{route('admin.index')}}"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">ADMINISTRACION BPA</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{route('admin.index')}}" class="{{request()->is('admin')? 'active' :  ''}}"><i class="fa fa-link"></i> <span>Panel de control</span></a></li>
            <li class="treeview">
                <a href="#" class="{{request()->routeIs('admin.manager*') ? 'active' :  ''}}"><i class="fa fa-link"></i> <span>Gestionar Usuarios</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                    <li><a class="{{request()->routeIs('admin.manager.roles*') ? 'active' :  ''}}" href="{{route('admin.manager.roles.index')}}">Roles</a></li>
                    <li><a class="{{request()->routeIs('admin.manager.users*') ? 'active' :  ''}}" href="{{route('admin.manager.users.index')}}">Usuarios</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#" class="{{request()->routeIs('admin.content*') ? 'active' :  ''}}"><i class="fa fa-link"></i> <span>Contenido</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu scrollbar" id="style1">
                    @can('apps.index')
                    <li><a class="{{request()->routeIs('admin.content.apps*') ? 'active' :  ''}}" href="{{route('admin.content.apps.index')}}">Aplicaciones móviles</a></li>
                    @endcan
                    @can('international-activity.index')
                        <li><a class="{{request()->routeIs('admin.content.international-activity*') ? 'active' :  ''}}" href="{{route('admin.content.international-activity.index')}}">Actividad internacional</a></li>
                    @endcan
                    @can('corporative-bank.index')
                        <li><a class="{{request()->routeIs('admin.content.corporative-bank*') ? 'active' :  ''}}" href="{{route('admin.content.corporative-bank.index')}}">Banca corporativa</a></li>
                    @endcan
                    @can('electronic-bank.index')
                        <li><a class="{{request()->routeIs('admin.content.electronic-bank*') ? 'active' :  ''}}" href="{{route('admin.content.electronic-bank.index')}}">Banca electrónica</a></li>
                    @endcan
                    @can('personal-bank.index')
                        <li><a class="{{request()->routeIs('admin.content.personal-bank*') ? 'active' :  ''}}" href="{{route('admin.content.personal-bank.index')}}">Banca personal</a></li>
                    @endcan
                    @can('atms.index')
                        <li><a class="{{request()->routeIs('admin.content.atms*') ? 'active' :  ''}}" href="{{route('admin.content.atms.index')}}">Cajeros Automáticos</a></li>
                    @endcan
                    @can('carousels.index')
                        <li><a class="{{request()->routeIs('admin.content.carousels*') ? 'active' :  ''}}" href="{{route('admin.content.carousels.index')}}">Carrusel de imagenes</a></li>
                    @endcan
                    @can('staff.index')
                        <li><a class="{{request()->routeIs('admin.content.staff*') ? 'active' :  ''}}" href="{{route('admin.content.staff.index')}}">Consejo de dirección</a></li>
                    @endcan
{{--                    @can('consults.index')--}}
{{--                        <li><a class="{{request()->routeIs('admin.content.consults*') ? 'active' :  ''}}" href="{{route('admin.content.consults.index')}}">Consultas</a></li>--}}
{{--                    @endcan--}}
                    @can('contacts.index')
                        <li><a class="{{request()->routeIs('admin.content.contacts*') ? 'active' :  ''}}" href="{{route('admin.content.contacts.index')}}">Contactos de Oficina Central</a></li>
                    @endcan
                    @can('sucursal.index')
                        <li><a class="{{request()->routeIs('admin.content.sucursal*') ? 'active' :  ''}}" href="{{route('admin.content.sucursal.index')}}">Contactos de sucursales</a></li>
                    @endcan
                    @can('downloads.index')
                        <li><a class="{{request()->routeIs('admin.content.downloads*') ? 'active' :  ''}}" href="{{route('admin.content.downloads.index')}}">Descargas</a></li>
                    @endcan
{{--                    @can('surveys.index')--}}
{{--                        <li><a class="{{request()->routeIs('admin.content.surveys*') ? 'active' :  ''}}" href="{{route('admin.content.surveys.index')}}">Encuestas</a></li>--}}
{{--                    @endcan--}}
                    @can('links.index')
                    <li><a class="{{request()->routeIs('admin.content.links*') ? 'active' :  ''}}" href="{{route('admin.content.links.index')}}">Enlaces de interés</a></li>
                    @endcan
                    @can('finances-info.index')
                        <li><a class="{{request()->routeIs('admin.content.finances-info*') ? 'active' :  ''}}" href="{{route('admin.content.finances-info.index')}}">Información financiera</a></li>
                    @endcan
                    @can('news.index')
                        <li><a class="{{request()->routeIs('admin.content.news*') ? 'active' :  ''}}" href="{{route('admin.content.news.index')}}">Noticias</a></li>
                    @endcan
                    @can('offices.index')
                    <li><a class="{{request()->routeIs('admin.content.offices*') ? 'active' :  ''}}" href="{{route('admin.content.offices.index')}}">Oficinas</a></li>
                    @endcan
                    @can('statics.index')
                        <li><a class="{{request()->routeIs('admin.content.statics*') ? 'active' :  ''}}" href="{{route('admin.content.statics.index')}}">Otras informaciones</a></li>
                    @endcan
                    @can('pages.index')
                        <li><a class="{{request()->routeIs('admin.content.pages*') ? 'active' :  ''}}" href="{{route('admin.content.pages.index')}}">Páginas internas</a></li>
                    @endcan
                    @can('questions.index')
                    <li><a class="{{request()->routeIs('admin.content.questions*') ? 'active' :  ''}}" href="{{route('admin.content.questions.index')}}">Preguntas frecuentes</a></li>
                    @endcan
                    @can('squestions.index')
                        <li><a class="{{request()->routeIs('admin.content.squestions*') ? 'active' :  ''}}" href="{{route('admin.content.squestions.index')}}">Preguntas de encuesta</a></li>
                    @endcan
                    @can('socials.index')
                    <li><a class="{{request()->routeIs('admin.content.socials*') ? 'active' :  ''}}" href="{{route('admin.content.socials.index')}}">Redes sociales</a></li>
                    @endcan
                    @can('about-us.index')
                        <li><a class="{{request()->routeIs('admin.content.about-us*') ? 'active' :  ''}}" href="{{route('admin.content.about-us.index')}}">Sobre nosotros</a></li>
                    @endcan
                    @can('terms.index')
                        <li><a class="{{request()->routeIs('admin.content.terms*') ? 'active' :  ''}}" href="{{route('admin.content.terms.index')}}">Tarifas de Términos</a></li>
                    @endcan
                    @can('interes.index')
                        <li><a class="{{request()->routeIs('admin.content.interes*') ? 'active' :  ''}}" href="{{route('admin.content.interes.index')}}">Tasa de interés</a></li>
                    @endcan
                    @can('taxes.index')
                        <li><a class="{{request()->routeIs('admin.content.taxes*') ? 'active' :  ''}}" href="{{route('admin.content.taxes.index')}}">Tasas de cambio</a></li>
                    @endcan
                    @can('tcp-cna.index')
                        <li><a class="{{request()->routeIs('admin.content.tcp-cna*') ? 'active' :  ''}}" href="{{route('admin.content.tcp-cna.index')}}">TCP CNA</a></li>
                    @endcan
                </ul>
            </li>
            <li class="treeview">
                <a href="#" class="{{request()->routeIs('admin.nomenclator*') ? 'active' :  ''}}"><i class="fa fa-link"></i> <span>Nomencladores</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu scrollbar" id="style1">
                    @can('ranks.index')
                    <li><a class="{{request()->routeIs('admin.nomenclator.ranks*') ? 'active' :  ''}}" href="{{route('admin.nomenclator.ranks.index')}}">Cargos de directivos</a></li>
                    @endcan
                    @can('municipalities.index')
                        <li><a class="{{request()->routeIs('admin.nomenclator.municipalities*') ? 'active' :  ''}}" href="{{route('admin.nomenclator.municipalities.index')}}">Municipios</a></li>
                    @endcan
                    @can('provinces.index')
                    <li><a class="{{request()->routeIs('admin.nomenclator.provinces*') ? 'active' :  ''}}" href="{{route('admin.nomenclator.provinces.index')}}">Provincias</a></li>
                    @endcan
                    @can('type-offices.index')
                    <li><a class="{{request()->routeIs('admin.nomenclator.type-offices*') ? 'active' :  ''}}" href="{{route('admin.nomenclator.type-offices.index')}}">Tipos de oficinas</a></li>
                    @endcan
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
<style>
    .scrollbar{
        max-height: 400px;
        overflow-y: auto!important;

    }

</style>