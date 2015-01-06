/*
 * This file is part of the CursoSf2 package.
 *
 * (c) Juan David Rodríguez García <juandavid.rodriguez@ite.educacion.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Enriquecimiento de la interfaz de usuario mediante las librerías
 * 
 * - jquery
 * - jquery-ui
 * - jquery-ui-layout
 */

$(document).ready( function() {

    /**
     * Definición del layout. Estará compuesto por:
     *  - cabecera (north)
     *  - tres columnas
     *  - pie
     */
    myLayout = $('body').layout({
        north:{
            size: 100,
            resizable: false,
            closable: false
        },
        west:{
            size: 200,
            togglerTip_open: "Cerrar"
        },
        east:
        {
            size: 650,
            togglerTip_open: "Cerrar"              
        },
        south:
        {
            size: 50,
            togglerTip_open: "Cerrar"
        }     
    });                   
                                              
    
                                        
                              
    var searchBox1 = $("#txt_buscar");  
    var botonSalir = $("#btn_salir");
    var searchBox1Default = "Buscar notas ...";  
                                    
    searchBox1.attr("value", searchBox1Default);
    searchBox1.focus(function(){  
        if($(this).attr("value") == searchBox1Default) $(this).attr("value", ""); 
        $(this).addClass("activo");
    });  
    searchBox1.blur(function(){  
        $(this).removeClass("activo");
                        
    });  
    
    botonSalir.hover(
        function(){ 
            $(this).addClass("salir-hover"); 
        },
        function(){ 
            $(this).removeClass("salir-hover"); 
        }
        );
      
      
    /**
     * Enriquecimiento (definición) de los botones
     */
    $( ".btn_buscar" ).button({
        icons: {
            primary:'ui-icon-search'
        }
    });
    
    $( "#btn_crear" ).button({                    
        icons: {
            primary: "ui-icon-circle-plus"
        }
    });
    $( "#btn_editar" ).button({                    
        icons: {
            primary: "ui-icon-pencil"
        }
    });
    $( "#btn_borrar" ).button({
        icons: {
            primary: "ui-icon-trash"
        }
    });
    
    $("#btn_borrar").click(function() {
            $( "#confirma-borrado" ).dialog({
                        resizable: false,
                        height:140,
                        modal: true,
                        title: 'Se borrará la nota',
                        buttons: {
                                "Borrar": function() {
                                        $( this ).dialog( "close" );
                                        $("#form_borrar").submit();
                                },
                                'Cancelar': function() {
                                        $( this ).dialog( "close" );
                                }
                        }
                });
    });
    
    
/**
     * Para colocar un selector de temas, descomentar desde **INICIO THEMESWITCHER**
     * hasta **FIN THEMESWITCHER**
     * 
     * y colocar en el código HTML un <div class="switcher"></div>
     * 
     * if a new theme is applied, it could change the height of some content,
     * so call resizeAll to 'correct' any header/footer heights affected
     * NOTE: this is only necessary because we are changing CSS *AFTER LOADING* using themeSwitcher
     */
    
// THEME SWITCHER
    
/* **INICIO THEMESWITCHER**
    $('#switcher').themeswitcher();
 
    setTimeout( myLayout.resizeAll, 1000 ); // allow time for browser to re-render with new theme 
    **FIN THEMESWITCHER** */
});


