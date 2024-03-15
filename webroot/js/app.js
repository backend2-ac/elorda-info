document.addEventListener('DOMContentLoaded', () => {
    let headerMenu = document.querySelector('.header__menu');
    document.addEventListener('click', ({ target }) => {
        // burger
        if (target.closest('.header__burger')) {
            target.classList.toggle('active');
            headerMenu.classList.toggle('active');
        }
        if(target.classList.contains('header__form-search')) {
            headerSearchForm.classList.toggle('active');
        }
    });
    let headerSearchBtn = document.querySelector('.header__search');
    let headerSearchForm = document.querySelector('.header__form-search');
    let headerSearchFormClear = document.querySelector('.search-form-clear');
    let headerSearchFormInput = document.querySelector('.header__form-search input');
    // headerSearchBtn.addEventListener('click', function(){
    //     this.classList.toggle('active');
    //     headerSearchForm.classList.toggle('active');
    // });
    headerSearchFormClear.addEventListener('click', () => {
        headerSearchFormInput.value = '';
    }); 

    let headerLangBtn = document.querySelector('.header__lang-active');
    let headerLangItems = document.querySelector('.header__lang-other');
    headerLangBtn.addEventListener('click', function(){
        this.classList.toggle('active');
        headerLangItems.classList.toggle('active');
    });

    // let time header
    let headerTime = document.querySelector('.js-time');

    // Функция для обновления времени
    function updateHeaderTime() {
        headerTime.innerHTML = new Date().toLocaleTimeString('en-US', { 
            hour12: false, 
            hour: "numeric", 
            minute: "numeric"
        });
    }

    // Вызываем функцию сразу после установки интервала
    updateHeaderTime();

    // Устанавливаем интервал на повторение каждую минуту
    setInterval(updateHeaderTime, 60000);

    var moneyjs = document.createElement('script');
    moneyjs.src = 'https://openexchangerates.github.io/money.js/money.min.js';
    document.body.appendChild(moneyjs);
    moneyjs.addEventListener('load', function() {
        fetch('https://www.cbr-xml-daily.ru/latest.js')
        .then(response => response.json())
        .then(function(data) {
            fx.rates = data.rates;
            fx.base = data.base;
            console.log(fx(100).from("RUB").to("KZT"));
            currentCurrencyValue.forEach((item, i) => {
                console.log(currencyArray[i]);
                item.innerHTML = convertCurrency(currencyArray[i]);
            });
        });
    });
    let currentCurrencyValue = document.querySelectorAll('.header__currency-value');
    let currencyArray = ["USD", "EUR", "RUB"];
    const convertCurrency = (item) => {
        return (fx(1).from(item).to("KZT")).toFixed(2);
    };

    // set header items
    let headerNav = document.querySelector('.header__nav');
    let headerSocials = document.querySelector('.header__socials');
    let headerWeather = document.querySelector('.header__weather');

    let headerMenuMobile = document.querySelector('.header__menu-wrap');
    let headerMenuDesktop = document.querySelector('.header__top');
    let headerMenuBot = document.querySelector('.header__bot');

    let headerBurgerRef = document.querySelector('.header__burger');
    let headerMenuRef = document.querySelector('.header__menu-scroll');
    let headerCurrencyRef = document.querySelector('.header__currency');

    let flagItem = true;
    function setItem() {
        if(window.innerWidth < 1241 && flagItem) {
            flagItem = false;
            headerMenuMobile.insertBefore(headerNav, headerMenuRef);
            headerMenuDesktop.insertBefore(headerWeather, headerBurgerRef);
            headerMenuMobile.appendChild(headerSocials);
        } else if(window.innerWidth > 1240 && !flagItem) {
            flagItem = true;
            headerMenuDesktop.insertBefore(headerNav, headerBurgerRef);
            headerMenuBot.insertBefore(headerWeather, headerCurrencyRef);
            headerMenuBot.insertBefore(headerSocials, headerCurrencyRef);
        }
    }
    setItem();
    window.addEventListener('resize', setItem);

    // tabs sidebar
    let newsActualBlock = document.querySelector('.news-actual__block');
    if(newsActualBlock) {
        newsActualBlock.addEventListener('click', ({target}) => {
            if(target.classList.contains('news-actual__header-tab')) {
                let targetId = target.getAttribute('data-id');
                newsActualBlock.querySelectorAll('.news-actual__header-tab').forEach(item => item.classList.remove('active'));
                target.classList.add('active');
                newsActualBlock.querySelectorAll('.news-actual__items').forEach(item => item.classList.remove('active'));
                newsActualBlock.querySelector(`.news-actual__items[data-id="${targetId}"]`).classList.add('active');
            }
        });
    }
});

window.onload = () => {
    // $.fn.setCursorPosition = function(pos) {
    //     if ($(this).get(0).setSelectionRange) {
    //         $(this).get(0).setSelectionRange(pos, pos)
    //     } else if ($(this).get(0).createTextRange) {
    //         var range = $(this).get(0).createTextRange()
    //         range.collapse(true)
    //         range.moveEnd('character', pos)
    //         range.moveStart('character', pos)
    //         range.select()
    //     }
    // }
    // $('input[type="tel"]').on('click', function() {
    //     $(this).setCursorPosition(3)
    // }).mask('+7 (999) 999 99 99')

    // $('.way').waypoint({
    //     handler: function() {
    //         $(this.element).addClass("way--active");

    //     },
    //     offset: '88%'
    // });

    $('.header__currency').slick({
        slidesToShow: 3,
        variableWidth: true,
        arrows: false,
        dots: false,
        responsive: [
            {
                breakpoint: 1240,
                settings: {
                    autoplay: true,
                    slidesToShow: 1,
                    variableWidth: false,
                    fade: true,
                }
            }
        ]
    });

    let heroSwiper = new Swiper('.hero__swiper', {
        slidePerView: 'auto',
        effect: 'fade',
        autoplay: true,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        }
    });

    var activeAccordion = null; // переменная для хранения ссылки на текущий открытый блок

    $(".js-accordeons__item-body").hide(); // скрываем все блоки с контентом при загрузке страницы

    $(".js-accordeons__item-title").click(function () {
        // при клике на заголовок
        var accordionBody = $(this).next(".js-accordeons__item-body"); // находим блок контента, соответствующий данному заголовку
        if (accordionBody.is(":hidden")) {
            // если контент скрыт, то
            if (activeAccordion) {
                // если уже есть открытый блок
                activeAccordion.slideToggle(); // скрываем его
                activeAccordion
                    .prev(".js-accordeons__item-title")
                    .removeClass("active"); // удаляем класс "active" у соответствующего заголовка
            }
            $(this).addClass("active"); // открываем текущий блок
            accordionBody.slideToggle(); // плавно отображаем контент
            activeAccordion = accordionBody; // сохраняем ссылку на текущий открытый блок
        } else {
            // иначе
            $(this).removeClass("active"); // закрываем текущий блок
            accordionBody.slideToggle(); // плавно скрываем контент
            activeAccordion = null; // удаляем ссылку на открытый блок
        }
    });

    $('.marquee').marquee({
        direction: 'left',
        speed: 100,
    });

    let ytWidget = document.querySelector('.yottie-widget-inner > a');
    if(ytWidget) {
        ytWidget.remove();
    }
};

// loader func
function submitForm() {
    $('#form_loader').show();
}
//Alert form
let alertt = document.querySelector(".alert--fixed");
let alertClose = document.querySelectorAll(".alert--close")
for (let item of alertClose) {
    item.addEventListener('click', function(event) {
        alertt.classList.remove("alert--active")
        alertt.classList.remove("alert--warning")
        alertt.classList.remove("alert--error")
    })
}