//MENU BURGER
const iconBurger = document.querySelector("#icon-burger")
const burger = document.querySelector(".burger")
const navBar = document.querySelector("nav")
const footer = document.querySelector(".footer")
const searchBar = document.getElementById('icon-search')
const searchDiv = document.querySelector('.search-bar')
const searchInput = document.getElementById('search-input')
let burgerChecked = 0
let searchBarOpened = 0
let pageContent = document.querySelector(".main-content")
let divAlreadyHere = 0

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


const createResultDiv = (resultArray) => {
    if(document.querySelector('.search-results') != null){
        document.querySelector('.search-results').remove()
    }
    let div = document.createElement('div')
    div.className = "search-results"
    for ( let i = 0; resultArray.length >= 5 ? i < 5 : i < resultArray.length; i++) {
        let product = resultArray[i];
        let link = document.createElement('a')
        let id = product.id
        link.href = `index.php?controller=products&id=${id}`
        link.innerHTML = product.name
        div.appendChild(link)
    }
    searchDiv.insertBefore(div, searchDiv.nextElementSibling)
}

const getParameterByName = (name) => {
    let url = new URL(document.URL);
    let parameter = url.searchParams.get(name)
    return parameter
}



searchBar.addEventListener('click', () => {
    console.log('search click')
    productsArray = []
    if (searchBarOpened == 0) {
        searchDiv.style.display = 'block'
        searchBarOpened ++
        fetch('index.php?controller=products&action=list', {
            method: 'POST'
        })
        .then(res => res.json())
        .then(json => {
            json.forEach(element => {
                productsArray.push(element)
            });
            productsArray.sort()
        })
        searchInput.addEventListener('keyup', () => {
            displayDivResult()
        })
        searchInput.addEventListener('focusout', () => {
            document.querySelector('.search-results').style.display = 'none'
        })
        searchInput.addEventListener('focusin', () => {
            if(document.querySelector('.search-results') != null){
                document.querySelector('.search-results').style.display = 'flex'
            }
            else{
                displayDivResult()
            }
        } )

    } else {
        searchDiv.style.display = 'none'
        searchBarOpened --
    }
    
})

const displayDivResult = () => {
    results = []
    productsArray.filter( el => {
        if (el.name.startsWith(searchInput.value) || el.name.toLowerCase().startsWith(searchInput.value)) {
            results.push(el)
        }
    })
    if (document.querySelector('.search-results') != null) {
        document.querySelector('.search-results').style.display = 'none'
    }
    createResultDiv(results)
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

//Product page
if (getParameterByName('controller') == 'products') {
    const quantityInput = document.getElementById('product-quantity')
    const quantityMaxVal = parseInt(quantityInput.max)
    const incrementQuantity = document.getElementById('increment-qtt')
    const decrementQuantity = document.getElementById('decrement-qtt')
    const addToCart = document.getElementById('add-cart')
    incrementQuantity.addEventListener('click', (e) => {
        e.preventDefault()
        if(quantityInput.value < quantityMaxVal ){
            quantityInput.value ++
        }
    })
    decrementQuantity.addEventListener('click', (e) => {
        e.preventDefault()
        if (quantityInput.value > 0) {
            quantityInput.value --
        }
    })
    addToCart.addEventListener('click', (e) => {
        e.preventDefault()
        console.log(quantityInput.value)
        fetch('index.php?controller=cart&action=add', {
            method: "post",
            body: JSON.stringify({'product_id' : getParameterByName('id'), 'quantity' : quantityInput.value})
        })
        .then(res => res.json())
        .then(json => {
            console.log(json)
        })
    })

}