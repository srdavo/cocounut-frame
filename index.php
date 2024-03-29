<?php 
include_once 'partials/header.php'; 
if (isset($_COOKIE['uid'])) {
    header("location: includes/login.inc.php");
}
?>

<transparent>
  <!-- <window id="login" class="dialog" data-flip-id="animate">
    <toolbar>
      <div class="content_box invisible">
        <button class="action red" onclick="toggleWindow()"><span class="material-symbols-rounded dynamic">close</span></button>
      </div> 
    </toolbar>
    <section>
      <h1>Iniciar Sesion</h1>
      <div class="simple_container">
        <div class="field_name">Correo electrónico</div>
        <input type="text" id="name" autocomplete="none">
        <div class="field_name">Contraseña</div>
        <input type="password" id="pwd">
        <button class="color-primary ripple_effect" style="margin-top:6px; margin-left:auto" onclick="logIn()">Entrar</button>
      </div>
    </section>
  </window> -->

  <!-- <window id="signup" class="dialog" data-flip-id="animate">
    <toolbar>
      <div class="content_box invisible">
        <button class="action red" onclick="toggleWindow()"><span class="material-symbols-rounded dynamic">close</span></button>
      </div> 
    </toolbar>
    <section>
      <h1>Crear cuenta</h1>
      <div class="simple_container" >
        <div class="field_name">Correo electrónico</div>
        <input type="text" id="email" autocomplete="none">
        <div class="field_name">Contraseña</div>
        <input type="password" id="pwdsignup">
        <div class="field_name">Repite la contraseña</div>
        <input type="password" id="pwdrepeat">
        <button class="color-primary ripple_effect" style="margin-top:6px; margin-left:auto" onclick="signUp()">Crear</button>
      </div>
    </section>
  </window> -->

  <window id="signup" class="slim" data-flip-id="animate">
    <toolbar>
      <div class="content_box invisible">
        <button class="action red" onclick="toggleWindow()"><span class="material-symbols-rounded dynamic">close</span></button>
      </div> 
    </toolbar>
    <section>

      <div class="simple_container" style="margin-bottom:8px;">
        <img src="resources/texticon.png" class="texticon-index">
        <h1 class="ultra-large">Crear cuenta</h1>
      </div>

      <div class="simple_container">
        <span class="modern-input">
          <label for="email">Correo electrónico</label>
          <input type="text" id="email" autocomplete="none">
        </span>
        <span class="modern-input">
          <label for="pwdsignup">Contraseña</label>
          <input type="password" id="pwdsignup" autocomplete="none">
        </span>
        <span class="modern-input">
          <label for="pwdrepeat">Repite la contraseña</label>
          <input type="password" id="pwdrepeat" autocomplete="none">
        </span>
      </div>
      <button class="color-primary ripple_effect" onclick="signUp()">Crear cuenta</button>

    </section>
  </window>

  <window id="login" class="slim" data-flip-id="animate">
    <toolbar>
      <div class="content_box invisible">
        <button class="action red" onclick="toggleWindow()"><span class="material-symbols-rounded dynamic">close</span></button>
      </div> 
    </toolbar>
    <section>
      <div class="simple_container" style="margin-bottom:8px;">
        <img src="resources/texticon.png" class="texticon-index">
        <h1 class="ultra-large">Iniciar sesión</h1>
      </div>
      
      <div class="simple_container">
        <span class="modern-input">
          <label for="name">Correo o nombre de usuario</label>
          <input type="text" id="name" autocomplete="none">
        </span>
        <span class="modern-input">
          <label for="pwd">Contraseña</label>
          <input type="password" id="pwd">
        </span>
      </div>
      <button class="color-primary ripple_effect" onclick="logIn()">Iniciar sesión</button>

    </section>
  </window>
    
</transparent>

<main>
  <holder>
    <toolbar>
      <button data-flip-id="animate" onclick="toggleWindow('#signup')" class="toolbar-button ripple_effect">Crear cuenta</button>
    </toolbar>

    <section class="active indexSection" id="section-start">
      <div class="content_box small" >
          <img src="resources/start_img.png" style="width:100%; height:100%; object-fit:cover; border-radius:16px">
      </div>
      <div class="content_box small" style="padding:48px;min-width:60%; justify-content: center">
          <h1 style="font-size:6vh; line-height:6vh;">Cocounut <br>Frame</h1>
          <h2 style="margin-bottom:24px;">Una estrucutra de proyectos</h2>
          <button class="color-primary" onclick="toggleWindow('#login')" data-flip-id="animate">Comenzar</button>
      </div>
    </section>

  </holder>
</main>


<?php include_once 'partials/footer.php'; ?>
