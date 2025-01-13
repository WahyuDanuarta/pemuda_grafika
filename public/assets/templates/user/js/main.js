/**
 * Template Name: Scaffold
 * Template URL: https://bootstrapmade.com/scaffold-bootstrap-metro-style-template/
 * Updated: Aug 07 2024 with Bootstrap v5.3.3
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */

(function () {
    ("use strict");

    /**
     * Apply .scrolled class to the body as the page is scrolled down
     */
    function toggleScrolled() {
        const selectBody = document.querySelector("body");
        const selectHeader = document.querySelector("#header");
        if (
            !selectHeader.classList.contains("scroll-up-sticky") &&
            !selectHeader.classList.contains("sticky-top") &&
            !selectHeader.classList.contains("fixed-top")
        )
            return;
        window.scrollY > 100
            ? selectBody.classList.add("scrolled")
            : selectBody.classList.remove("scrolled");
    }

    document.addEventListener("scroll", toggleScrolled);
    window.addEventListener("load", toggleScrolled);

    /**
     * Mobile nav toggle
     */
    const mobileNavToggleBtn = document.querySelector(".mobile-nav-toggle");

    function mobileNavToogle() {
        document.querySelector("body").classList.toggle("mobile-nav-active");
        mobileNavToggleBtn.classList.toggle("bi-list");
        mobileNavToggleBtn.classList.toggle("bi-x");
    }
    mobileNavToggleBtn.addEventListener("click", mobileNavToogle);

    /**
     * Hide mobile nav on same-page/hash links
     */
    document.querySelectorAll("#navmenu a").forEach((navmenu) => {
        navmenu.addEventListener("click", () => {
            if (document.querySelector(".mobile-nav-active")) {
                mobileNavToogle();
            }
        });
    });

    /**
     * Toggle mobile nav dropdowns
     */
    document
        .querySelectorAll(".navmenu .toggle-dropdown")
        .forEach((navmenu) => {
            navmenu.addEventListener("click", function (e) {
                e.preventDefault();
                this.parentNode.classList.toggle("active");
                this.parentNode.nextElementSibling.classList.toggle(
                    "dropdown-active"
                );
                e.stopImmediatePropagation();
            });
        });

    /**
     * Preloader
     */
    const preloader = document.querySelector("#preloader");
    if (preloader) {
        window.addEventListener("load", () => {
            preloader.remove();
        });
    }

    /**
     * Scroll top button
     */
    let scrollTop = document.querySelector(".scroll-top");

    function toggleScrollTop() {
        if (scrollTop) {
            window.scrollY > 100
                ? scrollTop.classList.add("active")
                : scrollTop.classList.remove("active");
        }
    }
    scrollTop.addEventListener("click", (e) => {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });

    window.addEventListener("load", toggleScrollTop);
    document.addEventListener("scroll", toggleScrollTop);

    /**
     * Animation on scroll function and init
     */
    function aosInit() {
        AOS.init({
            duration: 600,
            easing: "ease-in-out",
            once: true,
            mirror: false,
        });
    }
    window.addEventListener("load", aosInit);

    /**
     * Initiate glightbox
     */
    const glightbox = GLightbox({
        selector: ".glightbox",
    });

    /**
     * Init isotope layout and filters
     */
    document
        .querySelectorAll(".isotope-layout")
        .forEach(function (isotopeItem) {
            let layout = isotopeItem.getAttribute("data-layout") ?? "masonry";
            let filter = isotopeItem.getAttribute("data-default-filter") ?? "*";
            let sort =
                isotopeItem.getAttribute("data-sort") ?? "original-order";

            let initIsotope;
            imagesLoaded(
                isotopeItem.querySelector(".isotope-container"),
                function () {
                    initIsotope = new Isotope(
                        isotopeItem.querySelector(".isotope-container"),
                        {
                            itemSelector: ".isotope-item",
                            layoutMode: layout,
                            filter: filter,
                            sortBy: sort,
                        }
                    );
                }
            );

            isotopeItem
                .querySelectorAll(".isotope-filters li")
                .forEach(function (filters) {
                    filters.addEventListener(
                        "click",
                        function () {
                            isotopeItem
                                .querySelector(
                                    ".isotope-filters .filter-active"
                                )
                                .classList.remove("filter-active");
                            this.classList.add("filter-active");
                            initIsotope.arrange({
                                filter: this.getAttribute("data-filter"),
                            });
                            if (typeof aosInit === "function") {
                                aosInit();
                            }
                        },
                        false
                    );
                });
        });

    /**
     * Init swiper sliders
     */
    function initSwiper() {
        document
            .querySelectorAll(".init-swiper")
            .forEach(function (swiperElement) {
                let config = JSON.parse(
                    swiperElement
                        .querySelector(".swiper-config")
                        .innerHTML.trim()
                );

                if (swiperElement.classList.contains("swiper-tab")) {
                    initSwiperWithCustomPagination(swiperElement, config);
                } else {
                    new Swiper(swiperElement, config);
                }
            });
    }

    window.addEventListener("load", initSwiper);

    /**
     * Frequently Asked Questions Toggle
     */
    document
        .querySelectorAll(".faq-item h3, .faq-item .faq-toggle")
        .forEach((faqItem) => {
            faqItem.addEventListener("click", () => {
                faqItem.parentNode.classList.toggle("faq-active");
            });
        });

    /**
     * Correct scrolling position upon page load for URLs containing hash links.
     */
    window.addEventListener("load", function (e) {
        if (window.location.hash) {
            if (document.querySelector(window.location.hash)) {
                setTimeout(() => {
                    let section = document.querySelector(window.location.hash);
                    let scrollMarginTop =
                        getComputedStyle(section).scrollMarginTop;
                    window.scrollTo({
                        top: section.offsetTop - parseInt(scrollMarginTop),
                        behavior: "smooth",
                    });
                }, 100);
            }
        }
    });

    // // Fungsi untuk mengurutkan kategori
    // function sortCategories() {
    //   const kategoriList = document.getElementById("kategori-list");
    //   const kategoriItems = Array.from(kategoriList.querySelectorAll("li"));

    //   // Urutkan elemen berdasarkan teks di dalamnya
    //   kategoriItems.sort((a, b) => {
    //     const textA = a.textContent.trim().toLowerCase();
    //     const textB = b.textContent.trim().toLowerCase();
    //     return textA.localeCompare(textB); // Mengurutkan secara alfabet
    //   });

    //   // Hapus elemen lama dan tambahkan yang sudah diurutkan
    //   kategoriList.innerHTML = "";
    //   kategoriItems.forEach(item => kategoriList.appendChild(item));
    // }

    // Panggil fungsi setelah halaman dimuat
    document.addEventListener("DOMContentLoaded", function () {
        // Ambil semua dropdown toggle
        const dropdownToggles = document.querySelectorAll(".dropdown-toggle");

        // Tambahkan event click untuk setiap dropdown
        dropdownToggles.forEach((toggle) => {
            toggle.addEventListener("click", function (e) {
                // Mencegah aksi default agar link tidak berpindah halaman
                e.preventDefault();

                // Menemukan submenu terkait (ul yang berada setelah link)
                const dropdownMenu = this.nextElementSibling;

                // Toggle visibilitas dropdown menu (submenu)
                if (dropdownMenu && !dropdownMenu.classList.contains("show")) {
                    dropdownMenu.classList.add("show"); // Menampilkan submenu
                    this.parentNode.classList.add("active"); // Menandai kategori yang aktif
                } else {
                    dropdownMenu.classList.remove("show"); // Menutup submenu
                    this.parentNode.classList.remove("active"); // Menghapus tanda aktif
                }
            });
        });

        // Tutup dropdown jika area lain diklik
        document.addEventListener("click", function (e) {
            const dropdownMenus = document.querySelectorAll(".dropdown-menu");
            dropdownMenus.forEach((menu) => {
                // Pastikan klik bukan pada dropdown-toggle atau menu itu sendiri
                if (
                    !menu.contains(e.target) &&
                    !e.target.closest(".dropdown-toggle") &&
                    !e.target.closest(".dropdown")
                ) {
                    menu.classList.remove("show");
                    // Hapus kelas active dari kategori yang terbuka
                    menu.previousElementSibling.classList.remove("active");
                }
            });
        });
    });

    /**
     * Navmenu Scrollspy
     */
    let navmenulinks = document.querySelectorAll(".navmenu a");

    function navmenuScrollspy() {
        navmenulinks.forEach((navmenulink) => {
            if (!navmenulink.hash) return;
            let section = document.querySelector(navmenulink.hash);
            if (!section) return;
            let position = window.scrollY + 200;
            if (
                position >= section.offsetTop &&
                position <= section.offsetTop + section.offsetHeight
            ) {
                document
                    .querySelectorAll(".navmenu a.active")
                    .forEach((link) => link.classList.remove("active"));
                navmenulink.classList.add("active");
            } else {
                navmenulink.classList.remove("active");
            }
        });
    }
    window.addEventListener("load", navmenuScrollspy);
    document.addEventListener("scroll", navmenuScrollspy);
})();


    /**
     * Menu Wa
     */
    // Fungsi untuk mengubah status admin
    function updateAdminStatus(isOnline) {
        const statusElement = document.querySelector('.admin-status');
        if (isOnline) {
            statusElement.textContent = 'Chat Kami Sekarang!';
        } else {
            statusElement.textContent = 'Chat Kami Sekarang!';
        }
    }

    // Contoh penggunaan: Ubah status admin
    const adminIsOnline = false; // Ganti dengan kondisi nyata
    updateAdminStatus(adminIsOnline);


    //   bary
document.addEventListener("DOMContentLoaded", function () {
    const toggles = document.querySelectorAll(".dropdown-toggle");
    toggles.forEach(function (toggle) {
        toggle.addEventListener("click", function (e) {
            e.preventDefault();
            const dropdownMenu = this.nextElementSibling;
            if (dropdownMenu) {
                dropdownMenu.classList.toggle("dropdown-active");
            }
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", function (e) {
        if (!e.target.closest(".dropdown")) {
            document
                .querySelectorAll(".dropdown-active")
                .forEach(function (menu) {
                    menu.classList.remove("dropdown-active");
                });
        }
    });
});





