
const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const travelAd = $('.next');
const book = $('.book');
const book_close = $('.book__close');
const up = $('.header__items-up');
const down = $('.header__items-list');
const down_icon = $('.items-list-icons.down');

travelAd.onclick = function() {
    book.classList.remove('action');
}

book_close.onclick = function() {
    book.classList.add('action');
}

if(up) {
    up.onclick = function() {
        up.classList.add('action');
        down.classList.remove('action');
    }

    down_icon.onclick = function() {
        up.classList.remove('action');
        down.classList.add('action');
    }
}


let images = ['./storage/backgroup_1.jpg', 
'./storage/phuquoc-show-755x190.png',
 './storage/sky-latern-yipeng.png'];
let currentImageIndex = 0;
let bgtop = $('.header__bg-bgtop');
let order = $$('.bgtop__order-btn');

if(bgtop) {
    function changeImage(currentImageIndex) {
        order.forEach((button, index) => {
            button.classList.remove('action');
        
            button.onclick = function() {
                currentImageIndex = index;
                clearTimeout(timeOut);
                changeImage(currentImageIndex);
            }
            
        });
        
        bgtop.style.background = 'url(' + images[currentImageIndex] + ') top center / cover no-repeat';
        order[currentImageIndex].classList.add('action');
        currentImageIndex++;
    
        if (currentImageIndex === images.length) {
            currentImageIndex = 0;
        }
        
        timeOut = setTimeout(() => {
            order.forEach(button => {
                button.classList.remove('action');
            });
            changeImage(currentImageIndex);
        }, 2000);
    
    }
    
    changeImage(currentImageIndex);
}


//       Handle bookings

const plusButtons = $$('.plus');
const minusButtons = $$('.minus');
var total = $('.total');
if (total) {
    var totalBookings = parseInt(total.innerText);
}

const priceSystem = $('#price_system');
if (priceSystem) {
    
    var price = parseFloat(priceSystem.value);
    var alultValue = 1;
    var childrenValue = 0;
    var youngValue = 0;
    var babyValue = 0;
    var alultPrice = price;
    var childrenPrice = price * parseFloat($('#type__price-2').value) / 100;
    var youngPrice = price * parseFloat($('#type__price-3').value) / 100;
    var babyPrice = price * parseFloat($('#type__price-4').value) / 100;
    var totalPrice = price;
    var total = 0;
    var saleElement = $('#price_sale');
    var sale = 0;
    if(saleElement) {
        sale = parseFloat(saleElement.value);
    } 
    $('#type_1').value = alultValue;
    $('#type_2').value = childrenValue;
    $('#type_3').value = youngValue;
    $('#type_4').value = babyValue;
    
    plusButtons.forEach(button => {
        button.onclick = () => {
            total = alultValue + childrenValue + youngValue + babyValue;
            if(total >= totalBookings) {
                alert("Số khách tối đa: " + totalBookings)
            } else {
                if(button.parentNode.classList.contains('1')) {
    
                    alultValue++;
                    totalPrice += alultPrice;
                    button.parentNode.querySelector('.quantity').innerText = alultValue;
                    $('.right__1').innerText = alultValue + " x " + alultPrice.toLocaleString() + " đ";
                    if(sale > 0) {
                        $('.price__custom').innerText = totalPrice.toLocaleString() + " đ - " + sale.toLocaleString() + " %";
                    }
                    $('.price_now').innerText = (totalPrice - (totalPrice * sale / 100)).toLocaleString() + " đ";
                    $('#price').value = totalPrice;
                    $('#type_1').value = alultValue;
    
                } else if(button.parentNode.classList.contains('2')) {
    
                    childrenValue++;
                    totalPrice += childrenPrice;
                    button.parentNode.querySelector('.quantity').innerText = childrenValue;
                    $('.right__2').innerText = childrenValue + " x " + childrenPrice.toLocaleString() + " đ";
                    if(sale > 0) {
                        $('.price__custom').innerText = totalPrice.toLocaleString() + " đ - " + sale.toLocaleString() + " %";
                    }
                    $('.price_now').innerText = (totalPrice - (totalPrice * sale / 100)).toLocaleString() + " đ";
                    $('#price').value = totalPrice;
                    $('#type_2').value = childrenValue;
    
                } else if(button.parentNode.classList.contains('3')) {
    
                    youngValue++;
                    totalPrice += youngPrice;
                    button.parentNode.querySelector('.quantity').innerText = youngValue;
                    $('.right__3').innerText = youngValue + " x " + youngPrice.toLocaleString() + " đ";
                    if(sale > 0) {
                        $('.price__custom').innerText = totalPrice.toLocaleString() + " đ - " + sale.toLocaleString() + " %";
                    }
                    $('.price_now').innerText = (totalPrice - (totalPrice * sale / 100)).toLocaleString() + " đ";
                    $('#price').value = totalPrice;
                    $('#type_3').value = youngValue;
    
                } else if(button.parentNode.classList.contains('4')) {
    
                    babyValue++;
                    totalPrice += babyPrice;
                    button.parentNode.querySelector('.quantity').innerText = babyValue;
                    $('.right__4').innerText = babyValue + " x " + babyPrice.toLocaleString() + " đ";
                    if(sale > 0) {
                        $('.price__custom').innerText = totalPrice.toLocaleString() + " đ - " + sale.toLocaleString() + " %";
                    }
                    $('.price_now').innerText = (totalPrice - (totalPrice * sale / 100)).toLocaleString() + " đ";
                    $('#price').value = totalPrice;
                    $('#type_4').value = babyValue;
    
                }
            }
        }
    });
    
    minusButtons.forEach(button => {
        button.onclick = () => {
            if(button.parentNode.classList.contains('1')) {
                if(alultValue > 1) {
    
                    alultValue--;
                    totalPrice -= alultPrice;
                    button.parentNode.querySelector('.quantity').innerText = alultValue;
                    $('.right__1').innerText = alultValue + " x " + alultPrice.toLocaleString() + " đ";
                    if(sale > 0) {
                        $('.price__custom').innerText = totalPrice.toLocaleString() + " đ - " + sale.toLocaleString() + " %";
                    }
                    $('.price_now').innerText = (totalPrice - (totalPrice * sale / 100)).toLocaleString() + " đ";
                    $('#price').value = totalPrice;
                    $('#type_1').value = alultValue;
    
                } else {
                    alert("Số khách tối thiểu: 1");
                }
            } else if(button.parentNode.classList.contains('2')) {
                if(childrenValue > 0) {
    
                    childrenValue--;
                    totalPrice -= childrenPrice;
                    button.parentNode.querySelector('.quantity').innerText = childrenValue;
                    if(childrenValue == 0) {
                        $('.right__2').innerText = "0 đ";
                    } else {
                        $('.right__2').innerText = childrenValue + " x " + childrenPrice.toLocaleString() + " đ";
                    }
                    if(sale > 0) {
                        $('.price__custom').innerText = totalPrice.toLocaleString() + " đ - " + sale.toLocaleString() + " %";
                    }
                    $('.price_now').innerText = (totalPrice - (totalPrice * sale / 100)).toLocaleString() + " đ";
                    $('#price').value = totalPrice;
                    $('#type_2').value = childrenValue;
    
                } else {
                    alert("Số khách tối thiểu: 1");
                }
            } else if(button.parentNode.classList.contains('3')) {
                if(youngValue > 0) {
    
                    youngValue--;
                    totalPrice -= youngPrice;
                    button.parentNode.querySelector('.quantity').innerText = youngValue;
                    if(youngValue == 0) {
                        $('.right__3').innerText = "0 đ";
                    } else {
                        $('.right__3').innerText = youngValue + " x " + youngPrice.toLocaleString() + " đ";
                    }
                    if(sale > 0) {
                        $('.price__custom').innerText = totalPrice.toLocaleString() + " đ - " + sale.toLocaleString() + " %";
                    }
                    $('.price_now').innerText = (totalPrice - (totalPrice * sale / 100)).toLocaleString() + " đ";
                    $('#price').value = totalPrice;
                    $('#type_3').value = youngValue;
    
                } else {
                    alert("Số khách tối thiểu: 1");
                }
            } else if(button.parentNode.classList.contains('4')) {
                if(babyValue > 0) {
    
                    babyValue--;
                    totalPrice -= babyPrice;
                    button.parentNode.querySelector('.quantity').innerText = babyValue;
                    if(babyValue == 0) {
                        $('.right__4').innerText = "0 đ";
                    } else {
                        $('.right__4').innerText = babyValue + " x " + babyPrice.toLocaleString() + " đ";
                    }
                    if(sale > 0) {
                        $('.price__custom').innerText = totalPrice.toLocaleString() + " đ - " + sale.toLocaleString() + " %";
                    }
                    $('.price_now').innerText = (totalPrice - (totalPrice * sale / 100)).toLocaleString() + " đ";
                    $('#price').value = totalPrice;
                    $('#type_4').value = babyValue;
    
                } else {
                    alert("Số khách tối thiểu: 1");
                }
            }
            total = alultValue + childrenValue + youngValue + babyValue;
        }
    });
    
}

var clearButton = $('.search__items-icon.close');
if (clearButton) {
    clearButton.onclick = () => {
        $('.header__bg-bgtop-search input').value = '';
    }
}

const titlePlace = $('.book__nav-header--item');
const titlePlaceOut = $('.book__nav-header--item_out');
const listPlace = $$('.book__list');

if(titlePlace) {
    titlePlace.onclick = () => {
        titlePlaceOut.classList.remove('active');
        titlePlace.classList.add('active');
        listPlace.forEach(button => {
            if(button.classList.contains('active')) {
                button.classList.remove('active');
            } else {
                button.classList.add('active');
            }
        })
    };
    titlePlaceOut.onclick = () => {
        titlePlace.classList.remove('active');
        titlePlaceOut.classList.add('active');
        listPlace.forEach(button => {
            if(button.classList.contains('active')) {
                button.classList.remove('active');
            } else {
                button.classList.add('active');
            }
        })
    };
}


