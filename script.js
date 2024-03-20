/* fonction qui s'assure que la captcha a été remplie */

function validateForm() {
    var response = grecaptcha.getResponse();
    if (response.length == 0) {
        alert("Veuillez remplir le captcha.");
        return false;
    }
    return true;
}


