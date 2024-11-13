const titleEl = document.querySelector('#title');
const usernameEl = document.querySelector('#contname');
const emailEl = document.querySelector('#contemail');
const email2El = document.querySelector('#contemail2');
const checkEl = document.querySelector('#check');

const form = document.querySelector('#contact');

console.log('validation')

const checkUsername = () => {

    let valid = false;

    const min = 3,
        max = 50;

    const username = usernameEl.value.trim();

    if (!isRequired(username)) {
        showError(usernameEl, 'Votre nom complet est requise');
    } else if (!isBetween(username.length, min, max)) {
        showError(usernameEl, `Votre nom doit être compris entre ${min} et ${max} caractères`)
    } else {
        showSuccess(usernameEl);
        valid = true;
    }
    return valid;
};

const checkSpam = () => {

    let valid = false;

    const checkvalue = checkEl.value.trim();

    if (!isRequired(checkvalue)) {
        showError(checkEl, `Cette réponse est requise`);
    } else if ( checkvalue != 12 ) {
        showError(checkEl, `Cette réponse n'est pas correcte`)
    } else {
        showSuccess(checkEl);
        valid = true;
    }
    return valid;
};

const checkTitle = () => {

    let valid = false;
    const min = 3, max = 100;
    const title = titleEl.value.trim();

    if (!isRequired(title)) {
        showError(titleEl, 'Le nom de la ressource est requis');
    } else if (!isBetween(title.length, min, max)) {
        showError(titleEl, `Le nom de la ressource doit être compris entre ${min} et ${max} caractères`)
    } else {
        showSuccess(titleEl);
        valid = true;
    }
    return valid;
};


const checkEmail = () => {
    let valid = false;
    const email = emailEl.value.trim();
    if (!isRequired(email)) {
        showError(emailEl, `Votre adresse mail est requise`);
    } else if (!isEmailValid(email)) {
        showError(emailEl, `Votre adresse mail n'est pas valide.`)
    } else {
        showSuccess(emailEl);
        valid = true;
    }
    return valid;
};



const checkConfirmEmail = () => {
    let valid = false;
    // check confirm password
    const confirmEmail = email2El.value.trim();
    const email = emailEl.value.trim();

    if (!isRequired(confirmEmail)) {
        showError(email2El, `Merci de renseigner à nouveau l'adresse mail`);
    } else if (email !== confirmEmail) {
        showError(email2El, 'Les adresses ne correspondent pas');
    } else {
        showSuccess(email2El);
        valid = true;
    }

    return valid;
};

const isEmailValid = (email) => {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};


const isRequired = value => value === '' ? false : true;
const isBetween = (length, min, max) => length < min || length > max ? false : true;


const showError = (input, message) => {
    // get the form-field element
    const formField = input.parentElement;
    // add the error class
    formField.classList.remove('success');
    formField.classList.add('error');

    // show the error message
    const error = formField.querySelector('small');
    error.textContent = message;
};

const showSuccess = (input) => {
    // get the form-field element
    const formField = input.parentElement;

    // remove the error class
    formField.classList.remove('error');
    formField.classList.add('success');

    // hide the error message
    const error = formField.querySelector('small');
    error.textContent = '';
}


form.addEventListener('submit', function (e) {
    // prevent the form from submitting
    e.preventDefault();

    // validate fields
    let isUsernameValid = checkUsername(),
        isTitleValid = checkTitle(),
        isEmailValid = checkEmail(),
        ischeckSpamValid = checkSpam()
        isConfirmEmailValid = checkConfirmEmail();

    let isFormValid = isUsernameValid &&
        isTitleValid &&
        isEmailValid &&
        ischeckSpamValid &&
        isConfirmEmailValid;

    // submit to the server if the form is valid
    if (isFormValid) {
        form.submit();
    }
});


const debounce = (fn, delay = 500) => {
    let timeoutId;
    return (...args) => {
        // cancel the previous timer
        if (timeoutId) {
            clearTimeout(timeoutId);
        }
        // setup a new timer
        timeoutId = setTimeout(() => {
            fn.apply(null, args)
        }, delay);
    };
};

form.addEventListener('input', debounce(function (e) {
    switch (e.target.id) {
        case 'username':
            checkUsername();
            break;

        case 'username':
            checkUsername();
            break;

        case 'email':
            checkEmail();
            break;

    }
}));