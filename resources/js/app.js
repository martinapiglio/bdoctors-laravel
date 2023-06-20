import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

//ADMIN/CREATE + EDIT VIEWS
//phone number validation

let phoneNumber = document.getElementById("phone_number");
const pattern = /^[\+*#-]? ?(\((00|\+)39\)|(00|\+)39)?[\+*#-]? ?((0\s?\d{2,3}\s?\d{2,3}\s?\d{2,3}\s?\d{0,3})|(38[890]\s?\d{2,3}\s?\d{2,3}\s?\d{0,3}|34[7-90]\s?\d{2,3}\s?\d{2,3}\s?\d{0,3}|36[680]\s?\d{2,3}\s?\d{2,3}\s?\d{0,3}|33[3-90]\s?\d{2,3}\s?\d{2,3}\s?\d{0,3}|32[89]\s?\d{2,3}\s?\d{2,3}\s?\d{0,3}))[\+*#-]? ?$/;

function checkPhoneNoChar() {

    if (!pattern.test(phoneNumber.value)) {
        phoneNumber.setCustomValidity("Il numero di telefono non è valido in Italia.");
    } else {
        phoneNumber.setCustomValidity('');
    }
}

if(phoneNumber) {
    phoneNumber.oninput = checkPhoneNoChar;
}

// at least one spec must be selected - validation
let form = document.querySelector('#form');
let checkboxes;
let checkboxLength;
let firstCheckbox;

if(form) {
    checkboxes = form.querySelectorAll('input[type=checkbox]');
    checkboxLength = checkboxes.length;
    firstCheckbox = checkboxLength > 0 ? checkboxes[0] : null;

    init();

}

function init() {

    if (firstCheckbox) {
        for (let i = 0; i < checkboxLength; i++) {
            checkboxes[i].addEventListener('change', checkValidity);
        }

        checkValidity();
    }
}

function isChecked() {
    for (let i = 0; i < checkboxLength; i++) {
        if (checkboxes[i].checked) return true;
    }

    return false;
}

function checkValidity() {
    let errorMessage = !isChecked() ? 'Almeno una specializzazione deve essere selezionata' : '';
    firstCheckbox.setCustomValidity(errorMessage);
}


//SPONSORSHIP SHOW-PAYMENT
// credit card validation
let ccNum = document.getElementById("ccnum");
const ccPattern = /^[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}$/;

function checkCCNoChar() {

    if (!ccPattern.test(ccNum.value)) {
        ccNum.setCustomValidity("Il numero di carta di credito non è valido.");
    } else {
        ccNum.setCustomValidity('');
    }
}

if(ccNum) {
    ccNum.oninput = checkCCNoChar;
}

// expiry date validation
let expireDt = document.getElementById("expmonth");
const datePattern = /^(20\d{2})-(0[1-9]|1[0-2])$/;

function checkDate() {
    expireDt = document.getElementById("expmonth").value;
    let expiryDate = new Date(expireDt);
    let today = new Date();

    console.log(new Date('2025-06'));
    console.log(today);

    
    if (!datePattern.test(expireDt)) {
        document.getElementById("expmonth").setCustomValidity("Data non valida.");
    } else if (expiryDate < today) {
        document.getElementById("expmonth").setCustomValidity("La data di scadenza deve essere futura.");
    } else {
        document.getElementById("expmonth").setCustomValidity('');
    }
}

if(expireDt) {
    expireDt.oninput = checkDate;
}

// cvv validation
let cvv = document.getElementById("cvv");
const cvvPattern = /^[1-9][0-9]{2}$/

function checkCVV() {

    if (!cvvPattern.test(cvv.value)) {
        cvv.setCustomValidity("Il cvv non è valido.");
    } else {
        cvv.setCustomValidity('');
    }
}

if(cvv) {
    cvv.oninput = checkCVV;
}