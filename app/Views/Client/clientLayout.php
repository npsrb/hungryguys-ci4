<?= $this->extend('layout'); ?>
<?= $this->section('style'); ?>
<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
    }

    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
    }

    .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
        z-index: 1500;
    }

    body {
        background-image: linear-gradient(180deg, var(--bs-body-secondary-bg), var(--bs-body-bg) 100px, var(--bs-body-bg));
    }



    .pricing-header {
        max-width: 700px;
    }



    img {
        max-width: 100%;
        max-height: 100%;
    }

    .carousel-item {
        display: block;
        margin-right: 0;
        flex: 0 0 calc(100% / 3);
    }

    .img-wrapper {
        height: 21vw;
    }

    @media screen and (min-width: 700px) {
        .carousel-inner {
            display: flex;
        }
    }

    @media screen and (max-width: 600px) {
        .carousel-inner {
            display: block;
        }

        #carousel-control {
            display: none;
        }

        .carousel-inner {
            padding: 1em !important;
        }
    }

    .carousel-inner {
        padding: 2em;
    }

    .card {
        margin: 0 0.5em;
        border-radius: 0;
        box-shadow: 2px 6px 8px 0 rgba(22, 22, 26, 0.18);
        font-size: 0.9em;
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 4vh;
        height: 4vh;
        background-color: #e1e1e1;
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0.5;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        opacity: 0.8;
    }
</style>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>

<body>
    <?= $this->include("components/toggle"); ?>
    <div class="container p-3">
        <header>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center link-body-emphasis text-decoration-none">
                    <span class="fs-4 fw-bold">Hungry Guys Store</span>
                </a>

                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none text-primary" href="#">Home</a>
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="https://wa.me/081259188983?text=generate">Contact</a>
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="https://wa.me/081259188983?text=generate">About Us</a>
                </nav>
            </div>

            <div class="pricing-header mx-auto text-center border-bottom">
                <h1 class="display-4 fw-normal ">Your Game Voucer Partner</h1>
                <p class="fs-5 text-body-secondary">Choose your game here</p>
            </div>
        </header>
        <?= $this->renderSection('clientContent'); ?>
    </div>
</body>

<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        const multipleItemCarousel = document.querySelector("#carouselExampleControls");

        if (window.matchMedia("(min-width:576px)").matches) {
            const carousel = new bootstrap.Carousel(multipleItemCarousel, {
                interval: false
            });

            var carouselWidth = $(".carousel-inner")[0].scrollWidth;
            var cardWidth = $(".carousel-item").width();

            var scrollPosition = 0;

            $(".carousel-control-next").on("click", function() {
                if (scrollPosition < carouselWidth - cardWidth * 4) {
                    scrollPosition = scrollPosition + cardWidth;
                    $(".carousel-inner").animate({
                        scrollLeft: scrollPosition
                    }, 600);
                }
            });
            $(".carousel-control-prev").on("click", function() {
                if (scrollPosition > 0) {
                    scrollPosition = scrollPosition - cardWidth;
                    $(".carousel-inner").animate({
                        scrollLeft: scrollPosition
                    }, 600);
                }
            });
        } else {
            $(multipleItemCarousel).addClass("slide");
        }
    });
</script>
<?= $this->endSection(); ?>