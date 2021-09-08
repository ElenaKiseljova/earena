jQuery(document).ready(function ($) {

    $('#register input[name="email"], #register input[name ="username"]').on('change keyup paste', $.debounce(250, function () {
            var key = $(this).attr("name")
            var value = $(this).val()
            if ($(this).val().length < 5 || (key === 'email' && !validateEmail(value))) {
                setErrorClass(key)
                return false
            }
            $('#register [name=' + key + ']').removeClass('blank')
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: footAjax.admin_url,
                data: {
                    'action': 'register_check',
                    'reg_security': $('#reg_security').val(),
                    'key': key,
                    'value': value
                },
                success: function (respond) {
                    if (respond.data.checked) {
                        setSuccessClass(key)
                    } else {
                        $('#register .status_register').html(respond.data.message).show()
                        setErrorClass(key)
                    }
                },
            })
        })
    )

    $('#register select').bind('change click keyup', function () {
        var key = $(this).attr("name")
        if ($(this).val().length <= 1) {
            setErrorClass(key)
        } else {
            setSuccessClass(key)
        }
    })

    $('#register input[type="password"]').bind('change keyup', function () {
        var key = $(this).attr("name")
        if ($(this).val().length >= 8) {
            setSuccessClass(key)
        } else {
            setErrorClass(key)
        }
        if (($('#register input[name="confirm_password"]').val() === $('#register input[name="password"]').val()) && ($('#register input[name="confirm_password"]').val().length != 0) ) {
            setSuccessClass('confirm_password')
        } else {
            setErrorClass('confirm_password')
        }
    })


    $('#register_form').on('submit', function (e) {
        e.preventDefault()
        var nicknames = {}
        $('input[name^="nicknames"]').each(function () {
            var name = $(this).attr('name')
            var id = parseInt(name.match(/[0-9]+/))
            var val = $(this).val()
            if (!$(this).is(':disabled') && val !== '') {
                nicknames[id] = val
            }
        })
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ea_functions_object.url,
            data: {
                'action': 'ajax_register',
                'email': $('#register input[name=email]').val(),
                'username': $('#register input[name=username]').val(),
                'password': $('#register input[name=password]').val(),
                'confirm_password': $('#register input[name=confirm_password]').val(),
                'country': $('#register select[name=country]').val(),
                'birth_date': $('#register input[name=birth_date]').val(),
                'reg_security': $('#reg_security').val(),
            },
            success: function (respond, status, jqXHR) {
                if (respond.data.registered) {
                    document.location.href = 'profile?after_registration=1'
                } else {
                    $.each(respond.data.errors, function (key, val) {
                        console.log(key + ' = '+ val);
                    })
                }
            },
            error: function (jqXHR, status, errorThrown) {
                console.log('error => ' + status)
                $('#register.status_register').html('ОШИБКА: ' + status + '. Попробуйте обновить страницу.').show()
            }
        })
    })

    function setErrorClass(key) {
        $('#register [name=' + key + ']').removeClass('success')
        $('#register [name=' + key + ']').addClass('error')
    }

    function setSuccessClass(key) {
        $('#register .status_register').html('').hide()
        $('#register [name=' + key + ']').removeClass('error')
        $('#register [name=' + key + ']').addClass('success')
    }

    function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,:\s@"]+(\.[^<>()[\]\\.,:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        return re.test(String(email).toLowerCase())
    }

    $('#register input[name=email]').val('')
    $('#register input[name=username]').val('')
    $('#register input[name=password]').val('')
    $('#register input[name=confirm_password]').val('')
    $('#register select[name=country]').val('')
})
