//MENU BURGER
const iconBurger = document.querySelector("#icon-burger")
const burger = document.querySelector(".burger")
const navBar = document.querySelector("nav")
const footer = document.querySelector(".footer")
let burgerChecked = 0
let pageContent = document.querySelector(".main-content")
console.log(pageContent)

iconBurger.addEventListener( "click", function(e) {
    e.preventDefault()
    if (burgerChecked == 0) {   
        pageContent.style.display = "none"
        iconBurger.innerHTML = "close"
        navBar.style.boxShadow = "none"
        footer.style.display = "none"
        burger.classList = "burger burger-animated-in"

        burgerChecked++
    } else {                
        iconBurger.innerHTML = "menu"
        pageContent.style.display = "block"
        footer.style.display = "block"
        navBar.style.boxShadow = "0px 1px 10px grey"
        burger.classList = "burger burger-animated-out"
        burgerChecked--
    }

})

//CONNEXION
/* const buttonConnect = document.querySelector('#btn-connect') */
const userForm = document.querySelector('#user-form')
userForm.addEventListener('submit', async function(e) {
    e.preventDefault()
    let userFormData = new FormData(this)
    await fetch('index.php?controller=users&action=login',{
        method: "post",
        body: userFormData
    })
    .then(res => res.json())          
    .then(json => {
        if (json.is_logged_in == true) {
            window.location.href = 'index.php';
        }
        else{
            // Affichage d'un modal pour dire que l'utilisateur s'est trompé
        }
    })  

})