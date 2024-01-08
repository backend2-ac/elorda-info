/*nav*/
const hamburger = document.querySelector(".hamburger");
const headerNavLinks = document.querySelector(".header__nav__links");

hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active-nav");
    headerNavLinks.classList.toggle("active-nav");
})

document.querySelectorAll(".header__list__item").forEach(n => n.addEventListener("click", () => {
    hamburger.classList.remove(".active-nav");
    headerNavLinks.classList.remove(".active-nav");

}))

/* modal btn */
const openModalButtons = document.querySelectorAll('[data-modal-target]')
const closeModalButtons = document.querySelectorAll('[data-close-button]')
const overlay = document.getElementById('overlay')

if (openModalButtons.length != 0) {
    openModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modal = document.querySelector(button.dataset.modalTarget)
            openModal(modal)
        })
    })
}
if (overlay) {
    overlay.addEventListener('click', () => {
        const modals = document.querySelectorAll('.modal.active')
        modals.forEach(modal => {
            closeModal(modal)
        })
    })
}

if (closeModalButtons.length != 0) {
    closeModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modal = button.closest('.modal')
            closeModal(modal)
        })
    })
}


function openModal(modal) {
    if (modal == null) return
    modal.classList.add('active')
    overlay.classList.add('active')
}

function closeModal(modal) {
    if (modal == null) return
    modal.classList.remove('active')
    overlay.classList.remove('active')
}

/** */
$('.news__cards').slick({
    infinite: true,
    autoplay: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    dots: true,
    dotsClass: 'slick-dots slider__dots',
    customPaging: function(slider, i) {
        return '<button> <svg class="svg-dots" width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="5" cy="5" r="5" fill="white"/></svg> </button>';
    },
    prevArrow: '<button type="button" class="slick_arrow slick-prev"><svg width="41" height="12" viewBox="0 0 41 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.46967 5.46967C0.176777 5.76256 0.176777 6.23744 0.46967 6.53033L5.24264 11.3033C5.53553 11.5962 6.01041 11.5962 6.3033 11.3033C6.59619 11.0104 6.59619 10.5355 6.3033 10.2426L2.06066 6L6.3033 1.75736C6.59619 1.46447 6.59619 0.989593 6.3033 0.696699C6.01041 0.403806 5.53553 0.403806 5.24264 0.696699L0.46967 5.46967ZM41 5.25H1V6.75H41V5.25Z" fill="url(#paint0_linear_299_2404)"/><defs><linearGradient id="paint0_linear_299_2404" x1="21" y1="6" x2="21" y2="7" gradientUnits="userSpaceOnUse"><stop stop-color="#353643"/><stop offset="1" stop-color="#3A4C5F"/></linearGradient></defs></svg></button>',
    nextArrow: '<button type="button" class="slick_arrow slick-next"><svg width="41" height="12" viewBox="0 0 41 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M40.5303 5.46967C40.8232 5.76256 40.8232 6.23744 40.5303 6.53033L35.7574 11.3033C35.4645 11.5962 34.9896 11.5962 34.6967 11.3033C34.4038 11.0104 34.4038 10.5355 34.6967 10.2426L38.9393 6L34.6967 1.75736C34.4038 1.46447 34.4038 0.989593 34.6967 0.696699C34.9896 0.403806 35.4645 0.403806 35.7574 0.696699L40.5303 5.46967ZM0 5.25H40V6.75H0V5.25Z" fill="white"/></svg></button>',
    appendArrows: '.news__cards--arrows',
    responsive: [{
            breakpoint: 1460,
            settings: {
                slidesToShow: 3,
            },
        },
        {
            breakpoint: 1160,
            settings: {
                slidesToShow: 2,

                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 692,
            settings: {
                slidesToShow: 2,

                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 500,
            settings: {
                slidesToShow: 1,

                slidesToScroll: 1,
            },
        }
    ]
});


$('.steps__cards').slick({
    infinite: true,
    autoplay: false,
    slidesToShow: 3,
    slidesToScroll: 2,
    arrows: true,
    dots: true,
    dotsClass: 'slick-dots slider__dots',
    customPaging: function(slider, i) {
        return '<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="5" cy="5" r="5" fill="#31353D"/></svg>';
    },
    prevArrow: '<button type="button" class="slick_arrow slick-prev"><svg width="41" height="12" viewBox="0 0 41 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.46967 5.46967C0.176777 5.76256 0.176777 6.23744 0.46967 6.53033L5.24264 11.3033C5.53553 11.5962 6.01041 11.5962 6.3033 11.3033C6.59619 11.0104 6.59619 10.5355 6.3033 10.2426L2.06066 6L6.3033 1.75736C6.59619 1.46447 6.59619 0.989593 6.3033 0.696699C6.01041 0.403806 5.53553 0.403806 5.24264 0.696699L0.46967 5.46967ZM41 5.25H1V6.75H41V5.25Z" fill="url(#paint0_linear_299_2404)"/><defs><linearGradient id="paint0_linear_299_2404" x1="21" y1="6" x2="21" y2="7" gradientUnits="userSpaceOnUse"><stop stop-color="#353643"/><stop offset="1" stop-color="#3A4C5F"/></linearGradient></defs></svg></button>',
    nextArrow: '<button type="button" class="slick_arrow slick-next"><svg width="41" height="12" viewBox="0 0 41 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M40.5303 5.46967C40.8232 5.76256 40.8232 6.23744 40.5303 6.53033L35.7574 11.3033C35.4645 11.5962 34.9896 11.5962 34.6967 11.3033C34.4038 11.0104 34.4038 10.5355 34.6967 10.2426L38.9393 6L34.6967 1.75736C34.4038 1.46447 34.4038 0.989593 34.6967 0.696699C34.9896 0.403806 35.4645 0.403806 35.7574 0.696699L40.5303 5.46967ZM0 5.25H40V6.75H0V5.25Z" fill="white"/></svg></button>',
    appendArrows: '.steps__cards--arrows',
    responsive: [{
        breakpoint: 1260,
        settings: {
            slidesToShow: 2,
        },
    }, {
        breakpoint: 692,
        settings: {
            slidesToShow: 1,

            slidesToScroll: 1,
        },
    }]

});

/** */
function mobileOnlySlider() {
    $('.benefits__container').slick({
        autoplay: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<button type="button" class="slick_arrow slick-prev"><svg width="41" height="12" viewBox="0 0 41 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.46967 5.46967C0.176777 5.76256 0.176777 6.23744 0.46967 6.53033L5.24264 11.3033C5.53553 11.5962 6.01041 11.5962 6.3033 11.3033C6.59619 11.0104 6.59619 10.5355 6.3033 10.2426L2.06066 6L6.3033 1.75736C6.59619 1.46447 6.59619 0.989593 6.3033 0.696699C6.01041 0.403806 5.53553 0.403806 5.24264 0.696699L0.46967 5.46967ZM41 5.25H1V6.75H41V5.25Z" fill="url(#paint0_linear_299_2404)"/><defs><linearGradient id="paint0_linear_299_2404" x1="21" y1="6" x2="21" y2="7" gradientUnits="userSpaceOnUse"><stop stop-color="#353643"/><stop offset="1" stop-color="#3A4C5F"/></linearGradient></defs></svg></button>',
        nextArrow: '<button type="button" class="slick_arrow slick-next"><svg width="41" height="12" viewBox="0 0 41 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M40.5303 5.46967C40.8232 5.76256 40.8232 6.23744 40.5303 6.53033L35.7574 11.3033C35.4645 11.5962 34.9896 11.5962 34.6967 11.3033C34.4038 11.0104 34.4038 10.5355 34.6967 10.2426L38.9393 6L34.6967 1.75736C34.4038 1.46447 34.4038 0.989593 34.6967 0.696699C34.9896 0.403806 35.4645 0.403806 35.7574 0.696699L40.5303 5.46967ZM0 5.25H40V6.75H0V5.25Z" fill="white"/></svg></button>',
        appendArrows: '.benefits__cards__arrows'
    });
}

let sliderMain = document.querySelector('.benefits__container');
if (sliderMain) {
    if (window.innerWidth < 593) {
        mobileOnlySlider();
    }
}


$(window).resize(function(e) {
    if (window.innerWidth < 593) {
        if (!$('.benefits__container').hasClass('slick-initialized')) {
            mobileOnlySlider();
        }

    } else {
        if ($('.benefits__container').hasClass('slick-initialized')) {
            $('.benefits__container').slick('unslick');
        }
    }
});



/*tabs */
document.addEventListener('DOMContentLoaded', () => {
    function tabsMain() {
        let descParentTabs = document.querySelector('.tab-head')
        let btn = document.querySelectorAll('.tablink');
        // let block = document.querySelectorAll('.tabcontent');
        // btn.forEach((key, index) => {
        //     key.addEventListener('click', function() {
        //         block.forEach((item, itemindex) => {
        //             item.classList.toggle('active', index === itemindex)
        //             item.animate([
        //                 { opacity: '0' },
        //                 { opacity: '1' }
        //             ], { duration: 200, easing: 'ease-in' })
        //         });
        //     });
        // });
        if (descParentTabs) {
            descParentTabs.addEventListener('click', (e) => {
                const target = e.target
                if (target.classList.contains('tablink')) {
                    btn.forEach(item => {
                        item.classList.remove('tab-active')
                    })
                }
                target.classList.add('tab-active')
            });
        }

    }
    tabsMain();
    $('.plans__slider').slick({
        autoplay: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: '<button type="button" class="slick_arrow slick-prev"><svg width="41" height="12" viewBox="0 0 41 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.46967 5.46967C0.176777 5.76256 0.176777 6.23744 0.46967 6.53033L5.24264 11.3033C5.53553 11.5962 6.01041 11.5962 6.3033 11.3033C6.59619 11.0104 6.59619 10.5355 6.3033 10.2426L2.06066 6L6.3033 1.75736C6.59619 1.46447 6.59619 0.989593 6.3033 0.696699C6.01041 0.403806 5.53553 0.403806 5.24264 0.696699L0.46967 5.46967ZM41 5.25H1V6.75H41V5.25Z" fill="url(#paint0_linear_299_2404)"/><defs><linearGradient id="paint0_linear_299_2404" x1="21" y1="6" x2="21" y2="7" gradientUnits="userSpaceOnUse"><stop stop-color="#353643"/><stop offset="1" stop-color="#3A4C5F"/></linearGradient></defs></svg></button>',
        nextArrow: '<button type="button" class="slick_arrow slick-next"><svg width="41" height="12" viewBox="0 0 41 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M40.5303 5.46967C40.8232 5.76256 40.8232 6.23744 40.5303 6.53033L35.7574 11.3033C35.4645 11.5962 34.9896 11.5962 34.6967 11.3033C34.4038 11.0104 34.4038 10.5355 34.6967 10.2426L38.9393 6L34.6967 1.75736C34.4038 1.46447 34.4038 0.989593 34.6967 0.696699C34.9896 0.403806 35.4645 0.403806 35.7574 0.696699L40.5303 5.46967ZM0 5.25H40V6.75H0V5.25Z" fill="white"/></svg></button>',
        appendArrows: '.plans__arrows',
        adaptiveHeight: true,
        fade: true,
    })

    let plansSection = document.querySelector('.plans')
    let roomElems = document.querySelectorAll('.plans__dropdown-item.room');
    let areaElems = document.querySelectorAll('.plans__dropdown-item.area');
    let inputRoom = document.querySelector('#room');
    let inputFloor = document.querySelector('#floor');
    let inputArea = document.querySelector('#area');
    let inputQueue = document.querySelector('#queue');
    if (plansSection) {

        plansSection.addEventListener('click', e => {
            const target = e.target;
            if (target.classList.contains('room')) {
                areaElems.forEach(area => area.classList.remove('selected'))
                roomElems.forEach(item => item.classList.remove('active'))
                target.classList.add('active');
                setAreaDropDown();
                // let selectedArea = document.querySelector('.plans__dropdown-item.area.active');
                // selectedArea.classList.add('selected');
                filterSliderPlans();
                $('.plans__dropdown').slideUp();
                $('.plans__tabs-item').removeClass('active');
                if (inputRoom) {
                    inputRoom.value = target.getAttribute('data-room');
                    // console.log(inputRoom.value)
                }
            }
            if (target.classList.contains('area')) {
                areaElems.forEach(area => area.classList.remove('selected'))
                target.classList.add('selected');
                $('.plans__slider').slick('slickUnfilter');
                $('.plans__slider').slick('slickFilter', `[data-area="${target.getAttribute('data-area')}"]`);
                // filterSliderPlans();
                $('.plans__dropdown').slideUp();
                $('.plans__tabs-item').removeClass('active')
                inputArea.value = target.getAttribute('data-area');
                console.log(inputArea.value)
            }
            if (target.classList.contains('floor')) {
                inputFloor.value = target.getAttribute('data-floor');
                console.log(inputFloor.value)
                $('.plans__dropdown').slideUp();
                $('.plans__tabs-item').removeClass('active')
            }
            if (target.classList.contains('queue')) {
                inputQueue.value = target.getAttribute('data-room');
                console.log(inputQueue.value)
            }
        })

        function setAreaDropDown() {
            let activeRoom = document.querySelector('.plans__dropdown-item.room.active').getAttribute('data-room');
            let activeArea = document.querySelectorAll('.plans__dropdown-item.area');
            activeArea.forEach(area => {
                if (activeRoom === area.getAttribute('data-room')) {
                    area.classList.add('active');
                } else {
                    area.classList.remove('active')
                }
            })
        }
        setAreaDropDown();

        function filterSliderPlans() {
            let activeRoom = document.querySelector('.plans__dropdown-item.room.active').getAttribute('data-room');
            // let activeArea = document.querySelector('.plans__dropdown-item.area.selected').getAttribute('data-area');
            // console.log(activeRoom)
            // console.log(activeArea)
            $('.plans__slider').slick('slickUnfilter');
            $('.plans__slider').slick('slickFilter', `[data-room="${activeRoom}"]`);
            // $('.plans__slider').slick('slickFilter', `[data-area="${activeArea}"]`);
        }

        filterSliderPlans();
    }
    // Add class header
    window.addEventListener('scroll', addClassHeader)
    let header = document.querySelector('.header')
    if (header) {
        addClassHeader();
    }

    function addClassHeader() {
        if (window.scrollY > 50) {
            header.classList.add('active')
        } else {
            header.classList.remove('active')
        }
    }
})

/*arrow tabs */
// document.addEventListener('DOMContentLoaded', () => {
//     function tabsMainA() {
//         let descParentTabs = document.querySelector('.tab-head')
//         let btn = document.querySelectorAll('.tablink');
//         let block = document.querySelectorAll('.slick_arrow');

//         btn.forEach((key, index) => {
//             key.addEventListener('click', function() {
//                 block.forEach((item, itemindex) => {
//                     item.classList.toggle('activea', index === itemindex)
//                     item.animate([
//                         { opacity: '0' },
//                         { opacity: '1' }
//                     ], { duration: 200, easing: 'ease-in' })
//                 });
//             });
//         });

//         descParentTabs.addEventListener('click', (e) => {
//             const target = e.target
//             if (target.classList.contains('tablink')) {
//                 btn.forEach(item => {
//                     item.classList.remove('tab-active')
//                 })
//             }
//             target.classList.add('tab-active')
//         });
//     }
//     tabsMainA();
// })

/**slider for tabs */
var helpers = {
    addZeros: function(n) {
        return (n < 10) ? '0' + n : '' + n;
    }
};

/**first tab */
function sliderInit() {
    var $slider = $('.tab__slider');

    $($slider).slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        dots: false,
        infinite: true,
        arrows: true,
        prevArrow: '<button type="button" class="slick_arrow slick-prev"><svg width="41" height="12" viewBox="0 0 41 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.46967 5.46967C0.176777 5.76256 0.176777 6.23744 0.46967 6.53033L5.24264 11.3033C5.53553 11.5962 6.01041 11.5962 6.3033 11.3033C6.59619 11.0104 6.59619 10.5355 6.3033 10.2426L2.06066 6L6.3033 1.75736C6.59619 1.46447 6.59619 0.989593 6.3033 0.696699C6.01041 0.403806 5.53553 0.403806 5.24264 0.696699L0.46967 5.46967ZM41 5.25H1V6.75H41V5.25Z" fill="url(#paint0_linear_299_2404)"/><defs><linearGradient id="paint0_linear_299_2404" x1="21" y1="6" x2="21" y2="7" gradientUnits="userSpaceOnUse"><stop stop-color="#353643"/><stop offset="1" stop-color="#3A4C5F"/></linearGradient></defs></svg></button>',
        nextArrow: '<button type="button" class="slick_arrow slick-next"><svg width="41" height="12" viewBox="0 0 41 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M40.5303 5.46967C40.8232 5.76256 40.8232 6.23744 40.5303 6.53033L35.7574 11.3033C35.4645 11.5962 34.9896 11.5962 34.6967 11.3033C34.4038 11.0104 34.4038 10.5355 34.6967 10.2426L38.9393 6L34.6967 1.75736C34.4038 1.46447 34.4038 0.989593 34.6967 0.696699C34.9896 0.403806 35.4645 0.403806 35.7574 0.696699L40.5303 5.46967ZM0 5.25H40V6.75H0V5.25Z" fill="white"/></svg></button>',
        appendArrows: '.q__arrows'

    });


    $slider.each(function() {
        var $sliderParent = $(this).parent();

        if ($(this).find('.tab__item').length > 1) {
            $(this).siblings('.slides-numbers').show();
        }

        $(this).on('afterChange', function(event, slick, currentSlide) {
            $sliderParent.find('.slides-numbers .active').html(helpers.addZeros(currentSlide + 1));
        });

        var sliderItemsNum = $(this).find('.slick-slide').not('.slick-cloned').length;
        $sliderParent.find('.slides-numbers .total').html(helpers.addZeros(sliderItemsNum));


    });


};
sliderInit();




// /**2nd tab */
// function sliderInitTwo() {
//     var $slider = $('.tab__slider--2');
//     $slider.each(function() {
//         var $sliderParent = $(this).parent();
//         $(this).slick({
//             slidesToShow: 1,
//             slidesToScroll: 1,
//             fade: true,
//             dots: false,
//             infinite: true,
//             prevArrow: '<button type="button" class="slick_arrow slick-prev"><svg width="129" height="50" viewBox="0 0 129 50" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M127.793 0.5L78.7929 49.5H0.5V0.5H127.793Z" stroke="#C4C4C4"/><path d="M29.4697 24.4697C29.1768 24.7626 29.1768 25.2374 29.4697 25.5303L34.2426 30.3033C34.5355 30.5962 35.0104 30.5962 35.3033 30.3033C35.5962 30.0104 35.5962 29.5355 35.3033 29.2426L31.0607 25L35.3033 20.7574C35.5962 20.4645 35.5962 19.9896 35.3033 19.6967C35.0104 19.4038 34.5355 19.4038 34.2426 19.6967L29.4697 24.4697ZM70 24.25H30V25.75H70V24.25Z" fill="white"/></svg></button>',
//             nextArrow: '<button type="button" class="slick_arrow slick-next"><svg width="129" height="50" viewBox="0 0 129 50" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M50 0H129V50H0L50 0Z" fill="#FF7400"/><path d="M99.5303 24.4697C99.8232 24.7626 99.8232 25.2374 99.5303 25.5303L94.7574 30.3033C94.4645 30.5962 93.9896 30.5962 93.6967 30.3033C93.4038 30.0104 93.4038 29.5355 93.6967 29.2426L97.9393 25L93.6967 20.7574C93.4038 20.4645 93.4038 19.9896 93.6967 19.6967C93.9896 19.4038 94.4645 19.4038 94.7574 19.6967L99.5303 24.4697ZM59 24.25H99V25.75H59V24.25Z" fill="white"/></svg></button>',
//             appendArrows: '.sec__arrows'
//         });

//         if ($(this).find('.tab__item--2').length > 1) {
//             $(this).siblings('.slides-numbers').show();
//         }

//         $(this).on('afterChange', function(event, slick, currentSlide) {
//             $sliderParent.find('.slides-numbers .active').html(helpers.addZeros(currentSlide + 1));
//         });

//         var sliderItemsNum = $(this).find('.slick-slide').not('.slick-cloned').length;
//         $sliderParent.find('.slides-numbers .total').html(helpers.addZeros(sliderItemsNum));

//     });
// };
// sliderInitTwo();

// /**3 tab */
// function sliderInitThree() {
//     var $slider = $('.tab__slider--3');
//     $slider.each(function() {
//         var $sliderParent = $(this).parent();
//         $(this).slick({
//             fade: true,
//             slidesToShow: 1,
//             slidesToScroll: 1,
//             dots: false,
//             infinite: true,
//             prevArrow: '<button type="button" class="slick_arrow slick-prev"><svg width="129" height="50" viewBox="0 0 129 50" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M127.793 0.5L78.7929 49.5H0.5V0.5H127.793Z" stroke="#C4C4C4"/><path d="M29.4697 24.4697C29.1768 24.7626 29.1768 25.2374 29.4697 25.5303L34.2426 30.3033C34.5355 30.5962 35.0104 30.5962 35.3033 30.3033C35.5962 30.0104 35.5962 29.5355 35.3033 29.2426L31.0607 25L35.3033 20.7574C35.5962 20.4645 35.5962 19.9896 35.3033 19.6967C35.0104 19.4038 34.5355 19.4038 34.2426 19.6967L29.4697 24.4697ZM70 24.25H30V25.75H70V24.25Z" fill="white"/></svg></button>',
//             nextArrow: '<button type="button" class="slick_arrow slick-next"><svg width="129" height="50" viewBox="0 0 129 50" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M50 0H129V50H0L50 0Z" fill="#FF7400"/><path d="M99.5303 24.4697C99.8232 24.7626 99.8232 25.2374 99.5303 25.5303L94.7574 30.3033C94.4645 30.5962 93.9896 30.5962 93.6967 30.3033C93.4038 30.0104 93.4038 29.5355 93.6967 29.2426L97.9393 25L93.6967 20.7574C93.4038 20.4645 93.4038 19.9896 93.6967 19.6967C93.9896 19.4038 94.4645 19.4038 94.7574 19.6967L99.5303 24.4697ZM59 24.25H99V25.75H59V24.25Z" fill="white"/></svg></button>',
//             appendArrows: '.third__arrows'
//         });

//         if ($(this).find('.tab__item--3').length > 1) {
//             $(this).siblings('.slides-numbers').show();
//         }

//         $(this).on('afterChange', function(event, slick, currentSlide) {
//             $sliderParent.find('.slides-numbers .active').html(helpers.addZeros(currentSlide + 1));
//         });

//         var sliderItemsNum = $(this).find('.slick-slide').not('.slick-cloned').length;
//         $sliderParent.find('.slides-numbers .total').html(helpers.addZeros(sliderItemsNum));

//     });
// };
// sliderInitThree();



$('.gallery__slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    centerMode: true,
    variableWidth: true,
    prevArrow: '<button type="button" class="slick_arrow slick-prev"><svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg"><circle r="29.5" transform="matrix(-1 0 0 1 30 30)" stroke="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M34.2174 20.7829C33.7292 20.2947 32.9378 20.2947 32.4496 20.7829L24.1163 29.1162C23.6281 29.6044 23.6281 30.3958 24.1163 30.884L32.4496 39.2173C32.9378 39.7055 33.7292 39.7055 34.2174 39.2173C34.7055 38.7291 34.7055 37.9377 34.2174 37.4495L26.7679 30.0001L34.2174 22.5506C34.7055 22.0625 34.7055 21.271 34.2174 20.7829Z" fill="white"/></svg></button>',
    nextArrow: '<button type="button" class="slick_arrow slick-next"><svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="30" cy="30" r="29.5" stroke="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M25.7826 20.7829C26.2708 20.2947 27.0622 20.2947 27.5504 20.7829L35.8837 29.1162C36.3719 29.6044 36.3719 30.3958 35.8837 30.884L27.5504 39.2173C27.0622 39.7055 26.2708 39.7055 25.7826 39.2173C25.2945 38.7291 25.2945 37.9377 25.7826 37.4495L33.2321 30.0001L25.7826 22.5506C25.2945 22.0625 25.2945 21.271 25.7826 20.7829Z" fill="white"/></svg></button>',
    responsive: [{
        breakpoint: 550,
        settings: {
            centerMode: false,
            variableWidth: false,
        }
    }]
});

$('.partner__slider').slick({
    autoplay: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    prevArrow: '<button type="button" class="slick_arrow slick-prev"><svg width="41" height="12" viewBox="0 0 41 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.46967 5.46967C0.176777 5.76256 0.176777 6.23744 0.46967 6.53033L5.24264 11.3033C5.53553 11.5962 6.01041 11.5962 6.3033 11.3033C6.59619 11.0104 6.59619 10.5355 6.3033 10.2426L2.06066 6L6.3033 1.75736C6.59619 1.46447 6.59619 0.989593 6.3033 0.696699C6.01041 0.403806 5.53553 0.403806 5.24264 0.696699L0.46967 5.46967ZM41 5.25H1V6.75H41V5.25Z" fill="url(#paint0_linear_299_2404)"></path><defs><linearGradient id="paint0_linear_299_2404" x1="21" y1="6" x2="21" y2="7" gradientUnits="userSpaceOnUse"><stop stop-color="#353643"></stop><stop offset="1" stop-color="#3A4C5F"></stop></linearGradient></defs></svg></button>',
    nextArrow: '<button type="button" class="slick_arrow slick-next"><svg width="41" height="12" viewBox="0 0 41 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M40.5303 5.46967C40.8232 5.76256 40.8232 6.23744 40.5303 6.53033L35.7574 11.3033C35.4645 11.5962 34.9896 11.5962 34.6967 11.3033C34.4038 11.0104 34.4038 10.5355 34.6967 10.2426L38.9393 6L34.6967 1.75736C34.4038 1.46447 34.4038 0.989593 34.6967 0.696699C34.9896 0.403806 35.4645 0.403806 35.7574 0.696699L40.5303 5.46967ZM0 5.25H40V6.75H0V5.25Z" fill="white"></path></svg></button>',
    appendArrows: '.partners__arrows',
    responsive: [{
            breakpoint: 1360,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 550,
            settings: {
                slidesToShow: 1,
            }
        }
    ]
});


// document.querySelectorAll('.tablink').forEach(el => {

//     el.addEventListener('click', () => {
//         const arrowsQ = document.querySelectorAll('.q__arrows button')

//         if (el.innerText == 'архитектура') {
//             arrowsQ.forEach(el => {
//                 el.classList.remove('active')
//             })
//             arrowsQ[2].classList.add('active')
//             arrowsQ[3].classList.add('active')
//             $('.tabcontent.active .tab__slider').slick('setPosition');
//         } else if (el.innerText == 'инфраструктура') {
//             arrowsQ.forEach(el => {
//                 el.classList.remove('active')
//             })
//             arrowsQ[1].classList.add('active')
//             arrowsQ[4].classList.add('active')
//             $('.tabcontent.active .tab__slider').slick('setPosition');
//         } else if (el.innerText == 'интерьер') {
//             arrowsQ.forEach(el => {
//                 el.classList.remove('active')
//             })
//             arrowsQ[0].classList.add('active')
//             arrowsQ[5].classList.add('active')
//             $('.tabcontent.active .tab__slider').slick('setPosition');
//         }
//         arrowsQ.forEach(el => {
//             el.style.display = 'none';
//         })
//     })
// })
// document.querySelectorAll('.tablink')[0].click()

$('.tab__slider').slick('slickFilter', '.architecture_slide');
let total = document.querySelectorAll('.architecture_slide')
let totalHtml = document.querySelector('.slides-numbers .total')
if (totalHtml) {
    totalHtml.innerHTML = '0' + total.length;
}
$('.tab-head').on("click", function(event) {
    var target = event.target;
    var clsName = $(target).attr('data-id');

    if ($(target).hasClass('tablink')) {
        $('.tablink').removeClass('active');
        $(target).addClass('active');
        if (clsName == 'architecture_slide') {
            $('.tab__slider').slick('slickUnfilter');
            $('.tab__slider').slick('slickFilter', '.architecture_slide');
            let total = document.querySelectorAll('.architecture_slide')
            let totalHtml = document.querySelector('.slides-numbers .total')
            totalHtml.innerHTML = '0' + total.length;
        } else if (clsName == 'infrastructure_slide') {
            $('.tab__slider').slick('slickUnfilter');
            $('.tab__slider').slick('slickFilter', '.infrastructure_slide');
            let total = document.querySelectorAll('.infrastructure_slide')
            let totalHtml = document.querySelector('.slides-numbers .total')
            totalHtml.innerHTML = '0' + total.length;
        } else if (clsName == 'interior_slide') {
            $('.tab__slider').slick('slickUnfilter');
            $('.tab__slider').slick('slickFilter', '.interior_slide');
            let total = document.querySelectorAll('.interior_slide')
            let totalHtml = document.querySelector('.slides-numbers .total')
            totalHtml.innerHTML = '0' + total.length;
        }
        $('.tab__slider').slick('slickGoTo', 0);
    }
});

$('.gallery__filter').on("click", function(event) {
    var target = event.target;
    var clsName = $(target).attr('data-id');

    if ($(target).hasClass('gallery__filter-item')) {
        $('.gallery__filter-item').removeClass('active');
        $(target).addClass('active');
        if (clsName == 'hol_slide') {
            $('.gallery__slider').slick('slickUnfilter');
            $('.gallery__slider').slick('slickFilter', '.hol_slide');
        } else if (clsName == 'architecture_slide') {
            $('.gallery__slider').slick('slickUnfilter');
            $('.gallery__slider').slick('slickFilter', '.architecture_slide');
        } else if (clsName == 'plans_slide') {
            $('.gallery__slider').slick('slickUnfilter');
            $('.gallery__slider').slick('slickFilter', '.plans_slide');
        } else if (clsName == 'infra_slide') {
            $('.gallery__slider').slick('slickUnfilter');
            $('.gallery__slider').slick('slickFilter', '.infra_slide');
        }
        $('.gallery__slider').slick('slickGoTo', 0);
    }
});

$('.complex__slider-big').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    fade: true,
    prevArrow: '<button type="button" class="slick_arrow slick-prev"><svg width="31" height="57" viewBox="0 0 31 57" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M29 2L2 28.5L29 55" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg></button>',
    nextArrow: '<button type="button" class="slick_arrow slick-next"><svg width="31" height="57" viewBox="0 0 31 57" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 2L29 28.5L2 55" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg></button>',
    asNavFor: '.complex__slider-mini',
})

$('.complex__slider-mini').slick({
    autoplay: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: '.complex__slider-big',
    arrows: false,
    focusOnSelect: true,
    dots: true,
    responsive: [{
            breakpoint: 1260,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 650,
            settings: {
                slidesToShow: 2,
            }
        }
    ]
})

$('.plans__tabs-item').on("click", function(e) {
    const target = e.target
    if (target.classList.contains('active')) {
        $(target.nextElementSibling).slideUp();
        target.classList.remove('active')
            // console.log(target)
    } else {
        $('.plans__dropdown').slideUp();
        $(target.nextElementSibling).slideDown();
        $('.plans__tabs-item').removeClass('active')
        target.classList.add('active')
    }
});


// $("#phone").mask("+7(999)999-99-99");