<!DOCTYPE html>
<html lang="en">

<head>
    <title>Naviera PeP</title>
    <link rel="stylesheet" href="{{ asset('css/template.css') }}" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="stylesheet"href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:wght@300;500&display=swap"/>



    <style type="text/css">
        
        .tab {
            position: relative;
            max-width: 600px;
        }

        .tab input { display: none; }


        .tab label {
            
            display: block;
            margin-top: 10px;
         
            cursor: pointer;
        }


        .tab .tab-content {
              
            overflow: hidden;
            transition: max-height 0.3s;
            max-height: 0;
            margin-left: 40px;
        
        }


        .tab .tab-content p { padding: 10px; }

        .tab input:checked ~ .tab-content { max-height: 100vh; }
       

        .tab input:checked ~ label::after { 

            content: "\25b6";
            position: absolute;
            right: 10px;
            top: 0px;
            display: block;
            transition: all 0.4s;
            transform: rotate(90deg); 
        }

        .icon_color {

            color:#4FD1C5;

        }




    </style>


   

    <script src="{{ asset('js/jquery.js') }}"></script>



</head>

<body>



    
    <div class="head-logo">
        <img  src="https://i.ibb.co/6mG6PxF/logo.png" width="220px"/>
    </div>
    





    <nav class="main-menu" >


        <ul> 

            <li class="main-menu__menu">    

                <a href="/bienvenida" target="iframe_a">   
                
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
                
                        <div class="tab">

                            <input id="tab-5" type="checkbox">
                            
                            <label for="tab-5" class="nav-text">
                                
                                <i class="bi bi-clipboard-data" style="color:#4FD1C5;"></i> Informes

                            </label>

                            <div class="tab-content">

                                <br>

                                <a href="informe/nave" target="iframe_a">
                                   
                                    <span class="nav-text">
                                   
                                        Informes Nave
                                   
                                    </span>
                                
                                </a>
                            

                                <br><br>

                            
                                <a href="informe/ruta" target="iframe_a">
                                    
                                    <span class="nav-text">
                                    
                                        Informes Ruta
                                    
                                    </span>
                                
                                </a>
                            

                            </div>
                    
                        </div>
                    
                    </li>


                    <li>
                
                        <div class="tab">

                            <input id="tab-4" type="checkbox">
                            
                            <label for="tab-4" class="nav-text">
                                
                                <i class="bi bi-calendar-plus-fill" style="color:#4FD1C5;"></i> Ingresar

                            </label>

                            <div class="tab-content">

                                <br>

                                <a href="nave/registrar" target="iframe_a">
                                    
                                    <span class="nav-text">
                                    
                                        Ingresar Nave
                                    
                                    </span>
                                
                                </a>
                           

                                <br><br>

                           
                                <a href="ruta/registrar" target="iframe_a">
                                
                                    <span class="nav-text">
                                
                                        Ingresar Ruta
                                
                                    </span>
                                
                                </a>
                            

                                <br><br>
                           

                                <a href="usuario/registrar" target="iframe_a">
                                    
                                    <span class="nav-text">
                                    
                                        Ingresar Usuario
                                    
                                    </span>
                                
                                </a>
                            
                                
                                <br><br>


                           
                                <a href="sucursal/registrar" target="iframe_a">
                                   
                                    <span class="nav-text">
                                   
                                        Ingresar Surcursal
                                   
                                    </span>
                                
                                </a>
                             

                            </div>
                    
                        </div>
                    
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
                
                        <div class="tab">

                            <input id="tab-3" type="checkbox">
                            
                            <label for="tab-3" class="nav-text">
                                <i class="bi bi-calendar-plus-fill" style="color:#4FD1C5;"></i> Generar Manifiestos

                            </label>

                            <div class="tab-content">
                                
                                <br>

                                <a href="manifiesto/pasajero_v" target="iframe_a">

                                    <span class="nav-text">
                                    
                                        Pasajeros
                                    
                                    </span>
                                
                                </a>




                          

                                <br>
                                <br>

                                

                                <a href="manifiesto/carga_v" target="iframe_a">
                                
                                    <span class="nav-text">
                                
                                        Cargas
                                
                                    </span>
                                
                                </a>

                                
                             

                            </div>
                    
                        </div>
                    
                    </li>
       

                @endif


            @endisset


            <!------Gerente y Cajero-------->

            <li>
                
                <div class="tab">

                    <input id="tab-2" type="checkbox">
                    
                    <label for="tab-2" class="nav-text">
                        
                        <i class="bi bi-calendar-plus-fill" style="color:#4FD1C5;"></i> Reserva

                    </label>

                    <div class="tab-content">
                        
                        <br>

                         <a href="reserva/pasajero" target="iframe_a">
                            
                            <span class="nav-text">
                            
                                Pasajes
                            
                            </span>
                        
                        </a>

                        <br>
                        <br>


                        <a href="reserva/carga" target="iframe_a">
                           
                            <span class="nav-text">
                           
                                Carga
                           
                            </span>

                        </a>
                    
                    </div>
            
                </div>
            
            </li>

            <li>
                
                <div class="tab">

                    <input id="tab-1" type="checkbox">
                    
                    <label for="tab-1" class="nav-text">
                        <i class="bi bi-calendar-plus-fill" style="color:#4FD1C5;"></i> Venta

                    </label>

                    <div class="tab-content">
                        
                        <br>

                          <a href="venta/pasajero" target="iframe_a">

                            <span class="nav-text">

                                Pasajes
                            
                            </span>

                         </a>

                        <br>
                        <br>
                        
                        <a href="venta/carga" target="iframe_a">
                            
                            <span class="nav-text">
                            
                                Carga
                            
                            </span>
                        
                        </a>

                    </div>
            
                </div>
            
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
    
        <section class="anality-cards" >
    
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

            <iframe src="" width="1500" height="800" style="border: none; overflow: hidden;" name="iframe_a" title="Iframe Example" id="iframe_a" >
                
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
