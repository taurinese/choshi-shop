//MENU BURGER
const iconBurger = document.querySelector("#icon-burger")
const burger = document.querySelector(".burger")
const navBar = document.querySelector("nav")
const footer = document.querySelector(".footer")
let burgerChecked = 0
let pageContent = document.querySelector(".main-content")

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
    modal_p.style.color = 'white'
    modal.style.backgroundColor = color
    parent.insertBefore(modal, null) 
}

const getParameterByName = (name) => {
    let url = new URL(document.URL);
    let parameter = url.searchParams.get(name)
    console.log(parameter)
    return parameter
}



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
if(getParameterByName('controller') == 'users' && getParameterByName('action') == 'form'){
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
                    createModal(json.message,"#00B894", userForm)
                    document.querySelector('.close-button').onclick = () => {
                        window.location.href = 'index.php';
                    }
                }
                else{
                    // Affichage d'un modal pour dire que l'utilisateur s'est trompé
                    createModal(json.message,"#FF7675", userForm)
                    document.querySelector('.close-button').onclick = () => {
                        document.querySelector('.alert-modal').remove()
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
                    createModal(json.message,"#00B894", editUserForm)
                    document.querySelector('.close-button').onclick = () => {
                        document.querySelector('.alert-modal').remove()
                    }
                }
                else{
                    // Affichage d'un modal pour dire que l'utilisateur s'est trompé
                    createModal(json.message,"#FF7675", userForm)
                    document.querySelector('.close-button').onclick = () => {
                        document.querySelector('.alert-modal').remove()
                    }
                }
            })  
        }


    })
}  


// User profile, informations/commandes
if (getParameterByName('controller') == "users" && getParameterByName('action') == 'display') {
    console.log('Bonne page')
    const userSelectBtn = document.querySelector('.select-btn')
    const editUserForm = document.getElementById('edit-user-form')
    let isChecked = 0
    userSelectBtn.addEventListener('click', () => {
        if (isChecked == 0) {
            userSelectBtn.classList = "select-btn checked"
            isChecked ++
        } else {
            userSelectBtn.classList = "select-btn unchecked"
            isChecked --
        }
    })
    editUserForm.addEventListener('submit', async (e) =>{
        e.preventDefault()
        let editUserFormData = new FormData(editUserForm)
        await fetch(editUserForm.action,{
            method: "post",
            body: editUserFormData
        })
        .then(res => res.json())          
        .then(json => {
            if (json.is_updated == true) {
                createModal(json.message,"#00B894", editUserForm)
                document.querySelector('.close-button').onclick = () => {
                    document.querySelector('.alert-modal').remove()
                }
            }
            else{
                // Affichage d'un modal pour dire que l'utilisateur s'est trompé
                    createModal(json.message,"#FF7675", editUserForm)
                    document.querySelector('.close-button').onclick = () => {
                        document.querySelector('.alert-modal').remove()
                    }
            }
        }) 
    }) 
}

