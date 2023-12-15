
function Validate(options) {

    getParrent = function(element, selector) {
        while(element.parentElement) {
            if(element.parentElement.matches(selector))  {
                return element.parentElement;
            }
            element = element.parentElement;
        }
    }

    var validateRule = {};

    function runerror(inputElement, rule) {

        var parrent = getParrent(inputElement, options.formParrent);
        var display = parrent.querySelector(options.errorMessage);

        if(display)  {

            var valueElement;
            var rules = validateRule[rule.selector];

            for(var i=0;i<rules.length;i++) {
                switch(inputElement.type) {
                    case 'radio':
                    case 'checkbox':
                        valueElement = rules[i] (
                            formElement.querySelector(rule.selector + ':checked')
                        );
                        break;
                    default:
                        valueElement = rules[i](inputElement.value);
                }
                if(valueElement) break;
            }

            if(valueElement)  {
                display.innerText = valueElement;
                parrent.classList.add('invalid');

            } else {
                display.innerText = '';
                parrent.classList.remove('invalid');
            }

            inputElement.oninput = function() {
                display.innerText = '';
                getParrent(inputElement, options.formParrent).classList.remove('invalid');
            }
        }        
        return !valueElement;
    }

    var formElement = document.querySelector(options.form);

    if(formElement)  {
        formElement.onsubmit = function(e) {
            e.preventDefault();

            var isFormValid = true;
            options.rules.forEach(rule => {
                var inputElement = formElement.querySelector(rule.selector);
                var isValid = runerror(inputElement, rule);

                if(!isValid)  {
                    isFormValid = false;
                }
            });

            
            if(isFormValid)  {
                if(typeof options.onSubmit === 'function')  {
                    var enableInput = formElement.querySelectorAll('[name]');

                    var formValue = Array.from(enableInput).reduce( function(value, input) {
                        switch(input.type) {
                            case 'radio':
                                value[input.name] = formElement.querySelector('input[name="' + input.name + '"]:checked').value;
                                break;
                            case 'checkbox':
                                if(!input.matches(':checked')) return value;

                                if(!Array.isArray(value[input.name]))  {
                                    value[input.name] = [];
                                }
                                value[input.name].push()
                                break;
                            case 'file':
                                value[input.name] = input.files;
                                break;
                            default:
                                value[input.name] = input.value;
                                break;
                        } 
                        return value; 
                    }, {});

                    options.onSubmit(formValue);
                } else {
                    formElement.submit();
                }
            }
        }

        options.rules.forEach(rule => {

            if(Array.isArray(validateRule[rule.selector]))  {
                validateRule[rule.selector].push(rule.test);
            } else {
                validateRule[rule.selector] = [rule.test];
            }

            var inputElements = formElement.querySelectorAll(rule.selector);
            Array.from(inputElements).forEach(function(inputElement) {
                if(inputElement)   {
                    inputElement.onblur = function() {
                        runerror(inputElement, rule);
                    }
                    
                    inputElement.oninput = function() {
                        var display = getParrent(inputElement, options.formParrent).querySelector(options.errorMessage);
                        display.innerText = '';
                        getParrent(inputElement, options.formParrent).classList.remove('invalid');
                    }
                }
            })
        });
    }
}


Validate.isRequet = function(selector) {
    return {
        selector: selector,
        test: function(value) {
            return value ? undefined : 'Vui lòng nhập trường này!';
        }
    }
}

Validate.isEmail = function(selector) {
    return {
        selector: selector,
        test: function(value) {
            var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(value) ? undefined : 'Định dạng email không hợp lệ!';
        }
    }
}

Validate.isPassword = function(selector, min) {
    return {
        selector: selector,
        test: function(value) {
            return value.length >= min ? undefined : `Trường này phải từ ${min} ký tự trở lên!`;
        }
    }
}

Validate.isAgain = function(selector, getPass) {
    return {
        selector: selector,
        test: function(value) {
            return value === getPass() ? undefined : 'Nhập lại mật khẩu chưa chính xác!';
        }
    }
}