if (!String.prototype.includes) {
  String.prototype.includes = function(search, start) {
    'use strict';
    if (typeof start !== 'number') {
      start = 0;
    }

    if (start + search.length > this.length) {
      return false;
    } else {
      return this.indexOf(search, start) !== -1;
    }
  };
}
function check_val () {
    passwords = document.getElementsByName("password");
    logins = document.getElementsByName("login");
    emails = document.getElementsByName("email");
    function check (array, mask="default") {
        correct = [];
        if (array.lenght === 0) {
            return [false];
        }
        for (let i = 0; i < array.length; i++) {
            cont = array[i].value;
            correct.push(true);
            if (mask == "default") {
                if (cont === "") {
                    correct[i] = false;
                }
            }
            else {
                if (!mask.test(cont) ) {
                    correct[i] = false;
                }
            }
        }
        return correct;
    }
    cor_passw = check(passwords);
    cor_log = check(logins);
    cor_email = check(emails, /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,20})$/);
    function disable (array, name) {
		bool_arr = []
        for (let i = 0; i < array.length; i++) {
            let bool = array[i];
			bool_arr.push(bool)
            elem = document.getElementsByName(name)[i];
            logon = document.getElementsByName("logon")[i];
            if (!bool) {
                if (elem.hasAttribute("title")) {
                    if (elem.getAttribute("title") != "Поле заполнено некорректно :(") {
                        elem.setAttribute("title", "Поле заполнено корректно :)");
                    }
                }
                else {
                    elem.setAttribute("title", "Поле заполнено некорректно :(");
                }
                if (!logon.hasAttribute("disabled")) {
                    logon.setAttribute("disabled", "");
                }
                if (elem.hasAttribute("style")) {
                    if (!elem.getAttribute("style").includes("border:2px solid #ff373e;")) {
                        elem.setAttribute("style", "border:2px solid #ff373e;");
                    }
                }
                else {
                    elem.setAttribute("style", "border:2px solid #ff373e;");
                }
            }
            else {
                if (elem.hasAttribute("title")) {
                    if (elem.getAttribute("title") == "Поле заполнено некорректно :(") {
                        elem.setAttribute("title", "Поле заполнено корректно :)");
                    }
                }
                else {
                    elem.setAttribute("title", "Поле заполнено корректно :)");
                }
                if (logon.hasAttribute("disabled")) {
                    logon.removeAttribute("disabled");
                }
                if (elem.hasAttribute("style")) {
                    if (!elem.getAttribute("style").includes("border:2px solid lime;")) {
                        elem.setAttribute("style", "border:2px solid lime;");
                    }
                }
                else {
                    elem.setAttribute("style", "border:2px solid lime;");
                }
            }
        }
		return bool_arr;
    }
    bool_passw = disable(cor_passw, "password");
    bool_log = disable(cor_log, "login");
    if (emails.length !== 0) {
        bool_email = disable(cor_email, "email");
    }
	for (let i = 0; i < bool_passw.lenght; i++) {
		let bool = bool_passw[i] && bool_log[i]
		logon = document.getElementsByName("logon")[i];
		if (emails.lenght > i) {
			bool = bool && bool_email[i]
		}
		if (bool) {
			if (logon.hasAttribute("disabled")) {
				logon.removeAttribute("disabled");
			}
		}
		else {
			if (!logon.hasAttribute("disabled")) {
				logon.setAttribute("disabled", "");
			}
		}
	}
}
let timerId = setInterval(check_val, 500);