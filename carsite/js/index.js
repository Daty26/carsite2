const brandSelect = document.getElementById('brand-select')
let logIn = document.querySelector(".log-in");
const showHidePass = document.querySelectorAll('.bx-hide');
let carForms = document.querySelectorAll(".car-forms");
let navbar = document.querySelector('.navbar');
let currentHeight = navbar.clientHeight; 
navbar.style.height = (currentHeight + 1) + 'px';
if(logIn){
    logIn.addEventListener("click", function(){
        $('#auth').fadeIn('slow');
    })
}

// loginbutt.addEventListener("click", function(){
//     $(".user-items").slideToggle(800);
// })
$(document).ready(function() {
    $(".yearpicker").yearpicker({
       startYear: 1980,
       endYear: 2025
    });
 });
showHidePass.forEach(showPass =>{
    showPass.addEventListener("click", ()=>{
        let passField = showPass.parentElement.querySelectorAll(".password");
        passField.forEach(pass => {
            if(pass.type == "password"){
                pass.type = "text";
                showPass.style.color = "#0D6EFD";
            }else{
                pass.type = "password";
                showPass.style.color = "#31291D";
            }
        })
    })
})

loginbutt.addEventListener("click", function(){
    $(".user-items").slideToggle(800);
})
function validateForm() {
    var brand = document.querySelector('#brandFilter').value;
    var model = document.querySelector('#modelFilter').value;

    if (!brand || !model) {
      alert("Выберите бренд и модель машины.");
      return false; 
    }

    return true; 
  }
  function validateForm1() {
    var brand = document.querySelector('#brandFilter1').value;
    var model = document.querySelector('#modelFilter1').value;

    if (!brand || !model) {
      alert("Выберите бренд и модель машины.");
      return false; 
    }

    return true; 
  }
    
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    carForms.forEach((form) => {
        var brandSelect = form.querySelector('.brand-select');
        var modelSelect = form.querySelector('.model-select');
        brandSelect.addEventListener('change', function() {
            var brand = this.value;

            modelSelect.innerHTML = '<option value="">Выберите модель</option>';

            if (brand == 'Toyota') {
                addModels(modelSelect, ['Corolla', 'Camry', 'Rav4'])
            } else if (brand == 'Honda') {
                addModels(modelSelect, ['Civic', 'Accord', 'CR-V'])
            } else if (brand == 'BMW') {
                addModels(modelSelect, ['3 Series', '5 Series', 'X5'])
            } else if (brand == 'Mercedes') {
                addModels(modelSelect, ['C-Class', 'E-Class', 'GLC'])
            } else if (brand == 'Lexus') {
                addModels(modelSelect, ['NX', 'GX', 'RX', 'LX', 'EX'])
            }
        })
    })
});
function addModels(selectElement, models) {
    models.forEach(model => {
        var option = document.createElement('option');
        option.text = model;
        option.value = model;
        selectElement.add(option);
    })
}
function fadeInReg(){
    $(".forms").fadeIn("slow");
}
function fadeOutReg(){
    $("#reg").fadeOut("slow");
}
function fadeInAuth(){
    $("#auth").fadeIn("slow");
}
function fadeInCar(){
    $("#addCar").fadeIn("slow");
}
function closeRegOpenAuth(){
    $("#reg").fadeOut("2000");
    $("#auth").fadeIn("3000");
}
function closeAuthOpenReg(){
    $("#auth").fadeOut("2000");
    $("#reg").fadeIn("3000")
}