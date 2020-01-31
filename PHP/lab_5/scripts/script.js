; function validateForm() {
    
    var Name = document.getElementById("Name");
    var Surname = document.getElementById("Surname");
    var Patronymic = document.getElementById("Patronymic");
    var NameErr = document.getElementById("NameErr");
    var SurnameErr = document.getElementById("SurnameErr");
    var PatronymicErr = document.getElementById("PatronymicErr");
    var About = document.getElementById("About");
    var AboutErr = document.getElementById("AboutErr");
   // var 

    var text = Name.value;
    var validMessage = "*Only A-Z, a-z symbols allow."

    //sreturn false;
    var validName = validateString(text);
    if (!validName) {
        NameErr.textContent = validMessage;
    } else {
        NameErr.textContent = null;
    }
    text = Surname.value;
    var validSurn = validateString(text);
    if (!validSurn) {
        valid2 = false;        
        SurnameErr.textContent = validMessage;       
    } else {
        SurnameErr.textContent = null;
    }
    text = Patronymic.value;
    var validPart = validateString(text);
    if (!validPart) {      
        PatronymicErr.textContent = validMessage;
    } else {
        PatronymicErr.textContent = null;
    }
    text = About.value;
    var validTextAr = validateTextarea(text)
    if (!validTextAr) {
        AboutErr.textContent = validMessage;
    } else {
        AboutErr.textContent = null;
    }

    return validName && validSurn && validPart && validTextAr;
}

; function validate() {
    //alert('asd');
    var text = event.target.value;
    var target = event.target;
    //alert(text);

    if (text == "" || text == null) {
        event.target.style.border = "2px solid grey";
    }   
    else {      
        var isValid = true;
        var textLen = text.length;
        text = text.trim();
            if (!text.match(/^[a-z\s]+$/i)) {
                isValid = false;
            }
        if (isValid) {
            target.style.border = "2px solid green";
        } else {
            target.style.border = "2px solid red";            
        }
    }
}

; function validateString(string) {
    var reg = /^[a-z\s]+$/i;
    string = string.trim();
    return reg.test(string);
};

; function validateTextarea(string) {
    var reg = /^[A-Za-z\d\s\.,]+$/;
    string = string.trim();
    return reg.test(string); 
}

; function validateTA() {
    //alert('asd');
    var text = event.target.value;
    var target = event.target;
    //alert(text);

    if (text == "" || text == null) {
        event.target.style.border = "2px solid grey";
    }
    else {
        var isValid = true;
        var textLen = text.length;
        text = text.trim();
            if (!text.match(/^([A-Za-z\d\s\.,]+)$/)) {
                isValid = false;                
            }
       
        if (isValid) {
            target.style.border = "2px solid green";
        } else {
            target.style.border = "2px solid red";
        }
    }
}
