<!DOCTYPE html>
<html lang="en">

<head>
    <title>Naviera PeP</title>
    <link rel="stylesheet" href="{{ asset('css/template.css') }}" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="stylesheet"href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:wght@300;500&display=swap"/>

    <script src="{{ asset('js/jquery.js') }}"></script>
</head>

<body>
    <head>
        <div class="head-logo">
            <img  src="https://i.ibb.co/6mG6PxF/logo.png" width="220px"/>
        </div>
    </head>
    <nav class="main-menu">
        <ul> 



            <li class="main-menu__menu">    
                <a href="http://127.0.0.1:8000/bienvenida" target="iframe_a">   
                    <i class="bi bi-house-door-fill"></i>
                <span class="nav-text">

                    <b>Hola!

                    @isset($_SESSION['user'])

                       

                        {{json_decode($_SESSION['user'])->nombre}}

                    @endisset

                   </b>
                </span>  
                </a>     
            </li>  
            


            @isset($_SESSION['user'])

                @if(json_decode($_SESSION['user'])->tipo)

                    <!---Solo gerente--->

                     <li>
                        <a href="informe/nave" target="iframe_a">
                            <i class="bi bi-clipboard-data"></i>
                            <span class="nav-text">
                                Informes Nave
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="informe/ruta" target="iframe_a">
                            <i class="bi bi-clipboard-data"></i>
                            <span class="nav-text">
                                Informes Ruta
                            </span>
                        </a>
                    </li>


                    <li class="has-subnav">
                        <a href="nave/registrar" target="iframe_a">
                            <i class="bi bi-plus-square-fill"></i>
                            <span class="nav-text">
                                Ingresar Nave
                            </span>
                        </a>
                    </li>


                    <li class="has-subnav">
                        <a href="ruta/registrar" target="iframe_a">
                            <i class="bi bi-map-fill"></i>
                            <span class="nav-text">
                                Ingresar Ruta
                            </span>
                        </a>
                    </li>


                    <li class="has-subnav">
                        <a href="usuario/registrar" target="iframe_a">
                            <i class="bi bi-person-plus-fill"></i>
                            <span class="nav-text">
                                Ingresar Usuario
                            </span>
                        </a>
                    </li>
                    


                    <li class="has-subnav">
                        <a href="sucursal/registrar" target="iframe_a">
                            <i class="bi bi-building"></i>
                            <span class="nav-text">
                                Ingresar Surcursal
                            </span>
                        </a>
                    </li>




                    <li class="has-subnav">
                        <a href="itinerario/registrar" target="iframe_a">
                            <i class="bi bi-calendar-week"></i>
                            <span class="nav-text">
                                Itinerario
                            </span>
                        </a>
                    </li>   



                    <li>
                        <a href="contabilidad" target="iframe_a">
                            <i class="bi bi-cash-stack"></i>
                            <span class="nav-text">
                                Ventas & Contabilidad
                            </span>
                        </a>
                    </li>
   



                    <li>
                        <a href="manifiesto/carga_v" target="iframe_a">
                            <i class="bi bi-calendar-plus-fill"></i>
                            <span class="nav-text">
                                Generar Manifiesto de Cargas
                            </span>
                        </a>
                    </li>



                    <li>
                        <a href="manifiesto/pasajero_v" target="iframe_a">
                            <i class="bi bi-calendar-plus-fill"></i>
                            <span class="nav-text">
                                Generar Manifiesto de Pasajeros
                            </span>
                        </a>
                    </li>


                    

                @endif


            @endisset


            


            <!------Gerente y Cajero-------->

            <li>
                <a href="reserva/pasajero" target="iframe_a">
                    <i class="bi bi-calendar-plus-fill"></i>
                    <span class="nav-text">
                        Reservar Pasajes
                    </span>
                </a>
            </li>



            <li>
                <a href="reserva/carga" target="iframe_a">
                    <i class="bi bi-calendar-plus-fill"></i>
                    <span class="nav-text">
                        Reservar Espacios de Carga
                    </span>
                </a>
            </li>



            <li>
                <a href="venta/pasajero" target="iframe_a">
                    <i class="bi bi-calendar-plus-fill"></i>
                    <span class="nav-text">
                        Venta de Pasajes
                    </span>
                </a>
            </li>


            <li>
                <a href="venta/carga" target="iframe_a">
                    <i class="bi bi-calendar-plus-fill"></i>
                    <span class="nav-text">
                        Venta de Espacios de Carga
                    </span>
                </a>
            </li>




            <li>
                <a href="contabilidad/cierre_caja_v" target="iframe_a">
                    <i class="bi bi-calendar-plus-fill"></i>
                    <span class="nav-text">
                        Cierre de caja
                    </span>
                </a>
            </li>



         

             <li>
                <a href="login/logout">
                    <i class="bi bi-box-arrow-right"></i>
                    <span class="nav-text">
                        Cerrar Sesion
                    </span>
                </a>
            </li>


        </ul>
    </nav>

    <main>
    
        <section class="anality-cards">
    
            <article class="cards">
                <h5>Total Vendido</h5>
                <h5 class="totalmoney">$------<h2/>
                    <i class="bi bi-wallet-fill"></i> 
            </article>

            <article class="cards-b1">
                <h5>Total Vendido</h5>
                <h5 class="totalmoney">$------<h2/>
                    <i class="bi bi-wallet-fill"></i>  
            </article>
            

            <article class="cards-b2">
                <h5>Total Vendido</h5>
                <h5 class="totalmoney">$------<h2/>
                    <i class="bi bi-wallet-fill"></i>  
            </article>


        </section>


        <section id='main_container' class="main-main">

            <iframe src="" width="1500" height="800" style="border: none; overflow: hidden;" name="iframe_a" title="Iframe Example" id="iframe_a">
                
            </iframe>
        
        </section>
    
    </main>



    <script>
        

        desplegarTotal();
        desplegarBienvenida();

        function desplegarBienvenida(){

           $("#iframe_a").attr("src", "{{url('/bienvenida')}}");

        }


        function desplegarTotal(){



            $.ajax({

                type: 'GET',

                url: "{{url('informe/total')}}",
                    
                success: function(data) {

                    $('.totalmoney').html("$"+data);
                       

                },

                timeout:5000

            });
            
            
            
        }

    </script>

</body>

</html>
