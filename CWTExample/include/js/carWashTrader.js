$(document).ready(function () {
    $('#menu > li').bind('mouseover', openSubMenu);
    $('#menu > li').bind('mouseout', closeSubMenu);

    function openSubMenu() {
        $(this).find('ul').css('visibility', 'visible');
    }
    ;
    function closeSubMenu() {
        $(this).find('ul').css('visibility', 'hidden');
    }
    ;
});

$(document).ready(function () {
    $('.result').bind('mouseover', showCap);
    $('.result').bind('mouseout', hideCap);

    function showCap() {
        $(this).find('p').css('visibility', 'visible');
    }
    ;
    function hideCap() {
        $(this).find('p').css('visibility', 'hidden');
    }
    ;
});


$(document).ready(function () {
    $('#dropBox').selectBoxIt({
        //defaultText: "{ main_category_name }",
        showEffect: "slideDown",
        hideEffect: "slideUp",
        showEffectSpeed: 450,
        hideEffectSpeed: 650
    });
        $('#dropBox2').selectBoxIt({
        showEffect: "slideDown",
        hideEffect: "slideUp",
        showEffectSpeed: 450,
        hideEffectSpeed: 650
    });
            $('#dropBox3').selectBoxIt({
        showEffect: "slideDown",
        hideEffect: "slideUp",
        showEffectSpeed: 450,
        hideEffectSpeed: 650
    });
});

// NEW PRODUCTS
$(document).ready(function () {
    $('.thumb').bind('click', function() {
        $thumb = $(this);
        $('.newproduct').fadeTo(300, 0.5, function() {
            $('.newproduct').attr('src', $thumb.find('img').attr('src')).fadeTo(300, 1);
        });    
    });
});

$(document).ready(function () {


    $('.act').one('mouseover', show);
    $('.act').bind('click', hide);

    function show() {
        $('#'+$(this).attr('name')).slideDown();
    }
    ;
    function hide() {
        $('#'+$(this).attr('name')).slideUp();
    }
    ;
});

$(document).ready(function () {

        $('.clc').bind('click', show);
    
        function show() {
             $('.clc').unbind();
        $('#'+$(this).attr('name')).slideDown();
        $('.clc').bind('click', hide);
    }
    ;
    function hide() {
        $('.clc').unbind();
        $('#'+$(this).attr('name')).slideUp();
        $('.clc').bind('click', show);
    }
    ;
});


$(document).ready(function () {
        $('.clc2').bind('click', show);
    
        function show() {
        $('.clc2').unbind();
        $('div.'+$(this).attr('name')).slideDown();
        $('.clc2').bind('click', hide);
    }
    ;
    function hide() {
        $('.clc2').unbind();
        $('div.'+$(this).attr('name')).slideUp();
        $('.clc2').bind('click', show);
    }
    ;
});