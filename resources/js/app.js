import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

    //ADMIN/CREATE + EDIT VIEWS
    // phone number validation
    let phoneNumber = document.getElementById("phone_number");
    const pattern = /^[\+*#-]? ?(\((00|\+)39\)|(00|\+)39)?[\+*#-]? ?((0\s?\d{2,3}\s?\d{2,3}\s?\d{2,3}\s?\d{0,3})|(38[890]\s?\d{2,3}\s?\d{2,3}\s?\d{0,3}|34[7-90]\s?\d{2,3}\s?\d{2,3}\s?\d{0,3}|36[680]\s?\d{2,3}\s?\d{2,3}\s?\d{0,3}|33[3-90]\s?\d{2,3}\s?\d{2,3}\s?\d{0,3}|32[89]\s?\d{2,3}\s?\d{2,3}\s?\d{0,3}))[\+*#-]? ?$/;
    
    function checkPhoneNoChar() {

        if (!pattern.test(phoneNumber.value)) {
            phoneNumber.setCustomValidity("Il numero di telefono non è valido in Italia.");
        } else {
            phoneNumber.setCustomValidity('');
        }
    }
    
    phoneNumber.oninput = checkPhoneNoChar;

    // at least one spec must be selected - validation
    let form = document.querySelector('#form');
    let checkboxes = form.querySelectorAll('input[type=checkbox]');
    let checkboxLength = checkboxes.length;
    let firstCheckbox = checkboxLength > 0 ? checkboxes[0] : null;

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

    init();
