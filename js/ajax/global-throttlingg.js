const minInterval = 10000,
    maxInterval = 300000
let baseInterval = 1000;
const getLastUpdt = () => new Date().toLocaleString("en-US", {timeZone: 'UTC'});

jQuery(document).ready(function ($) {

    const initObj = {
        0: ['.page-header .time span'],
        1: [],//не существует в новой теме
        2: ['.user__money-amount span'],
        3: ['.header-main .nums .num-green', '.mobile-menu-wrap .nums .num-green', '.dropdown-menu .num-green', '.logged-in-menu-bottom .num-green', '.menu-profile .num-green'],
        4: ['.header-main .nums .num-red', '.mobile-menu-wrap .nums .num-red'],
        5: ['.header-main .nums .num-blue', '.mobile-menu-wrap .nums .num-blue', '.dropdown-menu .num-blue', '.logged-in-menu-bottom .num-blue', '.menu-profile .num-blue'],
        6: ['.header-main .login-menu-top .score span', '.mobile-menu-wrap .login-menu-top .score span', '.about-user .score span'],
        7: ['.dropdown-menu .matches .num-red', '.logged-in-menu-bottom .matches .num-red', '.menu-profile .matches .num-red'],
        8: ['.dropdown-menu .tournaments .num-red', '.logged-in-menu-bottom .tournaments .num-red', '.menu-profile .tournaments .num-red'],
        9: ['.dropdown-menu .admin .num-red', '.logged-in-menu-bottom .admin .num-red', '.menu-profile .admin .num-red'],
        10: ['.num-default', 'div.friend'],
    }
    // 0 curTime
    // 1 balanceTopCur
    // 2 balanceTopValue
    // 3 numGreen
    // 4 numRed
    // 5 numBlue
    // 6 rating
    // 7 matches
    // 8 tournaments
    // 9 admin
    // 10 friends

    const initData = {
        0: initing(0),
        1: initing(1),
        2: initing(2),
        3: initing(3),
        4: initing(4),
        5: initing(5),
        6: initing(6),
        7: initing(7),
        8: initing(8),
        9: initing(9),
        10: initing(10),
    }

    function initing(i) {
        return $(initObj[i][0]).html()
    }

    const data = {
        action: 'globalHeader',
        time: getLastUpdt(),
        offset: new Date().getTimezoneOffset(),
    }

    // let run = setInterval(getDataFunction, minInterval)
    let run ;
    getDataFunction()
    function getDataFunction() {
        $.post(
            earena_2_ajax.url,
            data,
             (response) => {
                const resp = JSON.parse(response)
                if (minInterval !== baseInterval) {
                    baseInterval = minInterval
                    clearInterval(run)
                    run = setInterval(getDataFunction, baseInterval)
                }
                if (resp) {
                  //console.log(resp);
                    if (0 in resp) {
                        const respData = resp[0]
                        for (const [key, value] of Object.entries(respData)) {
                            if (key >= 11) {
                                break
                            }
                            if (value !== initData[key]) {
                                initData[key] = value
                                for (const elem of initObj[key]) {
                                    $(elem).html(value)
                                }
                            }
                        }
                    }
                    if (1 in resp && 0 in resp[1] && resp[1][0] == 1) {
                        data.time = getLastUpdt()
                        if ($('#ajax-tour-single').length) {
                            const activetab = $('li[aria-selected=true]').index()
                            $('#ajax-tour-single').html(resp[1][1])
                            $('body').trigger('tournament-updated')
                            if ($('.tour-tab').length) {
                                $('.tour-tab').tabs({
                                    active: activetab
                                })
                            }
                            if ($('.create-tour-tab').length) {
                                $('.create-tour-tab').tabs({
                                    active: activetab
                                })
                            }
                        }
                        if ($('#ajax-tournament-match-single').length) {
                            const activetab = $('li[aria-selected=true]').index()
                            $('#ajax-tournament-match-single').html(resp[1][1])

                            function initFileUploader () {
                                $('#ajax-tournament-match-single .fileuploader', 'body').uploadFile({
                                    //url:"http://hayageek.com/examples/jquery/ajax-multiple-file-upload/upload.php",
                                    fileName: 'myfile',
                                    dragDrop: false,
                                    abortStr: '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.0003 18.3332C14.6027 18.3332 18.3337 14.6022 18.3337 9.99984C18.3337 5.39746 14.6027 1.6665 10.0003 1.6665C5.39795 1.6665 1.66699 5.39746 1.66699 9.99984C1.66699 14.6022 5.39795 18.3332 10.0003 18.3332Z" fill="#CACACA"/><path d="M12.5 7.5L7.5 12.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M7.5 7.5L12.5 12.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                                    showError: false,
                                    showFileCounter: false,
                                    statusBarWidth: 190,
                                    showProgress: false,
                                    uploadStr: '<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.0797 8.28768L9.18723 15.1802C8.34285 16.0246 7.19762 16.4989 6.00348 16.4989C4.80934 16.4989 3.66411 16.0246 2.81973 15.1802C1.97535 14.3358 1.50098 13.1906 1.50098 11.9964C1.50098 10.8023 1.97535 9.65707 2.81973 8.81268L9.71223 1.92018C10.2752 1.35726 11.0386 1.04102 11.8347 1.04102C12.6308 1.04102 13.3943 1.35726 13.9572 1.92018C14.5202 2.48311 14.8364 3.24659 14.8364 4.04268C14.8364 4.83878 14.5202 5.60226 13.9572 6.16518L7.05723 13.0577C6.77577 13.3391 6.39403 13.4973 5.99598 13.4973C5.59793 13.4973 5.21619 13.3391 4.93473 13.0577C4.65327 12.7762 4.49514 12.3945 4.49514 11.9964C4.49514 11.5984 4.65327 11.2166 4.93473 10.9352L11.3022 4.57518" stroke="#787878" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg> <span>Прикрепить фото</span>'

                                })
                            }

                            initFileUploader()
                            $('body').trigger('match-updated')
                            if ($('.tour-tab').length) {
                                $('.tour-tab').tabs({
                                    active: activetab
                                })
                            }
                            if ($('.create-tour-tab').length) {
                                $('.create-tour-tab').tabs({
                                    active: activetab
                                })
                            }
                        }
                        // Список друзей во вкладке Друзья в Профиле
                        if ($('#private-friend-list').length) {
                            $('#private-friend-list').html(resp[1][1])
                            $('body').trigger('private-friend-list-updated')
                        }

                        // Список друзей во вкладке Друзья в Профиле
                        if ($('#public-friend-list').length) {
                            $('#public-friend-list').html(resp[1][1])
                            $('body').trigger('private-friend-list-updated')
                        }
                    }
                    if (resp[1][3]) {
                        data.time = getLastUpdt()
                        $('body').trigger('edit-public-user-list')
                        $('body').trigger('edit-public-user-button')
                    }
                    if (resp[1][4]) {
                        data.time = getLastUpdt()
                        $('body').trigger('edit-public-user-button')
                    }
                    if (resp[1][5]) {
                        $('.ea-banner-counter1').html(resp[1][5][0])
                        $('.ea-banner-counter2').html(resp[1][5][1])
                    }
                } else { return }
            }
        ).fail(function (response) {
            if (baseInterval < maxInterval) {
                baseInterval = baseInterval * 2
                clearInterval(run)
                run = setInterval(getDataFunction, baseInterval)
            }
            console.log(response)
        })
    }

    $('body').on('vip-update tournament-update match-update', getDataFunction);

})
