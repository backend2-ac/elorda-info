// let tel = document.querySelectorAll(".tel");

$(document).ready(function() {
    $(".tel").each(function() { $(this).inputmask("+7(999)-999-9999", { "clearIncomplete": true }) });
    $(".age").each(function() { $(this).inputmask("99-99 лет", ) });
    $('.email').inputmask({
        mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
        greedy: false,
        onBeforePaste: function(pastedValue, opts) {
            pastedValue = pastedValue.toLowerCase();
            return pastedValue.replace("mailto:", "");
        },
        definitions: {
            '*': {
                validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                cardinality: 1,
                casing: "lower"
            }
        }
    });
});



$(document).ready(function() {

    $('input[type="file"]').each(function() {
        $(this).change(function(e) {
            let target = e.target;
            console.log(target)
            var value = $(target).val().replace(/.*(\/|\\)/, '');
            $(target.previousElementSibling).text(value);
        });
    })

});


let alertt = document.querySelector(".alert--fixed");
let alertClose = document.querySelectorAll(".alert--close")
for (let item of alertClose) {
    item.addEventListener('click', function(event) {
        alertt.classList.remove("alert--active")
        alertt.classList.remove("alert--warning")
        alertt.classList.remove("alert--error")
    })
}


const header = document.querySelector(".header");

window.addEventListener("scroll", function(e) {
    let scrollPos = window.scrollY;
    if (header) {
        if (scrollPos > 0) {
            header.classList.add("active");
        } else {
            header.classList.remove("active")
        }
    }
});


const menuBurger = document.querySelector('.menu__burger');
if (menuBurger) {
    const headerMenu = document.querySelector('.header-block__fixed');
    const headerMenuClose = document.querySelector('.header-block__close');
    headerMenuClose.addEventListener('click', function() {
        menuBurger.classList.remove('active');
        headerMenu.classList.remove('active');
        document.body.classList.remove('_actived')
    });
    menuBurger.addEventListener("click", function(e) {
        menuBurger.classList.toggle('active');
        headerMenu.classList.toggle('active');
        document.body.classList.toggle('_actived')
    });
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('header-block__fixed')) {
            menuBurger.classList.remove('active');
            headerMenu.classList.remove('active');
            document.body.classList.remove('_actived')
        }
    })
}

$(document).on("click", function(event) {
    var target = event.target;
    if (!$(target).hasClass('menu__link')) {
        $('.menu-two').slideUp();
        $('.list-icon').removeClass('active');
    }
});
$('.menu__link').on("click", function() {
    $(this).siblings('.menu-two').slideToggle();
    $(this).parent('.list-icon').toggleClass('active');
});

$(document).on("click", function(event) {
    var target = event.target;
    if (!$(target).hasClass('lang_choice')) {
        $('.other_lang').slideUp();
        $('.lang_block').removeClass('active');
    }
});
$('.lang_choice').on("click", function() {
    $(this).siblings('.other_lang').slideToggle();
    $(this).parent('.lang_block').toggleClass('active');
});

$('.courses-bottom__link').on("click", function(e) {
    const target = e.target
    $(target.nextElementSibling).slideToggle();
    target.classList.toggle('active')
});

$('.fqa__top__text').on("click", function(e) {
    const target = e.target
    $(target.nextElementSibling).slideToggle();
    target.classList.toggle('active')
})

var time = 1;

$('#counter').each(function() {
    $('.main-block__counter').each(function() {
        let i = 1;
        let num = $(this).data('number');
        let step = Math.round(1000 * (time / num));
        let that = $(this);
        let int = setInterval(function() {
            if (i <= num) {
                that.html(i);
            } else {
                clearInterval(int)
            }
            i = i + 3;
        }, step);
    });
});

$('.header__kebab').on("click", function() {
    $('.settings-and-support-list').slideToggle('medium', function() {
        if ($(this).is(':visible'))
            $(this).css('display', 'flex');
    });
    $('body').toggleClass('active');
})

let publishInputDel = document.querySelector('.publush__vacancy__input');
if (publishInputDel) {
    publishInputDel.addEventListener("click", (e) => {
        let target = e.target;
        if (target.classList.contains('publish__input__del')) {
            target.previousElementSibling.value = "";
        }
    })
}

const tabsTwoBtn = document.querySelectorAll('.courses-list__menu li');
const tabTwoItems = document.querySelectorAll('.courses-bottom__row');
tabsTwoBtn.forEach(function(item) {
    item.addEventListener('click', function() {
        let currentBtn = item;
        let tabId = currentBtn.getAttribute('data-courses');
        let currentTab = document.querySelector(tabId);
        if (!currentBtn.classList.contains('active')) {
            tabTwoItems.forEach(function(item) {
                item.classList.remove('active');
            });
            tabsTwoBtn.forEach(function(item) {
                item.classList.remove('active');
            });
            currentBtn.classList.add('active');
            currentTab.classList.add('active');
        }
    });
});

let swiperOne = document.querySelector('.review__block');

if (swiperOne) {
    new Swiper('.swiper-container', {
        spaceBetween: 30,
        loop: false,
        freeMode: true,
        scrollbar: {
            el: '.swiper-scrollbar',
            draggable: true,
        },
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            // 500: {
            // 	slidesPerView: 1,
            // 	loop: false,
            // 	// loopedSlides: 0,
            // 	freeMode: true,
            // },
            0: {
                slidesPerView: 1,
            }
        },
        // touchratio: 1,
    });
}

let swiperTwo = document.querySelector('.swiper-two-container');

if (swiperTwo) {
    new Swiper('.swiper-two-container', {
        // slidesPerView: 1,
        slidesPerView: 4,
        // slidesPerView: 3,
        // slidesPerGroup: 5,
        loop: false,
        // loopedSlides: 0,
        freeMode: true,
        // longSwipes: false,
        // loopedSlides: 3,
        // longSwipesMs: 300,
        scrollbar: {
            el: '.swiper-scrollbar',
            draggable: true,
            // dragSize: 100,
            // 		spaceBetween: 10,
            //   centeredSlides: true,
            //   slidesPerView: "auto",
            //   touchRatio: 0.2,
            //   slideToClickedSlide: true
            // 	//   snapOnRelease: true,
            //   dragSize: 4,
            //   hide: false,
        },
        breakpoints: {
            992: {
                slidesPerView: 4,
                freeMode: true,
            },
            500: {
                slidesPerView: 3,
                freeMode: true,
            },
            500: {
                slidesPerView: 3,
                freeMode: true,
            },
        },
        // touchratio: 1,
    });

}

const rangeSlider = document.getElementById('range-slider');
let rangeMix = document.getElementById('range_1');
let rangeMax = document.getElementById('range_2');
if (rangeSlider) {
    console.log(rangeMax)
    noUiSlider.create(rangeSlider, {
        start: [rangeMix.value, rangeMax.value],
        connect: true,
        step: 1,
        limit: 94700,
        pips: {
            mode: 'values',
            values: [30000, 95000],
            density: 0,
            stepped: false
        },
        range: {
            'min': 30000,
            'max': 95000
        },
    });
    const input0 = document.getElementById('range_1');
    const input1 = document.getElementById('range_2');
    const inputs = [input0, input1];

    rangeSlider.noUiSlider.on('update', function(values, handle) {
        inputs[handle].value = Math.round(values[handle]);
        console.log(Math.round(values[handle]));
    });

    const setRangeSlider = (i, value) => {
        let arr = [null, null];
        arr[i] = value;

        console.log(arr);

        rangeSlider.noUiSlider.set(arr);
    };

    inputs.forEach((el, index) => {
        el.addEventListener('change', (e) => {
            console.log(index);
            setRangeSlider(index, e.currentTarget.value);
        });
    });
};

let showAll = document.querySelectorAll('.position__block');
showAll.forEach(element => {
    element.addEventListener("click", (e) => {
        let target = e.target;
        if (target.classList.contains("blue_link") && !target.classList.contains('active')) {
            target.classList.add("active")
                // target.nextElementSibling.classList.add("active");
            target.parentElement.classList.add("active")
        } else {
            target.classList.remove('active')
            target.parentElement.classList.remove("active")
        }
    })
})
let showAllRadio = document.querySelectorAll('.subject__block');
if (showAllRadio) {
    showAllRadio.forEach(elem => {
        elem.addEventListener("click", (e) => {
            let target = e.target;
            if (target.classList.contains("blue_link") && !target.classList.contains('active')) {
                target.classList.add("active")
                    // target.nextElementSibling.classList.add("active");
                target.parentElement.classList.add("active")
            } else {
                target.classList.remove('active')
                target.parentElement.classList.remove("active")
            }
        })
    })
}
let courseTabs = document.querySelector('.courses-bottom__menu');
if (courseTabs) {
    courseTabs.addEventListener("click", (e) => {
        let target = e.target;
        if (target.classList.contains("blue_link")) {
            target.classList.toggle("active")
            target.closest('.courses-bottom__menu').classList.toggle("active")
        }
    })
}
// if (showAllRadio) {
//     showAllRadio.forEach(elem => {
//         elem.addEventListener("click", (e) => {
//             let target = e.target;
//             if (target.classList.contains("blue_link") && !target.classList.contains('active')) {
//                 target.classList.add("active")
//                     // target.nextElementSibling.classList.add("active");
//                 target.parentElement.classList.add("active")
//             } else {
//                 target.classList.remove('active')
//                 target.parentElement.classList.remove("active")
//             }
//         })
//     })
// }

// let vacancyNotice = document.querySelectorAll('.vacancy__notice__block');
// if (vacancyNotice) {
//     vacancyNotice.forEach(elem => {
//         elem.addEventListener("click", function(e) {
//             let target = e.target;
//             if (target.classList.contains('notice__delete')) {
//                 let check = confirm("Вы действительно хотите удалить?");
//                 if (check) {
//                     target.closest('.vacancy__notice__block').remove();
//                 }

//             }
//         })

//     })
// }

const filterVacancyBlock = document.querySelector('.filter__vacancy__block');
if (filterVacancyBlock) {
    filterVacancyBlock.addEventListener("click", function(e) {
        let target = e.target;
        if (target.classList.contains('show__all')) {
            filterVacancyBlock.classList.add('active');
        } else if (target.classList.contains('hide__all')) {
            filterVacancyBlock.classList.remove('active');
        }
    })
}

// BLue Link Show More

const BlueLink = document.querySelectorAll('.resume__info__block');
if (BlueLink) {
    BlueLink.forEach(elem => {
        elem.addEventListener("click", function(e) {
            let target = e.target;
            if (target.classList.contains('blue__link')) {
                target.classList.toggle("active");
                elem.classList.toggle("active")
            }
        })
    })
}

let showPassBlock = document.querySelectorAll(".auth__block__input");
if (showPassBlock) {
    showPassBlock.forEach((elem) => {
        elem.addEventListener("click", function(e) {
            let target = e.target;
            if (target.classList.contains("password-control") && target.previousElementSibling.getAttribute('type') == 'password') {
                target.classList.add("view");
                target.previousElementSibling.setAttribute('type', 'text');
            } else if (target.classList.contains("password-control") && target.previousElementSibling.getAttribute('type') == 'text') {
                target.classList.remove("view");
                target.previousElementSibling.setAttribute('type', 'password');
            }
        })
    })
}


// ЛИЧНЫЙ КАБИНЕТ ВЫБОР СТРАНЫ И ГОРОДА

let countryCabinet = document.querySelector('.js-choice-country-cabinet');
let cityCabinetBtn = document.querySelector('.js-choice-city-cabinet');
let countryPopup = document.querySelector('#country-popup');
let cityPopup = document.querySelector('#city-popup');
if (countryCabinet) {
    // click
    countryCabinet.addEventListener('click', e => {
        let countryInput = document.querySelector(`.country-input[data-country='${countryPopup.getAttribute('data-id')}']`);
        let activeCity = cityPopup.querySelectorAll('.region-popup__block');
        let activeCountry = countryPopup.querySelectorAll('.region-popup__checkbox');
        activeCountry.forEach(input => {
            if (input.checked) {
                // console.log(input)
                let textInput = input.closest('.region-popup__label').textContent.trim();
                countryInput.value = textInput
                countryInput.closest('.js-register-input').querySelector('.hidden-input').value = input.id;
                activeCity.forEach(city => {
                    if (input.dataset.country === city.dataset.country) {
                        city.classList.add('show')
                    } else {
                        city.classList.remove('show')
                    }
                })
            }
        })
    })
}

if (cityCabinetBtn) {
    cityCabinetBtn.addEventListener('click', e => {
        let cityInput = document.querySelector(`.city-input[data-city='${cityPopup.getAttribute('data-id')}']`);
        let activeCity = cityPopup.querySelectorAll('.region-popup__checkbox');
        activeCity.forEach(input => {
            if (input.checked) {
                let textInput = input.closest('.region-popup__label').textContent.trim();
                cityInput.value = textInput;
                cityInput.closest('.js-register-input').querySelector('.hidden-input').value = input.id;
            }
        })
    })
}

document.addEventListener('click', e => {
    const target = e.target;
    // set popup id for country and city 
    if (target.classList.contains('js-input-icon')) {
        if (countryPopup) {
            countryPopup.setAttribute('data-id', target.getAttribute('data-id'));
        }
        if (cityPopup) {
            cityPopup.setAttribute('data-id', target.getAttribute('data-id'));
        }
    }
    // download pdf resume
    if (target.classList.contains('js-download-resume')) {
        let fileName = 'cv.pdf';
        if (target.getAttribute('data-name')) {
            fileName = target.getAttribute('data-name') + '.pdf';
        }
        $('#hidden-text-resume').show();
        var element = document.getElementById('element-to-print');
        var opt = {
            margin: 0.2,
            filename: fileName,
            image: { type: 'jpeg', quality: 1 },
            html2canvas: {
                windowWidht: 2000,
                scale: 1,
                onclone: () => {
                    $('#hidden-text-resume').hide();
                }
            },
            jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait', compress: true, },

        };
        html2pdf().from(element).set(opt).save();
        // setTimeout(() => {
        //     $('#hidden-text-resume').hide();
        // }, 200)
    }
})

// ЛИЧНЫЙ КАБИНЕТ ПОИСК ВАКАНСИИ

let countryVakSearch = document.querySelector('.js-choice-city-vakancy-search');
if (countryVakSearch) {
    let searchCityBlock = document.querySelector('.search-regions');
    let searchRegionsBlock = document.querySelector('.search-regions');
    let popupRegionsBlock = document.querySelector('.region-blocks');
    countryVakSearch.addEventListener('click', e => {
        let activeSearchRegion = document.querySelectorAll('.search-region');
        let activeCity = document.querySelectorAll('.popup .region-popup__checkbox');
        if (activeSearchRegion.length) {
            activeSearchRegion.forEach(region => {
                region.remove();
            })
        }
        activeCity.forEach(input => {
            if (input.checked) {
                let searchCity = document.createElement('div');
                searchCity.classList.add('search-region');
                searchCity.innerHTML = `
                ${input.parentElement.textContent}
                <input value="${input.id.split('_')[1]}" style="display: none;" name="chkd_city_ids[]">
                <img class="sr_delet" src="/img/trash.png">
                `;
                searchCityBlock.appendChild(searchCity);
            }
        })
    });
    searchRegionsBlock.addEventListener('click', e => {
        const target = e.target;
        if (target.classList.contains('sr_delet')) {
            let targetId = target.parentElement.querySelector('input').value;
            let inputPopup = document.querySelector(`#field_${targetId}`);
            inputPopup.checked = false;
            target.parentElement.remove();
            inputPopup.closest('.region-popup__block').classList.add('active');
            let deactiveInputs = inputPopup.closest('.region-popup__block').querySelector('.rp__other__checkbox')?.querySelectorAll('input:checked');
            if (!deactiveInputs?.length) {
                inputPopup.closest('.region-popup__block').classList.remove('active');
            }
        }
    });
    popupRegionsBlock.addEventListener('click', e => {
        const target = e.target;
        if (target.classList.contains('js-input-parent')) {
            let parentInput = target.parentElement.nextElementSibling
            let childInputs = parentInput.querySelectorAll('input');
            if (target.checked) {
                childInputs.forEach(input => input.checked = true);
            } else {
                childInputs.forEach(input => input.checked = false);
                target.closest('.region-popup__block').classList.remove('active');
            }
        }
        if (target.classList.contains('js-child-input')) {
            checkSelectCity(target);
        }
    })

    function checkSelectCity(target) {
        // console.log(target)
        let targetParentBlock = target.closest('.region-popup__block');
        if (targetParentBlock) {
            // console.log(targetParentInputs)
            setTimeout(() => {
                let targetParentInputs = targetParentBlock.querySelector('.rp__other__checkbox input[type="checkbox"]:checked');
                if (targetParentInputs) {
                    targetParentBlock.classList.add('active')
                } else {
                    targetParentBlock.classList.remove('active')
                }
            }, 100);
        }
    }
}

$('.checkbox__arrow').on("click", function(e) {
    const target = e.target
    if (target.classList.contains('active')) {
        $($(target).parent().next()[0]).slideUp();
        target.classList.remove('active')
    } else {
        $('.rp__other__checkbox').slideUp();
        $($(target).parent().next()[0]).slideDown();
        $('.checkbox__arrow').removeClass('active')
        target.classList.add('active')
    }
});


const typeOrgChoice = document.getElementById('type-org-popup-btn');
const typeOrgContent = document.querySelector('.type-org-popup__content')
if (typeOrgChoice) {
    typeOrgChoice.addEventListener("click", function() {
        let cityInputs = typeOrgContent.querySelectorAll('.region-popup__checkbox');
        let typeorgInput = document.querySelector('.type-organization-input')
        cityInputs.forEach((el) => {
            if (el.checked && el.id) {
                typeorgInput.setAttribute("value", el.parentElement.textContent.trim());
                let hiddenInput = typeorgInput.parentElement.querySelector('.hidden-input');
                hiddenInput.setAttribute("value", el.id)
                    // typeorgInput.parentElement.appendChild(hiddenInput);
                    // hiddenInput.style.display = "none"
            }
        })
    })
}
const PositionChoice = document.getElementById('position-popup-btn');
const PositionContent = document.querySelector('.position-popup__content')
if (PositionChoice) {
    PositionChoice.addEventListener("click", function() {
        let cityInputs = PositionContent.querySelectorAll('.region-popup__checkbox');
        let typeorgInput = document.querySelector('.position-input')
        cityInputs.forEach((el) => {
            if (el.checked && el.id) {
                typeorgInput.setAttribute("value", el.parentElement.textContent.trim());
                let hiddenInput = typeorgInput.parentElement.querySelector('.hidden-input');
                hiddenInput.setAttribute("value", el.id)
            }
        })
    })
}

let resumeBlock = document.querySelector('.resume__blocks');
let deletItems = {};
if (resumeBlock) {
    resumeBlock.addEventListener('click', e => {
        const target = e.target;
        if (target.classList.contains('plus__item')) {
            let copyCounter = target.closest('.resume__blocks').querySelectorAll('.js-counter-block').length;
            let copyBlock = document.createElement('div');
            let copyHtmlBlock = target.closest('.resume__block').innerHTML;
            let copyBlockAfter = target.closest('.resume__block');
            copyBlock.innerHTML = copyHtmlBlock;
            copyBlock.classList.add('resume__block', 'js-counter-block')
            copyBlock.id = copyBlockAfter.id;
            copyBlock.setAttribute('data-counter', copyCounter + 1);
            copyBlockAfter.after(copyBlock);
            let copyBlockInputs = copyBlock.querySelectorAll('input');
            let copyBlockSelect = copyBlock.querySelectorAll('select');
            let copyBlockTextArea = copyBlock.querySelectorAll('textarea');
            let copyBlockFile = copyBlock.querySelector('.filupp');
            let copyBlockCountry = copyBlock.querySelector('.country-input');
            let copyBlockCity = copyBlock.querySelector('.city-input');
            let copyBlockIcon = copyBlock.querySelectorAll('.js-input-icon');
            // console.log(copyBlockInputs)
            if (copyBlockInputs.length) {
                copyBlockInputs.forEach((input, i) => {
                    input.value = '';
                    console.log(input.name)
                    input.name = input.name.replace(/\d+/, copyCounter);
                    input.checked = false;
                    copyBlockInputs[0].focus();
                    console.log(input.name)
                })
            }
            if (copyBlockSelect.length) {
                copyBlockSelect.forEach(select => {
                    select.value = '';
                    select.name = select.name.replace(/\d+/, copyCounter)
                })
            }
            if (copyBlockTextArea.length) {
                copyBlockTextArea.forEach(textarea => {
                    textarea.value = '';
                    textarea.name = textarea.name.replace(/\d+/, copyCounter)
                })
            }
            if (copyBlockFile) {
                copyBlockFile.querySelector('.filupp-file-name').textContent = '';
                copyBlockFile.querySelector('.custom-file-upload').value = '';
                copyBlockFile.querySelector('.custom-file-upload').classList.add('js-add-file-resume');
                copyBlockFile.closest('.js-block-file').querySelector('input[type="hidden"]').setAttribute('value', copyCounter);
            }
            if (copyBlockCountry) {
                copyBlockCountry.setAttribute('data-country', copyCounter);
            }
            if (copyBlockCity) {
                copyBlockCity.setAttribute('data-city', copyCounter);
            }
            if (copyBlockIcon.length) {
                copyBlockIcon.forEach(icon => {
                    icon.setAttribute('data-id', copyCounter)
                })
            }
            // scroll to new block
            let copyBlockYPos = copyBlock.offsetTop;
            window.scrollTo({
                top: copyBlockYPos,
                behavior: 'smooth'
            })
        }
        if (target.classList.contains('js-add-table-lang')) {
            let tableFields = target.closest('.add__table');
            let tableInputs = target.closest('.add__table').querySelectorAll('input');
            let tableSelect = target.closest('.add__table').querySelector('select');
            let tableCopy = document.createElement('tr');
            tableCopy.innerHTML = tableFields.innerHTML;
            tableFields.before(tableCopy);
            tableCopy.classList.add('add__table');
            let tableInputsCopy = tableCopy.querySelectorAll('input');
            let tableSelectCopy = tableCopy.querySelector('select');
            let tableRemoveCopy = tableCopy.querySelector('.table_add');
            tableRemoveCopy.classList.remove('js-add-table-lang');
            tableRemoveCopy.classList.add('js-remove-table-lang');
            tableRemoveCopy.querySelector('img').src = '/img/del.svg';
            tableRemoveCopy.querySelector('img').classList.add('del_img');
            let copyCounter = document.querySelectorAll('.add__table').length - 1;
            let regexp = /\d+/;
            tableInputs.forEach((input, i) => {
                tableInputsCopy[i].value = input.value;
                input.value = '';
                tableInputsCopy[i].name = input.name.replace(regexp, copyCounter)
            })
            tableSelectCopy.value = tableSelect.value;
            tableSelect.value = '';
            tableSelectCopy.name = tableSelect.name.replace(regexp, copyCounter)
        }
        if (target.classList.contains('js-remove-table-lang')) {
            target.closest('.add__table').remove();
        }
        if (target.classList.contains('del__item')) {
            let targetIdBlock = target.closest('.resume__block').id;
            let targetCountBlock = target.closest('.resume__block').getAttribute('data-counter');
            if (deletItems.hasOwnProperty(targetIdBlock)) {
                deletItems[targetIdBlock] = [...deletItems[targetIdBlock], targetCountBlock];
            } else {
                deletItems[targetIdBlock] = targetCountBlock;
            }
            let hiddenInputDeletesObj = target.closest('.resume__blocks').querySelector('.js-deletes-obj');
            hiddenInputDeletesObj.value = JSON.stringify(deletItems)
            let animateDeleteBlock = target.closest('.resume__block').animate([
                {opacity: '1'},
                {opacity: '0'}
            ], {duration: 300, easing: 'ease-in-out', fill: 'forwards'});
            animateDeleteBlock.addEventListener('finish', () => {
                target.closest('.resume__block').remove();
            })
        }
    })
    resumeBlock.addEventListener('input', e => {
        const target = e.target;
        if (target.classList.contains('js-add-file-resume')) {
            if (target.files.length) {
                target.closest('.filupp').querySelector('.js-value').textContent = target.files[0].name;
            } else {
                target.closest('.filupp').querySelector('.js-value').textContent = '';
            }
        }
    })
}

const aiToptext = document.querySelectorAll('.ai__top__text');
if (aiToptext) {
    aiToptext.forEach(elem => {
        elem.addEventListener("click", function(e) {
            let target = e.target;
            if (target.classList.contains('input-edit__btn')) {
                target.previousElementSibling.removeAttribute("disabled");
            }
        })
    })
}

const JobCheker = document.querySelector('.job-js-cheker');
if (JobCheker) {
    JobCheker.addEventListener("click", function(e) {
        let DataBlockJS = document.querySelector('.data-block-js')
        let target = e.target;
        if (target.classList.contains('no-data-js')) {
            DataBlockJS.style.display = 'none';
        } else if (target.classList.contains('yes-data-js')) {
            DataBlockJS.style.display = 'flex';
        }
    })
}


const smoothLinks = document.querySelectorAll('a[href^="#"].link');
for (let smoothLink of smoothLinks) {
    smoothLink.addEventListener('click', function(e) {
        e.preventDefault();
        const id = smoothLink.getAttribute('href');
        document.querySelector(id).scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    });
};

// SELECT

let x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
    selElmnt = x[i].getElementsByTagName("select")[0];
    ll = selElmnt.length;
    /*for each element, create a new DIV that will act as the selected item:*/
    a = document.createElement("DIV");
    a.setAttribute("class", "select-selected");
    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
    if (selElmnt.options[selElmnt.selectedIndex].hasAttribute('data-formsob')) {
        let atreb = selElmnt.options[selElmnt.selectedIndex].getAttribute('data-formsob');
        // $(a).attr("data-formsob", selElmnt.options[selElmnt.selectedIndex].dataset.formsob)
    }
    x[i].appendChild(a);
    /*for each element, create a new DIV that will contain the option list:*/
    b = document.createElement("DIV");
    b.setAttribute("class", "select-items select-hide");
    for (j = 1; j < ll; j++) {
        /*for each option in the original select element,
        create a new DIV that will act as an option item:*/
        c = document.createElement("DIV");
        c.innerHTML = selElmnt.options[j].innerHTML;
        c.addEventListener("click", function(e) {
            /*when an item is clicked, update the original select box,
            and the selected item:*/
            var y, i, k, s, h, sl, yl;
            s = this.parentNode.parentNode.getElementsByTagName("select")[0];
            sl = s.length;
            h = this.parentNode.previousSibling;
            for (i = 0; i < sl; i++) {
                if (s.options[i].innerHTML == this.innerHTML) {
                    s.selectedIndex = i;
                    h.innerHTML = this.innerHTML;
                    y = this.parentNode.getElementsByClassName("same-as-selected");

                    yl = y.length;
                    for (k = 0; k < yl; k++) {
                        y[k].removeAttribute("class");
                    }
                    this.setAttribute("class", "same-as-selected");
                    break;
                }
            }
            h.click();
        });
        b.appendChild(c);
    }
    x[i].appendChild(b);
    a.addEventListener("click", function(e) {
        /*when the select box is clicked, close any other select boxes,
        and open/close the current select box:*/
        e.stopPropagation();
        closeAllSelect(this);
        this.nextSibling.classList.toggle("select-hide");
        this.classList.toggle("select-arrow-active");
    });
}

function closeAllSelect(elmnt) {
    /*a function that will close all select boxes in the document,
    except the current select box:*/
    var x, y, i, xl, yl, arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");
    xl = x.length;
    yl = y.length;
    for (i = 0; i < yl; i++) {
        if (elmnt == y[i]) {
            arrNo.push(i)
        } else {
            y[i].classList.remove("select-arrow-active");
        }
    }
    for (i = 0; i < xl; i++) {
        if (arrNo.indexOf(i)) {
            x[i].classList.add("select-hide");
        }
    }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);

let graphicsBlock = document.querySelector('.graphics-block');
if (graphicsBlock) {
    let dataResponse = [];
    let data = [];
    am5.ready(function() {
        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("chartdiv");


        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
            am5themes_Animated.new(root)
        ]);

        root.dateFormatter.setAll({
            dateFormat: "yyyy",
            dateFields: ["valueX"]
        });

        // Create chart
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
            focusable: true,
            panX: true,
            panY: true,
            wheelX: "panX",
            wheelY: "zoomX",
            pinchZoomX: true
        }));

        var easing = am5.ease.linear;


        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
            maxDeviation: 0.1,
            groupData: false,
            baseInterval: {
                timeUnit: "day",
                count: 1
            },
            renderer: am5xy.AxisRendererX.new(root, {

            }),
            tooltip: am5.Tooltip.new(root, {})
        }));

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
            maxDeviation: 0.2,
            renderer: am5xy.AxisRendererY.new(root, {})
        }));


        // Add series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        var series = chart.series.push(am5xy.LineSeries.new(root, {
            minBulletDistance: 10,
            connect: false,
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: "value",
            valueXField: "date",
            tooltip: am5.Tooltip.new(root, {
                pointerOrientation: "horizontal",
                labelText: "{valueY}"
            })
        }));

        series.fills.template.setAll({
            fillOpacity: 0.2,
            visible: true
        });

        series.strokes.template.setAll({
            strokeWidth: 2
        });


        // Set up data processor to parse string dates
        // https://www.amcharts.com/docs/v5/concepts/data/#Pre_processing_data
        series.data.processor = am5.DataProcessor.new(root, {
            dateFormat: "yyyy-MM-dd",
            dateFields: ["date"]
        });

        series.data.setAll(data);

        series.bullets.push(function() {
            var circle = am5.Circle.new(root, {
                radius: 4,
                fill: root.interfaceColors.get("background"),
                stroke: series.get("fill"),
                strokeWidth: 2
            })

            return am5.Bullet.new(root, {
                sprite: circle
            })
        });

        series.data.setAll(data);
        // Add cursor
        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
            xAxis: xAxis,
            behavior: "none"
        }));
        cursor.lineY.set("visible", false);

        // add scrollbar
        chart.set("scrollbarX", am5.Scrollbar.new(root, {
            orientation: "horizontal"
        }));


        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        chart.appear(1000, 100);


        document.addEventListener('DOMContentLoaded', () => {
            let graphicsBlock = document.querySelector('.graphics-block');
            if (graphicsBlock) {
                let orgForm = document.querySelector('.corrent-vacancy__blocks');
                let graphicsForm = document.querySelector('.popup__graphics');
                if (orgForm) {

                    // запрос данных
                    let token = document.querySelector('meta[name="csrfToken"]').getAttribute('content');
                    const sendData = async(url, data) => {
                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json;charset=utf-8',
                                'X-CSRF-Token': token,
                            },
                            body: JSON.stringify(data),
                        })
                        if (!response.ok) {
                            throw new Error('Error!')
                        }
                        closeLoader();
                        dataResponse = await response.json();
                        dataResponse = Object.values(dataResponse.data);
                        data = dataResponse[0].tab;
                        series.data.setAll(data);
                    };

                    function sendId(id) {
                        const data = {
                            v_id: id,
                        }
                        sendData('/users/get_charts', data);
                    }
                    orgForm.addEventListener('click', e => {
                        const target = e.target;
                        const targetId = target.getAttribute('data-id');
                        if (target.classList.contains('js-graphics')) {
                            showLoader();
                            sendId(targetId)
                            graphicsForm.style.display = 'flex';
                            graphicsForm.animate([
                                { opacity: '0' },
                                { opacity: '1' }
                            ], { duration: 300, easing: 'ease-in-out', fill: 'forwards' })

                        }
                    })
                }
                let graphicsTabs = document.querySelector('.popup__graphics-tabs');
                let graphicsTabsElems = document.querySelectorAll('.popup__graphics-tab');
                let chartdivBlock = graphicsBlock.querySelector('.chartdiv');
                let chartdivError = graphicsBlock.querySelector('.chartdiv-error');
                if (graphicsTabs) {
                    graphicsTabs.addEventListener('click', e => {
                        const target = e.target;
                        if (target.classList.contains('popup__graphics-tab')) {
                            graphicsTabsElems.forEach(tab => tab.classList.remove('active'))
                            target.classList.add('active');
                            let targetId = target.getAttribute('data-id');
                            data = dataResponse[targetId].tab;
                            if (data.length) {
                                chartdivBlock.style.display = 'block';
                                chartdivError.style.display = 'none';
                            } else {
                                chartdivBlock.style.display = 'none';
                                chartdivError.style.display = 'block';
                            }
                            series.data.setAll(data);
                        }
                    })
                }
                let graphicsPopup = document.querySelector('.popup__graphics')
                if (graphicsPopup) {
                    graphicsPopup.addEventListener('click', e => {
                        const target = e.target;
                        if (target.classList.contains('popup__graphics-close') || !target.closest('.popup__graphics-box')) {
                            let graphicsAnimate = graphicsPopup.animate([
                                { opacity: '1' },
                                { opacity: '0' }
                            ], { duration: 300, easing: 'ease-in-out', fill: 'forwards' });
                            graphicsAnimate.addEventListener('finish', () => {
                                graphicsPopup.style.display = 'none'
                            })
                        }
                    })
                }
            }
        });
    });
}


document.addEventListener('DOMContentLoaded', () => {
    // files uploads
    let filesBlock = document.querySelectorAll('.js-files-block');
    if (filesBlock.length) {
        filesBlock.forEach(elem => {
            let filesUpload = elem.querySelector('.js-upload-files');
            let filesBlockBody = elem.querySelector('.js__upload__file__block');
            let oldFilesBlockBody = elem.querySelector('.js__old__files__block');
            let hiddenInputFiles = elem.querySelector('.js-array-remove-ids');
            let filesArray;
            let filesArrayIndexRemoves = [];
            let oldFilesArrayIndexRemoves = [];
            filesUpload.addEventListener('input', () => {
                let filesChild = filesBlockBody.querySelectorAll('.ai__bottom__item');
                filesArray = [];
                filesArrayIndexRemoves = [];
                hiddenInputFiles.value = '';
                if (filesChild.length) {
                    filesChild.forEach(item => item.remove());
                }
                for (let i = 0; i < filesUpload.files.length; i++) {
                    let fileBlock = document.createElement('div');
                    fileBlock.classList.add('ai__bottom__item');
                    fileBlock.innerHTML += `
					<label class="filupp">
						<span class="filupp-file-name">${filesUpload.files[i].name}</span>
					</label>
					<span class="file__delete js-new-file-delete"><img src="/img/x.svg" alt=""></span>
					`;
                    filesBlockBody.appendChild(fileBlock);
                    filesArray.push(filesUpload.files[i].name)
                }
                elem.classList.add('active')
                console.log(filesArray)
                console.log(filesUpload.files)
            })
            if (filesBlockBody) {
                filesBlockBody.addEventListener('click', e => {
                    const target = e.target;
                    // if(target.classList.contains('ai__bottom__item')) {
                    if (target.classList.contains('js-new-file-delete')) {
                        let myIndex = filesArray.indexOf(target.parentElement.querySelector('.filupp-file-name').textContent);
                        // filesArray.splice(myIndex, 1)
                        target.parentElement.style.display = 'none';
                        // console.log(filesArray)
                        // target.remove();
                        filesArrayIndexRemoves.push(myIndex);
                        // console.log(filesArrayIndexRemoves)
                        hiddenInputFiles.value = filesArrayIndexRemoves;
                        console.log(hiddenInputFiles.value)
                    }

                })
            }
            if (oldFilesBlockBody) {
                oldFilesBlockBody.addEventListener('click', e => {
                    const target = e.target;
                    if (target.classList.contains('js-old-file-delete')) {
                        let targetId = target.getAttribute('data-id');
                        let hiddenOldInputFiles = target.closest('.js__old__files__block').querySelector('.js-old-files-array');
                        oldFilesArrayIndexRemoves.push(targetId);
                        hiddenOldInputFiles.value = oldFilesArrayIndexRemoves;
                        target.closest('.ai__bottom__item').remove();
                    }
                })

            }

        })

    }
    // count summa tarif vakancy top-vakancies
    let topVakancies = document.querySelector('.js-vacancy-up-tarif');
    if (topVakancies) {
        let dataVakancies = JSON.parse(localStorage.getItem('dataVakancies')) || {};
        let inputsArray = document.querySelectorAll('.region-popup__checkbox');
        let dataPrice = document.querySelector('.js-vacancy-up-tarif').getAttribute('data-price');
        let inputVakancy = topVakancies.querySelector('.search__btn button span');
        let totalSumma = 0;
        // let dataVakanciesArray = [];
        // console.log(dataVakancies)

        function setLocalStorage() {
            localStorage.setItem('dataVakancies', JSON.stringify(dataVakancies))
        }

        function updateCart() {
            setLocalStorage();
        }

        function countPrice() {
            totalSumma = Object.keys(dataVakancies).length * dataPrice;
            if (totalSumma > 0) {
                inputVakancy.textContent = `: ${totalSumma}тг`;
            } else {
                inputVakancy.textContent = '';
            }
        }

        countPrice();

        topVakancies.addEventListener('click', e => {
            const target = e.target;
            if (target.classList.contains('region-popup__checkbox')) {
                // dataVakanciesArray = JSON.parse(localStorage.getItem('dataVakancies'))

                let targetId = target.getAttribute('data-id');
                if (target.checked) {
                    // dataVakancies.inputs = target.getAttribute('data-id');
                    dataVakancies[targetId] = targetId;
                    updateCart();
                    countPrice();
                }
                if (!target.checked) {
                    if (dataVakancies.hasOwnProperty(targetId)) {
                        delete dataVakancies[targetId];
                        updateCart();
                        countPrice();
                    }
                }
            }
        })
        inputsArray.forEach(input => {
            if (dataVakancies.hasOwnProperty(input.getAttribute('data-id'))) {
                input.checked = true;
            }
        })
    }
    // count summa tarif pages cards (standart, standart+, premium);
    let tarifInput = document.querySelector('.js-count-vakancy-tarif');
    let tarifRadioButtons = document.querySelectorAll('.js-tarif-days');
    let tarifBtn = document.querySelector('.js-tarif-btn');
    let standartTarif = document.querySelector('.js-tarif-standart span');
    let standartPlusTarif = document.querySelector('.js-tarif-standart-plus span');
    let premiumTarif = document.querySelector('.js-tarif-premium span');
    let standartTarifInput = document.querySelector('.js-tarif-standart input');
    let standartPlusTarifInput = document.querySelector('.js-tarif-standart-plus input');
    let premiumTarifInput = document.querySelector('.js-tarif-premium input');
    let tarifSummaBase = document.querySelector('.vacancy-salary span');
    let tarifSummaHiddenInput = document.querySelector('.vacancy-salary input');
    let currentStandartTarif,
        currentStandartPlusTarif,
        currentPremiumTarif;
    if (standartTarif) {
        currentStandartTarif = standartTarif.textContent;
    }
    if (standartPlusTarif) {
        currentStandartPlusTarif = standartPlusTarif.textContent;
    }
    if (premiumTarif) {
        currentPremiumTarif = premiumTarif.textContent;
    }

    if (tarifInput) {
        tarifInput.addEventListener('input', countSummaTarif);
        tarifBtn.addEventListener('click', countSummaTarif);
    }

    if (tarifRadioButtons.length) {
        tarifRadioButtons.forEach(radio => radio.addEventListener('input', countSummaTarif));
        tarifBtn.addEventListener('click', countSummaTarif);
    }

    function countSummaTarif() {
        if (tarifInput) {
            let tarifInputValue = tarifInput.value;
            if (tarifInputValue == '') {
                tarifInputValue = 0;
            }
            let tarifCityValue = tarifBtn.closest('.popup').querySelectorAll('input:checked');
            let totalCount = 0;
            let mean = tarifCityValue.length;
            if(tarifCityValue.length === 0) {
                totalCount = 0;
                mean = 1;
            }
            if (tarifInputValue || tarifInputValue === 0) {
                let totalInput = 0;
                tarifCityValue.forEach(input => {
                    totalInput += parseInt(input.getAttribute('data-price'));
                })
                totalCount = tarifInputValue * (totalInput / mean);
                if (standartTarif) {
                    standartTarif.textContent = Math.round(parseInt(currentStandartTarif.replace(' ', '')) + totalCount);
                    standartTarif.textContent = numberWithSpaces(standartTarif.textContent);
                    standartTarifInput.value = Math.round(parseInt(currentStandartTarif.replace(' ', '')) + totalCount);
                }
                if (standartPlusTarif) {
                    standartPlusTarif.textContent = Math.round(parseInt(currentStandartPlusTarif.replace(' ', '')) + totalCount);
                    standartPlusTarif.textContent = numberWithSpaces(standartPlusTarif.textContent);
                    standartPlusTarifInput.value = Math.round(parseInt(currentStandartPlusTarif.replace(' ', '')) + totalCount);
                }
                if (premiumTarif) {
                    premiumTarif.textContent = Math.round(parseInt(currentPremiumTarif.replace(' ', '')) + totalCount);
                    premiumTarif.textContent = numberWithSpaces(premiumTarif.textContent);
                    premiumTarifInput.value = Math.round(parseInt(currentPremiumTarif.replace(' ', '')) + totalCount);
                }
            }
        };
        if (tarifRadioButtons.length) {
            let activeRadioButton = document.querySelector('.js-tarif-days:checked');
            let tarifCityValue = tarifBtn.closest('.popup').querySelectorAll('input:checked');
            let totalInputCount = 0;
            if (activeRadioButton) {
                tarifCityValue.forEach(input => {
                    totalInputCount += parseInt(input.getAttribute('data-price'));
                })
                tarifSummaBase.textContent = numberWithSpaces(tarifSummaBase.textContent);
                tarifSummaBase.textContent = parseInt(activeRadioButton.getAttribute('data-price')) + parseInt(totalInputCount);
                tarifSummaBase.closest('.search-content__block').style.opacity = '1';
                tarifSummaHiddenInput.value = parseInt(activeRadioButton.getAttribute('data-price')) + parseInt(totalInputCount);
                if(tarifCityValue.length === 0) {
                    totalInputCount = 0;
                    tarifSummaBase.closest('.search-content__block').style.opacity = '0';
                }
            }
        }
    }

    function numberWithSpaces(x) {
        return x.replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    }
    document.addEventListener('click', e => {
        const target = e.target;
        if(target.classList.contains('sr_delet')) {
            countSummaTarif();
        }
        if(target.classList.contains('region-check-all-js')) {
            target.closest('.region-popup__content').querySelectorAll('input').forEach(inp => inp.checked = true);
        }
    })
})

function validateForm(e) {
    // console.log(e.target);
    let firstPass = e.target.querySelector('.first-pass');
    let secPass = e.target.querySelector('.second-pass');
    if (firstPass.value != secPass.value) {
        e.preventDefault();
        secPass.classList.add('error');
    } else {
        secPass.classList.remove('error');
        showLoader();
        // console.log(e.target);
        e.target.submit();
    }
    return false;
}


const aiImageDeleter = document.querySelector('.js__image__parent');
if (aiImageDeleter) {
    let arrayIndexRemove = [];
    aiImageDeleter.addEventListener("click", function(e) {
        let target = e.target;
        let arrayRemover = document.querySelector('.js-db-img-remover');
        arrayRemover.value = '';
        if (target.classList.contains('close-btn')) {
            arrayIndexRemove.push(target.closest('.ai__bottom__img').dataset.id);
            target.closest('.ai__bottom__img').style.display = 'none';
            arrayRemover.value = arrayIndexRemove;
        }
        if (aiImageDeleter.offsetHeight < 43) {
            aiImageDeleter.classList.add('hidden')
        }
    })
}


// show loader
let loaderInfo = document.querySelector('.popuploader')

function showLoader() {
    if (loaderInfo) {
        document.querySelector('body').style.overflow = 'hidden';
        loaderInfo.style.display = 'flex';
        loaderInfo.animate([
            { opacity: '0' },
            { opacity: '1' }
        ], { duration: 300, easing: 'ease-in-out', fill: 'forwards' });
    }
}

function closeLoader() {
    if (loaderInfo) {
        let loaderAnimate = loaderInfo.animate([
            { opacity: '1' },
            { opacity: '0' }
        ], { duration: 300, easing: 'ease-in-out', fill: 'forwards' });
        loaderAnimate.addEventListener('finish', () => {
            document.querySelector('body').style.overflow = 'unset';
            loaderInfo.style.display = 'none';
        })
    }
}

$('.slidercomp__items').slick({
    autoplay: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    fade: true,
    prevArrow: '<button type="button" class="slick_arrow slick_prev"><svg width="10" height="15" viewBox="0 0 10 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.875 13.2312L4.14375 7.5L9.875 1.76875L8.10625 0L0.60625 7.5L8.10625 15L9.875 13.2312Z" fill="white"/></svg></button>',
    nextArrow: '<button type="button" class="slick_arrow slick_next"><svg width="10" height="15" viewBox="0 0 10 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.125 13.2312L5.85625 7.5L0.125 1.76875L1.89375 0L9.39375 7.5L1.89375 15L0.125 13.2312Z" fill="white"/></svg></button>',

});


let navResume = document.querySelector('.right-main-block');
if(navResume) {
    let navLink = document.querySelectorAll('.right-main__link');
    navResume.addEventListener('click', e => {
        const target = e.target;
        navLink.forEach(link => link.classList.remove('active'));
        if(target.classList.contains('right-main__link')) {
            target.classList.add('active');
        }
    })
}


let copyNewsLink = document.querySelector('.copy-news-link');
if(copyNewsLink) {
    copyNewsLink.addEventListener('click', e => {
        let dummy = document.createElement('input'),
        text = window.location.href;
        document.body.appendChild(dummy);
        dummy.value = text;
        dummy.select();
        document.execCommand('copy');
        document.body.removeChild(dummy);
    })
}

$('#hidden-text-resume').hide();