//MENU BURGER
const iconBurger = document.querySelector("#icon-burger")
const burger = document.querySelector(".burger")
const navBar = document.querySelector("nav")
const footer = document.querySelector(".footer")
let burgerChecked = 0
let pageContent = document.querySelector(".main-content")


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
let modalAlreadyExists = 0
const userForm = document.querySelector('#user-form')
userForm.addEventListener('submit', async function(e) {
    e.preventDefault()
    let userFormData = new FormData(this)
    let currentForm = getParameterByName('form')
    if (currentForm == 'login') {
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
                if (modalAlreadyExists == 0) {
                    createModal("Identifiants incorrects!","red", userForm)
                    document.querySelector('.close-button').onclick = () => {
                        document.querySelector('.alert-modal').style.display = "none"
                        modalAlreadyExists = 0
                    }
                    modalAlreadyExists = 1
                } else if(modalAlreadyExists != 0) {
                    document.querySelector('.alert-modal').style.display = "block"
                }
            }
        })  
    } else if(currentForm == 'register'){
        await fetch('index.php?controller=users&action=register',{
            method: "post",
            body: userFormData
        })
        .then(res => res.json())          
        .then(json => {
            if (json.is_created == true) {
                window.location.href = 'index.php';
            }
            else{
                // Affichage d'un modal pour dire que l'utilisateur s'est trompé
                if (modalAlreadyExists == 0) {
                    createModal("Impossible de s'inscrire!","red", userForm)
                    document.querySelector('.close-button').onclick = () => {
                        document.querySelector('.alert-modal').style.display = "none"
                        modalAlreadyExists = 0
                    }
                    modalAlreadyExists = 1
                } else if(modalAlreadyExists != 0) {
                    document.querySelector('.alert-modal').style.display = "block"
                }
            }
        })  
    }


})


//FONCTIONS 
const createModal = (text, color, parent) => {
    let modal = document.createElement("div")
    modal.className = "alert-modal"
    let closeButton = document.createElement("button")
    closeButton.type = "button"
    closeButton.className = "close-button"
    closeButton.innerHTML = `<i class="far fa-times-circle"></i>`
    modal.appendChild(closeButton)
    let modal_p = document.createElement("p")
    modal.appendChild(modal_p)
    modal_p.innerHTML = text
    modal.style.backgroundColor = color
    parent.insertBefore(modal, null) 
}

const getParameterByName = (name) => {
let url = new URL(document.URL);
let parameter = url.searchParams.get(name)
console.log(parameter)
return parameter
}