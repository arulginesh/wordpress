jQuery(document).ready(function () {
                    jQuery('.autoplay2').slick({
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 3000,
                        responsive: [
                            {
                                breakpoint: 991,
                                settings: {
                                    centerMode: true,
                                    centerPadding: '0px',
                                    slidesToShow: 3
                                }
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    centerMode: true,
                                    centerPadding: '0px',
                                    slidesToShow: 2
                                }
                            },
                            {
                                breakpoint: 480,
                                settings: {
                                    centerMode: true,
                                    centerPadding: '0px',
                                    slidesToShow: 1
                                }
                            }
                        ]
                    });
                });