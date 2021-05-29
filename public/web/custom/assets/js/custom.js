(function ($) {

    //"use strict";

    let passiveSupported = false;

    try {
        const options = Object.defineProperty({}, 'passive', {
            get: function () {
                passiveSupported = true;
            }
        });

        window.addEventListener('test', null, options);
    } catch (err) { }

    let DIRECTION = null;

    function direction() {
        if (DIRECTION === null) {
            DIRECTION = getComputedStyle(document.body).direction;
        }

        return DIRECTION;
    }

    function isRTL() {
        return direction() === 'rtl';
    }

    /*
    // initialize custom numbers
    */
    $(function () {
        $('.input-number').customNumber();
    });
    /*
    // block slideshow
    */
    $(function () {
        $('.block-slideshow .owl-carousel').owlCarousel({
            items: 1,
            nav: false,
            dots: true,
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
            rtl: isRTL()
        });
    });


    /*
    // block brands carousel
    */
    $(function () {
        $('.block-brands__slider .owl-carousel').owlCarousel({
            nav: false,
            dots: false,
            loop: true,
            rtl: isRTL(),
            responsive: {
                1200: { items: 6 },
                992: { items: 5 },
                768: { items: 4 },
                576: { items: 3 },
                0: { items: 2 }
            }
        });
    });

    /*
        // products carousel
        */
    $(function () {
        $('.block-products-carousel').each(function () {
            const layout = $(this).data('layout');
            const options = {
                items: 5,
                margin: 14,
                nav: false,
                dots: false,
                loop: true,
                stagePadding: 1,
                rtl: isRTL()
            };
            const layoutOptions = {
                'grid-4': {
                    responsive: {
                        1200: { items: 4, margin: 14 },
                        992: { items: 4, margin: 10 },
                        768: { items: 3, margin: 10 },
                        576: { items: 2, margin: 10 },
                        475: { items: 2, margin: 10 },
                        0: { items: 2 }
                    }
                },
                'grid-4-sm': {
                    responsive: {
                        1200: { items: 4, margin: 14 },
                        992: { items: 3, margin: 10 },
                        768: { items: 3, margin: 10 },
                        576: { items: 2, margin: 10 },
                        475: { items: 2, margin: 10 },
                        0: { items: 2 }
                    }
                },
                'grid-5': {
                    responsive: {
                        1200: { items: 4, margin: 12 },
                        992: { items: 4, margin: 10 },
                        768: { items: 3, margin: 10 },
                        576: { items: 2, margin: 10 },
                        475: { items: 2, margin: 10 },
                        0: { items: 2 }
                    }
                },
                'horizontal': {
                    items: 3,
                    responsive: {
                        1200: { items: 3, margin: 14 },
                        992: { items: 3, margin: 10 },
                        768: { items: 2, margin: 10 },
                        576: { items: 1 },
                        475: { items: 1 },
                        0: { items: 2 }
                    }
                },
            };
            const owl = $('.owl-carousel', this);
            let cancelPreviousTabChange = function () { };

            owl.owlCarousel($.extend({}, options, layoutOptions[layout]));

            $(this).find('.block-header__group').on('click', function (event) {
                const block = $(this).closest('.block-products-carousel');

                event.preventDefault();

                if ($(this).is('.block-header__group--active')) {
                    return;
                }

                cancelPreviousTabChange();

                block.addClass('block-products-carousel--loading');
                $(this).closest('.block-header__groups-list').find('.block-header__group--active').removeClass('block-header__group--active');
                $(this).addClass('block-header__group--active');

                // timeout ONLY_FOR_DEMO! you can replace it with an ajax request
                let timer;
                let category_id = $(this).data('category-id')
                console.log(category_id);

                $.ajax({
                    url: `/ajax/category/${category_id}/products`,
                    type: "get",
                    success: function (data) {
                        block.find('.owl-carousel').empty().html(data)

                        owl.trigger('destroy.owl.carousel');
                        owl.owlCarousel($.extend({}, options, layoutOptions[layout]));
                        $('.currencyField').formatCurrency({ symbol: "Rs. " });

                        // .trigger('refresh.owl.carousel')
                        // .trigger('to.owl.carousel', [0, 0]);
                    }
                })


                // timer = setTimeout(function() {
                //     let items = block.find('.owl-carousel .owl-item:not(".cloned") .block-products-carousel__column');

                //     /*** this is ONLY_FOR_DEMO! / start */
                //     /**/ const itemsArray = items.get();
                //     /**/ const newItemsArray = [];
                //     /**/
                //     /**/ while (itemsArray.length > 0) {
                //     /**/     const randomIndex = Math.floor(Math.random() * itemsArray.length);
                //     /**/     const randomItem = itemsArray.splice(randomIndex, 1)[0];
                //     /**/
                //     /**/     newItemsArray.push(randomItem);
                //     /**/ }
                //     /**/ items = $(newItemsArray);
                //     /*** this is ONLY_FOR_DEMO! / end */

                //     console.log(items)
                //     block.find('.owl-carousel')
                //         .trigger('replace.owl.carousel', [items])
                //         .trigger('refresh.owl.carousel')
                //         .trigger('to.owl.carousel', [0, 0]);

                //     $('.product-card__quickview', block).on('click', function() {
                //         quickview.clickHandler.apply(this, arguments);
                //     });

                //     block.removeClass('block-products-carousel--loading');
                // }, 1000);


                cancelPreviousTabChange = function () {
                    // timeout ONLY_FOR_DEMO!
                    clearTimeout(timer);
                    cancelPreviousTabChange = function () { };
                };
            });

            $(this).find('.block-header__arrow--left').on('click', function () {
                owl.trigger('prev.owl.carousel', [500]);
            });
            $(this).find('.block-header__arrow--right').on('click', function () {
                owl.trigger('next.owl.carousel', [500]);
            });
        });
    });
    /*
    // block posts carousel
    */
    $(function () {
        $('.block-posts').each(function () {
            const layout = $(this).data('layout');
            const options = {
                margin: 30,
                nav: false,
                dots: false,
                loop: true,
                rtl: isRTL()
            };
            const layoutOptions = {
                'grid-nl': {

                    responsive: {
                        992: { items: 2 },
                        768: { items: 2 },
                        0: { items: 1 }
                    }
                },
                'list-sm': {
                    responsive: {
                        992: { items: 2 },
                        0: { items: 1 }
                    }
                }
            };
            const owl = $('.block-posts__slider .owl-carousel');

            owl.owlCarousel($.extend({}, options, layoutOptions[layout]));

            $(this).find('.block-header__arrow--left').on('click', function () {
                owl.trigger('prev.owl.carousel', [500]);
            });
            $(this).find('.block-header__arrow--right').on('click', function () {
                owl.trigger('next.owl.carousel', [500]);
            });
        });
    });


    $(".website-product__search").autocomplete({
        minLength: 2,
        source: function (request, response) {
            let category = $('.category-value').val();
            $.ajax({
                url: '/product/search',
                data: { keyword: request.term, category: category },
                success: function (res) {
                    if (!Object.keys(res).length) {
                        res = {
                            "0": {
                                text: "No Results Found!!"
                            }
                        }
                    }
                    response(res)
                },
            });
        },
        focus: function (event, ui) {
            return false;
        },
        select: function (event, ui) {
            if (ui.item.products_slug)
                window.location.href = '/product-detail/' + ui.item.products_slug;
            else
                return;

        }
    }).autocomplete("instance")._renderItem = function (ul, item) {
        var item_to_render = "";

        if (item.products_name) {
            item_to_render = $("<li>")
                .append(`<div style="padding:5px"><div class="row"><div class="col-2 col-sm-3" style="padding-left:17px"><img style="width:60px" src="/${item.path}" /></div><div class="col-10 col-sm-9" style="padding-top:15px; padding-left:5px"> ${item.products_name} in <strong> ${item.categories_name}</strong></div></div><div>`)
                .appendTo(ul);
        } else {
            item_to_render = $("<li>")
                .append(`<div class="text-center"><a>  ${item.text} </a></div>`)
                .appendTo(ul);
        }
        return item_to_render;
    };

    $(".website-product__search_mobile").autocomplete({
        minLength: 2,
        source: function (request, response) {
            let category = $('.category-value').val();
            $.ajax({
                url: '/product/search',
                data: { keyword: request.term, category: category },
                success: function (res) {
                    if (!Object.keys(res).length) {
                        res = {
                            "0": {
                                text: "No Results Found!!"
                            }
                        }
                    }
                    response(res)
                },
            });
        },
        focus: function (event, ui) {
            return false;
        },
        select: function (event, ui) {
            if (ui.item.products_slug)
                window.location.href = '/product-detail/' + ui.item.products_slug;
            else
                return;
        }
    }).autocomplete("instance")._renderItem = function (ul, item) {
        var item_to_render = "";

        if (item.products_name) {
            item_to_render = $("<li>")
                .append(`<div style="padding:10px"><div class="row"><div class="col-2 col-sm-3" style="padding:10px"><img style="width:60px" src="/${item.path}" /></div><div class="col-10 col-sm-9" style="padding-top:15px; padding-left:20px"> ${item.products_name} in <strong> ${item.categories_name}</strong></div></div><div>`)
                .appendTo(ul);
        } else {
            item_to_render = $("<li>")
                .append(`<div class="text-center"><a>  ${item.text} </a></div>`)
                .appendTo(ul);
        }
        return item_to_render;
    };

})(jQuery);