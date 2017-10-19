/**
 * Created by Paradoxs on 31.08.2017.
 */


$(document).ready(function(){
    $(".toggle-block").click(function(){
        $('.toggle-mnu').addClass("on");
        $('.head-block').addClass('active');
        return false;
    });

    $('header .close').click(function(){
        $('.head-block').removeClass('active');
        $('.toggle-mnu').removeClass("on");
    });

    $(window).scroll(function() {
        if($(this).scrollTop() != 0) {
            $('.button-top').fadeIn();
        } else {
            $('.button-top').fadeOut();
        }
    });
    $('.button-top').click(function() {
        $('body,html').animate({scrollTop:0},800);
    });

    $('.slider-market').slick({
        infinite: true,
        dots: false,
        arrows: true,
        autoplay: true,
        slidesToShow: 8,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 6
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 550,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 430,
                settings: {
                    slidesToShow: 2
                }
            }
        ]
    });

    $("main .tabs .tab").click(function() {
        $("main .tabs .tab").removeClass("active").eq($(this).index()).addClass("active");
        $("main .tab_item").hide().eq($(this).index()).fadeIn()
    }).eq(0).addClass("active");

    $("#popup .tabs .tab").click(function(){
        $("#popup .tabs .tab").removeClass("active").eq($(this).index()).addClass("active");
        $("#popup .tab_item").hide().eq($(this).index()).fadeIn()
    }).eq(0).addClass("active");


    $('.panel-btn .fa').click(function(){
        $(this).parent().toggleClass('active');
        $('.category-product tbody').slideToggle(1000);
    });

    /*********search*********/
    var str = '', content, arr = [], num = 0, category, text;

    // $('.category-btn, .category>p label').click(function(){
    //     $(this).parent().find('.category-btn').toggleClass('active');
    //     $(this).parent().next().slideToggle();
    // });

    $('.btn-clear').click(function(event){
        event.preventDefault();
        $(this).parents('.search-block').find('.search-block-middle input[type="checkbox"]').prop('checked', false)
            .parents('.search-block').find('.search-block-top input').val('');

    });

    $('.button-search').click(function(){
        $(this).next().slideToggle();
    });


    // $('.category input[type="checkbox"]').click(function(){
    //     if($(this).parent().next().not(':visible')){
    //         $(this).parent().next().slideDown();
    //         $(this).prev().addClass('active');
    //     }
    //     content = $(this).next().text();
    //
    //     if($(this).prop('checked') != false){
    //         arr.push($(this).next().text());
    //
    //         for(var i = 0; i<=arr.length; i++) {
    //
    //             if (arr.length == 1) {
    //                 str = content;
    //             } else if (arr.length != 1) {
    //                 str = '';
    //                 for (var key in arr) {
    //                     str += arr[key] + ', ';
    //                 }
    //             }
    //             $(this).parents('.search-block').find('.search-block-top input').val(str);
    //         }
    //     }else if($(this).prop('checked') == false){
    //
    //         for(var i = 0; i<=arr.length; i++){
    //             if(content == arr[i]){
    //                 num = i;
    //             }
    //         }
    //
    //         delete arr[num];
    //
    //         str = '';
    //         for (var key in arr) {
    //             str += arr[key] + ', ';
    //         }
    //
    //         $(this).parents('.search-block').find('.search-block-top input').val(str);
    //     }
    //
    // });
    // $('.category input[type="checkbox"]').click(function(){
    //     if($(this).parent().next().not(':visible')){
    //         $(this).parent().next().slideDown();
    //         $(this).prev().addClass('active');
    //     }
    //     content = $(this).next().text();
    //
    //     if($(this).prop('checked') != false){
    //         arr.push($(this).next().text());
    //
    //         for(var i = 0; i<=arr.length; i++) {
    //
    //             if (arr.length == 1) {
    //                 str = content;
    //             } else if (arr.length != 1) {
    //                 str = '';
    //                 for (var key in arr) {
    //                     str += arr[key] + ', ';
    //                 }
    //             }
    //             $(this).parents('.search-block').find('.search-block-top input').val(str);
    //         }
    //     }else if($(this).prop('checked') == false){
    //
    //         for(var i = 0; i<=arr.length; i++){
    //             if(content == arr[i]){
    //                 num = i;
    //             }
    //         }
    //
    //         delete arr[num];
    //
    //         str = '';
    //         for (var key in arr) {
    //             str += arr[key] + ', ';
    //         }
    //
    //         $(this).parents('.search-block').find('.search-block-top input').val(str);
    //     }
    //
    // });

    $('.category input[type="checkbox"]').click(function(){

        content = $(this).next().text();

        if($(this).prop('checked') != false){
            arr.push($(this).next().text());

            for(var i = 0; i<=arr.length; i++) {
                str = '';
                for (var key in arr) {
                    str += arr[key] + ', ';
                }
                $(this).parents('.search-block').find('.search-block-top input').val(str);
            }
        }else if($(this).prop('checked') == false){

            for(var i = 0; i<=arr.length; i++){
                if(content == arr[i]){
                    num = i;
                }
            }

            delete arr[num];

            str = '';
            for (var key in arr) {
                str += arr[key] + ', ';
            }

            $(this).parents('.search-block').find('.search-block-top input').val(str);
        }

    });

    $('body').on('click', '.ui-menu-item', function(){
        text = $(this).text();

        if(arr.length){
            for(var key in arr){
                if(arr[key] != text){
                    arr.push(text);
                    $('.category p').each(function(){
                        category = $(this).find('label').text();
                        if(category === text){
                            $(this).find('label').click();
                        }
                    });
                }
            }
        }else{
            arr.push(text);
            $('.category p').each(function(){
                category = $(this).find('label').text();
                if(category === text){
                    $(this).find('label').click();
                }
            });
        }

    });


    $('.phone').mask('+380 99 999 99 99');

    $('.inline-popups').magnificPopup({
        delegate: 'a',
        removalDelay: 500,
        callbacks: {
            beforeOpen: function() {
                this.st.mainClass = this.st.el.attr('data-effect');
            }
        },
        midClick: true
    });

    var src, title, priceNew, priceOld, desc, path, sale;
    $('.product-img a').click(function(){
        path = $(this).parents('.product-block');

        src = $(this).find('img').attr('src');

        title = path.find('.product-title').text();
        priceNew = path.find('.price-new').html();
        priceOld = path.find('.price-old').html();
        desc = path.find('.product-desc').html();
        sale = path.find('.product-sale').text();

        $(this).parents('body').find('#popup img').attr('src', src);
        $(this).parents('body').find('#popup h4').text(title);
        $(this).parents('body').find('#popup .price-new').html(priceNew);
        $(this).parents('body').find('#popup .price-old').html(priceOld);
        $(this).parents('body').find('#popup .product-desc').html(desc);

        if(sale != ''){
            $(this).parents('body').find('#popup .wrap').html($('<div class="product-sale"></div>'));
            $(this).parents('body').find('#popup .product-sale').html(sale);
        }else{
            $(this).parents('body').find('#popup .product-sale').remove();
        }

    });

    $("select").select2();

});

$(function() {
        var availableTags = [
            'Бакалея',
            'Хлебобулочные',
            'Сладкое и дессерт',
            'Готовые блюда',
            'Овощи и фрукты',
            'Молочные продукты и яйца',
            'Мясо и рыба',
            'Рыбные продукты и икра',
            'Замороженные продукты',
            'Чай и кофе',
            'Напитки',
            'Табак',
            'Товары для животных',
            'Товары для детей',
            'Косметика гигиена',
            'Товары для дома',
            'Косметика и гигиена',
            'Одежда и обувь'
        ];
        function split(val) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }

        $(".input-search").on( "keydown", function( event ) {
            if( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        }).autocomplete({
            minLength: 0,
            source: function( request, response ) {
                response( $.ui.autocomplete.filter(
                    availableTags, extractLast( request.term ) ) );
            },
            focus: function() {
                return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
                terms.pop();
                terms.push( ui.item.value );
                terms.push( "" );
                this.value = terms.join( ", " );
                return false;
            }
        });



});

var iconBase = 'http://promotions/';
var icons = {
    atb: {
        icon: iconBase + '/images/atb-map.jpg'
    },
    silpo: {
        icon: iconBase + '/images/silpo-map.jpg'
    },
    klass: {
        icon: iconBase + '/images/klass-map.jpg'
    },
    brusnichka: {
        icon: iconBase + '/images/brusnichka-map.jpg'
    },
    antoshka: {
        icon: iconBase + '/images/antoshka-map.jpg'
    },
    tavria: {
        icon: iconBase + '/images/tavria-map.jpg'
    },
    velmart: {
        icon: iconBase + '/images/velmart-map.jpg'
    },
    posad: {
        icon: iconBase + '/images/posad-map.jpg'
    },
    okwine: {
        icon: iconBase + '/images/okwine-map.jpg'
    }
};



$('main .tab:last').click(function(){
	var features = [
    {
        position: new google.maps.LatLng(50.018822, 36.226844),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.026461, 36.327192),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.953202, 36.258777),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.061816, 36.202971),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.957162, 36.315942),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.944980, 36.320365),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.011745, 36.352703),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.027915, 36.353018),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.984649, 36.153306),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.990179, 36.204829),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.930571, 36.436562),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.011658, 36.352579),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.006909, 36.254425),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.967023, 36.220369),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.943234, 36.368565),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.032717, 36.232023),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.944654, 36.276102),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.954131, 36.329782),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.004747, 36.331093),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.981337, 36.241730),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.003244, 36.340149),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.992699, 36.221674),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.990226, 36.349528),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.038080, 36.363766),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.013367, 36.342267),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.067540, 36.208993),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.964504, 36.319260),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.934117, 36.427969),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.006120, 36.349933),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.956113, 36.343734),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.050729, 36.194889),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.991735, 36.361610),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.011994, 36.217016),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.958979, 36.331781),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.983055, 36.185087),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.939828, 36.379073),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.949669, 36.164701),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.945081, 36.260982),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.017262, 36.332231),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.953593, 36.314124),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.022168, 36.349573),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.986350, 36.259655),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.984756, 36.174698),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.914760, 36.275171),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.026553, 36.338543),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.995486, 36.235194),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.036785, 36.237058),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.942452, 36.309486),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.929423, 36.408247),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.035338, 36.353768),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.044307, 36.353221),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.946076, 36.358913),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.977754, 36.252509),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.970172, 36.184299),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.012325, 36.325717),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.982322, 36.348942),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.999944, 36.240388),
        type: 'atb'
    }, {
        position: new google.maps.LatLng(50.026954, 36.220752),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(50.017747, 36.345694),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(50.024026, 36.339270),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(49.980964, 36.361385),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(49.956452, 36.359569),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(49.962367, 36.334738),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(49.990194, 36.291302),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(50.058504, 36.205058),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(50.049038, 36.208046),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(49.996049, 36.339176),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(49.996027, 36.341814),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(49.965432, 36.328162),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(49.947118, 36.259054),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(49.988851, 36.351898),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(50.056994, 36.202948),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(49.916473, 36.408432),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(49.943165, 36.302226),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(50.009510, 36.350180),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(50.002301, 36.219169),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(50.037586, 36.348051),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(49.944940, 36.400573),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(49.943933, 36.369430),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(49.946292, 36.360259),
        type: 'brusnichka'
    }, {
        position: new google.maps.LatLng(50.038743, 36.197840),
        type: 'brusnichka'
    }, {
        position: new google.maps.LatLng(50.090034, 36.256392),
        type: 'brusnichka'
    }, {
        position: new google.maps.LatLng(50.091602, 36.258684),
        type: 'brusnichka'
    }, {
        position: new google.maps.LatLng(50.020997, 36.223470),
        type: 'brusnichka'
    }, {
        position: new google.maps.LatLng(49.990450, 36.260885),
        type: 'brusnichka'
    }, {
        position: new google.maps.LatLng(49.993130, 36.217866),
        type: 'brusnichka'
    }, {
        position: new google.maps.LatLng(49.980230, 36.182196),
        type: 'brusnichka'
    }, {
        position: new google.maps.LatLng(49.961019, 36.305687),
        type: 'brusnichka'
    }, {
        position: new google.maps.LatLng(50.013799, 36.225518),
        type: 'antoshka'
    }, {
        position: new google.maps.LatLng(49.982289, 36.241434),
        type: 'antoshka'
    }, {
        position: new google.maps.LatLng(50.000165, 36.243387),
        type: 'antoshka'
    }, {
        position: new google.maps.LatLng(50.026333, 36.331682),
        type: 'antoshka'
    }, {
        position: new google.maps.LatLng(50.031973, 36.356688),
        type: 'velmart'
    }, {
        position: new google.maps.LatLng(49.994336, 36.339287),
        type: 'velmart'
    }, {
        position: new google.maps.LatLng(49.956147, 36.361726),
        type: 'velmart'
    }, {
        position: new google.maps.LatLng(49.929749, 36.434440),
        type: 'velmart'
    }, {
        position: new google.maps.LatLng(49.985945, 36.230755),
        type: 'okwine'
    }, {
        position: new google.maps.LatLng(49.998231, 36.329651),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(49.989643, 36.249433),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(49.940774, 36.367703),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(49.949175, 36.308769),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(50.035411, 36.226752),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(50.026000, 36.337552),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(50.018036, 36.327127),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(50.013784, 36.338394),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(50.009925, 36.351007),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(49.975372, 36.260666),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(49.913956, 36.402991),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(49.983733, 36.356274),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(49.987447, 36.215796),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(50.006513, 36.250901),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(49.949879, 36.314161),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(50.001719, 36.353813),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(50.038109, 36.290494),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(50.022400, 36.373330),
        type: 'posad'
    }
];
    var map;
    function initMap(){
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 49.988086, lng: 36.232516},
            zoom: 12
        });

        features.forEach(function(feature) {
            var marker = new google.maps.Marker({
                position: feature.position,
                icon: icons[feature.type].icon,
                map: map
            });
        });
    }
    initMap();
});

$('.white-popup .tab:last').click(function(){
	var features = [
    {
        position: new google.maps.LatLng(50.018822, 36.226844),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.026461, 36.327192),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.953202, 36.258777),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.061816, 36.202971),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.957162, 36.315942),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.944980, 36.320365),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.011745, 36.352703),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.027915, 36.353018),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.984649, 36.153306),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.990179, 36.204829),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.930571, 36.436562),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.011658, 36.352579),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.006909, 36.254425),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.967023, 36.220369),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.943234, 36.368565),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.032717, 36.232023),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.944654, 36.276102),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.954131, 36.329782),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.004747, 36.331093),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.981337, 36.241730),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.003244, 36.340149),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.992699, 36.221674),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.990226, 36.349528),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.038080, 36.363766),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.013367, 36.342267),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.067540, 36.208993),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.964504, 36.319260),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.934117, 36.427969),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.006120, 36.349933),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.956113, 36.343734),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.050729, 36.194889),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.991735, 36.361610),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.011994, 36.217016),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.958979, 36.331781),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.983055, 36.185087),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.939828, 36.379073),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.949669, 36.164701),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.945081, 36.260982),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.017262, 36.332231),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.953593, 36.314124),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.022168, 36.349573),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.986350, 36.259655),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.984756, 36.174698),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.914760, 36.275171),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.026553, 36.338543),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.995486, 36.235194),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.036785, 36.237058),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.942452, 36.309486),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.929423, 36.408247),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.035338, 36.353768),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.044307, 36.353221),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.946076, 36.358913),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.977754, 36.252509),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.970172, 36.184299),
        type: 'atb'
    },{
        position: new google.maps.LatLng(50.012325, 36.325717),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.982322, 36.348942),
        type: 'atb'
    },{
        position: new google.maps.LatLng(49.999944, 36.240388),
        type: 'atb'
    }, {
        position: new google.maps.LatLng(50.026954, 36.220752),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(50.017747, 36.345694),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(50.024026, 36.339270),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(49.980964, 36.361385),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(49.956452, 36.359569),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(49.962367, 36.334738),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(49.990194, 36.291302),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(50.058504, 36.205058),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(50.049038, 36.208046),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(49.996049, 36.339176),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(49.996027, 36.341814),
        type: 'silpo'
    }, {
        position: new google.maps.LatLng(49.965432, 36.328162),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(49.947118, 36.259054),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(49.988851, 36.351898),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(50.056994, 36.202948),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(49.916473, 36.408432),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(49.943165, 36.302226),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(50.009510, 36.350180),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(50.002301, 36.219169),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(50.037586, 36.348051),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(49.944940, 36.400573),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(49.943933, 36.369430),
        type: 'klass'
    }, {
        position: new google.maps.LatLng(49.946292, 36.360259),
        type: 'brusnichka'
    }, {
        position: new google.maps.LatLng(50.038743, 36.197840),
        type: 'brusnichka'
    }, {
        position: new google.maps.LatLng(50.090034, 36.256392),
        type: 'brusnichka'
    }, {
        position: new google.maps.LatLng(50.091602, 36.258684),
        type: 'brusnichka'
    }, {
        position: new google.maps.LatLng(50.020997, 36.223470),
        type: 'brusnichka'
    }, {
        position: new google.maps.LatLng(49.990450, 36.260885),
        type: 'brusnichka'
    }, {
        position: new google.maps.LatLng(49.993130, 36.217866),
        type: 'brusnichka'
    }, {
        position: new google.maps.LatLng(49.980230, 36.182196),
        type: 'brusnichka'
    }, {
        position: new google.maps.LatLng(49.961019, 36.305687),
        type: 'brusnichka'
    }, {
        position: new google.maps.LatLng(50.013799, 36.225518),
        type: 'antoshka'
    }, {
        position: new google.maps.LatLng(49.982289, 36.241434),
        type: 'antoshka'
    }, {
        position: new google.maps.LatLng(50.000165, 36.243387),
        type: 'antoshka'
    }, {
        position: new google.maps.LatLng(50.026333, 36.331682),
        type: 'antoshka'
    }, {
        position: new google.maps.LatLng(50.031973, 36.356688),
        type: 'velmart'
    }, {
        position: new google.maps.LatLng(49.994336, 36.339287),
        type: 'velmart'
    }, {
        position: new google.maps.LatLng(49.956147, 36.361726),
        type: 'velmart'
    }, {
        position: new google.maps.LatLng(49.929749, 36.434440),
        type: 'velmart'
    }, {
        position: new google.maps.LatLng(49.985945, 36.230755),
        type: 'okwine'
    }, {
        position: new google.maps.LatLng(49.998231, 36.329651),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(49.989643, 36.249433),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(49.940774, 36.367703),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(49.949175, 36.308769),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(50.035411, 36.226752),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(50.026000, 36.337552),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(50.018036, 36.327127),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(50.013784, 36.338394),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(50.009925, 36.351007),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(49.975372, 36.260666),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(49.913956, 36.402991),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(49.983733, 36.356274),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(49.987447, 36.215796),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(50.006513, 36.250901),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(49.949879, 36.314161),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(50.001719, 36.353813),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(50.038109, 36.290494),
        type: 'posad'
    }, {
        position: new google.maps.LatLng(50.022400, 36.373330),
        type: 'posad'
    }
];

    var map;
    function initMap() {

        map = new google.maps.Map(document.getElementById('popup-map'), {
            center: {lat: 49.988086, lng: 36.232516},
            zoom: 14
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {

                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                map.setCenter(pos);

                var marker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    title: 'Your location'
                });
            });

        }

        features.forEach(function (feature) {
            var marker = new google.maps.Marker({
                position: feature.position,
                icon: icons[feature.type].icon,
                map: map
            });
        });
    }

    initMap();
});
