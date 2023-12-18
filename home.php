<?php 
    include_once 'partials/header.php'; 
    include_once 'includes/utilities.php';
    date_default_timezone_set('America/Mazatlan');
?>

<transparent>
    <window id="window-logout" class="dialog" data-flip-id="animate">
        <section>
            <h2>Cerrar sesión</h2>
            <p>¿Estas seguro de que quieres cerrar sesión?</p>
            <button class="toolbar-button" onclick="toggleWindow()">Cancelar</button>
            <button class="toolbar-button ripple_effect" onclick="localStorage.setItem('currentSection', ''); window.location='includes/logout.inc.php'">Cerrar sesión</button>
        </section>
    </window>
    <window id="window-test" class="increased slim" data-flip-id="animate">
        <toolbar>
            <button onclick="toggleWindow()" class="action"><span class="material-symbols-rounded">close</span></button>
        </toolbar>
        <section>
            <h1>Ventana de prueba</h1>
        </section>
    </window>
</transparent>

<main>
    <sidebar>    
        <selector id="sel-start" onclick="toggleSection('#section-start')" class="active ripple_effect" style="margin-top:80px">
            <span class="material-symbols-rounded">home</span>Inicio
        </selector>
        <selector id="sel-example" onclick="toggleSection('#section-example')" class="ripple_effect">
            <span class="material-symbols-rounded">inbox</span>Ejemplo
        </selector>
    </sidebar>
    <bottombar>
        <selector id="btmSel-start" onclick="toggleSection('#section-start')"  class="active" ><span class="material-symbols-rounded">home</span>Inicio</selector>
        <selector id="btmSel-example" onclick="toggleSection('#section-example');"><span class="material-symbols-rounded">inbox</span>Ejemplo</selector>
        
    </bottombar>
    <holder>
        <toolbar>
            <div class="toolbar_divisor">
                <button class="toolbar-button ripple_effect" onclick="toggleSidebar()"><span class="material-symbols-rounded">side_navigation</span></button>
            </div>
            <div class="toolbar_divisor">
            <button class="toolbar-button ripple_effect" onclick="toggleTheme()"><span class="material-symbols-rounded" id="toggle-theme_icon">light_mode</span></button>
                <button class="toolbar-button ripple_effect" data-flip-id="animate" onclick="toggleWindow('#window-logout', 'absolute')"><span class="material-symbols-rounded">exit_to_app</span></button>
            </div>
        </toolbar>

        <section id="section-start" class="active">
            <h1>Inicio</h1>
            <div class="content_box small">
                <h2>Elementos</h2>
                <button class="color-normal ripple_effect">Button</button>
                <button class="color-outline ripple_effect">Button</button>
                <button class="small color-normal ripple_effect">Small button</button>
                <button class="small color-primary ripple_effect">Small button</button>
                <button class="small color-primaryNeutral ripple_effect">Small button</button>
                <button class="toolbar-button ripple_effect">Toolbar button</button>
                <button class="table-button ripple_effect"><span class="material-symbols-rounded">edit</span></button>
                <button class="table-button small ripple_effect"><span class="material-symbols-rounded">edit</span></button>
                <div class="info_element">
                    <button class="toolbar-button ripple_effect"><span class="material-symbols-rounded">Help</span></button>
                    <span class="hover_info">Action details</span>
                </div>

            </div>
            <div class="content_box small">
                <button onclick="toggleWindow('#window-test')" class="color-primaryNeutral ripple_effect" data-flip-id="animate">Abrir ventana</button>
            </div>
        
        </section>

        <section id="section-example">
            <h1>Otra sección!</h1>
            
        </section>
    </holder>
</main>


<?php include_once 'partials/footer.php'; ?>
