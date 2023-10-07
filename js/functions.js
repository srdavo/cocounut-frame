// Main structure functions
function toggleSection(sectionId){
  if (!sectionId) {return};

  const bottombar = document.querySelector("BOTTOMBAR");

  const activeSection = document.querySelector("section.active");
  const activeSelector = document.querySelector("selector.active");
  const activeSelectorBottom = bottombar.querySelector("selector.active");
  if(("#"+activeSection.id) === sectionId){return;}
  if (activeSelector) { activeSelector.classList.remove("active"); }
  if (activeSelectorBottom) { activeSelectorBottom.classList.remove("active"); }
  activeSection.classList.remove("active");

  // section is the section to open 
  if (sectionId == "history_back") {
    sectionId = localStorage.getItem("lastSection");
  }
  const section = document.querySelector(sectionId);
  const sidebarSelector = document.querySelector("#sel-" + sectionId.split("-")[1]);
  const bottomSelector = document.querySelector("#btmSel-" + sectionId.split("-")[1]);
  section.classList.toggle("active");
  if(sidebarSelector){sidebarSelector.classList.toggle("active");}
  if(bottomSelector){bottomSelector.classList.toggle("active");}
  localStorage.setItem("lastSection", "#"+activeSection.id); 

  
  // specific functions per section
  switch (sectionId) {
    case "#section-start": break;

    default: break;
  }

  localStorage.setItem("currentSection", sectionId); 

  // With this we can reset responses
  lastSection = getStorage("lastSection");
  switch (lastSection) {
    case "#section-calendarDayAppts":
      resetDisplayDayEvents();
      break;
  }
    
}
function toggleWindow(windowId, position){
  if (windowId == ''){windowId = null}

  // Close any other open window
  const transparent = document.querySelector('transparent');
  const activeWindow = transparent.querySelector('window.active');

  function closingAnimation() {
    if (transparent.hasAttribute("closing")) {
      transparent.classList.remove('active');
      transparent.removeAttribute("closing");
      
      activeWindow.classList.remove('active');
    }
  }

  if (activeWindow) {
    if (transparent.hasAttribute("closing")) { return; }
    toggleOvermessage();

    // This attribute added and all makes the close animation smooth
    transparent.setAttribute("closing", "");
    transparent.addEventListener("animationend", () =>{closingAnimation()}, {once: true})
    
    resetForm();
    return;
  }
  if (transparent.hasAttribute("closing") && transparent.classList.contains("active")) {
    transparent.removeAttribute("closing");
  }

  // remove useless classes
  transparent.classList.remove('dynamic', 'right', 'left', 'top', 'bottom');


  // Window to open
  const windowNew = document.querySelector(windowId);
  if (!windowNew) { return; }
  transparent.classList.add('active'); 
  localStorage.setItem("currentWindow", windowId); 

  

  // Set origin element of animation
  if (event && event.currentTarget) {
    element = event.currentTarget;
  }else{element = null}

  // specific functions per window
  switch (windowId) {
    case "#window-apptEdit": 
      getApptData(getStorage('currentAppt')); 
      getData("appt_status", "#edit-appt_status", getStorage('currentAppt'));
    break;
    case "#window-settings": 
      getUserData(); 
    break;

    default: break;
  }

  // Set element with Dynamic position
  if(position == "absolute"){
    windowNew.classList.add("absolute");
    var rect = element.getBoundingClientRect();
    screenWidth = window.innerWidth;
    screenHeight = window.innerHeight;
    // Tests
    
    

    if (rect.left < (screenWidth/2)) {
      windowNew.style.right = "unset";
      windowNew.style.left = Math.round(rect.left)+"px";
      transparent.classList.add("left");
    } else{
      windowNew.style.left = "unset";
      windowNew.style.right = screenWidth-Math.round(rect.right)+"px";
      transparent.classList.add("right");
    }

    if (rect.top < (screenHeight/2)) {
      windowNew.style.bottom = "unset";
      windowNew.style.top = (Math.round(rect.top) + Math.round(rect.height) + 8)+"px";
      transparent.classList.add("top");

    }else{
      windowNew.style.top = "unset";
      windowNew.style.bottom = (screenHeight-Math.round(rect.bottom) + Math.round(rect.height) + 8)+"px";
      transparent.classList.add("bottom");
    }
    
    
    requestAnimationFrame(function() {
      var windowHeight = windowNew.offsetHeight;
      var windowBottom = screenHeight - (windowNew.offsetTop + windowNew.offsetHeight);
      
      var windowWidth = windowNew.offsetWidth;

    });

    

    
  }
  animate(element, windowNew);
}
function toggleOvermessage(overId){
  if (overId == ''){overId = null}

  const currentWindow = document.querySelector(getStorage("currentWindow")); 

  // Close
  const activeOvermessage = currentWindow.querySelector(".overmessage.active");
  function closingAnimation() {
    if (activeOvermessage.hasAttribute("closing")) {
      activeOvermessage.classList.remove('active');
      activeOvermessage.removeAttribute("closing");
    }
  }
  if (activeOvermessage) {
    activeOvermessage.setAttribute("closing", "");
    activeOvermessage.addEventListener("animationend", () =>{closingAnimation()}, {once: true})
    return;
  }
  if (activeOvermessage) {
    if (activeOvermessage.hasAttribute("closing") && activeOvermessage.classList.contains("active")) {
      activeOvermessage.removeAttribute("closing");
    }
  }
  

  // Open
  const overmessage = currentWindow.querySelector(overId);
  if(!overmessage){ return; }
  overmessage.classList.add("active");

}
function animate(element, window){
    let state = Flip.getState(element);
    window.classList.toggle('active');
    Flip.from(state, {
      targets: window,
      duration: 0.7,
      // scale: true,
      ease: CustomEase.create("custom", "M0,0 C0.308,0.19 0.107,0.633 0.288,0.866 0.382,0.987 0.656,1 1,1 "),
      // ease: CustomEase.create("easeName", ".47,.29,0,1"),
      // ease: CustomEase.create("easeName", ".58,.18,0,1"),
      // ease: CustomEase.create("easeName", ".21,.19,0,1"),
      // ease: CustomEase.create("emphasized", "0.2, 0, 0, 1"),
      // ease: CustomEase.create("classic", "0.1, 0.8, 0, 1"),
      // ease: CustomEase.create("classic", "0.4, 0.4, 0, 1.2"),
      absolute: true,
    })
    
}

// Main complementary functions
function resetForm(){
  inputs = document.querySelectorAll('input:not(.no-reset) , textarea, select:not(.no-reset)');
  for (let i=0; i<inputs.length; i++){
    inputs[i].value = inputs[i].defaultValue;
    inputs[i].style.backgroundColor = "";
    inputs[i].classList.remove('error');
  }
  if(document.getElementById('new_selects') !== null){
    document.getElementById('new_selects').innerHTML = '';
  }
  button = document.querySelector("BUTTON")
  if(button){
    button.disabled = false;
  }
  loadAnimation('body', false);
}
function checkEmpty(parentId, element, type){
  parent = document.querySelector(parentId);
  inputs = parent.querySelectorAll(element);
  validation = 0;
  for (let i=0; i<inputs.length; i++){
      inputs[i].addEventListener("focus", function() {inputs[i].classList.remove('error')});
      if(inputs[i].value === "" || inputs[i].value === "0"){ 
        validation = 1; 
        if(type != "dialog"){inputs[i].classList.add('error')}
      }
  }
  // console.log(validation);
  if(validation != 0){
    console.log("Se han encontrado espacios vacios");
    if(type==="dialog"){toggleWindow("#empty_spaces")} 
    return false;
    }else{
      console.log("No se han encontrado espacios vacios");
      return true
    }
}
function loadAnimation(parentId, action){
  parent = document.querySelector(parentId);
  circle = parent.querySelector("circle");
  if (action) {
    if(!circle){    
    circleHolder = parent.appendChild(document.createElement("circleHolder"));
    circle = circleHolder.appendChild(document.createElement("circle"));
    }else{console.log("El elemento ya existe");}
  }else{
    $(parent).find('circle').remove();
    $(parent).find('circleholder').remove();
  }
}
function toggleButton(windowId, action){
  openWindow = document.querySelector(windowId);
  button = openWindow.querySelectorAll('BUTTON');
  lastButton = button[button.length - 1];
  if(action){
    lastButton.disabled = true;
  }else{
    lastButton.disabled = false;
  }
}
let currentTimeoutId = null;
function message(message, action){
  const messageElement = document.querySelector("MESSAGE");
  if (action === "error") {messageElement.classList.add('error'); image = ''}
  else if(action === "done"){messageElement.classList.add('done'); image = ''}
  else{image='';}
  
  messageElement.innerHTML = image + message;
  messageElement.style.display = "flex";
  messageElement.style.animation = "messageIn 0.7s cubic-bezier(.11,.86,0,.99)";
  if (currentTimeoutId) {clearTimeout(currentTimeoutId);}
  currentTimeoutId = setTimeout(() => {
      messageElement.style.animation = "messageOut 0.8s";
      setTimeout(() => {messageElement.style.display = "none"; currentTimeoutId = null;}, 700);
  }, 4000);
}

// Sub Structure Functions
function setStorage(varName, value){
  localStorage.setItem(varName, value); 
}
function getStorage(varName){
  return localStorage.getItem(varName);
}
function toggleSidebar(){
  sidebar = document.querySelector("SIDEBAR");
  sidebar.classList.toggle("minimize");
}



// User System functions
function logIn(){
  if(!checkEmpty('#login', 'input')){
    return false;
  }
  //Desabilitamos boton
  toggleButton('#login', true);
  //Mostramso animacion de carga
  loadAnimation("#login", true);
  userInput = openWindow.querySelector("#name");
  pwdInput = openWindow.querySelector("#pwd");

  var user=$("#login #name").val();
  var pwd=$("#login #pwd").val();
  $.ajax({
    url:'includes/login.inc.php',
    method:'POST',
    data:{
    user:user,
    pwd:pwd,
    },
    success:function(response){
      switch (response) {
        case "user_doesnt_exist": 
          message("El usuario no existe", "error"); 
          userInput.classList.add('error'); 
          toggleButton('#login', false);
        break;
        case "wrong_password": 
          message("Usuario o contraseña incorrectos", "error"); 
          userInput.classList.add('error');
          pwdInput.classList.add('error');
          toggleButton('#login', false);
        break;
        case "access_accepted":
          window.location.href='home.php';
        break;
      }
      toggleButton('#login', false);
      loadAnimation("#login", false);
    }
  });
}
function signUp(){
  if(!checkEmpty('#signup', 'input')){
    return false;
  }
  openWindow = document.querySelector('#signup');
  userInput = openWindow.querySelector("#email");
  pwdInput = openWindow.querySelector("#pwdsignup");
  pwdRepeatInput = openWindow.querySelector("#pwdrepeat");
  if(pwdInput.value != pwdRepeatInput.value) {
    pwdInput.classList.add('error');
    pwdRepeatInput.classList.add('error');
    message("Las contraseñas no son iguales", "error");
    return false;
  }
  //Validacion de correo:
  pwdInput.classList.remove('error');
  pwdRepeatInput.classList.remove('error');
  var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (!regex.test(userInput.value)) {
    message("El correo no es valido", "error");
    userInput.classList.add('error');
    return false;
  }
  
  //Desabilitamos boton
  pwdInput.classList.remove('error');
  pwdRepeatInput.classList.remove('error');
  button = openWindow.querySelector('BUTTON');
  button.disabled = true;
  //Mostramso animacion de carga
  loadAnimation("#signup", true);

  var email=$("#email").val();
  var pwd=$("#pwdsignup").val();
  $.ajax({
    url:'includes/signup.inc.php',
    method:'POST',
    data:{
    email:email,
    pwd:pwd,
    },
    success:function(response){
      switch (response) {
        case "user_already_exists":
          message("El usuario ya exite", "error");
          userInput.classList.add('error'); 
          button.disabled = false;
        break;
        case "access_accepted":
          window.location.href='home.php';
        break;
        default:
          button.disabled = false;
          message("Hubo un error", "error");
        break;
      }
      loadAnimation("#signup", false);

    }
  });
}

// Ripple Effect || ripple_effect
document.addEventListener('mousedown', (event) => {
  if (event.target.classList.contains('ripple_effect')) {

    var body = document.querySelector('body');
    var x, y;
    
    if (event.target.tagName === 'BUTTON') { // Si el elemento es un botón
      var rect = event.target.getBoundingClientRect();
      x = event.clientX - rect.left;
      y = event.clientY - rect.top;
    } else { // Si el elemento es un enlace
      x = event.offsetX;
      y = event.offsetY;
    }
    
    var ripples = document.createElement('ripple');
    var size = event.target.offsetWidth * 2;
    ripples.style.left = x - size/2 + 'px';
    ripples.style.top = y - size/2 + 'px';
    event.target.appendChild(ripples);
    ripples.style.width = ripples.style.height = size + 'px';

    setTimeout(() => {
      ripples.remove();
    }, 1000);
  }
});